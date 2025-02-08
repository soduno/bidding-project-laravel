@extends('layouts/layout')

@section('titletag', 'Create account')

  <div class="login-form register">
    <div class="flex flex-center flex-column">
      <header class="flex flex-center flex-column text-center">
        <span class="logo block"><img src="/images/logo.png" /></span>
        <h1>Reset your password</h1>
      </header>

      @yield('formular-content')

    </div>
  </div>
@endsection
