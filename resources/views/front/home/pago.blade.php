@extends('front.layouts.app')

@section('content')
<div class="row no-gutters row_main_mod2 mb-5">


    <div class="col-10 m-auto">
        <div class="col-12">
            <div class="row mb-3">
                <div class="m-auto d-flex">
                    <div class="d-inline py-1 pr-3 pl-0 step-shopping active">
                        <div class="d-inline float-left">
                            <div class="rounded-circle bg-warning text-center text-white step-status">
                                <i class="dripicons-checkmark"></i>
                            </div>
                        </div>
                        <div class="d-inline float-left ml-2 py-1 font-weight-bold">
                            Selecciona <br>
                            Fecha
                        </div>
                    </div>
                    <div class="d-inline py-1 pr-3 pl-0 step-shopping active">
                        <div class="d-inline float-left">
                            <div class="rounded-circle bg-warning text-center text-white step-status">
                                <i class="dripicons-checkmark"></i>
                            </div>
                        </div>
                        <div class="d-inline float-left ml-2 py-1 font-weight-bold">
                            Selecciona <br>
                            Horario
                        </div>
                    </div>
                    <div class="d-inline py-1 pr-3 pl-0 step-shopping active">
                        <div class="d-inline float-left">
                            <div class="rounded-circle bg-warning text-center text-white step-status">
                                <i class="dripicons-checkmark"></i>
                            </div>
                        </div>
                        <div class="d-inline float-left ml-2 py-1 font-weight-bold">
                            Selecciona <br>
                            Asiento
                        </div>
                    </div>
                    <div class="d-inline py-1 pr-3 pl-0 step-shopping">
                        <div class="d-inline float-left">
                            <div class="rounded-circle bg-warning step-status"></div>
                        </div>
                        <div class="d-inline float-left ml-2 py-1 font-weight-bold">
                            Realiza la <br>
                            Compra
                        </div>
                    </div>
                    <div class="d-inline py-1 pr-3 pl-0 step-shopping">
                        <div class="d-inline float-left">
                            <div class="rounded-circle bg-warning step-status"></div>
                        </div>
                        <div class="d-inline float-left ml-2 py-1 font-weight-bold ajuste-padding-1">
                            ¡Listo!
                        </div>
                    </div>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-md-12 col6-informacion_mod3">

                    <div class="title_informacion_pasajero_mod3">REVISA TUS DATOS Y REALIZA TU COMPRA</div>

                    <div class="row">

                        <div class="col-md-4">

                            <div class="col3_mod4_ticket">
                                <div class="div_ticket_main_mod4 text-center">

                                    <div class="font12_mod4"><img src="{{ asset('front/img/icon_fecha_na.png')}}"
                                            alt=""> FECHA DE SALIDA
                                    </div>
                                    @php
                                    $date = explode('/', \Carbon\Carbon::parse($travel->date)->format('m/d/Y'));
                                    @endphp
                                    <div class="fecha_ticket_col3_mod4">{{ $date[1] }} / {{ $date[0] }} / {{ $date[2] }}
                                    </div>
                                    <hr class="hr_mod4">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="font12_mod4"><span><img
                                                        src="{{ asset('front/img/icon_reloj_na.png')}}" alt=""></span>
                                                SALIDA</div>
                                            <div>{{ substr($travel->hour_ini, 0, 5) }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="font12_mod4"><span><img
                                                        src="{{ asset('front/img/icon_reloj_na.png')}}" alt=""></span>
                                                LLEGADA</div>
                                            <div>{{ substr($travel->hour_fin, 0, 5) }}</div>
                                        </div>
                                    </div>
                                    <hr class="hr_mod4">


                                    <div class="row ticket_pasajero_mod3">
                                        @if (isset($session['pasajeros']))
                                        @foreach ($session['pasajeros'] as $pasajeros)
                                        <div class="col-md-12">
                                            <div class="font12_mod4"><span><img
                                                        src="{{asset('front/img/icon_pasajero_na.png')}}" alt=""></span>
                                                PASAJERO</div>
                                            <div class="color_gray_izq">
                                                <div class="color_gray">
                                                    {{ $pasajeros["name"] . ' ' . $pasajeros["last_name"] }}</div>
                                                <div class="color_gray">{{ $pasajeros["email"] }}</div>
                                                <div class="color_gray">{{ $pasajeros["phone"] }}</div>
                                                <div class="font12_mod4">ASIENTO {{ $pasajeros["asiento"] }}</div>
                                            </div>
                                            <hr class="hr_mod4">
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>

                                    <div class="row div_ticket_row2_mod4">
                                        <div class="col-md-7"><img class="img_100"
                                                src="{{asset('front/img/icon_van_na.png')}}" alt="">
                                            <span class="img_chofer_ticket_b"><img class="rounded-circle driver-photo-ticket-view" width="50" height="50" 
                                                    src="{{ $travel->driver->file_driver }}"></span>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="title_chofer">Tu chofer:</div>
                                            <div class="color_gray">{{ $travel->driver->fullname()}}</div>
                                            <div class="title_chofer">{{ $travel->car->registration}}</div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <div class="col-md-8  shadow_col8_mod4">
                            <div class="div_informacion_pading_mod3">
                                <div class="title_informacion_asiento_mod4">Datos del comprador</div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre(s) del comprador *</label>
                                            <input type="text" class="form-control" id="nombre" placeholder="Nombre"
                                                value="{{ $session['pasajeros'][0]['name'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellidos del comprador *</label>
                                            <input type="text" class="form-control" id="apellido" placeholder="Apellido"
                                                value="{{ $session['pasajeros'][0]['last_name'] }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="">Teléfono del comprador (10 dígitos)</label>
                                    <input type="text" class="form-control" id="telefono" placeholder="Telefono"
                                        value="{{ $session['pasajeros'][0]['phone'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Correo electrónico del comprador*</label>
                                    <input type="text" class="form-control" id="correo" placeholder="Correo"
                                        value="{{ $session['pasajeros'][0]['email'] }}">
                                </div>


                                <div class="total_mod4">TOTAL:
                                    ${{ number_format(($travel->route->price * count($session["pasajeros"])), 2, '.', ',') }}
                                </div>

                                <div class="descripcion_pago_mod4">
                                    <div class="radio">
                                        <input type="radio" name="optradio" id="card-check" class="payment-check">
                                        <label for="card-check">Pago con Tarjeta de Crédito o Débito</label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="optradio" id="oxxo-check" class="payment-check">
                                        <label for="oxxo-check">Oxxo Pay Payment</label>
                                    </div>

                                    <div class="payment-container" id="card-conekta-container">
                                        <hr class="hr_mod4_pagar">
                                        <form action="" method="POST" id="card-form-conekta">
                                            <div class="row">
                                                <span class="card-errors"></span>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Nombre del tarjetahabiente *</label>
                                                        <input type="text" class="form-control" id="nombre"
                                                            placeholder="Nombre" size="20" data-conekta="card[name]">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Número de tarjeta *</label>
                                                        <input type="text" class="form-control" id="tarjeta"
                                                            placeholder="Número de tarjeta" size="20"
                                                            data-conekta="card[number]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">CVC *</label>
                                                        <input type="text" class="form-control" id="cvc"
                                                            placeholder="CVC" size="4" data-conekta="card[cvc]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Año (AAAA) *</label>
                                                        <input type="text" class="form-control" id="cvc"
                                                            placeholder="Año de expiración" size="4"
                                                            data-conekta="card[exp_year]">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Mes (MM) *</label>
                                                        <input type="text" class="form-control" id="cvc"
                                                            placeholder="Mes de expiración" size="2"
                                                            data-conekta="card[exp_month]">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">Tus datos personales se utilizaran para procesar
                                                    tu
                                                    pedido,
                                                    mejorar tu experiencia en esta web y otros propositos descritos
                                                    en nuestra <a class="a_mod4_pagar" href="#">politica de
                                                        privacidad.</a>
                                                </div>
                                                <div class="col-md-12 title_leido_mod4">
                                                    <input type="checkbox" id="accept-terms-card-conekta"
                                                        name="accept-terms-card-conekta">
                                                    He leido y estos de acuerdo con los <a class="a_mod4_pagar"
                                                        href="#">
                                                        terminos y condiciones</a> de
                                                    la web*
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group pt-3">
                                                        <button type="button" id="conekta-card"
                                                            class="btn btn-danger w-100">Pagar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="payment-container" id="oxxo-conekta-container">
                                        <hr class="hr_mod4_pagar">

                                        <div class="col-md-12">Tus datos personales se utilizaran para procesar tu
                                            pedido,
                                            mejorar tu experiencia en esta web y otros propositos descritos
                                            en nuestra <a class="a_mod4_pagar" href="#">politica de privacidad.</a>
                                        </div>
                                        <div class="col-md-12 title_leido_mod4">
                                            <input type="checkbox" id="accept-terms-oxxo-conekta"
                                            name="accept-terms-oxxo-conekta">
                                            He leido y estos de acuerdo con los <a class="a_mod4_pagar" href="#">
                                                terminos y condiciones</a> de
                                            la web*
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <button type="button" id="conekta-oxxo" class="btn btn-danger w-100" onclick="PaymentObject.createConektaOxxoOrder()">Generar número de
                                                    referencia de pago</button>
                                            </div>
                                        </div>
                                        <hr class="hr_mod4_pagar">
                                    </div>
                                </div>

                                <div class="d-none">
                                    <input type="hidden" id="oxxo-key-public" name="oxxo-key-public"
                                        value="{{ config('payment.conekta.public', 'Laravel') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ asset('front/js/request.js') }}"></script>

<!-- Conekta Payment -->
<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>

<script type="text/javascript">
    // Se obtiene la llave publica de conekta
    let CONEKTA_PUBLIC_KEY = $('#oxxo-key-public').val();
    Conekta.setPublicKey(CONEKTA_PUBLIC_KEY);
</script>

<script type="text/javascript">
    $(".payment-check").on('change', function(){

        if($("#card-check").is(":checked")){
            $(".payment-container").hide();
            $("#card-conekta-container").show();
        }

        if($("#oxxo-check").is(":checked")){
            $(".payment-container").hide();
            $("#oxxo-conekta-container").show();
        }
    });
    
</script>
@endsection