@extends('front.layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <div class="d-block text-center mb-2">
                <span class="title_ticket_mod2">TICKET</span>
            </div>
            <div class="d-block bg-ticket text-white px-3 py-4">
                <div class="d-block text-center mt-4">
                    <span class="font12">FECHA DE SALIDA</span>
                </div>
                <div class="d-block text-center mt-1">
                    @php
                    $date = explode('/', \Carbon\Carbon::parse($travel->date)->format('m/d/Y'));
                    @endphp
                    <span class="fecha_ticket_col3_mod2">{{ $date[1] }} / {{ $date[0] }} / {{ $date[2] }}</span>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="font12"><span><img src="{{ asset('front/img/icono_salida.png')}}" alt=""></span>
                            SALIDA</div>
                        <div class="font12_nbold hour-ini-ticket-view">{{ substr($travel->hour_ini, 0, 5) }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="font12"><span><img src="{{ asset('front/img/icono_salida.png')}}" alt=""></span>
                            LLEGADA</div>
                        <div class="font12_nbold hour-fin-ticket-view">{{ substr($travel->hour_fin, 0, 5) }}</div>
                    </div>
                </div>
                <hr>
                <div class="row ticket_pasajero_mod3">
                    @if (isset($session['pasajeros']))
                        @foreach ($session['pasajeros'] as $pasajeros)
                        <div class="col-md-12">
                            <div class="title1_pasajero_mod3 font12"><span><img src="img/icon_pasajero.png" alt=""></span>
                                PASAJERO</div>
                            <div class="color_gray_izq">
                                <div class="pasajero_txt font12_nbold">{{ $pasajeros["name"] . ' ' . $pasajeros["last_name"] }}</div>
                                <div class="pasajero_txt font12_nbold">{{ $pasajeros["email"] }}</div>
                                <div class="title1_pasajero_mod3 font12">{{ $pasajeros["phone"] }}</div>
                                <div class="pasajero_txt font12_nbold">Asiento {{ $pasajeros["asiento"] }}</div>
                            </div>
                            <hr class="hr100">
                        </div>
                        @endforeach
                    @endif
                </div>
                <br><br><br>
                <div class="row div_ticket_row2_mod2">

                    <div class="col-md-7"><img class="img_100" src="{{ asset('front/img/icono_van.png')}}" alt="">
                        <span class="img_chofer_ticket"><img src="{{ asset('front/img/imagen_chofer.png')}}"></span>
                    </div>

                    <div class="col-md-5 font_chofer">
                        <div>Tu chofer:</div>
                        <div class="ticket_name_chofer driver-name-ticket-view">{{ $travel->driver->fullname()}}</div>
                        <div class="car-registration-ticket-view">{{ $travel->car->registration}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="row">
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
                    <div class="d-inline py-1 pr-3 pl-0 step-shopping">
                        <div class="d-inline float-left">
                            <div class="rounded-circle bg-warning step-status"></div>
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
            <form method="POST" action="{{ url('pasajeros/')}}">
                @csrf
                <div class="row mt-4 col3_asiento">
                    <div class="col-md-7 text-center col3_asiento_int">
                        <div class="title_elige_asiento_mod3">ELIGE TU ASIENTO</div>
                        <div class="row opciones_elige_asiento_mod3 mb-2">
                            <span class="opciones_elegir_span"><span class="cuadrado_span_disponible"></span>
                                Disponible</span>
                            <span class="opciones_elegir_span"><span class="cuadrado_span_ocupado"></span>Ocupado</span>
                            <span class="opciones_elegir_span"><span class="cuadrado_span_elegir"></span>Elegir</span>
                        </div>
                        <div class="col3_asiento_int_img">
                            {!! file_get_contents(asset('images/van.svg')) !!}
                            <!--<img class="img_vantogo_main" src="{{ asset('front/img/asientos_van_2.png') }}" alt="">-->
                        </div>
                    </div>

                    <div class="col-md-5 col6-informacion_mod3">
                        <div class="title_informacion_pasajero_mod3"><span><img
                                    src="{{ asset('front/img/icon_pasajero.png') }}" alt=""></span>
                            INFORMACION DEL PASAJERO</div>

                        <div class="div_informacion">
                            <div class="div_informacion_pading_mod3">
                                <div class="title_informacion_asiento_mod3 ">
                                    ASIENTO <span class="asiento-seleccionado">{{ old('asiento') }}</span>                                
                                    <input type="hidden" id="asiento" name="asiento" placeholder="ASIENTO" value="{{ old('asiento') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="NOMBRE(S)">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name') }}" placeholder="APELLIDOS">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="EMAIL">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{ old('phone') }}" placeholder="TELÉFONO">
                                </div>
                                <div class="div_btn_contunuar_mod3"><button type="submit"
                                        class="btn btn-danger btn_consultar_main">CONTINUAR</button></div>
                                <input type="hidden" name="travel_id" id="travel_id" value="{{ $travel->id }}">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
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
        @if (isset($session['pasajeros']))
            @foreach ($session['pasajeros'] as $pasajeros)
                $("#asiento-{{ $pasajeros['asiento'] }}").addClass('ocupado');
            @endforeach
        @endif
    });

    $(".asientos").on('click', function(){
        if(!$(this).hasClass('ocupado')){   
            $(".asientos").removeClass('seleccionado');     
            $(this).addClass('seleccionado');
            var asiento = $(this).attr('data-asiento');
            $('.asiento-seleccionado').html(asiento)
            $('#asiento').val(asiento)
        }
    });
</script>

@endsection