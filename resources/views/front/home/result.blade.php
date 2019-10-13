@extends('front.layouts.app')

@section('content')

<div class="container my-lg-5 my-2">
    <div class="row">
        <div class="col-12 col-lg-4 order-lg-1 order-2">
            <div class="d-block text-center mb-2">
                <span class="title_ticket_mod2">TICKET</span>
            </div>
            <div class="d-block bg-ticket text-white px-3 py-4">
                <div class="d-block text-center mt-4">
                    <span class="font12">FECHA DE SALIDA</span>
                </div>
                <div class="d-block text-center mt-1">
                    @php
                    $date = explode('/', \Carbon\Carbon::parse($travels[0]->date)->format('m/d/Y'));
                    @endphp
                    <span class="fecha_ticket_col3_mod2">{{ $date[1] }} / {{ $date[0] }} / {{ $date[2] }}</span>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6 text-center">
                        <div class="font12"><span><img src="{{ asset('front/img/icono_salida.png')}}" alt=""></span>
                            SALIDA</div>
                        <div class="font12_nbold hour-ini-ticket-view">{{ substr($travels[0]->hour_ini, 0, 5) }}</div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="font12"><span><img src="{{ asset('front/img/icono_salida.png')}}" alt=""></span>
                            LLEGADA</div>
                        <div class="font12_nbold hour-fin-ticket-view">{{ substr($travels[0]->hour_fin, 0, 5) }}</div>
                    </div>
                </div>
                <br><br><br>
                <div class="row div_ticket_row2_mod2">

                    <div class="col-md-7 pt-3"><img class="img_100" src="{{ asset('front/img/icono_van.png')}}" alt="">
                        <span class="img_chofer_ticket"><img src="{{ asset('front/img/imagen_chofer.png')}}"></span>
                    </div>

                    <div class="col-md-5 font_chofer">
                        <div>Tu chofer:</div>
                        <div class="ticket_name_chofer driver-name-ticket-view">{{ $travels[0]->driver->fullname()}}
                        </div>
                        <div class="car-registration-ticket-view">{{ $travels[0]->car->registration}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8 order-lg-2 order-1">
            <div class="row">
                <div class="m-auto d-lg-flex d-none">
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
                    <div class="d-inline py-1 pr-3 pl-0 step-shopping">
                        <div class="d-inline float-left">
                            <div class="rounded-circle bg-warning step-status"></div>
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
                <div class="m-auto w-100">
                    <h1 class="title_elige_asiento_mod3">ELIGE TU HORARIO</h1>
                </div>
            </div>
            <form method="GET" action="{{ url('asientos/')}}">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr class="table_tr_mod2">
                                        <th scope="col">
                                            <span>
                                                <img class="icono_centrado_texto col_mobile"
                                                    src="{{ asset('front/img/icono_salida.png')}}" alt="">
                                            </span>
                                            <span class="d-none d-lg-inline">HORA</span>
                                            <span class="d-inline">SALIDA</span>
                                        </th>
                                        <th scope="col">
                                            <span>
                                                <img class="icono_centrado_texto col_mobile"
                                                    src="{{ asset('front/img/icono_salida.png')}}" alt="">
                                            </span>
                                            <span class="d-none d-lg-inline">HORA</span>
                                            <span class="d-inline">LLEGADA</span>
                                        </th>
                                        <th scope="col">
                                            <span>
                                                <img class="icono_centrado_texto col_mobile"
                                                    src="{{ asset('front/img/icono_fecha.png')}}" alt="">
                                            </span>
                                            <span class="d-inline">FECHA</span>
                                            <span class="d-none d-lg-inline">SALIDA</span>
                                        </th>
                                        <th scope="col">
                                            <span>
                                                <img class="icono_centrado_texto col_mobile"
                                                    src="{{ asset('front/img/icono_precio.png')}}" alt="">
                                            </span>
                                            <span class="d-inline">PRECIO</span>
                                        </th>
                                        <th scope="col">
                                            <span>
                                                <img class="icono_centrado_texto col_mobile"
                                                    src="{{ asset('front/img/icono_asiento.png')}}" alt="">
                                            </span>
                                            <span class="d-inline">ASIENTOS</span>
                                            <span class="d-none d-lg-inline">DISPONIBLES</span>
                                        </th>
                                        <th scope="col"><span><img class="icono_centrado_texto col_mobile"
                                                    src="{{ asset('front/img/icono_palomita.png')}}" alt=""></span>
                                            ELEGIR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($travels) > 0)
                                    @foreach ($travels as $key => $travel)
                                    <tr>
                                        <td scope="row">{{ $travel->hour_ini }}</td>
                                        <td>{{ $travel->hour_fin }}</td>
                                        <td>{{ $travel->date }}</td>
                                        <td>${{ number_format($travel->route->price, 2, '.', ',')  }}</td>
                                        <td>{{ $travel->disponibilidad() }} ASIENTOS</td>
                                        <td><input type="radio" name="viaje_seleccionado" class="checkbox_travel"
                                                id="seleccionar_{{ $travel->id }}" value="{{ $travel->code }}"
                                                {{ ($key == 0) ? 'checked' : '' }}
                                                data-hour-ini="{{ substr($travel->hour_ini, 0, 5) }}"
                                                data-hour-fin="{{ substr($travel->hour_fin, 0, 5) }}"
                                                data-car-registration="{{ $travel->car->registration }}"
                                                data-driver-name="{{ $travel->driver->fullname() }}">
                                            <label for="seleccionar_{{ $travel->id }}"></label>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6">Sin viajes disponibles</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="div_btn_contunuar_mod2"><button type="submit"
                                class="btn btn-danger btn_consultar_main">CONTINUAR</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- Typehead -->
<script src="{{ asset('front/js/vendor/handlebars.min.js') }}"></script>
<script src="{{ asset('front/js/vendor/typeahead.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/pages/demo.typehead.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#origen').select2({
            placeholder: "Origen"
        });
        $('#destino').select2({
            placeholder: "Destino"
        });
    });

    $('.checkbox_travel').on('change', function(){
        var hour_ini = $(this).attr('data-hour-ini');
        var hour_fin = $(this).attr('data-hour-fin');
        var registration = $(this).attr('data-car-registration');
        var name = $(this).attr('data-driver-name');

        $('.hour-ini-ticket-view').html(hour_ini);
        $('.hour-fin-ticket-view').html(hour_fin);
        $('.car-registration-ticket-view').html(registration);
        $('.driver-name-ticket-view').html(name);
    });
</script>

@endsection