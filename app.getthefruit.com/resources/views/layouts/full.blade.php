@include('layouts/parts/header')
<header id="main-header" class="container-fluid">
  <div class="container">
    <div class="row flex-vcenter">
      <div class="col-lg-3 text-center">
        <a href="/dashboard/">
        <span class="logo block"><img src="/images/logo.png" /></span>
      </a>
      </div>
      <div class="col-lg-5 search-orders">
        <form action="">
          <span class="form-group search-c">
            <input type="text" class="search-input" placeholder="Search orders" />
            <button type="submit">&nbsp;</button>
          </span>
        </form>
      </div>
      <div class="col-lg-4 user-methods text-center">
        <div class="create-order block">
          <?php
            if(Auth::user()->access_level == 10):
           ?>
          <a class="btn" href="/demand/create/">
            <span>Create demand</span>
          </a>
        <?php endif; ?>

          <span class="user-nav">
            <img src="/images/usr-ico.png" class="toggle-nav pointer" onclick="$.app.header.toggleUser()" />
            <nav class="hidden-t">
              <ul>
                <?php
                  if(Auth::user()->access_level == 20):
                 ?>
                <li>
                  <a href="/dashboard" class="block">Recent demands</a>
                </li>
              <?php endif; ?>
                <?php
                  if(Auth::user()->access_level == 10):
                 ?>
                <li>
                  <a href="/mydemands" class="block">My demands</a>
                </li>
              <?php endif; ?>
                <?php
                  if(Auth::user()->access_level == 10):
                 ?>
                <li>
                  <a href="/demand/create" class="block">Create demand</a>
                </li>
              <?php endif; ?>
                <li>
                  <a href="/profile/edit" class="block">Edit profile</a>
                </li>
              </ul>
            </nav>

          </span>
          <span><img src="/images/chat-ico.png" /></span>
        </div>
      </div>
    </div>
  </div>
</header>

<div class="content container full">
  @yield('content')
</div>

@include('layouts/parts/footer')
