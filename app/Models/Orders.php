<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function travel()
    {
        return $this->hasOne('App\Models\Travels', 'id', 'travel_id');
    }

    public function details()
    {
        return $this->hasMany('App\Models\OrdersDetails', 'order_id', 'id');
    }
}
