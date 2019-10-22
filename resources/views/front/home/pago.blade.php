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
                                            <input type="text" class="form-control" id="nombre" placeholder="Nombre"
                                                value="{{ $session['pasajeros'][0]['name'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Apellido *</label>
                                            <input type="text" class="form-control" id="apellido" placeholder="Apellido"
                                                value="{{ $session['pasajeros'][0]['last_name'] }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="">Telefono (10 digitos)(opcional)</label>
                                    <input type="text" class="form-control" id="telefono" placeholder="Telefono"
                                        value="{{ $session['pasajeros'][0]['phone'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Direccion de correo electronico *</label>
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

                                    <hr class="hr_mod4_pagar">

                                    <div class="payment-container p-2" id="card-container">
                                        <form action="{{ url('payment/cart') }}" method="POST" id="card-form">
                                            @csrf
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

                                                <div class="col-md-12">Tus datos personales se utilizaran para procesar tu pedido,
                                                    mejorar tu experiencia en esta web y otros propositos descritos
                                                    en nuestra <a class="a_mod4_pagar" href="#">politica de privacidad.</a>
                                                </div>
                                                <div class="col-md-12 title_leido_mod4">
                                                    <input type="checkbox" aria-label="Checkbox for following text input">
                                                    He leido y estos de acuerdo con los <a class="a_mod4_pagar" href="#">
                                                        terminos y condiciones</a> de
                                                    la web*
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group pt-3">
                                                        <button type="submit"
                                                            class="btn btn-danger w-100">Pagar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <hr class="hr_mod4_pagar">
                                    </div>
                                    <div class="payment-container" id="oxxo-container">

                                        <div class="col-md-12">Tus datos personales se utilizaran para procesar tu pedido,
                                            mejorar tu experiencia en esta web y otros propositos descritos
                                            en nuestra <a class="a_mod4_pagar" href="#">politica de privacidad.</a>
                                        </div>
                                        <div class="col-md-12 title_leido_mod4">
                                            <input type="checkbox" aria-label="Checkbox for following text input">
                                            He leido y estos de acuerdo con los <a class="a_mod4_pagar" href="#">
                                                terminos y condiciones</a> de
                                            la web*
                                        </div>
                                        <div class="col-md-12 mt-3">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger w-100">Generar número de
                                                    referencia de pago</button>
                                            </div>
                                        </div>
                                        <hr class="hr_mod4_pagar">
                                    </div>
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
<!-- Typehead -->
<script src="{{ asset('front/js/vendor/handlebars.min.js') }}"></script>
<script src="{{ asset('front/js/vendor/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/pages/demo.typehead.js') }}"></script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#asiento').select2({
            placeholder: "Seleccione su asiento"
        });
    });

    $(".payment-check").on('change', function(){

        if($("#card-check").is(":checked")){
            $(".payment-container").hide();
            $("#card-container").show();
        }

        if($("#oxxo-check").is(":checked")){
            $(".payment-container").hide();
            $("#oxxo-container").show();
        }
    });
    
</script>

<script type="text/javascript">
    Conekta.setPublicKey('key_MkiU5dwbUbyqjNHoFv5NvVA');
  
    var conektaSuccessResponseHandler = function(token) {
      var $form = $("#card-form");
      //Inserta el token_id en la forma para que se envíe al servidor
       $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
      $form.get(0).submit(); //Hace submit
    };
    var conektaErrorResponseHandler = function(response) {
      var $form = $("#card-form");
      $form.find(".card-errors").text(response.message_to_purchaser);
      $form.find("button").prop("disabled", false);
    };
  
    //jQuery para que genere el token después de dar click en submit
    $(function () {
      $("#card-form").submit(function(event) {
        var $form = $(this);
        // Previene hacer submit más de una vez
        $form.find("button").prop("disabled", true);
        Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
        return false;
      });
    });
</script>
@endsection