<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travels extends Model
{

    public function route()
    {
        return $this->hasOne('App\Models\Routes', 'id', 'route_id');
    }

    public function car()
    {
        return $this->hasOne('App\Models\Cars', 'id', 'car_id');
    }

    public function driver()
    {
        return $this->hasOne('App\Models\Drivers', 'id', 'driver_id');
    }
}
