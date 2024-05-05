<!DOCTYPE html>
<html lang="en">

    <head>
        <title>@yield('title')</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
            rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('frontend/css/open-iconic-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">

        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">

        <link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}">

        <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">

        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/jquery.timepicker.css') }}">


        <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    </head>

    <body class="goto-here">


        {{-- start header --}}

        @include('include.header')

        {{-- end header --}}


        {{-- start navbar --}}

        @include('include.navbar')

        {{-- end navbar --}}


        {{-- start content --}}

        @yield('content')

        {{-- end content --}}

        <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
            <div class="container py-4">
                <div class="row d-flex justify-content-center py-5">
                    <div class="col-md-6">
                        <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
                        <span>Get e-mail updates about our latest shops and special offers</span>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <form action="#" class="subscribe-form">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control" placeholder="Enter email address">
                                <input type="submit" value="Subscribe" class="submit px-3">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        {{-- start header --}}

        @include('include.footer')

        {{-- end header --}}




        <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
        <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
        <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('frontend/js/aos.js') }}"></script>
        <script src="{{ asset('frontend/js/jquery.animateNumber.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('frontend/js/scrollax.min.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
        <script src="{{ asset('frontend/js/google-map.js') }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>

        @yield('scripts')

    </body>

</html>
