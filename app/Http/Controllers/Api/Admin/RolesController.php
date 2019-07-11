<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;

class RolesController extends Controller
{
    public function list(){
        return datatables()->eloquent(Roles::query())->toJson();
    }
}
