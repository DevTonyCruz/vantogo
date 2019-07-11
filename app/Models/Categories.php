<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ["photo_url"];

    public function categoria()
    {
        return $this->hasOne('App\Models\Categories', 'id', 'parent_id');
    }

    public function productos()
    {
        return $this->hasMany('App\Models\Products', 'category_id', 'id');
    }
}
