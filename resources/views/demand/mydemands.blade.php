@extends('layouts/full')
@section('content')
<div class="container demands">

  <div class="page-title">
    <h3 class="text-center">Ready for selection demands</h3>
  </div>

  <div class="row justify-content-center">
      <div class="col-md-12">
        <table class="demand w100">
          @foreach ($demands->readyDemands as $demand)
            <tr>
              <td class="thumb"><img src="/images/placeholder.jpg" /></td>
              <td>10 kg</td>
              <td>{{ date('d. M Y', strtotime($demand->created_at)) }}</td>
              <td>{{$demand->country}}</td>
              <td>{{ $demand->user['cname']}}</td>
              <td>Rating here</td>

              <td class="actions">
                <div>
                  <a href="/demand/bids/{{$demand->id}}" class="btn-demand block">Choose supplier</a>

                </div>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
  </div>

  <div class="page-title">
    <h3 class="text-center">Active demands</h3>
  </div>

  <div class="row justify-content-center">
      <div class="col-md-12">
        <table class="demand w100">
          @foreach ($demands->activeDemands as $demand)
            <tr>
              <td class="thumb"><img src="/images/placeholder.jpg" /></td>
              <td>10 kg</td>
              <td>{{ date('d. M Y', strtotime($demand->created_at)) }}</td>
              <td>{{$demand->country}}</td>
              <td>{{ $demand->user['cname']}}</td>
              <td>Rating here</td>

              <td class="actions">
                <div>
                  <a href="/demand/bids/{{$demand->id}}" class="btn-demand block">See bids</a>

                </div>
              </td>
            </tr>
          @endforeach
        </table>
      </div>
  </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

            </div>
        </div>
    </div>
</div>
@endsection
