<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faqs extends Model
{

    public function topic()
    {
        return $this->hasOne('App\Models\Topics', 'id', 'topic_id');
    }
}
