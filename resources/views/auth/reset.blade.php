@extends('layouts/layout')

@section('titletag', 'Create account')

@section('content')
  <div class="login-form register">
    <div class="flex flex-center flex-column">
      <header class="flex flex-center flex-column text-center">
        <span class="logo block"><img src="/images/logo.png" /></span>
        <h1>Reset your password</h1>
      </header>

      <form action="" method="post">
        {{ csrf_field() }}

        <span class="block">
          <input type="text" placeholder="Your email" name="email" id="email" class="input-fields" />
        </span>

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif

        <div class="actions flex">
          <button type="submit" name="submit" class="btn btn-primary w100">
            <span class="Log in">Reset my password</span>
          </button>
        </div>

      </form>

    </div>
  </div>
@endsection
