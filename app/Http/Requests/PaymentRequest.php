<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "nombre" => "required",
            "apellido" => "required",
            "telefono" => "required",
            "correo" => "required|email",
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es requerido.',
            'apellido.required' => 'El campo apellido es requerido.',
            'telefono.required' => 'El campo teléfono es requerido.',
            'correo.required' => 'El campo correo electrónico es requerido.',
            'correo.email' => 'El campo correo electrónico no es válido.'
        ];
    }


    public function response(array $errors)
    {
        if ($this->expectsJson()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }
    }

    /*public function attributes()
    {
        return [
            'nombre' => 'nombre del producto',
            'price' => 'precio de venta',
        ];
    }*/
}
