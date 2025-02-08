<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\SessionGuard;
use App\Controllers\ProfileController;
use Illuminate\Support\Facades\Input;
use App\Mail\resetPassword;
use Redirect;
use Mail;



class LoginController extends Controller
{
    public function Index()
    {
      // $usr = \App\user::where('id', 26)->first();
      // $usr->password = 1234;
      // $usr->save();

      return view('auth/login');
    }

    public function ResetViewToken(Request $request, $token)
    {
      return view('auth/reset-token');
    }

    public function ResetViewTokenDo(Request $request, $email)
    {

      $validateData = $request->validate([
        'pwd' => 'required|same:pwd2',
      ]);

      $token = Input::get('token');


      if(!Hash::check('mail@simonduun.com', $token)){
        return Redirect('/reset-password/'.$email.'?token='.$token)->with('error', 'Reset password is expired');
      }

      if(!$validateData){
        return Redirect('/reset-password/'.$email.'?token='.$token)->with('error', 'Check that your passwords match');
      }

      $usr = \App\User::where([
        ['reset_token', '=', $token],
        ['email', '=', $email],
      ])->get()->first();

      if($usr){
        $usr->password = $request->input('pwd');
        $usr->reset_token = '';
        $usr->save();

        return Redirect('/');
      }

    }

    public function ResetView()
    {
      return view('auth/reset');
    }

    public function ResetAction(Request $request)
    {
      $token = Hash::make(('email'));

      $validateData = $request->validate([
        'email' => 'required|email',
      ]);

      if($validateData){
        $user = \App\User::where('email', $request->input('email'))->get();

        if(!$user->isEmpty()){
          $user = $user->first();
          $user->reset_token = $token;
          $user->save();
        }

        Mail::to($request->input('email'))->send(new resetPassword($request->input('email'), $token));

        return Redirect('/reset-password')->with('status', 'If a user is registered with the account, a email is on it\'s way');

      }else{
        return Redirect('/reset-password')->with('error', 'Not a valid email');
      }
    }

    public function DoLogin(Request $request)
    {

      if($request->validate([
        'login' => 'required',
        'password' => 'required',
      ])){

        if (Auth::attempt([
          'name' => $request->input('login'),
          'password' => $request->input('password'),
          ])) {

            return redirect()->intended('/profile/'.Auth::user()->id);

        }else{
          return Redirect::back()->withErrors(['User not found, or password is incorrect']);
        }

      }
    }
}
