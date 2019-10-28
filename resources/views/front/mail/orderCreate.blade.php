<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="{{ config('app.name', 'Laravel') }}" name="description" />
    <meta content="AdrenalinaLabs" name="author" />

    <!-- URL app -->
    <meta name="url-app" content="{{ config('app.url', 'http://localhost') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @php
        $bootstrap = 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css';
    @endphp
    <style type="text/css">
        {!! file_get_contents(asset($bootstrap)) !!}
        {!! file_get_contents(asset('front/css/custom.css')) !!}
    </style>

</head>

<body>
    <div class="row no-gutters row_main_mod2 mb-5">


        <div class="col-10 m-auto">
            <div class="col-12">
                <div class="row no-gutters">
                    <div class="col-md-12 col6-informacion_mod3 p-3">

                        <div class="row">

                            <div class="col-12 py-3 text-center">
                                <img src="{{ asset('admin/images/logo-light.png') }}" class="img-fluid" width="250">
                            </div>

                            <div class="col-12 text-center">
                                <h4 class="title-final">HOLA {{ $order->name . ' ' . $order->last_name }}</h4>
                                <p class="text-14">Gracias por tu compra, a continuación verás los datos de tu boleto.</p>
                                <h4 class="title-final">{{ $order->travel->route->origin }} - {{ $order->travel->route->destination }}</h4>
                            </div>

                            <div class="col-6">

                                <div class="col3_mod4_ticket">
                                    <div class="div_ticket_main_mod4 text-center">

                                        <div class="font12_mod4"><img src="{{ asset('front/img/icon_fecha_na.png')}}"
                                                alt=""> FECHA DE SALIDA
                                        </div>
                                        @php
                                        $date = explode('/',
                                        \Carbon\Carbon::parse($order->travel->date)->format('m/d/Y'));
                                        @endphp
                                        <div class="fecha_ticket_col3_mod4">{{ $date[1] }} / {{ $date[0] }} /
                                            {{ $date[2] }}
                                        </div>
                                        <hr class="hr_mod4">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="font12_mod4"><span><img
                                                            src="{{ asset('front/img/icon_reloj_na.png')}}"
                                                            alt=""></span>
                                                    SALIDA</div>
                                                <div>{{ substr($order->travel->hour_ini, 0, 5) }}</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="font12_mod4"><span><img
                                                            src="{{ asset('front/img/icon_reloj_na.png')}}"
                                                            alt=""></span>
                                                    LLEGADA</div>
                                                <div>{{ substr($order->travel->hour_fin, 0, 5) }}</div>
                                            </div>
                                        </div>
                                        <hr class="hr_mod4">

                                        <div class="row div_ticket_row2_mod4">
                                            <div class="col-md-7"><img class="img_100"
                                                    src="{{asset('front/img/icon_van_na.png')}}" alt="">
                                                <span class="img_chofer_ticket_b"><img
                                                        class="rounded-circle driver-photo-ticket-view" width="50"
                                                        height="50"
                                                        src="{{ asset($order->travel->driver->file_driver) }}"></span>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="title_chofer">Tu chofer:</div>
                                                <div class="color_gray">{{ $order->travel->driver->fullname()}}</div>
                                                <div class="title_chofer">{{ $order->travel->car->registration}}</div>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                            </div>

                            <div class="col-6">

                                <div class="col3_mod4_ticket">
                                    <div class="div_ticket_main_mod4 text-center">

                                        <div class="row ticket_pasajero_mod3">
                                            @php
                                             $count = 0;   
                                            @endphp
                                            @foreach ($order->details as $pasajeros)
                                            <div class="col-md-12">
                                                <div class="font12_mod4"><span><img
                                                            src="{{asset('front/img/icon_pasajero_na.png')}}"
                                                            alt=""></span>
                                                    PASAJERO</div>
                                                <div class="color_gray_izq">
                                                    <div class="color_gray">
                                                        {{ $pasajeros->name . ' ' . $pasajeros->last_name }}</div>
                                                    <div class="color_gray">{{ $pasajeros->email }}</div>
                                                    <div class="color_gray">{{ $pasajeros->phone }}</div>
                                                    <div class="font12_mod4">ASIENTO {{ $pasajeros->place }}</div>
                                                </div>
                                                @if($count > 0)
                                                <hr class="hr_mod4">
                                                @endif
                                                @php
                                                 $count++;   
                                                @endphp
                                            </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="col-12 py-3 text-center">
                                <h4 class="title-final">FOLIO DE COMPRA <span class="text-14">{{ $order->order_code }}</span></h4> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>