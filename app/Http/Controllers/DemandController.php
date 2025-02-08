<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Storage;

class DemandController extends Controller
{
  public function AddComment(Request $request){
    $validateData = $request->validate([
      'comment' => 'required',
      'demandId' => "required"
    ]);
    if($validateData){
       $profileId = Auth::user()->id;

       $comment = \App\Comment::create([
         'comment' => $request->comment,
         'fk_user' => $profileId,
         'fk_demand' => $request->demandId
       ]);

       return redirect('demand/' . $request->demandId);
     }

  }

  public function CreateDemand(Request $request)
  {
    //$profile = \App\userDetails::where('user_id', $request->profileId)->get()[0];

    return view('demand/create', compact('profile'));
  }

  public function SubmitDemand(Request $request)
  {
    //$profile = \App\userDetails::where('user_id', $request->profileId)->get()[0];

    $validateData = $request->validate([
      'product' => 'required|max:255',
      'packaging' => 'required|max:255',
      'country' => 'required|max:255',
      'pallet' => 'required|max:255',
      'boxes' => 'required|max:255',
      'label' => 'required|max:255',
      'lot' => 'required|max:255',
      'ending_day' => 'required',
      'ending_time' => 'required',
      'certificates' => 'required',
      'delivery' => 'required',
      'description' => 'required'

    ]);

    if($validateData){
       $profileId = Auth::user()->id;

       $certificates = json_encode($request->certificates);

       $demand = \App\Demands::create([
         'product' => $request->product,
         'packaging' => $request->packaging,
         'country' => $request->country,
         'pallet' => $request->pallet,
         'boxes' => $request->boxes,
         'label' => $request->label,
         'lot' => $request->lot,
         'ending_day' => $request->ending_day,
         'ending_time' => $request->ending_time,
         'certificates' => $certificates,
         'delivery' => $request->delivery,
         'description' => $request->description,
         'created_at' => date("Y-m-d H:i:s"),
         'fk_user' => $profileId
       ]);

    }

  return redirect('dashboard');
  }

  public function DemandDo(Request $request, $demandId)
  {

    $validateData = $request->validate([
      'priceinput' => 'required',
    ]);

    if(!$validateData){
      return Redirect('/demand/'.$demandId)->with('error', 'Please check your fields');
    }

    return Redirect('/place-bid/'.$demandId.'/'.$request->input('priceinput'));
  }

  public function ViewDemand(Request $request)
  {

    $demand = \App\Demands::where("id", "=" ,$request->demandId)->first();
    $created_by = \App\userDetails::where("user_id", "=" ,$demand->fk_user)->first();
    $demand->user = $created_by;
    $demand->user->avatar_url = Storage::url($demand->user->avatar);
    $comments = \App\Comment::where("fk_demand", "=" ,$request->demandId)->orderBy("id", "desc")->get();

    foreach ($comments as $comment) {
        $comment->userDetails = \App\userDetails::where("user_id", "=", $comment->fk_user)->first();
        $comment->userDetails->avatar_url = Storage::url($comment->userDetails->avatar);
    }
    $demand->comments = $comments;

    return view('demand/view', compact('demand'));
  }

  public function MyDemands(Request $request){

    $activeDemands = \App\Demands::where("fk_user", "=", Auth::user()->id)
    ->where("ending_day", ">", date("Y-m-d"))
           ->take(20)
           ->get();

           $readyDemands = \App\Demands::where("fk_user", "=", Auth::user()->id)
           ->where("ending_day", "<", date("Y-m-d"))
                  ->take(20)
                  ->get();

    foreach ($activeDemands as $demand) {
        $demand->user =  \App\userDetails::where("user_id", $demand->fk_user)->first();
    }
    foreach ($readyDemands as $demand) {
        $demand->user =  \App\userDetails::where("user_id", $demand->fk_user)->first();
    }
    $demands = new \stdClass();
    $demands->readyDemands = $readyDemands;
    $demands->activeDemands = $activeDemands;

    return view('demand/mydemands', compact('demands'));

  }

  public function placeBid($demandId, $price){

    $demand = \App\Demands::where("id", "=", $demandId)->first();
    $userDetails = \App\userDetails::where("user_id", "=", $demand->fk_user)->first();

    $totalBid = $price*$demand->boxes;
    $fee = $totalBid*0.02;

    return view('demand/place-bid', [
      'static' => 1,
      'demand' => $demand,
      'userDetails' => $userDetails,
      'bidData' => [
        'price' => $price,
        'totalBid' => $totalBid,
        'fee' => $fee,
        'total' => $totalBid + $fee,
      ]
    ]);
  }

  public function placeBidStore(Request $request, $demandId, $price)
  {

    $nextId = DB::table('demand_bids')->max('id') + 1;
    $orderId = $nextId.Str::random(10);

    $demand = \App\Demands::find($demandId)->first();
    $totalBid = $price*$demand->boxes;
    $fee = $totalBid*0.02;

    $placeBid = new \App\Bids;
    $placeBid->demand_id = $demandId;
    $placeBid->price_bid = $price;
    $placeBid->price_fee = $fee;
    $placeBid->price_total = $totalBid;
    $placeBid->price_box = $demand->boxes;
    $placeBid->user_id = Auth::id();
    $placeBid->order_id = $orderId;
    $placeBid->description = $request->bid_description;

    $images = $request->file('file_goods');
    if($request->hasFile('file_goods'))
    {

        $images_url = [];
        foreach ($images as $file) {
            $path = Storage::putFile('public', $file);
            $images_url[] = $path;
        }
        $placeBid->images = json_encode($images_url);
    }
    if($request->has('certificates_name')) {

      $certificates_input = $request->certificates_name;

      $certificates = [];
      $count = 0;
      foreach ($certificates_input as $item) {
          $certificate = ['name' => $item, 'url' => $request->certificates_url[$count]];
          $certificates[] = $certificate;
          $count++;
      }
      $placeBid->certificates = json_encode($certificates);


    }


    if($placeBid->save()){
      return Redirect('/order-completed/'.$orderId);
    }
  }

  public function orderCompleted($orderId)
  {

    $bidOrder = \App\Bids::find(['order_id', $orderId])->where('user_id', Auth::id())->first();
    if($bidOrder){
      if(!empty($bidOrder->images)):
          $images = json_decode($bidOrder->images);
          $images_url = [];
          foreach ($images as $image) {
          $image =  Storage::url($image);
          $images_url[] = $image;
          }

          $bidOrder->images_url = $images_url;
      endif;
      return view('/demand/order-completed', compact('bidOrder'));
    }else{
      return Redirect('/');
    }

  }
}
