<?php

namespace App\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Models\Travels;
use Conekta\Conekta;

class PaymentController extends Controller
{
    protected $conekta_private_key;
    protected $conekta_api_version;

    public function __construct()
    {
        $this->conekta_private_key = config('payment.conekta.private', '');
        $this->conekta_api_version = config('payment.conekta.api', '');
    }

    public function cartConektaPayment(PaymentRequest $requestt)
    {
        dd('llego 1');
        Conekta::setApiKey($this->conekta_private_key);
        Conekta::setApiVersion($this->conekta_api_version);

        $initiated_order = $this->validate_request($request);

        if ($initiated_order->error) {
            return response()->json(["data" => $initiated_order])->setStatusCode(400);
        }

        $session = $request->session()->get('vantogo');

        $pasajeros = $session['pasajeros'];
        $cantidad = $session['cantidad'][0];
        $viaje = $session['viaje'][0];

        $travel = Travels::where('id', $viaje)->first();

        $newOrder = new Payment();
        $newOrder->travel_id = $viaje;
        $newOrder->cantidad = $cantidad;
        $newOrder->total = $travel->route->price * $cantidad;

        if($newOrder->save()){

            try {
                $order = \Conekta\Order::create(
                    array(
                        "line_items" => [
                            [
                                "name" => "Pago de boleto",
                                "unit_price" => $travel->route->price * 100,
                                "quantity" => $cantidad
                            ]
                        ],
                        "currency" => "MXN",
                        "customer_info" => array(
                            "name" => $pasajeros[0]['name'] . ' ' . $pasajeros[0]['apellido'],
                            "email" => "<a href=\"mailto:" . $pasajeros[0]['email'] . "\">" . $pasajeros[0]['email'] . "</a>",
                            "phone" => $pasajeros[0]['phone']
                        ), //customer_info
                        "shipping_contact" => array(
                            "address" => array(
                                "street1" => "Calle 123, int 2",
                                "postal_code" => "06100",
                                "country" => "MX"
                            ) //address
                        ), 
                        "charges" => array(
                            array(
                                "payment_method" => array(
                                    //"monthly_installments" => 3,
                                    "type" => "card",
                                    "token_id" => "tok_test_visa_4242"
                                ) //payment_method - use customer's default - a card
                                //to charge a card, different from the default,
                                //you can indicate the card's source_id as shown in the Retry Card Section
                            ) //first charge
                        ) //charges
                    ) //order
                );

                dd($order);
            } catch (\Conekta\ProcessingError $error) {
                dd($error->getMessage());
            } catch (\Conekta\ParameterValidationError $error) {
                dd($error->getMessage());
            } catch (\Conekta\Handler $error) {
                dd($error->getMessage());
            }
        }
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
            return response()->json(["data" => $initiated_order])->setStatusCode(400);
        }

        // Inicia la transacción de creación de orden de compra
        DB::beginTransaction();

        // Creamos la orden y su detalle con los datos validados
        $create_orde = $this->create_order($initiated_order);

        if ($create_orde->error) {
            DB::rollback();
            return response()->json(["data" => $create_orde])->setStatusCode(400);
        }

        // Creamos el cargo en la plataforma de pago que seleccionamos
        $payment_method = $this->payment_method($create_orde->data, $request);

        if ($payment_method->error) {
            DB::rollback();
            return response()->json(["data" => $payment_method])->setStatusCode(400);
        }

        DB::commit();

        return $this->terminated_order($create_orde->data->order_code, $payment_method);
    }

    public function validate_request(PaymentRequest $request)
    {

        dd('llego');


        // Crear order_code y validar que no exista
        /*$order_code = $this->get_order_code();

        $data_create_order = (object) [
            "shipping_id" => $shipping_id_request,
            "invoice_id" => $invoice_id_request,
            "receive_store" => $receiver_store_request,
            "name_receive_store" => $name_receiver_store_request,
            "phone_receive_store" => $phone_receiver_store_request,
            "sucursal_receiver_store" => $sucursal_receiver_store_request,
            "user_id" => $shipping_id_request,
            "email" => $user_email_request,
            "order_code" => $order_code,
            "user_type" => $user_type,
            "payment_type" => $type_payment_request,
            "local_id" => $request->id_local,
            "error" => false
        ];

        $response->error = false;
        $response->code = 200;
        $response->msg = '';
        $response->data = $data_create_order;

        return $response;*/
    }

    public function create_order($initiated_order)
    {
        // Array de respuesta de este método
        $response = (object) ['error' => false, 'msg' => '', 'code' => 400, 'data' => []];

        try {

            // Creamos la orden de compra en donde almacenaremos la información
            $order = new Orders();
            $order->shipping_id = $initiated_order->data->shipping_id;
            $order->invoice_id = $initiated_order->data->invoice_id;
            $order->receive_store = $initiated_order->data->receive_store;
            $order->name_receive_store = $initiated_order->data->name_receive_store;
            $order->phone_receive_store = $initiated_order->data->phone_receive_store;
            $order->sucursal_receive_store = $initiated_order->data->sucursal_receiver_store;
            $order->user_id = (Auth::user() && Auth::user()->rol_id == 2) ? Auth::user()->id : null;
            $order->email = $initiated_order->data->email;
            $order->order_code = $initiated_order->data->order_code;
            $order->user_type = $initiated_order->data->user_type;

            if ($order->save()) {
                $order->fill(['folio_consecutive' => str_pad($order->id, 5, "0", STR_PAD_LEFT)])->save();

                $shoppingCart = ShoppingCart::where('local_id', $initiated_order->data->local_id)->first();

                if (!is_null($shoppingCart->coupon_id)) {
                    $validate_coupon = $this->validate_coupon($shoppingCart->coupon_id);

                    if ($validate_coupon->error) {
                        // return response()->json(["data" => $validate_coupon])->setStatusCode(400);
                        return $validate_coupon;
                    }
                }

                $create_details_order = $this->create_details_order($order->id, $shoppingCart->id);

                if ($create_details_order->error) {
                    //return response()->json(["data" => $create_details_order])->setStatusCode(400);
                    return $create_details_order;
                }

                $response->error = false;
                $response->msg = '';
                $response->code = 200;
                $response->data = $order;
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

    public function create_details_order($order_id, $shoppingCart_id)
    {
        $response = (object) ['error' => false, 'msg' => '', 'code' => 400, 'data' => []];
        $data_shopping_cart["id"] =  $shoppingCart_id;
        $data_shopping_cart["msg"] = 'Carrito obtenido con éxito';

        $ShoppingCartObject = new CartController();
        $shoppingCartProducts = $ShoppingCartObject->total_in_shopping_cart($data_shopping_cart);
        $productos = $shoppingCartProducts["productos"];

        if (count($productos) > 0) {

            try {

                $order = Orders::where('id', $order_id)->first();
                $order->subtotal = $shoppingCartProducts["subtotal"];
                if ($order->receive_store == 1) {
                    $order->total = $shoppingCartProducts["subtotal"] - $shoppingCartProducts["discount"];
                    $order->shipping_price = 0;
                } else {
                    $order->total = $shoppingCartProducts["total"];
                    $order->shipping_price = $shoppingCartProducts["shipping"];
                }
                $order->coupon_discount = $shoppingCartProducts["discount"];
                $order->quantity = $shoppingCartProducts["quantity"];
                $order->coupon_id = $shoppingCartProducts["coupon_id"];
                $order->process_id = 1;

                if ($order->save()) {

                    $status_order = new Status_order();
                    $status_order->order_id = $order->id;
                    $status_order->message = 'La orden a sido registrada con éxito';
                    $status_order->status = 1;
                    $status_order->save();

                    foreach ($productos as $producto) {

                        $orderDetails = new OrdersDetail();
                        $orderDetails->order_id = $order->id;
                        $orderDetails->product_id = $producto["id"];
                        $orderDetails->quantity = $producto["quantity"];
                        $orderDetails->shipping_price = $producto["shipping"];
                        $orderDetails->price = $producto["price"];

                        $data = (object) [
                            "product_id" => $producto["id"],
                            "quantity" => $producto["quantity"],
                            "order_folio" => $order->folio_consecutive
                        ];
                        $this->remove_stock($data);

                        if (!$orderDetails->save()) {

                            $mensaje = "";
                            foreach ($orderDetails->getMessages() as $message) {
                                $mensaje .= $message . ', ';
                            }

                            $mensaje = substr($mensaje, 0, -1);

                            //agregar que hacer en caso de error, regresar dinero o intentar despues
                            throw new \Exception('Existe un problema en el producto ' . $producto->name . ' por lo siguiente: ' . $mensaje);
                        }

                        ShoppingCartDetails::where('shopping_cart_id', $shoppingCart_id)->delete();

                        $response->error = false;
                        $response->code = 200;
                        $response->msg = 'Pedido creado con éxito';
                        $response->data = [
                            "order_id" => $order->id,
                            "order_folio" => $order->folio_consecutive,
                        ];
                    }
                } else {

                    $mensaje = "";
                    foreach ($order->getMessages() as $message) {
                        $mensaje .= $message . ', ';
                    }

                    $mensaje = substr($mensaje, 0, -1);

                    //agregar que hacer en caso de error, regresar dinero o intentar despues

                    $response->error = true;
                    $response->msg = 'La orden no puede ser generada por lo siguiente: ' . $mensaje;
                    $response->data = [];

                    //throw new \Exception('La orden no puede ser generada por lo siguiente: ' . $mensaje);
                }
            } catch (\Exception $e) {

                $response->error = true;
                $response->msg = $e->getMessage();
                $response->data = [];
            }
        } else {

            $response->error = true;
            $response->msg = 'No cuenta con productos en su carrito';
            $response->data = [];
        }

        return (object) $response;
    }

    public function payment_method($order, Request $request)
    {
        switch ($request->type_payment) {
            case 'openpay_cart':

                return $this->pay_order_openpay_cart($order, $request);

                break;
            case 'conekta_oxxo':

                return $this->pay_order_conekta_oxxo($order, $request);
                break;
            default:
                return response()->json([])->setStatusCode(400, 'El método de pago seleccionado no es válido');
                break;
        }
    }

    public function terminated_order($order_code, $payment_method)
    {
        $order = Orders::where('order_code', $order_code)->first();
        $configuracion = Configuration::where('alias', 'telefono_contacto')->first();
        $telefono = ($configuracion) ? $configuracion->telefono_contacto : 3333333333;

        $order->telefono_contacto = $telefono;
        Mail::to($order->email)->send(new OrderCreateMail($order));

        if($payment_method->data->type_payment == 'openpay'){
            $data = [
                "order_code" => $order_code,
                "redirect" => $payment_method->data->redirect
            ];
        }

        if($payment_method->data->type_payment == 'oxxo'){
            $data = [
                "order_code" => $order_code
            ];
        }

        return response()->json(["data" => $data])->setStatusCode(200);
    }

    private function pay_order_openpay_cart($order, Request $request)
    {
        $order_id = $order->id;
        $deviceIdHiddenFieldName = $request->deviceIdHiddenFieldName;

        // Array de respuesta de este método
        $response = (object) ['error' => false, 'msg' => '', 'code' => 400, 'data' => []];

        $openpay = \Openpay::getInstance(
            $this->openpay_id,
            $this->openpay_private_key
        );

        $token_id = $this->validate_string_request($request->token_id, 'Token de pago de openpay');

        // El local id siempre es obligatorio para poder generar un pedido
        $token_id_request = null;
        if ($token_id->error) {
            $response->data = [];
            $response->error = true;
            $response->msg = $token_id->msg;
            return $response;
        } else {
            $token_id_request = $request->token_id;
        }

        $order = Orders::where('id', $order_id)->first();

        if ($order) {

            $customer = [];
            if ($order->receive_store == 1) {
                $customer = [
                    'name' => 'Tallerdoce',
                    'last_name' => 'Cliente recoge en sucursal',
                    'phone_number' => '',
                    'email' => $order->email,
                ];
            } else {
                if (is_null($order->user_id)) {

                    $customer = [
                        'name' => $order->shipping_address->name,
                        'last_name' => $order->shipping_address->first_last_name . ' ' . $order->shipping_address->second_last_name,
                        'phone_number' => $order->phone,
                        'email' => $order->email,
                    ];
                } else {
                    $customer = [
                        'name' => $order->cliente[0]->name,
                        'last_name' => $order->cliente[0]->first_last_name . ' ' . $order->cliente[0]->second_last_name,
                        'phone_number' => $order->phone,
                        'email' => $order->email,
                    ];
                }
            }

            $chargeData = [
                'method' => 'card',
                'source_id' => $token_id_request,
                'amount' => (float) round($order->total, 2),
                'description' => 'Compra reaizada a taller doce por el usuario con el correo ' . $order->email,
                'device_session_id' => $deviceIdHiddenFieldName,
                'customer' => $customer,
                'use_3d_secure' => true,
                'redirect_url' => url('payment/openpay/payment-secure/' . $order->id)
            ];

            try {
                $charge = $openpay->charges->create($chargeData);

                $chargeSuccess = (object) [
                    "id_charge" => $charge->id,
                    "authorization" => $charge->authorization,
                    "method" => $charge->card->type,
                    "operation_type" => $charge->operation_type,
                    "type_payment" => 'openpay',
                    "amount" => $charge->amount,
                    "user_email" => $order->email,
                    "id_order" => $order->id,
                    "redirect" => $charge->payment_method->url,
                ];

                $openpay = new Openpay();
                $openpay->id_charge = $charge->id;
                $openpay->authorization = $charge->authorization;
                $openpay->method = $charge->card->type;
                $openpay->operation_type = $charge->operation_type;
                $openpay->amount = $charge->amount;
                $openpay->user_email = $order->email;
                $openpay->order_id = $order->id;

                if ($openpay->save()) {

                    $response->data = $chargeSuccess;
                    $response->error = false;
                    $response->code = 200;
                    $response->msg = '';

                    //Log::error('Error: No se a logrado cambiar el estatus del pedido. Order ID: ' . $order->id);
                } else {
                    $response->data = $chargeSuccess;
                    $response->error = false;
                    $response->code = 200;
                    $response->msg = '';

                    //Log::error('Error: No se a logrado almacenar los datos del método de pago de openpay. Order ID: ' . $order->id);
                }
            } catch (OpenpayApiTransactionError $e) {

                $response->data = [];
                $response->error = true;
                $response->msg = 'Error: ' . $e->getMessage() . ' Código de error: ' . $e->getErrorCode();
                error_log('ERROR on the transaction: ' . $e->getMessage() .
                    ' [error code: ' . $e->getErrorCode() .
                    ', error category: ' . $e->getCategory() .
                    ', HTTP code: ' . $e->getHttpCode() .
                    ', request ID: ' . $e->getRequestId() . ']', 0);
            } catch (OpenpayApiRequestError $e) {
                $response->data = [];
                $response->error = true;
                $response->msg = 'Error: ' . $e->getMessage() . ' Código de error: ' . $e->getErrorCode();
                error_log('ERROR on the request: ' . $e->getMessage(), 0);
            } catch (OpenpayApiConnectionError $e) {
                $response->data = [];
                $response->error = true;
                $response->msg = 'Error: ' . $e->getMessage() . ' Código de error: ' . $e->getErrorCode();
                error_log('ERROR while connecting to the API: ' . $e->getMessage(), 0);
            } catch (OpenpayApiAuthError $e) {
                $response->data = [];
                $response->error = true;
                $response->msg = 'Error: ' . $e->getMessage() . ' Código de error: ' . $e->getErrorCode();
                error_log('ERROR on the authentication: ' . $e->getMessage(), 0);
            } catch (OpenpayApiError $e) {
                $response->data = [];
                $response->error = true;
                $response->msg = 'Error: ' . $e->getMessage() . ' Código de error: ' . $e->getErrorCode();
                error_log('ERROR on the API: ' . $e->getMessage(), 0);
            } catch (Exception $e) {
                $response->data = [];
                $response->error = true;
                $response->msg = 'Error: ' . $e->getMessage() . ' Código de error: ' . $e->getErrorCode();
                error_log('Error on the script: ' . $e->getMessage(), 0);
            }
        } else {
            $response->data = [];
            $response->error = true;
            $response->msg = 'La orden que intenta obtener no existe';
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

    private function pay_order_conekta_oxxo($order, Request $request)
    {

        Conekta::setApiKey($this->conekta_private_key);
        Conekta::setApiVersion($this->conekta_api_version);

        // Array de respuesta de este método
        $response = (object) ['error' => false, 'msg' => '', 'code' => 400, 'data' => []];

        $order_id = $order->id;
        $order = Orders::where('id', $order_id)->first();

        if ($order) {
            // Generamos el arreglo de productos comprados
            $items = [];

            $item = [
                "name" => 'Compra en TallerDoce',
                "unit_price" => ($order->total) * 100,
                "quantity" => 1
            ];

            array_push($items, $item);

            // Obtenemos el total de costo de envío
            $shipping = [
                //"amount" => $order->shipping_price,
                "amount" => 0,
                "carrier" => "FEDEX"
            ];

            // Obtenemos la los datos de contacto
            $customer = [];
            $address = [];
            $phone = '';
            if ($order->receive_store == 1) {

                $configuracion = Configuration::where('alias', 'telefono_contacto')->first();

                if ($configuracion) {
                    $phone = $configuracion->value;
                }

                $customer = [
                    'name' => 'Tallerdoce',
                    'phone' => $phone,
                    'email' => $order->email,
                ];

                $address = [
                    "street1" => "Dirección taller doce",
                    "city" => "Guadalajara",
                    "state" => "Jalisco",
                    "postal_code" => "06100",
                    "country" => "MX"
                ];
            } else {
                if (is_null($order->user_id)) {

                    if ($order->shipping_address->phone) {
                        $phone = $order->shipping_address->phone;
                    }

                    $customer = [
                        'name' => $order->shipping_address->name . ' ' . $order->shipping_address->first_last_name . ' ' . $order->shipping_address->second_last_name,
                        'phone' => $phone,
                        'email' => $order->email,
                    ];
                } else {

                    if ($order->cliente[0]->phone) {
                        $phone = $order->cliente[0]->phone;
                    } elseif ($order->shipping_address->phone) {
                        $phone = $order->shipping_address->phone;
                    }

                    $customer = [
                        'name' => $order->cliente[0]->name . ' ' . $order->cliente[0]->first_last_name . ' ' . $order->cliente[0]->second_last_name,
                        'phone' => $phone,
                        'email' => $order->email,
                    ];
                }

                $direccion = (!is_null($order->shipping_address->direction)) ? $order->shipping_address->direction : '';
                $direccion .= (!is_null($order->shipping_address->exterior)) ? ' ' . $order->shipping_address->exterior : '';
                $direccion .= (!is_null($order->shipping_address->interior)) ? ' Interior ' . $order->shipping_address->interior : '';
                $direccion .= (!is_null($order->shipping_address->sepomex->name)) ? ', ' . $order->shipping_address->sepomex->name : '';
                $zip_code = (!is_null($order->shipping_address->sepomex->zip_code)) ? $order->shipping_address->sepomex->zip_code : '';
                $location = (!is_null($order->shipping_address->sepomex->location)) ? $order->shipping_address->sepomex->location : '';
                $state = (!is_null($order->shipping_address->sepomex->state)) ? $order->shipping_address->sepomex->state : '';

                $address = [
                    "street1" => $direccion,
                    "city" => $location,
                    "state" => $state,
                    "postal_code" => $zip_code,
                    "country" => "MX"
                ];
            }

            try {
                $configuracion = Configuration::where('alias', 'expirate_oxxo')->first();
                $date_now = new Carbon(now());
                $dias = ($configuracion) ? $configuracion->value : 5;
                $add_days = $date_now->addDays($dias);
                $expire_oxxo = strtotime($add_days);

                $conekta_order = Order::create(
                    [
                        //"line_items" => $items,
                        "line_items" => [
                            $item
                        ],
                        "shipping_lines" => [
                            $shipping
                        ],
                        "currency" => "MXN",
                        "customer_info" => $customer,
                        "shipping_contact" => [
                            "address" => $address
                        ],
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
                $conekta->payment_method = $conekta_order->charges[0]->payment_method->service_name;
                $conekta->reference = $conekta_order->charges[0]->payment_method->reference;
                $conekta->amount = $conekta_order->amount / 100;
                $conekta->currency = $conekta_order->currency;

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
                return $response;
                //echo $error->getMessage();
            } catch (Handler $error) {
                $response->data = [];
                $response->error = true;
                $response->msg = $error->getMessage();
                return $response;
                //echo $error->getMessage();
            } catch (QueryException $error) {
                $response->data = [];
                $response->error = true;
                $response->msg = $error->getMessage();
                return $response;
            }
        } else {
            $response->data = [];
            $response->error = true;
            $response->msg = 'La orden que intenta obtener no existe';
        }

        return $response;
    }

    public function validate_coupon($coupon_id)
    {
        $coupon = Coupons::where('id', $coupon_id)->first();

        if (!$coupon) {

            $data = [
                "error" => true,
                "msg" => "El cupón que desea utilizar no existe"
            ];

            return (object) $data;
        }

        $couponsObj = new CouponsController();

        //validate status
        $status = $couponsObj->validate_status($coupon);
        if ($status->error) {

            return $status;
        }

        //validate user
        $user = $couponsObj->validate_user($coupon);
        if ($user->error) {
            return $user;
        }

        //validate dates
        $dates = $couponsObj->validate_dates($coupon);
        if ($dates->error) {
            return $dates;
        }

        //validate uses
        $uses = $couponsObj->validate_uses($coupon);
        if ($uses->error) {
            return $uses;
        }

        $data = [
            "error" => false,
            "msg" => "Cupón válido"
        ];
        return (object) $data;
    }

    public function remove_stock($data)
    {
        $sotck = Stock::where('product_id', $data->product_id)->first();

        $moves = new StockMoves();
        $moves->description = 'Compra de la orden #' . $data->order_folio;
        $moves->type_move = 'Salida';
        $moves->product_id = $data->product_id;
        $moves->stock_old = $sotck->quantity;
        $moves->stock_add = $data->quantity;
        $moves->stock_new = $sotck->quantity - $data->quantity;
        $moves->user = 0;
        $moves->save();

        $sotck->quantity = $sotck->quantity - $data->quantity;

        if (!$sotck->update()) {
            StockMoves::where('id', $moves->id)->delete();
        }
    }
}
