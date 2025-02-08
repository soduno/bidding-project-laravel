<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $demands = \App\Demands::orderBy('id', 'desc')
               ->take(3)
               ->get();
        foreach ($demands as $demand) {
            $demand->user =  \App\userDetails::where("user_id", $demand->fk_user)->first();
        }

        return view('home', compact('demands'));
    }
}
