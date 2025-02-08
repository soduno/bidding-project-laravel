@extends('layouts/full')

@section('content')
<style>
.filebox{
  width:200px;
  height: 200px;
  margin-top: 20px;
  margin-right: 20px;
  float: left;
  background: #eee;
  text-align: center;
  padding-top: 90px;
}
</style>
  <div class="row order-completed">
    <div class="col-lg-12">
      <div class="page-title hero text-center">
        <h1>Thank you for your bid</h1>
        <span class="block sub-line">we will let you know if the customer chooses your bid</span>
      </div>
    </div>
  </div>

  <div class="row order-completed">
    <div class="col-lg-3  offset-lg-1">
      <div class="page-title">
        <h3>Demand information</h3>
        <span>
          {{$bidOrder->description}}
        </span>
      </div>
    </div>

    <div class="col-lg-3  offset-lg-1">
      <div class="page-title">
        <h3>Bid information</h3>
      </div>
      <table class="w100 order-receipt">
        <tbody>
          <tr>
            <th>Your price pr. box</th>
            <td class="text-right">{{$bidOrder->price_box}}</td>
          </tr>
          <tr>
            <th>Your bid</th>
            <td class="text-right">{{$bidOrder->price_bid}}</td>
          </tr>
          <tr>
            <th>Getthefruit fee(2%)</th>
            <td class="text-right">{{$bidOrder->price_fee}}</td>
          </tr>
          <tr>
            <th>total</th>
            <td class="text-right">{{$bidOrder->price_total}}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-lg-3 offset-lg-1">
      <div class="page-title">
        <h3>Attached files</h3>
        <?php
          if(!empty($bidOrder->images_url)):

            $count = 1;
            foreach ($bidOrder->images_url as $img):?>
              <a target="_blank" href="<?php echo $img; ?>">
                <div class="filebox">File <?php echo $count; ?></div>
              </a>
          <?php $count++; endforeach;
        endif;

         ?>
      </div>
    </div>
  </div>
@endsection
