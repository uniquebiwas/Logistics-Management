<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('meta')
      <title>@yield('page_title')</title>


    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="" href="img/icon.png">
    <link rel="stylesheet" href="{{ asset('front/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/line-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/flaticon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/metisMenu.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/lightslider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/lightgallery.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/owl.carousel.min.css') }}">
    <link href="{{ asset('front/css/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/toastr.min.css') }}">
    @stack('styles')
</head>

<body>
    <div class="wrapper">
        <x-frontend.header />
        @yield('content')
        <x-frontend.footer />
    </div>
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('front/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/js/aos.js') }}"></script>
    <script src="{{ asset('front/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('front/js/lightslider.min.js') }}"></script>
    <script src="{{ asset('front/js/lightgallery-all.min.js') }}"></script>
    <script src="{{ asset('front/js/custom.js') }}"></script>
    <script src="{{ asset('plugins/toastrjs/toastr.min.js') }}"></script>
    @stack('scripts')

</body>

</html>
