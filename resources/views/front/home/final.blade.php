@extends('front.layouts.app')

@section('content')
<div class="row no-gutters row_main_mod2 mb-5">


    <div class="col-10 m-auto">
        <div class="col-12">
            <div class="row no-gutters">
                <div class="col-md-12 col6-informacion_mod3 text-center py-5">
                    <div class="my-5 py-5 w-100">
                        <h2 class="title-final">¡Tu compra ha sido un éxito!</h2>
                        <p>
                            Te hemos enviado un correo con todos los datos de tu <br>
                            compra para que tu viaje sea lo más cómodo posible.
                        </p>

                        <a href="{{ url('/') }}" class="btn btn-final">Regresar a home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection