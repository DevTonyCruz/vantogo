<?php 

return [
    
    /*
    |--------------------------------------------------------------------------
    | Conketa
    |--------------------------------------------------------------------------
    |
    | Se agregarn las claves para la pasarela de pagos de conekta.
    |
    */

    'conekta' => [
        'api' => env('CONEKTA_API_VERSION', ''),
        'private' => env('CONEKTA_PRIVATE_KEY', ''),
        'public' => env('CONEKTA_PUBLIC_KEY', ''),
    ],
];