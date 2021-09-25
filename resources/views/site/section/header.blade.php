<!-- offcanvas-overlay start -->
<div class="offcanvas-overlay"></div>
<!-- offcanvas-overlay end -->
<!-- offcanvas-mobile-menu start -->
<div id="offcanvas-mobile-menu" class="offcanvas theme1 offcanvas-mobile-menu">
    <div class="inner">
        <div class="border-bottom mb-4 pb-4 text-right">
            <button class="offcanvas-close">×</button>
        </div>
        <div class="offcanvas-head mb-4">
            <nav class="offcanvas-top-nav">
                <ul class="d-flex flex-wrap">
                    <li class="my-2 mx-2">
                        <a href="{{ route('site.shop.carts.index') }}">
                            <i class="icon-bag"></i> سبد خرید <span>(0)</span></a>
                    </li>
                    <li class="my-2 mx-2">
                        <a href="wishlist.html">
                            <i class="ion-android-favorite-outline"></i> علاقه مندی ها
                            <span>(3)</span></a
                        >
                    </li>

                    <li class="my-2 mx-2">
                        <a class="search search-toggle" href="javascript:void(0)">
                            <i class="icon-magnifier"></i> جستجو</a>
                    </li>
                </ul>
            </nav>
        </div>
        <nav class="offcanvas-menu">
            <ul>
                <li><a href="/">صفحه اصلی</a></li>
                <li><a href="{{ route('site.products.index') }}">محصولات</a></li>
                <li><a href="/">وبلاگ</a></li>
                <li><a href="/">درباره ما</a></li>
                <li><a href="/">تماس با ما</a></li>
            </ul>
        </nav>
        <div class="offcanvas-social py-30">
            <ul>
                <li>
                    <a href="#"><i class="icon-social-facebook"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-twitter"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-instagram"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-google"></i></a>
                </li>
                <li>
                    <a href="#"><i class="icon-social-instagram"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- offcanvas-mobile-menu end -->
<!-- OffCanvas Wishlist Start -->
<div id="offcanvas-wishlist" class="offcanvas offcanvas-wishlist theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title">Wishlist</span>
            <button class="offcanvas-close">×</button>
        </div>
        <ul class="minicart-product-list">
            <li>
                <a href="single-product.html" class="image"
                ><img src="/assets/store/img/mini-cart/4.png" alt="Cart product Image"
                    /></a>
                <div class="content">
                    <a href="single-product.html" class="title"
                    >orginal Age Defying Cosmetics Makeup</a
                    >
                    <span class="quantity-price"
                    >1 x <span class="amount">$100.00</span></span
                    >
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"
                ><img src="/assets/store/img/mini-cart/5.png" alt="Cart product Image"
                    /></a>
                <div class="content">
                    <a href="single-product.html" class="title"
                    >On Trend Makeup and Beauty Cosmetics</a
                    >
                    <span class="quantity-price"
                    >1 x <span class="amount">$35.00</span></span
                    >
                    <a href="#" class="remove">×</a>
                </div>
            </li>
            <li>
                <a href="single-product.html" class="image"
                ><img src="/assets/store/img/mini-cart/6.png" alt="Cart product Image"
                    /></a>
                <div class="content">
                    <a href="single-product.html" class="title"
                    >orginal Age Defying Cosmetics Makeup</a
                    >
                    <span class="quantity-price"
                    >1 x <span class="amount">$9.00</span></span
                    >
                    <a href="#" class="remove">×</a>
                </div>
            </li>
        </ul>
        <a
            href="wishlist.html"
            class="btn btn-primary btn--lg d-block d-sm-inline-block mt-30"
        >view wishlist</a
        >
    </div>
</div>
<!-- OffCanvas Wishlist End -->

<!-- OffCanvas Cart Start -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart theme1">
    <div class="inner">
        <div class="head d-flex flex-wrap justify-content-between">
            <span class="title">سبد خرید</span>
            <button class="offcanvas-close">×</button>
        </div>
        @guest
            <p class="minicart-message">کاربر گرامی برای اضافه محصول به سبد خرید لطفا لاگین فرمائید!</p>
            <a href="{{ route('login') }}"
               class="btn btn-dark btn--lg d-block d-sm-inline-block mt-4 mt-sm-0">ورود</a>
        @else
            <ul class="minicart-product-list">
                <li>
                    <a href="single-product.html" class="image"
                    ><img src="/assets/store/img/mini-cart/1.png" alt="Cart product Image"
                        /></a>
                    <div class="content">
                        <a href="single-product.html" class="title"
                        >orginal Age Defying Cosmetics Makeup</a
                        >
                        <span class="quantity-price"
                        >1 x <span class="amount">$100.00</span></span
                        >
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"
                    ><img src="/assets/store/img/mini-cart/2.png" alt="Cart product Image"
                        /></a>
                    <div class="content">
                        <a href="single-product.html" class="title"
                        >On Trend Makeup and Beauty Cosmetics</a
                        >
                        <span class="quantity-price"
                        >1 x <span class="amount">$35.00</span></span
                        >
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
                <li>
                    <a href="single-product.html" class="image"
                    ><img src="/assets/store/img/mini-cart/3.png" alt="Cart product Image"
                        /></a>
                    <div class="content">
                        <a href="single-product.html" class="title"
                        >orginal Age Defying Cosmetics Makeup</a
                        >
                        <span class="quantity-price"
                        >1 x <span class="amount">$9.00</span></span
                        >
                        <a href="#" class="remove">×</a>
                    </div>
                </li>
            </ul>
            <div class="sub-total d-flex flex-wrap justify-content-between">
                <strong>Subtotal :</strong>
                <span class="amount">$144.00</span>
            </div>
            <a
                href="cart.html"
                class="btn btn-primary btn--lg d-block d-sm-inline-block mr-sm-2"
            >view cart</a
            >
            <a href="checkout.html"
               class="btn btn-dark btn--lg d-block d-sm-inline-block mt-4 mt-sm-0"
            >checkout</a>
            <p class="minicart-message">Free Shipping on All Orders Over $100!</p>
        @endguest

    </div>
</div>
<!-- OffCanvas Cart End -->

<!-- header start -->
<header>
    <!-- header top start -->
    <div class="header-top theme1 theme-bg py-15">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-6 order-last order-sm-first">
                    <div
                        class="d-flex justify-content-center justify-content-sm-start align-items-center"
                    >
                        <div class="social-network2 modify">
                            <ul class="d-flex">
                                <li>
                                    <a href="https://www.facebook.com/" target="_blank"
                                    ><span class="icon-social-facebook"></span
                                        ></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/" target="_blank"
                                    ><span class="icon-social-twitter"></span
                                        ></a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/" target="_blank"
                                    ><span class="icon-social-youtube"></span
                                        ></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/" target="_blank"
                                    ><span class="icon-social-instagram"></span
                                        ></a>
                                </li>
                            </ul>
                        </div>
                        <div class="media static-media ml-4 d-flex align-items-center">
                            <div class="media-body">
                                <div class="phone modify">
                                    <a href="tel:(+123)4567890" class="text-white"
                                    ><i class="icon-call-out mr-1"></i> (+123)4567890</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <nav class="navbar-top modify pb-2 pb-sm-0 position-relative">
                        <ul class="d-flex justify-content-center justify-content-md-end align-items-center">
                            <li>
                                <a href="#"
                                   id="dropdown1"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false">ناحیه کاربری <i class="ion ion-ios-arrow-down"></i></a>
                                <ul class="topnav-submenu dropdown-menu"
                                    aria-labelledby="dropdown1">
                                    @guest
                                        <li><a href="{{ route('login',['keyword'=>'login']) }}">ورود</a></li>
                                        <li><a href="{{ route('login',['keyword'=>'reg']) }}">ثبت نام</a></li>
                                    @else
                                        @switch(auth()->user()->level)
                                            @case('admin')
                                            <li><a href="{{ route('admin.dashboard') }}">پنل کاربری</a></li>
                                            @break
                                            @case('student')
                                            <li><a href="{{ route('student.dashboard') }}">پنل کاربری</a></li>
                                            @break
                                        @endswitch
                                        <li><a href="{{ route('logout') }}">خروج</a></li>
                                    @endguest

                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- header top end -->
    <!-- header-middle satrt -->
    <div id="sticky" class="header-middle theme1 py-15 py-lg-0">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-6 col-lg-3">
                    <div class="logo">
                        <a href="/"
                        ><img src="{{ asset('imgs/logo-panel.png') }}" width="85" alt="logo"
                            /></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <ul class="main-menu d-flex justify-content-center">

                        <li><a href="/">صفحه اصلی</a></li>
                        <li><a href="{{ route('site.products.index') }}">محصولات</a></li>
                        <li><a href="/">وبلاگ</a></li>
                        <li><a href="/">درباره ما</a></li>
                        <li><a href="/">تماس با ما</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <!-- search-form end -->
                    <div class="d-flex align-items-center justify-content-end">
                        <!-- static-media end -->
                        <div class="cart-block-links theme1 d-none d-sm-block">
                            <ul class="d-flex">
                                <li>
                                    <a href="javascript:void(0)" class="search search-toggle">
                                        <i class="icon-magnifier"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="compare.html">
                    <span class="position-relative">
                      <i class="icon-shuffle"></i>
                      <span class="badge cbdg1">1</span>
                    </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="offcanvas-toggle" href="#offcanvas-wishlist">
                    <span class="position-relative">
                      <i class="icon-heart"></i>
                      <span class="badge cbdg1">3</span>
                    </span>
                                    </a>
                                </li>
                                <li class=" cart-block position-relative">
                                    <a class="offcanvas-toggle" href="#offcanvas-cart">
                    <span class="position-relative">
                      <i class="icon-bag"></i>
                      <span class="badge cbdg1">3</span>
                    </span>
                                    </a>
                                </li>
                                <!-- cart block end -->
                            </ul>
                        </div>
                        <div class="mobile-menu-toggle theme1 d-lg-none">
                            <a href="#offcanvas-mobile-menu" class="offcanvas-toggle">
                                <svg viewbox="0 0 700 550">
                                    <path
                                        d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200"
                                        id="top"
                                    ></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path
                                        d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190"
                                        id="bottom"
                                        transform="translate(480, 320) scale(1, -1) translate(-480, -318)"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- header-middle end -->
</header>
<!-- header end -->
