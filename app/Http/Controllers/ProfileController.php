<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function getCustomerType()
    {

      $userType = Auth::user()->access_level;

      switch ($userType) {
        case 20:
          $userType = 'customer';
          break;

        default:
          $userType = 'supplier';
          break;
      }

      return $userType;
    }

    public function ViewProfile(Request $request)
    {
      $profile = \App\userDetails::where('user_id', $request->profileId)->get()[0];


      return view('profile/view', compact('profile'));
    }

    public function EditProfile(Request $request)
    {

      $profile = \App\userDetails::where('user_id', Auth::user()->id)->get();
      $profile[0]->access_level = Auth::user()->access_level;



      if($profile){
        $profile = $profile[0];

        $profile->avatar_url = Storage::url($profile->avatar);
        $profile->certificates = json_decode($profile->certificates);

        return view('profile/edit', compact('profile'));
      }

    }

    public function RemoveCertificate(Request $request)
    {

      $profile = \App\userDetails::where('user_id', Auth::user()->id)->get();


      if($profile){
        $profile = $profile[0];
         $certificates = $profile->certificates;
         if(!empty($certificates)){
           $certificates = json_decode($certificates);
           unset($certificates[$request->count]);
           $profile->certificates = json_encode($certificates);
         }

      }

      if($profile->save()){
        return Redirect('/profile/edit')->with('status', 'Profile is updated');
      }else{
        return Redirect('/profile/edit')->withErrors(['Could not update']);
      }

    }

    public function UpdateProfile(Request $request)
    {
      $profileId = Auth::user()->id;
      if(isset($_FILES['avatar'])){
        $path = Storage::putFile('public', $request->file('avatar'));
        $userDetails = \App\userDetails::where('user_id', $profileId)->first();
        $userDetails->avatar = $path;



        if($userDetails->save()){
          return Redirect('/profile/edit')->with('status', 'Profile is updated');
        }else{
          return Redirect('/profile/edit')->withErrors(['Could not update']);
        }
      }

      $validateData = $request->validate([
        'cname' => 'max:255',
        'vat' => 'max:255',
        'adress' => 'max:255',
        'country' => 'max:255',
        'email' => 'max:255',
        'phone' => 'max:255',
        'website' => 'max:255',
        'adress_invoice' => 'max:255',
        'contact_name' => 'max:255',
        'contact_phone' => 'max:255',
        'contact_email' => 'max:255'
      ]);

      if($validateData){
        $userDetails = \App\userDetails::where('user_id', $profileId)->first();
        $user = \App\user::where('id', $profileId)->first();
        $user->access_level = $request->input('access_level');
        $user->save();
        $certificates = $request->file('certificates');


        if($request->hasFile('certificates'))
        {

            $certificate_url = [];
            $count = 0;
            foreach ($certificates as $file) {

                $path = Storage::putFile('public', $file);
                $row = [];
                $row['url'] = $path;
                $row['name'] = $request->input('certificate_name')[$count];
                $certificate_url[] = $row;
                $count++;
            }

            $original_certificates = $userDetails->certificates;
            if(!empty($original_certificates)){
              $original_certificates = json_decode($original_certificates);
              foreach ($original_certificates as $item) {
                $certificate_url[] = $item;
              }
            }

            $userDetails->certificates = json_encode($certificate_url);
        }



          // $store->avatar = $request->input('');
          $userDetails->cname = $request->input('cname');
          $userDetails->email = $request->input('email');
          $userDetails->phone = $request->input('phone');
          $userDetails->country = $request->input('country');
          $userDetails->adress = $request->input('adress');
          $userDetails->vat = $request->input('vat');
          $userDetails->adress_invoice = $request->input('adress_invoice');
          $userDetails->contact_name = $request->input('contact_name');
          $userDetails->contact_phone = $request->input('contact_phone');
          $userDetails->contact_email = $request->input('contact_email');

          if($userDetails->save()){
            return Redirect('/profile/edit')->with('status', 'Profile is updated');
          }else{
            return Redirect('/profile/edit')->withErrors(['Could not update']);
          }

      }

    }
}
