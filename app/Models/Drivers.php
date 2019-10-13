<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drivers extends Model
{
    protected $fillable = ['photo'];

    public function fullname(){
        $fullname = '';

        $fullname .= ($this->name) ? $this->name : '';
        $fullname .= ($this->first_last_name) ? ' ' .$this->first_last_name : '';
        $fullname .= ($this->second_last_name) ? ' ' .$this->second_last_name : '';

        return $fullname;
    }
}
