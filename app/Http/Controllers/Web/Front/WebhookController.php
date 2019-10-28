<?php

namespace App\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conekta;
use App\Models\Orders;
use Illuminate\Support\Facades\Mail;

class WebhookController extends Controller
{
    public function conekta_oxxo()
    {
        $body = @file_get_contents('php://input');
        $data = json_decode($body);
        http_response_code(200); // Return 200 OK

        if ($data->type == 'charge.paid') {

            \Log::debug('webhoook tipo: ' . $data->type);
            if($data->data->object->payment_method->type == 'oxxo'){
                \Log::debug('webhoook tipo: ' . $data->type);
                $conekta = Conekta::where('conekta_id', $data->data->object->order_id)->first();
                \Log::debug('Id de orden de conekta: ' . $conekta->order_id);

                if($conekta){                    
                    $order = Orders::where('id', $conekta->order_id)->first();
                    \Log::debug('Id de orden: ' . $order->id);
                    if($order){  
                        $order->status = 2;
                        if ($order->update()) {
                            //Mail::to($order->email)->send(new StatusOrderMail($order, $status_order));
                            \Log::debug('Se guardo el status de la orden');
                        }else{
                            \Log::debug('No es posible actualizar el process_id de la orden con id: ' . $order->id);
                        }
                    }else{
                        \Log::debug('No se encontro la orden de tallerdoce con el id: ' . $conekta->order_id);
                    }

                }else{
                    \Log::debug('No se encontro la orden de conekta con el order_id: ' . $data->data->object->order_id);
                }
            }
        }
    }
}
