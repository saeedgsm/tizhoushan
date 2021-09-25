<!DOCTYPE html>
<html lang="en">

<!-- index.html  30 Nov 2019 03:15:44 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>آکادمی تخصصی تیزهوشان علم برتر سالار </title>

    <!-- fontawesome css link -->
    <link rel="stylesheet" href="/site/css/fontawesome-all.min.css">
    <!-- flaticon css -->
    <link rel="stylesheet" href="/site/font/flaticon.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="/site/css/magnific-popup.css">
    <!-- nice-select css -->
    <link rel="shortcut icon" href="{{ asset('imgs\logo-panel.png') }}">
    <link rel="stylesheet" href="/site/css/nice-select.css">
    <!-- bootstrap css link -->
    <link rel="stylesheet" href="/site/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/app-rtl.min.css">
    <link href="{{ asset('vazir/font-face.css') }}" rel="stylesheet" type="text/css" />
    <!-- swipper css link -->
    <link rel="stylesheet" href="/site/css/swiper.min.css">
    <!-- favicon -->
    <link rel="shortcut icon" href="/site/images/fav.png" type="image/x-icon">
    <!-- animate.css -->
    <link rel="stylesheet" href="/site/css/animate.css">
    <!-- main style css link -->
    <link rel="stylesheet" href="/site/css/style.css">
    <!-- responsive css link -->
    <link rel="stylesheet" href="/site/css/responsive.css">
</head>
<body>


<!-- preloader -->
<div class="preloader" id="preloader">
    <div class="preloader-thumb">
        <img src="{{ asset('imgs\logo-panel.png') }}" alt="image">
    </div>
</div>

<!-- header-section start -->
<header class="header-section">
    <div class="header-top d-none d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="header-wrapper">
                        <div class="header-info">
                            <div class="info-item">
                                <div class="info-thumb">
                                    <i class="flaticon-placeholder"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">آدرس</h6>
                                    <span>ارومیه</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-thumb">
                                    <i class="flaticon-message"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">آدرس ایمیل</h6>
                                    <span>demo@gmail.com</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-thumb">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="info-content">
                                    <h6 class="title">شماره تماس</h6>
                                    <span>12345678900</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <a class="site-logo site-title" href="/"><img src="{{ asset('imgs\logo-panel.png') }}" width="85" alt="site-logo"></a>
                <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fas fa-bars"></span>
                </button>
                <nav class="navbar navbar-expand-lg p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav main-menu ml-auto">

                            <li><a href="/">صفحه اصلی</a></li>
                        </ul>
                        <div class="header-action d-flex flex-wrap align-items-center">
                            @guest
                                 <a href="{{ route('login',['keyword'=>'login']) }}" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @elseif(auth()->user()->level == 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @elseif(auth()->user()->level == 'teacher')
                                <a href="{{ route('teacher.dashboard') }}" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @elseif(auth()->user()->level == 'agency')
                                <a href="{{ route('agency.dashboard') }}" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @elseif(auth()->user()->level == 'office')
                                <a href="{{ route('office.dashboard') }}" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @elseif(auth()->user()->level == 'student')
                                <a href="{{ route('student.dashboard') }}" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- header-section end -->



<a href="#" class="scrollToTop"><img src="/site/images/aeroplane.png" alt="image"></a>


<!-- about-section start -->
<section class="about-section pt-120 pb-120 bg_img" data-background="/site/images/map.png">
    <div class="about-element-one">
        <img src="{{ asset('imgs\logo-panel.png') }}" width="356" alt="image">
    </div>
    <div class="about-element-two my-paroller" data-paroller-factor="0.05" data-paroller-type="foreground" data-paroller-direction="horizontal">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <div class="about-left-content">
                    <h2 class="title">آکادمی تخصصی تیزهوشان علم برتر سالار </h2>
                    <p>بالاترین آمار قبولی تیزهوشان در کل کشور </p>
                    <p>106 قبولی در شعبه مرکزی
                        800 قبولی در نمایندگی های کل کشور </p>

                    <a href="#" class="cmn-btn">درباره ما</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about-section end -->


<section class="overview-section">
    <div class="overview-element my-paroller" data-paroller-factor="0.05" data-paroller-type="foreground" data-paroller-direction="horizontal" style="transform: unset; transition: transform 0.1s ease 0s; will-change: transform;">

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 pl-lg-0">
                <div class="overview-thumb--style2" style="background: url(/site/images/res/156367968.jpg) no-repeat;z-index: 2;
    position: relative;
    background-position: center;
    height: 100%;"></div>
            </div>
            <div class="col-lg-6">
                <div class="overview-content pt-120 pb-120">
                    <h2 class="title">جهت مشاوره و دریافت نمایندگی و طرح سئوالات و مشکلات</h2>

                    <div class="row mb-30-none">
                        <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                            <div class="counter-item">
                                <span class="counter-number">66</span>
                                <h3 class="counter-content">کل دوره ها</h3>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                            <div class="counter-item">
                                <span class="counter-number">25</span>
                                <span class="counter-content">تعداد دانش آموزان</span>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8 mb-30">
                            <div class="counter-item">
                                <span class="counter-number">169</span>
                                <span class="counter-content">آزمون های آنلاین</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- jquery -->
<script src="/site/js/jquery-3.3.1.min.js"></script>
<!-- migarate-jquery -->
<script src="/site/js/jquery-migrate-3.0.0.js"></script>
<!-- bootstrap js -->
<script src="/site/js/bootstrap.min.js"></script>
<!-- magnific-popup js -->
<script src="/site/js/jquery.magnific-popup.js"></script>
<!-- isotope -->
<script src="/site/js/isotope.pkgd.min.js"></script>
<!-- nice-select js-->
<script src="/site/js/jquery.nice-select.js"></script>
<!-- swipper js -->
<script src="/site/js/swiper.min.js"></script>
<!-- waypoints js link -->
<script src="/site/js/jquery.waypoints.min.js"></script>
<!-- counterup js -->
<script src="/site/js/jquery.counterup.min.js"></script>
<!-- paroller js -->
<script src="/site/js/jquery.paroller.min.js"></script>
<!-- main -->
<script src="/site/js/main.js"></script>


</body>

<!-- index.html  30 Nov 2019 03:18:45 GMT -->
</html>
