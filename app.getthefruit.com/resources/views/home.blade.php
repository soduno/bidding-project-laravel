@extends('layouts/full')
@section('content')
<div class="container demands">

  <div class="page-title">
    <h3 class="text-center">Most Recent demands</h3>
  </div>

  <div class="row justify-content-center">
      <div class="col-md-12">
        <table class="demand w100">
          @foreach ($demands as $demand)
            <tr>
              <td class="thumb"><img src="/images/placeholder.jpg" /></td>
              <td>10 kg</td>
              <td>{{ date('d. M Y', strtotime($demand->created_at)) }}</td>
              <td>{{$demand->country}}</td>
              <td>{{ $demand->user['cname']}}</td>
              <td>Rating here</td>

              <td class="actions">
                <div>
                  <a href="/demand/{{$demand->id}}" class="btn-demand block">More information</a>
                  <a class="btn-demand bid block">Place bid</a>
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
