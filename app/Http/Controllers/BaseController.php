<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BaseController extends Controller
{
  public function __construct()
{
 //its just a dummy data object.
 $access_level = Auth::user()->access_level;

 // Sharing is caring
 View::share('access_level', $access_level);
}
}
