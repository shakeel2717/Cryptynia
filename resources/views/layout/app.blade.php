<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }}</title>

    <link href="/landing/css/bootstrap.css" rel="stylesheet">
    <link href="/landing/css/magnific-popup.css" rel="stylesheet">
    <link href="/landing/css/style.css" rel="stylesheet">
    <link href="/landing/css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="/landing/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="/landing/images/favicon.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>

<body>

    <div class="wrapper_box">

        <!-- Preloader -->
        <div class="loader-wrap">
            <div class="preloader"></div>
            <div class="layer layer-one"><span class="overlay"></span></div>
            <div class="layer layer-two"><span class="overlay"></span></div>
            <div class="layer layer-three"><span class="overlay"></span></div>
        </div>

        <!-- Main Header-->
        <header class="main-header">

            <div class="header_top">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="header_top_inner clearfix">
                                <div class="header_top_two_box pull-right">
                                    <div class="social_links_1">
                                        <a href="#"><i class="fab fa-facebook-square"></i></a>
                                        <a href="#"><i class="fab fa-youtube"></i></a>
                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 448 512">
                                                <style>
                                                    svg {
                                                        fill: #ffffff
                                                    }
                                                </style>
                                                <path
                                                    d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                                            </svg></a>
                                        <a href="#"><i class="fab fa-telegram"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Upper -->
            <div class="header_upper">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="header_upper_inner clearfix">
                                <div class="header_upper_one_box pull-left">
                                    <div class="logo">
                                        <a href="{{ route('index') }}">
                                            <h2 class="fw-bold text-uppercase">{{ env('APP_NAME') }}</h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="header_upper_two_box one pull-right">
                                    <div class="nav-outer">
                                        <!--Mobile Navigation Toggler-->
                                        <div class="mobile-nav-toggler">
                                            <span class="icon flaticon-menu"></span>
                                        </div>
                                        <div class="nav-inner">
                                            <!-- Main Menu -->
                                            <nav class="main-menu navbar-expand-xl navbar-dark">

                                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                                    <ul class="navigation">
                                                        <li><a href="{{ route('index') }}">Home</a></li>
                                                        <li><a href="{{ route('about') }}">About</a></li>
                                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                                        <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                                                        <li><a href="{{ route('login') }}">Sign In</a></li>
                                                        <li><a href="{{ route('register') }}">Create Account</a></li>
                                                    </ul>
                                                </div>
                                            </nav><!-- Main Menu End-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--End Header Upper-->

            <!--End Header Upper-->
            <div class="sticky-header">
                <div class="auto-container">
                    <div class="outer-container">
                        <div class="header-column">
                            <div class="logo-box">
                                <div class="logo"><a href="{{ route('index') }}">
                                        <h2 class="fw-bold text-uppercase">{{ env('APP_NAME') }}</h2>
                                    </a></div>
                            </div>
                        </div>
                        <div class="header-column">
                            <div class="nav-outer">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>

                                <div class="nav-inner">
                                    <!-- Main Menu -->
                                    <nav class="main-menu navbar-expand-xl navbar-dark">
                                        <div class="collapse navbar-collapse">
                                            <ul class="navigation">
                                            </ul>
                                        </div>
                                    </nav><!-- Main Menu End-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile-menu close-menu">
                <nav class="menu-box">
                    <ul class="navigation"></ul>
                </nav>
            </div>

            <div class="nav-overlay">
            </div>
        </header>

        @yield('content')

        <footer class="footer-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <h2 class="text-uppercase text-white text-center">{{ env('APP_NAME') }}</h2>
                        <div class="social_links_1 d-flex justify-content-center">
                            <a href="#"><i class="fab fa-facebook-square"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 448 512">
                                    <style>
                                        svg {
                                            fill: #ffffff
                                        }
                                    </style>
                                    <path
                                        d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z" />
                                </svg></a>
                            <a href="#"><i class="fab fa-telegram"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                        </div>
                        <div class="footer-bottom">
                            <p>© 2023, All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fas fa-arrow-up"></span>
        </div>
    </div>

    <script src="/landing/js/jquery.js"></script>
    <script src="/landing/js/popper.min.js"></script>
    <script src="/landing/js/bootstrap.min.js"></script>
    <script src="/landing/js/swiper.min.js"></script>
    <script src="/landing/js/appear.js"></script>
    <script src="/landing/js/jquery.countTo.js"></script>
    <script src="/landing/js/isotope.js"></script>
    <script src="/landing/js/owl.js"></script>
    <script src="/landing/js/wow.js"></script>
    <script src="/landing/js/jquery.fancybox.js"></script>
    <script src="/landing/js/TweenMax.min.js"></script>
    <script src="/landing/js/jquery.magnific-popup.min.js"></script>
    <script src="/landing/js/parallax.min.js"></script>
    <script src="/landing/js/custom.js"></script>
    <x-alert />
</body>

</html>
