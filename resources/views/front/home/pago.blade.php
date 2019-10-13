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

                                    <div class="font12_mod4"><img src="img/icon_fecha_na.png" alt=""> FECHA DE SALIDA
                                    </div>
                                    @php
                                    $date = explode('/', \Carbon\Carbon::parse($travel->date)->format('m/d/Y'));
                                    @endphp
                                    <div class="fecha_ticket_col3_mod4">{{ $date[1] }} / {{ $date[0] }} / {{ $date[2] }}
                                    </div>
                                    <hr class="hr_mod4">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="font12_mod4"><span><img src="img/icon_reloj_na.png"
                                                        alt=""></span>
                                                SALIDA</div>
                                            <div>{{ substr($travel->hour_ini, 0, 5) }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="font12_mod4"><span><img src="img/icon_reloj_na.png"
                                                        alt=""></span>
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
                                                    <div class="color_gray">{{ $pasajeros["name"] }}</div>
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
                                            <span class="img_chofer_ticket_b"><img
                                                    src="{{asset('front/img/imagen_chofer.png')}}"></span>
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
                                <div class="title_informacion_asiento_mod4">Direccion principal</div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombre *</label>
                                            <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellido *</label>
                                            <input type="text" class="form-control" id="apellido"
                                                placeholder="Apellido">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="">Telefono (10 digitos)(opcional)</label>
                                    <input type="text" class="form-control" id="telefono" placeholder="Telefono">
                                </div>
                                <div class="form-group">
                                    <label for="">Direccion de correo electronico *</label>
                                    <input type="text" class="form-control" id="correo" placeholder="Correo">
                                </div>


                                <div class="total_mod4">TOTAL: ${{ number_format(($travel->route->price * count($session["pasajeros"])), 2, '.', ',') }}</div>

                                <div class="descripcion_pago_mod4">
                                    <div class="radio">
                                        <label><input type="radio" name="optradio" checked=""> Pago con Tarjeta de
                                            Credito o
                                            Debito</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio"> Oxxo Pay Payment</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio"> PayPal Express Checkout</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="optradio"> Tranferencia bancaria SPEI</label>
                                    </div>
                                    <hr class="hr_mod4_pagar">
                                    <div>Tus datos personales se utilizaran para procesar tu pedido,
                                        mejorar tu experiencia en esta web y otros propositos descritos
                                        en nuestra <a class="a_mod4_pagar" href="#">politica de privacidad.</a>
                                    </div>
                                    <div class="title_leido_mod4">
                                        <input type="checkbox" aria-label="Checkbox for following text input">
                                        He leido y estos de acuerdo con los <a class="a_mod4_pagar" href="#">
                                            terminos y condiciones</a> de
                                        la web*
                                    </div>
                                </div>


                                <div class="div_btn_contunuar_mod3"><button type="button"
                                        class="btn_consultar_main">COMPRAR</button></div>
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
<!-- Typehead -->
<script src="{{ asset('front/js/vendor/handlebars.min.js') }}"></script>
<script src="{{ asset('front/js/vendor/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/pages/demo.typehead.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#asiento').select2({
            placeholder: "Seleccione su asiento"
        });
    });
</script>

@endsection