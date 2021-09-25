@extends('site.master')
@section('page_title') محصولات@endsection
@section('content')

    <!-- product-single start -->
    <section class="product-single theme1 pt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div>
                        <div class="position-relative">
                            <span class="badge badge-danger top-right">ویژه</span>
                        </div>
                        <div class="product-sync-init mb-20">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="{{ asset($product->product_image) }}" alt="product-thumb"/>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="/assets/store/img/slider/thumb/2.jpg" alt="product-thumb"/>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="/assets/store/img/slider/thumb/3.jpg" alt="product-thumb"/>
                                </div>
                            </div>
                            <!-- single-product end -->
                            <div class="single-product">
                                <div class="product-thumb">
                                    <img src="/assets/store/img/slider/thumb/4.jpg" alt="product-thumb"/>
                                </div>
                            </div>
                            <!-- single-product end -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-6">
                    <div class="single-product-info">
                        <div class="single-product-head">
                            <h2 class="title mb-20">{{ $product->product_name }}</h2>
                            <div class="star-content mb-20">
                                <span class="star-on"><i class="ion-ios-star"></i> </span>
                                <span class="star-on"><i class="ion-ios-star"></i> </span>
                                <span class="star-on"><i class="ion-ios-star"></i> </span>
                                <span class="star-on"><i class="ion-ios-star"></i> </span>
                                <span class="star-on"><i class="ion-ios-star"></i> </span>
                                <a href="#" id="write-comment"
                                ><span class="ml-2"><i class="far fa-comment-dots"></i></span>
                                    خواندن نظرات <span>(1)</span></a
                                >
                            </div>
                        </div>
                        <div class="product-body mb-40">
                            <div class="d-flex align-items-center mb-30">
              <span class="product-price mr-20">
                <span class="onsale"> {{ $product->product_price }}  <span>تومان</span> </span></span>
                            </div>
                            <p>
                                {{ $product->product_label }}
                            </p>
                        </div>

                        <div class="product-grouped product-count style">
                            <div
                                class="media flex-column flex-sm-row align-items-sm-center mb-4"
                            >
                                <div class="count d-flex">
                                    <input type="number" min="1" max="10" step="1" value="1"/>
                                    <div class="button-group">
                                        <button class="count-btn increment">
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                        <button class="count-btn decrement">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="media-body d-flex align-items-center">
                                    <div class="group-img mr-4">
                                        <img src="/assets/store/img/slider/thumb/1.1.jpg" alt=""/>
                                    </div>
                                    <div>
                                        <h3 class="title">تعداد</h3>
                                        <span>$251</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="product-footer">
                            <div class="mb-4">
                                <button class="btn btn-dark btn--xl mt-5 mt-sm-0">
                                    <span class="mr-2"><i class="ion-android-add"></i></span>
                                    اضافه کردن به سبد
                                </button>
                            </div>
                            <div class="addto-whish-list">
                                <a href="#"><i class="icon-heart"></i> به علاقه مندی ها اضافه کن</a>
                            </div>
                            <div class="pro-social-links mt-10">
                                <ul class="d-flex align-items-center">
                                    <li class="share">اشتراک گذاری</li>
                                    <li>
                                        <a href="#"><i class="ion-social-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-social-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-social-google"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="ion-social-pinterest"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-single end -->
    <!-- product tab start -->
    <div class="product-tab theme1 bg-white pt-60 pb-80">
        <div class="container">
            <div class="product-tab-nav">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav class="product-tab-menu single-product">
                            <ul
                                class="nav nav-pills justify-content-center"
                                id="pills-tab"
                                role="tablist"
                            >
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        id="pills-home-tab"
                                        data-toggle="pill"
                                        href="#pills-home"
                                        role="tab"
                                        aria-controls="pills-home"
                                        aria-selected="true"
                                    >توضیحات</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link"
                                        id="pills-profile-tab"
                                        data-toggle="pill"
                                        href="#pills-profile"
                                        role="tab"
                                        aria-controls="pills-profile"
                                        aria-selected="false"
                                    >جزئیات محصول</a
                                    >
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link active"
                                        id="pills-contact-tab"
                                        data-toggle="pill"
                                        href="#pills-contact"
                                        role="tab"
                                        aria-controls="pills-contact"
                                        aria-selected="false"
                                    >نظرات</a
                                    >
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- product-tab-nav end -->
            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- first tab-pane -->
                        <div
                            class="tab-pane fade"
                            id="pills-home"
                            role="tabpanel"
                            aria-labelledby="pills-home-tab"
                        >
                            <div class="single-product-desc">
                                {!! $product->product_body !!}
                            </div>
                        </div>
                        <!-- second tab-pane -->
                        <div
                            class="tab-pane fade"
                            id="pills-profile"
                            role="tabpanel"
                            aria-labelledby="pills-profile-tab"
                        >
                            <div class="single-product-desc">
                                <div class="product-anotherinfo-wrapper">
                                    <ul>
                                        <li><span>وزن</span> 400 g</li>
                                        <li><span>ابعاد</span>10 x 10 x 15 cm</li>
                                        <li><span>جنس</span> 60% cotton, 40% polyester</li>
                                        <li>
                                            <span>سایر اطلاعات</span> American heirloom jean shorts pug
                                            seitan letterpress
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- third tab-pane -->
                        <div
                            class="tab-pane fade show active"
                            id="pills-contact"
                            role="tabpanel"
                            aria-labelledby="pills-contact-tab"
                        >
                            <div class="single-product-desc">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="review-wrapper">
                                            <div class="single-review">
                                                <div class="review-img">
                                                    <img src="/assets/store/img/testimonial-image/1.png" alt=""/>
                                                </div>
                                                <div class="review-content">
                                                    <div class="review-top-wrap">
                                                        <div class="review-left">
                                                            <div class="review-name">
                                                                <h4>سعید قاسمی</h4>
                                                            </div>
                                                            <div class="rating-product">
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                            </div>
                                                        </div>
                                                        <div class="review-left">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <div class="review-bottom">
                                                        <p>
                                                            نمونه نظر من
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-review child-review">
                                                <div class="review-img">
                                                    <img src="/assets/store/img/testimonial-image/2.png" alt=""/>
                                                </div>
                                                <div class="review-content">
                                                    <div class="review-top-wrap">
                                                        <div class="review-left">
                                                            <div class="review-name">
                                                                <h4>پریسا</h4>
                                                            </div>
                                                            <div class="rating-product">
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                                <i class="ion-android-star"></i>
                                                            </div>
                                                        </div>
                                                        <div class="review-left">
                                                            <a href="#">Reply</a>
                                                        </div>
                                                    </div>
                                                    <div class="review-bottom">
                                                        <p>
                                                            و نمونه نظر من
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="ratting-form-wrapper">
                                            <h3>نظر خود را بگو</h3>
                                            <div class="ratting-form">
                                                <form action="#">
                                                    <div class="star-box">
                                                        <span>نظر شما:</span>
                                                        <div class="rating-product">
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                            <i class="ion-android-star"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="rating-form-style mb-10">
                                                                <input placeholder="نام" type="text"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="rating-form-style mb-10">
                                                                <input placeholder="ایمیل" type="email"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="rating-form-style form-submit">
                              <textarea
                                  name="Your Review"
                                  placeholder="پیام"
                              ></textarea>
                                                                <input type="submit" value="ثبت نظر"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product tab end -->
    <!-- new arrival section start -->
    <section class="theme1 bg-white pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="title pb-3 mb-3">برای شما ممکنه مرتبط باشد</h2>
                        <p class="text mt-10">....</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="product-slider-init theme1 slick-nav">
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img
                                                    class="first-img"
                                                    src="/assets/store/img/product/1.png"
                                                    alt="thumbnail"
                                                />
                                            </a>
                                            <!-- product links -->
                                            <ul class="actions d-flex justify-content-center">
                                                <li>
                                                    <a class="action" href="wishlist.html">
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="add to wishlist"
                              class="icon-heart"
                          >
                          </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#compare"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Add to compare"
                              class="icon-shuffle"
                          ></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#quick-view"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Quick view"
                              class="icon-magnifier"
                          ></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title">
                                                    <a href="shop-grid-4-column.html"
                                                    >All Natural Makeup Beauty Cosmetics</a
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
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img
                                                    class="first-img"
                                                    src="/assets/store/img/product/2.png"
                                                    alt="thumbnail"
                                                />
                                            </a>
                                            <!-- product links -->
                                            <ul class="actions d-flex justify-content-center">
                                                <li>
                                                    <a class="action" href="wishlist.html">
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="add to wishlist"
                              class="icon-heart"
                          >
                          </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#compare"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Add to compare"
                              class="icon-shuffle"
                          ></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#quick-view"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Quick view"
                              class="icon-magnifier"
                          ></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title">
                                                    <a href="shop-grid-4-column.html"
                                                    >On Trend Makeup and Beauty Cosmetics</a
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
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img
                                                    class="first-img"
                                                    src="/assets/store/img/product/3.png"
                                                    alt="thumbnail"
                                                />
                                            </a>
                                            <!-- product links -->
                                            <ul class="actions d-flex justify-content-center">
                                                <li>
                                                    <a class="action" href="wishlist.html">
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="add to wishlist"
                              class="icon-heart"
                          >
                          </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#compare"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Add to compare"
                              class="icon-shuffle"
                          ></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#quick-view"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Quick view"
                              class="icon-magnifier"
                          ></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title">
                                                    <a href="shop-grid-4-column.html"
                                                    >The Cosmetics and Beauty brand Shoppe</a
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
                                                    <span class="product-price">$21.51</span>
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
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img
                                                    class="first-img"
                                                    src="/assets/store/img/product/4.png"
                                                    alt="thumbnail"
                                                />
                                            </a>
                                            <!-- product links -->
                                            <ul class="actions d-flex justify-content-center">
                                                <li>
                                                    <a class="action" href="wishlist.html">
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="add to wishlist"
                              class="icon-heart"
                          >
                          </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#compare"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Add to compare"
                              class="icon-shuffle"
                          ></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#quick-view"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Quick view"
                              class="icon-magnifier"
                          ></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title">
                                                    <a href="shop-grid-4-column.html"
                                                    >orginal Age Defying Cosmetics Makeup</a
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
                        <!-- slider-item end -->
                        <div class="slider-item">
                            <div class="card product-card">
                                <div class="card-body p-0">
                                    <div class="media flex-column">
                                        <div class="product-thumbnail position-relative">
                                            <span class="badge badge-danger top-right">New</span>
                                            <a href="single-product.html">
                                                <img
                                                    class="first-img"
                                                    src="/assets/store/img/product/5.png"
                                                    alt="thumbnail"
                                                />
                                                <img
                                                    class="second-img"
                                                    src="/assets/store/img/product/6.png"
                                                    alt="thumbnail"
                                                />
                                            </a>
                                            <!-- product links -->
                                            <ul class="actions d-flex justify-content-center">
                                                <li>
                                                    <a class="action" href="wishlist.html">
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="add to wishlist"
                              class="icon-heart"
                          >
                          </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#compare"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Add to compare"
                              class="icon-shuffle"
                          ></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        class="action"
                                                        href="#"
                                                        data-toggle="modal"
                                                        data-target="#quick-view"
                                                    >
                          <span
                              data-toggle="tooltip"
                              data-placement="bottom"
                              title="Quick view"
                              class="icon-magnifier"
                          ></span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- product links end-->
                                        </div>
                                        <div class="media-body">
                                            <div class="product-desc">
                                                <h3 class="title">
                                                    <a href="shop-grid-4-column.html"
                                                    >orginal Clear Water Cosmetics On Trend</a
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
                        <!-- slider-item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- new arrival section end -->

@endsection
