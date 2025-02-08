<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SuppliersController extends Controller
{
    public function Profile(Request $request)
    {

      $id = $request->supplierId;

      $profile = \App\Suppliers::Where('user_id', $id)->get()[0];

      return view('supplier/profile', compact('profile'));
    }

    public function EditProfile()
    {
      $profile = \App\Customers::where('user_id', Auth::id())->get()[0];

      return view('share/profile/edit', compact('profile'));
    }
}
