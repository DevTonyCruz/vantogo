@extends('front.layouts.app')

@section('content')

<div class="row no-gutters row_index">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="text-center title_main_index">Trayectos que te <span class="color_van">van</span> a encantar</div>
        <form method="POST" action="{{ url('/viaje') }}">
            <div class="row">
                @csrf
                <div class="col-xl-3">
                    <div class="input-group{{ $errors->has('origen') ? ' is-invalid' : '' }}">
                        <select class="form-control select2" data-toggle="select2" id="origen" name="origen">
                            <option></option>
                            @foreach ($origin as $route)
                            <option value="{{ $route->origin }}"
                                {{ (old('origen') == $route->origin) ? 'selected' : '' }}>{{ $route->origin }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append icon-select">
                            <span class="input-group-text">
                                <img src="{{ asset('front/img/icon_pin.png') }}"
                                    alt="icon_pin"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="input-group">
                        <select class="custom-select select2" data-toggle="select2" id="destino" name="destino">
                            <option></option>
                            @foreach ($destination as $route)
                            <option value="{{ $route->destination }}"
                                    {{ (old('destino') == $route->destination) ? 'selected' : '' }}>{{ $route->destination }}</option>
                            @endforeach
                        </select>
                        <div class="input-group-append icon-select">
                            <span class="input-group-text"><img src="{{ asset('front/img/icon_pin.png') }}"
                                    alt="icon_pin"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="input-group">
                        <input type="text" id="date" name="date" class="form-control date" data-toggle="date-picker"
                            data-single-date-picker="true" value="{{ old('date') }}" required="">
                        <div class="input-group-append">
                            <span class="input-group-text"><img src="{{ asset('front/img/icon_calendario.png') }}"
                                    alt="icon_calendario"></span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="input-group">
                        <input type="number" id="pasajeros" name="pasajeros" class="form-control"
                            placeholder="Pasajeros" aria-label="Pasajeros" value="{{ old('pasajeros') }}">
                        <div class="input-group-append">
                            <span class="input-group-text"><img src="{{ asset('front/img/icon_pasajeros.png') }}"
                                    alt="icon_pasajeros"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-danger btn_consultar_main">Consultar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-2"></div>
</div>


<div class="row no-gutters row_comodidad">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="text-center title_comodidad_index">Cuenta con toda la comodidad</div>
        <div class="row no-gutters">
            <div class="col-md-2"></div>
            <div class="col-md-8 col10_comodidad">
                <div class="column-comodidad">
                    <img src="{{ asset('front/img/aire.png') }}" alt="aire">
                </div>
                <div class="column-comodidad">
                    <img src="{{ asset('front/img/pantalla.png') }}" alt="pantalla">
                </div>
                <div class="column-comodidad">
                    <img src="{{ asset('front/img/internet.png') }}" alt="internet">
                </div>
                <div class="column-comodidad">
                    <img src="{{ asset('front/img/luz.png') }}" alt="luz">
                </div>
                <div class="column-comodidad">
                    <img src="{{ asset('front/img/seguridad.png') }}" alt="seguridad">
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row no-gutters row_cajas_color">
            <div class="col-lg-4">
                <div class="caja_amarilla_main"></div>
            </div>
            <div class="col-lg-4">
                <div class="caja_rosa_main"></div>
            </div>
            <div class="col-lg-4">
                <div class="caja_roja_main"></div>
            </div>
        </div>

    </div>
    <div class="col-md-2"></div>
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