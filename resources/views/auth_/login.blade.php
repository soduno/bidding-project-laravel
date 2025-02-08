@extends('layout')

@section('titletag', 'Login')

@section('content')
  <div class="login-form">
    <div class="flex flex-center flex-column">
      <header class="flex flex-center">
        <span class="logo block"><img src="/images/logo.png" /></span>
      </header>

      <form action="{{ route('login') }}" method="post">
        @csrf

        <span class="block">
          <input type="text" placeholder="Username / e-mail" name="email" id="login" class="input-fields" />
          @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
          @endif
        </span>
        <span class="block">
          <input type="password" placeholder="Password" class="{{ $errors->has('password') ? ' is-invalid' : '' }} input-fields" name="password" id="password" class="input-fields" />
          @if ($errors->has('password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
          @endif
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

        <div class="actions flex">
          <label for="remember-me" class="stay-logged pointer">
            <input type="checkbox" id="remember-me" name="remember-me" />
            Stay logged in
          </label>

          <button type="submit" name="submit" class="btn btn-primary">
            <span class="Log in">Log in</span>
          </button>
        </div>

      </form>

    </div>
  </div>
@endsection
