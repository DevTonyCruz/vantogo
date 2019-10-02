@extends('front.layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-4">
            <div class="d-block text-center mb-2">
                <span class="title_ticket_mod2">TICKET</span>
            </div>
            <div class="d-block bg-ticket text-white px-2 py-4">
                <div class="d-block text-center mt-4">
                    <span class="font12">FECHA DE SALIDA</span>
                </div>
                <div class="d-block text-center mt-1">
                    <span class="fecha_ticket_col3_mod2">23 / JUL / 2019</span>
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
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr class="table_tr_mod2">
                                    <th scope="col"><span><img class="icono_centrado_texto col_mobile"
                                                src="img/icono_salida.png" alt=""></span> HORA SALIDA</th>
                                    <th scope="col" class="col_mobile"><span><img
                                                class="icono_centrado_texto col_mobile" src="img/icono_salida.png"
                                                alt=""></span> HORA LLEGADA</th>
                                    <th scope="col" class="col_mobile"><span><img
                                                class="icono_centrado_texto col_mobile" src="img/icono_fecha.png"
                                                alt=""></span> FECHA DE SALIDA </th>
                                    <th scope="col"><span><img class="icono_centrado_texto col_mobile"
                                                src="img/icono_precio.png" alt=""></span> PRECIO</th>
                                    <th scope="col"><span><img class="icono_centrado_texto col_mobile"
                                                src="img/icono_asiento.png" alt=""></span> ASIENTOS DISPONIBLES</th>
                                    <th scope="col"><span><img class="icono_centrado_texto col_mobile"
                                                src="img/icono_palomita.png" alt=""></span> ELEGIR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col_mobile" scope="row">7:00 am</td>
                                    <td>8:00 am</td>
                                    <td class="col_mobile">23/JUL/2019</td>
                                    <td>$150.00</td>
                                    <td>6 ASIENTOS</td>
                                    <td><input type="radio" name="radio_horario" id="test1"><label for="test1"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="col_mobile">7:00 am</td>
                                    <td>8:00 am</td>
                                    <td class="col_mobile">23/JUL/2019</td>
                                    <td>$150.00</td>
                                    <td>6 ASIENTOS</td>
                                    <td><input type="radio" name="radio_horario" id="test2"><label for="test2"></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row" class="col_mobile">7:00 am</td>
                                    <td>8:00 am</td>
                                    <td class="col_mobile">23/JUL/2019</td>
                                    <td>$150.00</td>
                                    <td>6 ASIENTOS</td>
                                    <td><input type="radio" name="radio_horario" id="test3"><label for="test3"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="div_btn_contunuar_mod2"><button type="button"
                            class="btn_consultar_main">CONTINUAR</button>
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
        $('#origen').select2({
            placeholder: "Origen"
        });
        $('#destino').select2({
            placeholder: "Destino"
        });
    });
</script>

@endsection