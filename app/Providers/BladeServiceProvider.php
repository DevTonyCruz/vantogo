<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Models\Permissions;
use Illuminate\Support\Facades\Auth;
use App\Models\Relation_rol_permission;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('permission', function ($data) {

            $permisos = Permissions::where('slug', $data)->first();
            $user = Auth::user();

            $authorized = Relation_rol_permission::where('rol_id', $user->rol_id)->where('permission_id', $permisos->id)->first();

            if ($authorized) {
                return true;
            }
            return false;
        });
    }
}
