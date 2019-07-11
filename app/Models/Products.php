<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['photo_url'];

    public function categoria()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'category_id');
    }

    public function stock()
    {
        return $this->hasOne('App\Models\Stock', 'product_id', 'id');
    }

    public function imagenes()
    {
        return $this->hasMany('App\Models\Products_images', 'product_id', 'id');
    }
}
