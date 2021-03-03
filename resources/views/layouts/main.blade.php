<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta description="Nettflytt home page">

        <title>Nettflytt</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="{{ asset('css/bootstrap.min.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('css/tavo-calendar.css') }}?v={{ time() }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}?v={{ time() }}" rel="stylesheet">
        <!-- <link href="{{ asset('css/purecookie.css') }}?v={{ time() }}" rel="stylesheet"> -->
    </head>
    <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg px-0">
        <a class="navbar-brand title" href="/">
        <img src="{{ asset('images/nettflytt-logo.png')}}" width="40" height="40" class="d-inline-block align-top" alt="Netflytt logo">
        Nettflytt
        </a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <div class="dropdown float-right">
                    <button class="btn" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Meny <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                        <a href="/" class="dropdown-item" type="button">Hjem</a>
                        <a href="/" class="dropdown-item" type="button">Start flytting</a>
                        <a href="/about-us" class="dropdown-item" type="button">Personvern</a>
                        <a href="/contact-us" class="dropdown-item" type="button">Kontakt oss</a>
                    </div>
                </div>               
            </li>
        </ul>
        </nav>
    </div>
    <!--Navbar-->
<!--/.Navbar-->
        <div class="container mt-md-5">
            <?php echo json_encode(session('customer')); ?>
<!--             @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->

            <div class="content">
                @yield('content')
            </div>
        </div>

<footer class="page-footer bg-info">
  <div class="container text-center text-md-left py-5">
    <div class="row">
      <div class="col-md-3 mb-md-0 mb-3">
        <h5>Informasjon</h5>
        <ul class="list-unstyled">
          <li>
            <a href="/privacy-policy">Personvern</a>
          </li>
          <li>
            <a href="/terms-of-use/">Kjøpsvilkår</a>
          </li>
          <li>
            <a href="/contact-us/">Kontakt oss</a>
          </li>
        </ul>
      </div>
      <div class="col-md-3 mb-md-0 mb-3">
        <h5>Selskap</h5>

        <ul class="list-unstyled">
          <li>
            <a href="/">Nettflytt AS</a>
          </li>
          <li>
            <a href="/">924 729 341 MVA</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/58a5e1829b.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/moment.min.js') }}" ></script>
    <script src="{{ asset('js/moment-with-locales.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('js/tavo-calendar.js') }}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/pagination.js') }}"></script>
    <!-- <script src="{{ asset('js/purecookie.js') }}"></script> -->

</html>
