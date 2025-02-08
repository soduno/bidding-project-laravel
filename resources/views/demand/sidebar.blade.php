<?php
  if(!isset($static)){
    $static = 0;
  }

?>

<div class="col-xs-12 col-sm-4 col-lg-4 place-demand @if($static == 1) offset-lg-1 @endif">
  <div class="demand-box">
    <div class="page-title">
      <h3>Place bid on demand</h3>
    </div>
    @if($static !== 1)
    <form action="" method="post">
      {{ csrf_field() }}
    @endif
      Your price pr box

      <input type="number" name="priceinput" id="priceinput" placeholder="@if($static == 1) {{$bidData['totalBid']}} @endif" class="block w100" onkeyup="$.app.placeBid.calculate();" @if($static == 1) disabled @endif  />

      @if($static !== 1)
        <input type="hidden" name="boxes" id="boxes" value="{{$demand->boxes}}" />
      @endif
      <table class="table totals">
        <tr>
            <th>Your bid</td>
            <td class="text-right"><span class="sum" id="bid">
              @if($static == true)
                {{$bidData['totalBid']}}
              @else
                0
              @endif
            </span></td>
        </tr>
        <tr>
            <th>Getthefruit fee (2%)</td>
            <td class="text-right"><span class="sum" id="fee">
              @if($static == true)
                {{$bidData['fee']}}
              @else
                0
              @endif
            </span></td>
        </tr>
        <tr>
            <th>Total</td>
            <td class="text-right"><span class="sum" id="total">
              @if($static == true)
                {{$bidData['total']}}
              @else
                0
              @endif
            </span></td>
        </tr>
      </table>

      <div class="hero">
        <span>This price includes....</span>
      </div>

      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      @if($static == 1)
        <div class="terms">
          <input type="checkbox" />
          By continuing you accept the terms and conditions.
        </div>
      @endif

      <button type="submit" class="btn w100">
        <span>
          @if($static == 1)
            Place bid
          @else
            Continue
          @endif
        </span>
      </button>
    @if($static !== 1)</form>@endif

  </div>
</div>
