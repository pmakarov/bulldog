<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
</head>
<body id="main">
    <div id="app">
        
        <nav class="navbar">
          <div class="container">
            <div class="navbar-brand">
              <a class="navbar-item" href="../">
                <!-- <img src="http://bulma.io/images/bulma-type-white.png" alt="Logo"> -->
                BULLDOG
              </a>
              <span class="navbar-burger burger" data-target="navbarMenu">
                <span></span>
                <span></span>
                <span></span>
              </span>
            </div>  <!-- end navbar-brand -->
            <div id="navbarMenu" class="navbar-menu">
              <div class="navbar-end">
                <!-- <a class="navbar-item">
                  Tutorials
                </a>
                <a class="navbar-item">
                  Documentation
                </a> -->
                @auth
                <!-- <span class="navbar-item">
                  <a href="{{ url('/home') }}">Home</a>
                </span>  -->
                <div class="navbar-item has-dropdown is-hoverable">
                      <a class="navbar-link" href="">
                      {{ Auth::user()->name }}
                      </a>
                      <div class="navbar-dropdown is-boxed">
                          <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              Logout
                          </a>
                      </div>
                </div> <!-- end navbar-item -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
                @else
                  <span class="navbar-item">
                    <a class="button is-white is-outlined is-small" href="{{ route('login') }}">
                    <span class="icon">
                        <i class="fa fa-sign-in"></i>
                    </span>
                    <span>Login</span>  
                  </a>
                  </span> 
                  <span class="navbar-item">
                    <a class="button is-white is-outlined is-small" href="{{ route('register') }}">
                    <span class="icon">
                        <i class="fa fa-address-card"></i>
                    </span>
                      <span>Register<span>  
                    </a>
                  </span> 
                  @endauth
              </div> <!-- end navbar-end -->
            </div>   <!-- end navbar-menu -->

        
          </div> <!-- end container -->
        </nav> <!-- end nav -->

        

    </div> <!-- end of app -->
    <main id="">
      @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
