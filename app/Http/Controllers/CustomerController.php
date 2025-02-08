<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class CustomerController extends Controller
{
    public function Index()
    {
      return view('/customer/home');
    }

    public function Profile(Request $request)
    {
      return view('/customer/profile');
    }

    public function EditProfile()
    {
      $profile = \App\Customers::where('user_id', Auth::id())->get()[0];

      return view('share/profile/edit', compact('profile'));
    }
}
