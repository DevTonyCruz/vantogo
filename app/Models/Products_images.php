<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products_images extends Model
{
    protected $table = 'products_photos';
    protected $fillable = ['photo_url'];
}
