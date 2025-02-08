<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;
use App\Controllers\ProfileController;
use Redirect;

class RegisterController extends Controller
{
    public function Index()
    {
      return view('auth/register');
    }

    public function attemtLogin($request, $profileId)
    {
      if(Auth::attempt([
        'name' => $request->email,
        'email'    => $request->email,
        'password' => $request->password,
      ])){

        return Redirect('profile/edit');
      }
    }

    public function createUser(Request $request)
    {

      if(!$request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'terms' => 'required',
      ])){
        return Redirect::back()->withErrors(['Validation is not complete. Please check your fields.']);
      }

      $user = User::create([
        'name' => $request->email,
        'email'    => $request->email,
        'password' => $request->password,
      ]);

      $userDetails = new \App\userDetails;
      $userDetails->user_id = $user->id;

      if($userDetails->save()){
        return $this->attemtLogin($request, $user->id);
      }else{
        return Redirect::back()->withErrors(['An error occoured while trying to add a new user. Please try again']);
      }

    }
}
