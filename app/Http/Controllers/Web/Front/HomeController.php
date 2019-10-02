<?php

namespace App\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Routes;

class HomeController extends Controller
{
    public function index(Request $request){
        $origin = Routes::groupBy('origin')->get();
        $destination = Routes::groupBy('destination')->get();
        $request->session()->put('vantogo', [
            "uno" => 1,
            "dos" => 2,
            "tres" => 3,
        ]);
        return view('front.home.index', [
            'origin' => $origin,
            'destination' => $destination
        ]);
    }

    public function result(Request $request){
        $request->session()->push('vantogo', ["cuatro" => 4]);
        $sesion = $request->session()->get('vantogo');
        dd($sesion);
        return view('front.home.result');
        $origin = Routes::groupBy('origin')->get();
        $destination = Routes::groupBy('destination')->get();
        return view('front.home.index', [
            'origin' => $origin,
            'destination' => $destination
        ]);
    }
}
