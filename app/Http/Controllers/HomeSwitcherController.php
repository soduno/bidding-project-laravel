<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;

use Illuminate\Http\Request;

class HomeSwitcherController extends Controller
{

    public function Index()
    {

      if(Auth::check()){

        $userType = \App\Http\Controllers\LoginController::getUserType(Auth::user()->access_level);

        return Redirect($userType.'/home');
      }else{
          return Redirect('login');
      }

    }

}
