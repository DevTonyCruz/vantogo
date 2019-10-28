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

    public function orders()
    {
        return $this->hasMany('App\Models\Orders', 'travel_id', 'id');
    }

    public function disponibilidad(){
        $ocupados = $this->orders;

        $reservados = 0;
        foreach ($ocupados as $ocupado) {
            $reservados += count($ocupado->details);
        }

        $capacity = 13; //$this->car->capacity;
        return $capacity - $reservados;
    }
}
