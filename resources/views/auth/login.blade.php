@extends('layouts/layout')

@section('titletag', 'Login')

@section('content')
  <div class="login-form">
    <div class="flex flex-center flex-column">
      <header class="flex flex-center">
        <span class="logo block"><img src="/images/logo.png" /></span>
      </header>

      <form action="" method="post">
        {{ csrf_field() }}

        <span class="block">
          <input type="text" placeholder="Username / e-mail" name="login" id="login" class="input-fields"  />
        </span>
        <span class="block">
          <input type="password" placeholder="Password" name="password" id="password" class="input-fields" />
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

        <footer class="text-center">
          <div class="forgot">
            <a href="/reset-password">Forgot your password?</a>
            <a href="/reset-password">Reset your password</a><span><br /></span>
          </div>

          <div class="signup">
            <a href="/register">Sign up here</a><span> If you don't have an account</span>
          </div>
        </footer>

      </form>

    </div>
  </div>
@endsection
