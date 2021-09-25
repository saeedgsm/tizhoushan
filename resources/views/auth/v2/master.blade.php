<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="{{ asset('assets/karnameh/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/karnameh/css/bootstrap-reboot.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/karnameh/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/karnameh/css/login.css') }}">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'
          integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <!--javascript-->
    @yield('style')


</head>
<body>
<div class="container-fluid register">
    <div class="row">
        <div class="col-md-3 register-left">
            <img src="{{ asset('imgs\logo-panel.png') }}" alt=""/>
            <h5 class="title">آکادمی تخصصی تیزهوشان علم برتر سالار</h5>
        </div>
        @yield('content')
    </div>

</div>
<script src="{{ asset('assets/karnameh/js/jquery-3.3.1.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('assets/karnameh/js/bootstrap.js') }}"></script>
@yield('script')
</body>
</html>
