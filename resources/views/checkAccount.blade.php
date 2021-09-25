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
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-mini.png') }}">
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
        <img src="/site/images/propeller.png" alt="image">
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
                <a class="site-logo site-title" href="index.html"><img src="/site/images/res/logo2.png" alt="site-logo"></a>
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
                                 <a href="/login" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @else
                                <a href="{{ route('admin.dashboard') }}" class="cmn-btn">ورود به ناحیه کاربری</a>
                            @endguest
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- header-section end -->

<!-- banner-section start -->
<section class="inner-banner-section pt-120 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="inner-banner-content">
                    <h2 class="title">فرم بررسی حساب کاربری</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner-section end -->


<a href="#" class="scrollToTop"><img src="/site/images/aeroplane.png" alt="image"></a>

<!-- breadcrumb-section start -->
<div class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">صفحه اصلی</a></li>
                <li class="breadcrumb-item active" aria-current="page">فرم بررسی حساب کاربری</li>
            </ol>
        </nav>
    </div>
</div>
<!-- breadcrumb-section end -->


<!-- contact-section start -->
<section class="contact-section pt-120 pb-120">
    <div class="container">
        <div class="account-wrapper">
            <div class="login-area account-area change-form">
                <div class="row m-0">
                    <div class="col-lg-5 p-0">
                        <div class="change-catagory-area">
                            <h3 class="title">فرم بررسی حساب کاربری</h3>
                            <form class="contact-form" action="{{ route('check.account.st') }}" method="post">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <input type="text"  name="username" placeholder="نام کاربری">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="کلمه عبور">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="cmn-btn.active" value="بررسی حساب">

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 p-0">
                        <div class="common-form-style bg-one create-account">
                            <h3 class="title">توجه</h3>
                            <p>سیستم آموزش آنلاین بروز رسانی شده است جهت بازیابی اطلاعات کاربری نام کاربری و کلمه عبور قبلی خود را وارد کنید</p>
                            <ul class="account-item">
                                <li>راه های ارتباطی</li>
                                <li>example@.com demo@.com</li>
                                <li>01234567890 0124567890</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact-section end -->

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
