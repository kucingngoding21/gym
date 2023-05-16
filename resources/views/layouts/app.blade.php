<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Amazing E-Grocery</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .footer {
          position: fixed;
          left: 0;
          bottom: 0;
          width: 100%;
          background-color: red;
          color: white;
          text-align: center;
        }
        </style>
</head>
<body class="">
    <div id="app">
        @guest

        <nav class="navbar navbar-expand-md bg-success shadow">
            <div class="container">
                <a class="navbar-brand text-dark position-absolute" style="right: 530px;" href="{{ url('/') }}">
                    <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Amazing E-Grocery</h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="btn btn-warning m-2 " style="" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-warning m-2 " style="" href="{{ route('index.user') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

            </div>
        </nav>
        @else
        <div class="container-fluid p-5 bg-success text-white text-center">
            <a class="navbar-brand text-dark position-absolute" style="right: 440px;" href="{{ url('/') }}">
                <h1 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Amazing E - Grocery 2023</h1>
            </a>


            <br>
            <div class="position-absolute" style="right:200px;">
                <a class="btn btn-sm btn-warning text-dark font-weight-bold" href="{{ route('logout') }}" style=""  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            <br>
          </div>
          <div class=".container">
            <ul class="nav bg-warning justify-content-center shadow">
              <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold hover" href="{{ url('/home') }}" style="">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold" href="{{ route('index.order') }}" style="">Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark font-weight-bold" href="{{ route('index.profile') }}" style="">Profile</a>
              </li>
              @if(Auth::check())
              @if(Auth::user()->first_name && Auth::user()->role_name ==  'admin')
              <li class="nav-item">
                <a class="nav-link  text-dark font-weight-bold" href="{{ route('index.user') }}"  style="">Account Maintenance</a>
              </li>
              @endif
              @endif

            </ul>
        </div>
        @endguest
        <div class="mb-3">
            <main class="py-4">
                @yield('content')
            </main>
        </div>
        <div>
            <div class="footer bg-success text-dark">
                <p>&copy Amazing E-Grocery 2023</p>
              </div>
        </div>
    </body>
    <!-- Footer -->

</html>
