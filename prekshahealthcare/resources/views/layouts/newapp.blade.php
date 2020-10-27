<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <!-- Document Meta ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--IE Compatibility Meta-->
    <meta name="author" content="Preksha Health Care"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Preksha Health Care">
    <link href="{{ asset('images/favicon/favicon.png') }}" rel="icon">

    <!-- Fonts ============================================= -->
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,400i,500,600,700' rel='stylesheet' type='text/css'>

    <!-- Stylesheets ============================================= -->
    <link href="{{ asset('css/external.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]> <script src="assets/js/html5shiv.js"></script> <script src="assets/js/respond.min.js"></script> <![endif]-->

    <!-- Document Title ============================================= -->
    <title>{{ config('app.name', 'Laravel') }}</title>
  </head>
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <body class="body-scroll">
    <!-- Document Wrapper ============================================= -->
    <div id="wrapperParallax" class="wrapper clearfix">

      <!-- Header ============================================= -->
      <header id="navbar-spy" class="header header-1 header-transparent header-fixed">
        <nav id="primary-menu" class="navbar navbar-expand-lg navbar-dark">
          <div class="container">
            <a class="navbar-brand" href="/">
              <img class="logo logo-dark" src="{{ asset('images/logo/prekshalogo.png') }}" alt="Prekhsa Health Care">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="toogle-inner"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
              <ul class="navbar-nav mr-auto nav-link-color">
                     <!-- Authentication Links -->
                          <li><a class="" href="/book_tests">Tests</a></li>  
                          <li> <a class="dropdown-item" href="/book_offers">Offers</a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="/book_profiles">Profiles</a>
                                  </li>
                                  
                           
                      
                    </li>
                    @guest
                        <li>
                            <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a class="" href="{{url('/viewcart/'.Auth::user()->id)}}">View Cart</a>
                        </li>
                        <li>
                          <a class="" href="{{url('/myorders/')}}">Orders</a>
                      </li>
                        <li class="dropdown">
                            <a id="navbarDropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Hi, {{ Auth::user()->first_name }} <span class="caret"></span>
                            </a> 
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/edit">Edit Profile</a>
                                {{-- <a class="dropdown-item" href="{{url('/myorders/'.Auth::user()->id)}}">My Orders</a> --}}
                                {{-- <a class="dropdown-item" href="{{url('/myreports/'.Auth::user()->id)}}">My Reports</a> --}}
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest






              </ul>
            </div>
            <!--/.nav-collapse -->
          </div>
        </nav>
      </header>



      @include('layouts.messages')
      @yield('content')


      <!-- Footer ============================================= -->
      <footer id="footerParallax" class="footer">
        <div class="footer-top">
          <div class="container">
            <div class="row widget-boxes text-center">
              <div class="col-12 col-md-4 col-lg-4">
                <div class="widget-info-box">
                  <div class="info-img">
                    <img src="{{ asset('images/footer/1.svg') }}" alt="phone">
                  </div>
                  <h4>Phone</h4>
                  <p>+91 98924 60335</p>
                </div>
                <!-- .widget-info-box end -->
              </div>
              <!-- .col-md-4 end -->
              <div class="col-12 col-md-4 col-lg-4">
                <div class="widget-info-box">
                  <div class="info-img">
                    <img src="{{ asset('images/footer/2.svg') }}" alt="phone">
                  </div>
                  <h4>Address</h4>
                  <p>Preksha Health Care,  Naveejan society, Opp Abhyudaya Bank, Ganesh Lane Bhanduo West Mumbai 400078</p>
                </div>
                <!-- .widget-info-box end -->
              </div>
              <!-- .col-md-4 end -->
              <div class="col-12 col-md-4 col-lg-4">
                <div class="widget-info-box">
                  <div class="info-img">
                    <img src="{{ asset('images/footer/3.svg') }}" alt="phone">
                  </div>
                  <h4>Order Timing</h4>
                  <p>24x7</p>
                </div>
                <!-- .widget-info-box end -->
              </div>
              <!-- .col-md-4 end -->
            </div>
            <!-- .row end -->
          </div>
          <!-- .container end -->
        </div>
        <!-- .footer-top end -->
        <div class="footer-bar">
          <div class="container">
            <div class="row">
              <div class="col">
                <hr>
              </div>
            </div>
          </div>
          <!-- .container end -->
        </div>
        <!-- .footer-bar end -->
        <div class="footer-bottom">
          <div class="container">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="footer-copyright">
                  <span>Handcrafted by <a href="https://www.weswitched.studio">We Switched Studio</a></span>
                </div>
              </div>
              <!-- .col-md-6 end -->
              <div class="col-12 col-md-6 col-lg-6">
                <div class="footer-social">
                  <a class="facebook" href="#">
                    <i class="fa fa-facebook"></i>
                  </a>
                  <a class="twitter" href="#">
                    <i class="fa fa-twitter"></i>
                  </a>
                  <a class="instagram" href="#">
                    <i class="fa fa-instagram"></i>
                  </a>
                </div>
              </div>
              <!-- .col-md-6 end -->
            </div>
            <!-- .row end -->
          </div>
          <!-- .container end -->
        </div>
        <!-- .footer-bottom end -->
      </footer>
      <!-- #footer end -->
    </div>
    <!-- #wrapper end -->

    <!-- Footer Scripts ============================================= -->
    
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
  </body>

</html>
