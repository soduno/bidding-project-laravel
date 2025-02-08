@extends('layouts/layout')

@section('titletag', 'Create account')

@section('content')
  <div class="login-form register">
    <div class="flex flex-center flex-column">
      <header class="flex flex-center flex-column text-center">
        <span class="logo block"><img src="/images/logo.png" /></span>
        <h1>Create free account</h1>
      </header>

      <form action="" method="post">
        {{ csrf_field() }}

        <span class="block">
          <input type="text" placeholder="e-mail" name="email" id="email" class="input-fields" />
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
          <label for="terms" class="stay-logged pointer">
            <input type="checkbox" id="terms" name="terms" />
            I accept the <a href="/terms-and-conditions">terms and conditions</a>
          </label>

          <button type="submit" name="submit" class="btn btn-primary">
            <span class="Log in">Log in</span>
          </button>
        </div>

        <footer class="text-center">
          <div class="forgot">
            <span>Do you already have an account?</span>
            <a href="/login">Login here</a><span><br /></span>
          </div>
        </footer>

      </form>

    </div>
  </div>
@endsection
