<?php

namespace App\Http\Controllers\Web\Front;

use App\Exceptions\Handler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Mail\OrderCreateMail;
use App\Models\Conekta as AppConekta;
use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\Payment;
use App\Models\Travels;
use Carbon\Carbon;
use Conekta\Conekta;
use Conekta\Order;
use Conekta\ParameterValidationError;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    protected $conekta_private_key;
    protected $conekta_api_version;

    public function __construct()
    {
        $this->conekta_private_key = config('payment.conekta.private', '');
        $this->conekta_api_version = config('payment.conekta.api', '');
    }

    public function oxxoConektaPayment()
    {
        Conekta::setApiKey($this->conekta_private_key);
        Conekta::setApiVersion($this->conekta_api_version);

        $valid_order =
            array(
                'line_items' => array(
                    array(
                        'name'        => 'Box of Cohiba S1s',
                        'description' => 'Imported From Mex.',
                        'unit_price'  => 20000,
                        'quantity'    => 1,
                        'sku'         => 'cohb_s1',
                        'category'    => 'food',
                        'tags'        => array('food', 'mexican food')
                    )
                ),
                'currency'    => 'mxn',
                'metadata'    => array('test' => 'extra info'),
                'charges'     => array(
                    array(
                        'payment_method' => array(
                            'type'       => 'oxxo_cash',
                            'expires_at' => strtotime(date("Y-m-d H:i:s")) + "36000"
                        ),
                        'amount' => 20000
                    )
                ),
                'currency'      => 'mxn',
                'customer_info' => array(
                    'name'  => 'John Constantine',
                    'phone' => '+5213353319758',
                    'email' => 'hola@hola.com'
                )
            );

        try {
            $order = \Conekta\Order::create($valid_order);
            dd($order);
        } catch (\Conekta\ProcessingError $e) {
            dd($e->getMessage());
        } catch (\Conekta\ParameterValidationError $e) {
            dd($e->getMessage());
        }
    }

    public function initiated_order(Request $request)
    {
        // Validamos los datos recibidos del formulario
        $initiated_order = $this->validate_request($request);

        if ($initiated_order->error) {
            return response()->json(["data" => ["errors" => $initiated_order->data, "type" => "validation"]])->setStatusCode(400);
        }

        if ($request->tipo == 'conekta-card') {
            // Validamos token conekta
            $initiated_order = $this->validate_token_request($request);

            if ($initiated_order->error) {
                return response()->json(["data" => ["errors" => $initiated_order->data, "type" => "validation"]])->setStatusCode(400);
            }
        }

        // Validamos disponibilidad de asientos
        $disponibilidad = $this->disponibilidad($request);

        if ($disponibilidad->error) {

            $request->session()->forget('vantogo');
            $request->session()->flush();

            return response()->json(["data" => ["errors" => $disponibilidad->msg, "type" => "redirect", "place" => route('front.home.index')]])->setStatusCode(400);
        }

        // Inicia la transacción de creación de orden de compra
        DB::beginTransaction();

        // Creamos la orden y su detalle con los datos validados
        $create_orde = $this->create_order($request);

        if ($create_orde->error) {
            DB::rollback();
            return response()->json(["data" => ["errors" => $create_orde->msg, "type" => "process"]])->setStatusCode(400);
        }

        // Creamos el cargo en la plataforma de pago que seleccionamos
        $payment_method = $this->payment_method($create_orde->data, $request);

        if ($payment_method->error) {
            DB::rollback();
            return response()->json(["data" => ["errors" => $payment_method->msg, "type" => "process"]])->setStatusCode(400);
        }

        DB::commit();

        return $this->terminated_order($create_orde->data->order_code);
    }

    public function validate_request(Request $request)
    {
        $response = (object) ['error' => false, 'data' => []];

        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email',
        ];

        $messages = [
            'nombre.required' => 'El campo nombre del comprador es requerido',
            'apellido.required' => 'El campo apellido del comprador es requerido',
            'correo.required' => 'El campo correo electrónico del comprador es requerido',
            'correo.email' => 'El campo correo electrónico del comprador no es válido',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response->error = true;
            $response->data = $validator->errors();

            return $response;
        } else {
            $response->error = false;
            $response->data = [];

            return $response;
        }
    }

    public function validate_token_request(Request $request)
    {
        $response = (object) ['error' => false, 'data' => []];

        $rules = [
            'token' => 'required'
        ];

        $messages = [
            'token.required' => 'El token de pago es invalido, recarge el sitio y pruebe nuevamente'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            $response->error = true;
            $response->data = $validator->errors();

            return $response;
        } else {
            $response->error = false;
            $response->data = [];

            return $response;
        }
    }

    public function create_order(Request $request)
    {
        // Array de respuesta de este método
        $response = (object) ['error' => false, 'data' => [], 'msg' => ''];

        // Obtenemos la información de compra de la sesión activa
        $session_active = $request->session()->get('vantogo');
        try {

            // Creamos la orden de compra en donde almacenaremos la información
            $order = new Orders();
            $order->travel_id = $session_active["viaje"][0];
            $order->name = $request->nombre;
            $order->last_name = $request->apellido;
            $order->phone = $request->telefono;
            $order->email = $request->correo;
            $order->order_code = $this->get_order_code();

            if ($order->save()) {
                $create_details_order = $this->create_details_order($order->id, $session_active);

                if ($create_details_order->error) {
                    return $create_details_order;
                }

                $response->error = false;
                $response->msg = '';
                $response->data = $order;
            } else {

                $mensaje = "";
                foreach ($order->getMessages() as $message) {
                    $mensaje .= $message . ', ';
                }

                $mensaje = substr($mensaje, 0, -1);

                //agregar que hacer en caso de error, regresar dinero o intentar despues
                throw new \Exception('La orden no puede ser generada por lo siguiente: ' . $mensaje);
            }
        } catch (\Exception $e) {
            DB::rollback();

            $response->error = true;
            $response->msg = $e->getMessage();
            $response->data = [];
        } catch (\Throwable $e) {
            DB::rollback();
            $response->error = true;
            $response->msg = $e->getMessage();
            $response->data = [];
        }

        return $response;
    }

    public function create_details_order($order_id, $session_active)
    {
        $response = (object) ['error' => false, 'data' => [], 'msg' => ''];

        $total_pasajeros = count($session_active["pasajeros"]);
        if ($total_pasajeros > 0) {

            try {

                $order = Orders::where('id', $order_id)->first();

                $order->subtotal = $order->travel->route->price;
                $order->quantity = $total_pasajeros;
                $order->total = $total_pasajeros * $order->travel->route->price;

                if ($order->update()) {

                    $mensaje = "";
                    $error = false;
                    foreach ($session_active["pasajeros"] as $pasajero) {

                        $orderDetails = new OrdersDetails();
                        $orderDetails->order_id = $order->id;
                        $orderDetails->name = $pasajero["name"];
                        $orderDetails->last_name = $pasajero["last_name"];
                        $orderDetails->phone = $pasajero["phone"];
                        $orderDetails->email = $pasajero["email"];
                        $orderDetails->price = $order->travel->route->price;
                        $orderDetails->place = $pasajero["asiento"];

                        if (!$orderDetails->save()) {

                            foreach ($orderDetails->getMessages() as $message) {
                                $mensaje .= $message . ', ';
                            }

                            $mensaje = substr($mensaje, 0, -1);
                            throw new \Exception('La orden no puede ser generada por lo siguiente: ' . $mensaje);
                        }
                    }
                } else {

                    $mensaje = "";
                    foreach ($orderDetails->getMessages() as $message) {
                        $mensaje .= $message . ', ';
                    }

                    $mensaje = substr($mensaje, 0, -1);

                    //agregar que hacer en caso de error, regresar dinero o intentar despues
                    throw new \Exception('La orden no puede ser generada por lo siguiente: ' . $mensaje);
                }
            } catch (\Exception $e) {
                $response->error = true;
                $response->msg = $e->getMessage();
                $response->data = [];
            }
        } else {

            $response->error = true;
            $response->data = [];
            $response->msg = 'No cuenta con pasajeros agregados.';
        }

        return (object) $response;
    }

    public function payment_method($order, Request $request)
    {
        switch ($request->tipo) {
            case 'conekta-card':

                return $this->pay_order_conekta_cart($order, $request);

                break;
            case 'conekta-oxxo':

                return $this->pay_order_conekta_oxxo($order, $request);
                break;
            default:

                $response = (object) ['error' => false, 'data' => [], 'msg' => ''];
                $response->error = true;
                $response->msg = 'El método de pago seleccionado no es válido';
                $response->data = [];
                return $response;
                break;
        }
    }

    public function pay_order_conekta_cart($order, Request $request)
    {
        $response = (object) ['error' => false, 'data' => [], 'msg' => ''];

        Conekta::setApiKey($this->conekta_private_key);
        Conekta::setApiVersion($this->conekta_api_version);

        $order = Orders::where('id', $order->id)->first();
        if ($order) {

            try {

                $conekta_order = \Conekta\Order::create(
                    array(
                        "line_items" => [
                            [
                                "name" => "Pago de boleto",
                                "unit_price" => $order->total * 100,
                                "quantity" => 1
                            ]
                        ],
                        "currency" => "MXN",
                        "customer_info" => array(
                            "name" => $request->nombre . ' ' . $request->apellido,
                            "email" => $request->correo,
                            "phone" => $request->telefono
                        ),
                        /*"shipping_contact" => array(
                            "address" => array(
                                "street1" => "Vantogo",
                                "postal_code" => "45000",
                                "country" => "MX"
                            ) 
                        ),*/
                        "charges" => array(
                            array(
                                "payment_method" => array(
                                    //"monthly_installments" => 3,
                                    "type" => "card",
                                    "token_id" => $request->token
                                ) //payment_method - use customer's default - a card
                                //to charge a card, different from the default,
                                //you can indicate the card's source_id as shown in the Retry Card Section
                            ) //first charge
                        ) //charges
                    ) //order
                );

                if ($conekta_order->payment_status == 'paid') {
                    $order->status = 2;
                    $order->update();
                }

                $conekta = new AppConekta();
                $conekta->order_id = $order->id;
                $conekta->conekta_id = $conekta_order->id;
                $conekta->payment_method = 'card';
                $conekta->reference = $conekta_order->charges[0]->payment_method->reference;
                $conekta->amount = $conekta_order->amount / 100;

                $conekta->save();

                $response->error = false;
                $response->msg = '';
                $response->data = $conekta_order;
            } catch (\Conekta\ProcessingError $error) {

                $response->error = true;
                $response->msg = $error->getMessage();
                $response->data = [];
            } catch (\Conekta\ParameterValidationError $error) {

                $response->error = true;
                $response->msg = $error->getMessage();
                $response->data = [];
            } catch (\Conekta\Handler $error) {

                $response->error = true;
                $response->msg = $error->getMessage();
                $response->data = [];
            }
        } else {

            $response->error = true;
            $response->msg = 'La orden que se esta buscando no existe.';
            $response->data = [];
        }

        return $response;
    }

    private function pay_order_conekta_oxxo($order, Request $request)
    {
        Conekta::setApiKey($this->conekta_private_key);
        Conekta::setApiVersion($this->conekta_api_version);

        // Array de respuesta de este método
        $response = (object) ['error' => false, 'msg' => '', 'data' => []];

        $order = Orders::where('id', $order->id)->first();

        if ($order) {

            try {
                $date_now = new Carbon(now());
                $add_hours = $date_now->addHours(1);
                $expire_oxxo = strtotime($add_hours);

                $conekta_order = Order::create(
                    [
                        "line_items" => [
                            [
                                "name" => "Pago de boleto",
                                "unit_price" => $order->total * 100,
                                "quantity" => 1
                            ]
                        ],
                        "currency" => "MXN",
                        "customer_info" => array(
                            "name" => $request->nombre . ' ' . $request->apellido,
                            "email" => $request->correo,
                            "phone" => $request->telefono
                        ),
                        /*"shipping_contact" => [
                            "address" => $address
                        ],*/
                        "charges" => array(
                            array(
                                "payment_method" => array(
                                    "type" => "oxxo_cash",
                                    'expires_at' => $expire_oxxo
                                )
                            )
                        )
                    ]
                );

                // Guardar en tabla de compras de conekta
                $chargeSuccess = (object) [
                    "order_id" => $order->id,
                    "conekta_id" => $conekta_order->id,
                    "payment_method" => $conekta_order->charges[0]->payment_method->service_name,
                    "type_payment" => 'oxxo',
                    "reference" => $conekta_order->charges[0]->payment_method->reference,
                    "amount" => $conekta_order->amount / 100,
                    "currency" => $conekta_order->currency
                ];

                $conekta = new AppConekta();
                $conekta->order_id = $order->id;
                $conekta->conekta_id = $conekta_order->id;
                $conekta->payment_method = 'oxxo';
                $conekta->reference = $conekta_order->charges[0]->payment_method->reference;
                $conekta->amount = $conekta_order->amount / 100;

                $conekta->save();

                $response->data = $chargeSuccess;
                $response->error = false;
                $response->code = 200;
                $response->msg = '';

                return $response;
            } catch (ParameterValidationError $error) {
                $response->data = [];
                $response->error = true;
                $response->msg = $error->getMessage();
            } catch (Handler $error) {
                $response->data = [];
                $response->error = true;
                $response->msg = $error->getMessage();
            } catch (QueryException $error) {
                $response->data = [];
                $response->error = true;
                $response->msg = $error->getMessage();
            }
        } else {
            $response->data = [];
            $response->error = true;
            $response->msg = 'La orden que intenta obtener no existe';
        }

        return $response;
    }

    public function terminated_order($order_code)
    {
        $order = Orders::where('order_code', $order_code)->first();
        /*$configuracion = Configuration::where('alias', 'telefono_contacto')->first();
        $telefono = ($configuracion) ? $configuracion->telefono_contacto : 3333333333;

        $order->telefono_contacto = $telefono;*/
        Mail::to($order->email)->send(new OrderCreateMail($order));

        $data = [
            "order_code" => $order_code,
            "redirect" => route('front.home.final')
        ];

        return response()->json(["data" => $data])->setStatusCode(200);
    }

    public function disponibilidad(Request $request)
    {

        $response = (object) ['error' => false, 'data' => [], 'msg' => ''];

        $session_active = $request->session()->get('vantogo');
        $travel_id = $session_active["viaje"][0];
        $travel = Travels::where('id', $travel_id)->first();

        $ocupados = $travel->orders;

        $asientos = [];
        foreach ($ocupados as $ocupado) {
            foreach ($ocupado->details as $asiento) {
                array_push($asientos, $asiento->place);
            }
        }

        $disponibles = true;
        foreach ($session_active["pasajeros"] as $asiento) {
            if (in_array($asiento["asiento"], $asientos)) {
                $disponibles = false;
            }
        }

        if ($disponibles) {
            $response->error = false;
            $response->msg = '';
            $response->data = [];
        } else {
            $response->error = true;
            $response->msg = 'Lo sentimos pero los asientos seleccionados actualmente ya se ocuparon, el proceso se reiniciara en 5 segundos.';
            $response->data = [];
        }

        return $response;
    }























    public function payment_finish($code)
    {
        $order = Orders::where('order_code', $code)->first();

        return view('front.payment.response', [
            "order" => $order
        ]);
    }

    private function get_order_code()
    {
        $order_code = strtoupper(str_random(15));

        $orders = Orders::where('order_code', $order_code)->count();

        if ($orders > 0) {
            $this->get_order_code();
        } else {
            return $order_code;
        }
    }
}
