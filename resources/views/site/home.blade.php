@extends('site.master')
@section('page_title')علم برتر سالار@endsection
@section('content')

    <!-- main slider start -->
    <section class="bg-light" dir="ltr">
        <div class="main-slider dots-style theme1">
            <!-- slider-item end -->
            <div class="slider-item bg-img bg-img1" style="background-image: url({{ asset('imgs/wall.jpg') }})">
                <div class="container">
                    <div class="row align-items-center slider-height">
                        <div class="col-12">
                            <div class="slider-content">
                                <p class="text animated"
                                    data-animation-in="fadeInDown"
                                    data-delay-in=".300">
                                    دوره های آموزش آنلاین
                                </p>
                                <h2 class="title animated">
                <span
                    class="animated d-block"
                    data-animation-in="fadeInLeft"
                    data-delay-in=".800">منابع آموزش معتبر</span>
                                    <span class="animated font-weight-bold"
                                        data-animation-in="fadeInRight"
                                        data-delay-in="1.5">دریافت تخفیف تا 30%</span>
                                </h2>
                                <a
                                    class="btn btn-outline-primary btn--lg animated mt-45 mt-sm-25"
                                    data-animation-in="fadeInLeft" data-delay-in="1.9">مشاهده دوره ها</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- slider-item end -->

        </div>
    </section>
    <!-- main slider end -->

    <!-- staic media start -->
    <section class="static-media-section theme-bg py-45">
        <div class="container">
            <div class="static-media-wrap p-0">
                <div class="row">
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img
                                class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3"
                                src="/assets/store/img/icon/2.png"
                                alt="icon"
                            />
                            <div class="media-body">
                                <h4 class="title text-capitalize text-white">ارسال رایگان</h4>
                                <p class="text text-white">ارسال رایگان محصول خرید بالای 100 هزار تومان</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img
                                class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3"
                                src="/assets/store/img/icon/3.png"
                                alt="icon"
                            />
                            <div class="media-body">
                                <h4 class="title text-capitalize text-white">ضمانت برگشت </h4>
                                <p class="text text-white">ضمانت محصول تا 9 روز کاری</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img
                                class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3"
                                src="/assets/store/img/icon/5.png"
                                alt="icon"
                            />
                            <div class="media-body">
                                <h4 class="title text-capitalize text-white">پشتیبانی 24/7</h4>
                                <p class="text text-white">تماس با ما در 24 ساعت هر روز</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 py-3">
                        <div class="d-flex static-media2 flex-column flex-sm-row">
                            <img
                                class="align-self-center mb-2 mb-sm-0 mr-auto mr-sm-3"
                                src="/assets/store/img/icon/4.png"
                                alt="icon"
                            />
                            <div class="media-body">
                                <h4 class="title text-capitalize text-white">امنیت خرید 100 درصد</h4>
                                <p class="text text-white">خرید های شما با ما مطمئن</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- staic media end -->

    <!-- common banner  start -->
    <div class="common-banner bg-white pb-50 pt-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-30">
                    <div class="banner-thumb">
                        <a
                            class="zoom-in d-block overflow-hidden position-relative"
                            href="shop-grid-4-column.html"><img src="/assets/store/img/banner/5.jpg" alt="banner-thumb-naile"/></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-30">
                    <div class="banner-thumb">
                        <a
                            class="zoom-in d-block overflow-hidden position-relative"
                            href="shop-grid-4-column.html">
                            <img src="/assets/store/img/banner/6.jpg" alt="banner-thumb-naile"/></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-30">
                    <div class="banner-thumb">
                        <a
                            class="zoom-in d-block overflow-hidden position-relative"
                            href="shop-grid-4-column.html">
                            <img src="/assets/store/img/banner/4.jpg" alt="banner-thumb-naile"/></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- common banner  end -->
    <!-- popular-section  start -->
    <div class="popular-section popular-bg1 theme1 bg-white px-md-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">محصولات محبوب</h2>
                        <p class="text">
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                            Perspiciatis, culpa?
                        </p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="popular-slider-init dots-style">
                        <div class="slider-item">
                            <div class="card popular-card zoom-in d-block overflow-hidden">
                                <div class="card-body">
                                    <a href="#" class="thumb-naile">
                                        <img
                                            class="d-block mx-auto"
                                            src="/assets/store/img/popular/5.png"
                                            alt="img"
                                        /></a>
                                    <h3 class="popular-title">
                                        <a href="#"> Accessories & Parts <span>(17)</span></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card popular-card zoom-in d-block overflow-hidden">
                                <div class="card-body">
                                    <a href="#" class="thumb-naile">
                                        <img
                                            class="d-block mx-auto"
                                            src="/assets/store/img/popular/1.png"
                                            alt="img"
                                        /></a>
                                    <h3 class="popular-title">
                                        <a href="#"> Audio & Video <span>(17)</span></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card popular-card zoom-in d-block overflow-hidden">
                                <div class="card-body">
                                    <a href="#" class="thumb-naile">
                                        <img
                                            class="d-block mx-auto"
                                            src="/assets/store/img/popular/2.png"
                                            alt="img"
                                        /></a>
                                    <h3 class="popular-title">
                                        <a href="#"> Smart Fashion <span>(18)</span></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card popular-card zoom-in d-block overflow-hidden">
                                <div class="card-body">
                                    <a href="#" class="thumb-naile">
                                        <img
                                            class="d-block mx-auto"
                                            src="/assets/store/img/popular/3.png"
                                            alt="img"
                                        /></a>
                                    <h3 class="popular-title">
                                        <a href="#"> Camera & Photo <span>(19)</span></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card popular-card zoom-in d-block overflow-hidden">
                                <div class="card-body">
                                    <a href="#" class="thumb-naile">
                                        <img
                                            class="d-block mx-auto"
                                            src="/assets/store/img/popular/4.png"
                                            alt="img"
                                        /></a>
                                    <h3 class="popular-title">
                                        <a href="#"> Headphones <span>(20)</span></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card popular-card zoom-in d-block overflow-hidden">
                                <div class="card-body">
                                    <a href="#" class="thumb-naile">
                                        <img
                                            class="d-block mx-auto"
                                            src="/assets/store/img/popular/5.png"
                                            alt="img"
                                        /></a>
                                    <h3 class="popular-title">
                                        <a href="#"> Video Games <span>(21)</span></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- popular-section  end -->

    <!-- common banner  start -->
    <div class="common-banner bg-white pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-30">
                    <div class="banner-thumb common-bthumb1">
                        <a
                            href="shop-grid-4-column.html"
                            class="zoom-in d-block overflow-hidden"
                        >
                            <img src="/assets/store/img/banner/1.jpg" alt="banner-thumb-naile"/>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mb-30">
                    <div class="banner-thumb common-bthumb1">
                        <a
                            href="shop-grid-4-column.html"
                            class="zoom-in d-block overflow-hidden"
                        >
                            <img src="/assets/store/img/banner/4.jpg" alt="banner-thumb-naile"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- common banner  end -->
    <!-- brand slider start -->
    <div class="brand-slider-section theme1 bg-white pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-init slick-nav-brand">
                        <div class="slider-item">
                            <div class="single-brand">
                                <a
                                    href="https://themeforest.net/user/hastech"
                                    class="brand-thumb"
                                >
                                    <img src="/assets/store/img/brand/1.jpg" alt="brand-thumb-nail"/>
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a
                                    href="https://themeforest.net/user/hastech"
                                    class="brand-thumb"
                                >
                                    <img src="/assets/store/img/brand/2.jpg" alt="brand-thumb-nail"/>
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a
                                    href="https://themeforest.net/user/hastech"
                                    class="brand-thumb"
                                >
                                    <img src="/assets/store/img/brand/3.jpg" alt="brand-thumb-nail"/>
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a
                                    href="https://themeforest.net/user/hastech"
                                    class="brand-thumb"
                                >
                                    <img src="/assets/store/img/brand/4.jpg" alt="brand-thumb-nail"/>
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a
                                    href="https://themeforest.net/user/hastech"
                                    class="brand-thumb"
                                >
                                    <img src="/assets/store/img/brand/5.jpg" alt="brand-thumb-nail"/>
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a
                                    href="https://themeforest.net/user/hastech"
                                    class="brand-thumb"
                                >
                                    <img src="/assets/store/img/brand/2.jpg" alt="brand-thumb-nail"/>
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-brand">
                                <a
                                    href="https://themeforest.net/user/hastech"
                                    class="brand-thumb"
                                >
                                    <img src="/assets/store/img/brand/3.jpg" alt="brand-thumb-nail"/>
                                </a>
                            </div>
                        </div>
                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand slider end -->
    <!-- featured  slider start-->
    <section class="featured-slider theme1 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">محصولات نمونه</h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="featured-init slick-nav">
                        <div class="slider-item">
                            <div class="product-list mb-30">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/1.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html">
                                                            All Natural Makeup Beauty</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                            <div class="product-list">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/5.png"
                                                        alt="thumbnail"
                                                    />
                                                    <img
                                                        class="second-img"
                                                        src="/assets/store/img/product/2.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >On Trend Makeup and
                                                        </a>
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                        </div>
                        <!-- slider-item End -->
                        <div class="slider-item">
                            <div class="product-list mb-30">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/3.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >The Cosmetics and Beauty</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                          <span class="product-price"
                          ><del class="del">$23.90</del>
                            <span class="onsale">$21.51</span></span
                          >
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                            <div class="product-list">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/9.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >orginal Age Defying</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                        </div>
                        <!-- slider-item End -->
                        <div class="slider-item">
                            <div class="product-list mb-30">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/2.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >New Balance Fresh Foam</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                            <div class="product-list">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/7.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >Juicy Couture Tricot</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                        </div>
                        <!-- slider-item End -->
                        <div class="slider-item">
                            <div class="product-list mb-30">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/8.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >Quilted Terry Track Face Cream</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                            <div class="product-list">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/9.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >Couture Quilted Terry</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                        </div>
                        <!-- slider-item End -->
                        <div class="slider-item">
                            <div class="product-list mb-30">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/10.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >Fila Locker Room Varsity</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                            <div class="product-list">
                                <div class="card product-card no-shadow">
                                    <div class="card-body p-0">
                                        <div class="media">
                                            <div class="product-thumbnail">
                                                <a href="single-product.html">
                                                    <img
                                                        class="first-img"
                                                        src="/assets/store/img/product/4.png"
                                                        alt="thumbnail"
                                                    />
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="product-desc">
                                                    <h3 class="title">
                                                        <a href="shop-grid-4-column.html"
                                                        >Calvin Klein Jeans</a
                                                        >
                                                    </h3>
                                                    <div class="star-rating">
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star"></span>
                                                        <span class="ion-ios-star de-selected"></span>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-between"
                                                    >
                                                        <span class="product-price">$11.90</span>
                                                        <button
                                                            class="pro-btn"
                                                            data-toggle="modal"
                                                            data-target="#add-to-cart"
                                                        >
                                                            <i class="icon-basket"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- "product-list End -->
                        </div>
                        <!-- slider-item End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured  slider end-->
    <!-- blog-section start -->
    <section class="blog-section theme1 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">آخرین مطالب</h2>
                        <p class="text">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-init slick-nav">
                        <div class="slider-item">
                            <div class="single-blog">
                                <a
                                    class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html"
                                >
                                    <img src="/assets/store/img/blog-post/1.png" alt="blog-thumb-naile"/>
                                </a>
                                <div class="blog-post-content">
                                    <a
                                        class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech"
                                    >Fashion</a
                                    >
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is first Post For Blog</a>
                                    </h3>
                                    <h5 class="sub-title">
                                        Posted by
                                        <a
                                            class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech"
                                        >HasTech</a
                                        >12TH Nov 2020
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a
                                    class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html"
                                >
                                    <img src="/assets/store/img/blog-post/2.png" alt="blog-thumb-naile"/>
                                </a>
                                <div class="blog-post-content">
                                    <a
                                        class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech"
                                    >Fashion</a
                                    >
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is Secound Post For Blog</a>
                                    </h3>
                                    <h5 class="sub-title">
                                        Posted by
                                        <a
                                            class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech"
                                        >HasTech</a
                                        >12TH Nov 2020
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a
                                    class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html"
                                >
                                    <img src="/assets/store/img/blog-post/3.png" alt="blog-thumb-naile"/>
                                </a>
                                <div class="blog-post-content">
                                    <a
                                        class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech"
                                    >Fashion</a
                                    >
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is third Post For Blog</a>
                                    </h3>
                                    <h5 class="sub-title">
                                        Posted by
                                        <a
                                            class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech"
                                        >HasTech</a
                                        >12TH Nov 2020
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a
                                    class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html"
                                >
                                    <img src="/assets/store/img/blog-post/4.png" alt="blog-thumb-naile"/>
                                </a>
                                <div class="blog-post-content">
                                    <a
                                        class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech"
                                    >Fashion</a
                                    >
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is fourth Post For Blog</a>
                                    </h3>
                                    <h5 class="sub-title">
                                        Posted by
                                        <a
                                            class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech"
                                        >HasTech</a
                                        >12TH Nov 2020
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="single-blog">
                                <a
                                    class="blog-thumb mb-20 zoom-in d-block overflow-hidden"
                                    href="blog-grid-left-sidebar.html"
                                >
                                    <img src="/assets/store/img/blog-post/5.png" alt="blog-thumb-naile"/>
                                </a>
                                <div class="blog-post-content">
                                    <a
                                        class="blog-link theme-color d-inline-block mb-10 text-uppercase"
                                        href="https://themeforest.net/user/hastech"
                                    >Fashion</a
                                    >
                                    <h3 class="title mb-15">
                                        <a href="single-blog.html">This is fiveth Post For Blog</a>
                                    </h3>
                                    <h5 class="sub-title">
                                        Posted by
                                        <a
                                            class="theme-color d-inline-block mx-1"
                                            href="https://themeforest.net/user/hastech"
                                        >HasTech</a
                                        >12TH Nov 2020
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-section end -->

@endsection
