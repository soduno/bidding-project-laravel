@extends('layouts/full')

@section('titletag', 'Dashboard')

@section('content')
  <div class="row profile-section">
    <div class="col-lg-4 avatar flex flex-center flex-vcenter flex-column">
      <section class="profile-image">

      </section>
      <div class="ratings flex flex-center flex-vcenter">
        @for ($i=0; $i < 4; $i++)
          <span class="rating"><img src="/images/rating-star.png" /></span>
        @endfor
      </div>
    </div>

    <div class="col-lg-4 quick-facts facts">
      <h3>{{$profile->cname}}</h3>
      <ul>
        <li>14 orders delivered</li>
        <li>Member since 2009</li>
      </ul>
    </div>

    <div class="col-lg-4 information facts">
      <h3>{{$profile->title}}</h3>
      <ul>
        <li>Email: {{$profile->email}}</li>
        <li>Phone: {{$profile->phone}}</li>
        <li>Ean.: {{$profile->ean}}</li>
        <li>Website: {{$profile->website}}</li>
        <li>Country: {{$profile->country}}</li>
        <li>Contact person: {{$profile->contact_name}}</li>
      </ul>
    </div>
  </div>
@endsection
