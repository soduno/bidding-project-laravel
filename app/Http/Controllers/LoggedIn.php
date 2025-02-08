<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class LoggedIn extends Controller
{
    public function Index()
    {
      return view('user/dashboard');
    }
}
