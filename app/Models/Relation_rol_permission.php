<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relation_rol_permission extends Model
{
    protected $table = 'relation_rol_permission';

    public function permiso()
    {
        return $this->hasOne('App\Models\Permissions', 'id', 'permission_id');
    }
}
