<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    public function faq()
    {
        return $this->hasMany('App\Models\Faqs', 'topic_id', 'id');
    }
}
