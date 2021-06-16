<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta description="Flytteregisteret home page">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Flytteregisteret</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}?v={{ time() }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

        <link href="{{ asset('css/bootstrap.min.css') }}?v={{ time() }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        table tr td{
            text-align: left!important;
        }
        .mw-300{
            max-width: 350px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand title" href="/">
                <img src="{{ asset('images/nettflytt-logo.png')}}" width="40" height="40" class="d-inline-block align-top" alt="Netflytt logo">
                Flytteregisteret
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        @if(Auth::user()->type == 1)
                        <div class="card">
                            <div class="card-header"><h5>{{ __('Reports') }}</h5></div>
                            <div class="card-body">
                                <ul>
                                    <li><a href="/sales-report">Sales Report</a></li>
                                    <li><a href="/power-report">Norges Energi Report</a></li>
                                    <li><a href="/offers-report">Offers Report</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-header"><h5>{{ __('Admin Tools') }}</h5></div>
                            <div class="card-body">
                                <ul>
                                    <li><a href="/storage-update">Storage Update</a></li>
                                    <li><a href="/sms-management">Manage SMS</a></li>
                                    <li><a href="/users-management">Manage Users</a></li>

                                </ul>
                            </div>
                        </div>
                        @else
                        <div class="card">
                            <div class="card-header"><h5>{{ __('Sales Management Tools') }}</h5></div>
                            <div class="card-body">
                                <ul>
                                    <li><a href="/storage-update">Storage Update</a></li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
    <script type="application/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="application/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="application/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/admin.js') }}"></script>
    <script type="application/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</html>
