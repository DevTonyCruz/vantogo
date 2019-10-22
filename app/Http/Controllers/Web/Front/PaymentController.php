<?php

namespace App\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function cartPayment(Request $request)
    {
        Conekta::setApiKey($this->conekta_private_key);
        Conekta::setApiVersion($this->conekta_api_version);

        $session = $request->session()->get('vantogo');

        $pasajeros = $session['pasajeros'];
        $cantidad = $session['cantidad'][0];
        $viaje = $session['viaje'][0];

        $travel = Travels::where('id', $viaje)->first();

        /*
            $table->integer('travel_id');
            $table->integer('cantidad');
            $table->float('total');
            $table->string('tipo_pago');
            $table->string('referencia');
            $table->integer('status');*/

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
            } catch (\Conekta\ProcessingError $error) {
                echo $error->getMessage();
            } catch (\Conekta\ParameterValidationError $error) {
                echo $error->getMessage();
            } catch (\Conekta\Handler $error) {
                echo $error->getMessage();
            }
        }
    }

    public function oxxoPayment()
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
}
