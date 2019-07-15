<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Roles;
use App\User;
use App\Models\Pages;
use App\Models\Configurations;

class GlobalVariablesProvider extends ServiceProvider
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
        $total_roles = (\Schema::hasTable('roles')) ? Roles::count() : 0;
        view()->share('total_roles', $total_roles);

        $total_users = (\Schema::hasTable('users')) ? User::where('rol_id', 1)->count() : 0;
        view()->share('total_users', $total_users);

        $total_configurations = (\Schema::hasTable('configuration')) ? Configurations::get()->count() : 0;
        view()->share('total_configurations', $total_configurations);

        $total_clients = (\Schema::hasTable('users')) ? User::where('rol_id', 2)->count() : 0;
        view()->share('total_clients', $total_clients);

        $pages = '';
        $title_login = '';
        if(\Schema::hasTable('pages')){
            $pages = Pages::where('slug', 'titulo-login')->first();
            if($pages){
                $title_login = $pages->name;
            }
        }

        $subtitle_login = '';
        if(\Schema::hasTable('pages')){
            $pages = Pages::where('slug', 'subtitulo-login')->first();
            if($pages){
                $subtitle_login = $pages->name;
            }
        }

        $name_login = '';
        if(\Schema::hasTable('pages')){
            $pages = Pages::where('slug', 'nombre-login')->first();
            if($pages){
                $name_login = $pages->name;
            }
        }

        view()->share('title_login', $title_login);
        view()->share('subtitle_login', $subtitle_login);
        view()->share('name_login', $name_login);


    }
}
