@extends('site.master')

@section('page_title')درباره آزمون@endsection

@section('content')

    <!-- product-single start -->
    <section class="product-single theme1 pt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div>
                        <div class="position-relative">
                            <span class="badge badge-danger top-right">جدید</span>
                        </div>
                        <div class="product-sync-init mb-20">
                            <div class="single-product">
                                <div class="product-thumb">
                                    <?php
                                    $img['url']=$azmoon->soal->soal_cover;
                                    if ($img['url'] == null || !file_exists(public_path($img['url'])))
                                    {$img['url'] = "assets/images/widget-img.png";}
                                    ?>
                                    <img src="{{ asset($img['url']) }}" alt="product-thumb"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="single-product-info">
                        <div class="single-product-head">
                            <h2 class="title mb-20">{{ $azmoon->azmoon_title ?? '' }}</h2>
                        </div>
                        <div class="product-body mb-40">
                            <div class="d-flex align-items-center mb-30">
              <span class="product-price mr-20">
                <span class="onsale">
                    <span>نوع آزمون :</span>
                    @if($azmoon->type_payment == 'free')
                        <b> رایگان</b>
                    @else
                        <b> تومان {{ $azmoon->price ?? '' }}</b>
                    @endif
                    {{ $azmoon->price ?? '' }}
                </span>
              </span>
                            </div>
                            <p class="mb-3">
                                توضیحات دوره...
                            </p>

                            <ul>
                                <li class="mb-3">
                                    <span> کتاب های مربوطه : </span>
                                    <span>
                                        @foreach($azmoon->azmoonBooks as $eachBook)
                                            {{ $eachBook->book->book_name }},
                                        @endforeach
                                    </span>
                                </li >
                                <li class="mb-3">
                                    <span> زمان آزمون : </span>
                                    <span>
                                       {{ $azmoonDate['start']  }}
                                    </span>
                                </li >
                            </ul>
                        </div>
                        <div class="product-footer">
                            <div class="mt-30 mb-30">
                                @guest

                                    <a target="_blank" class="btn btn-secondary btn--xl mt-5 mt-sm-0 mb-2"  href="/login">
                                        <span class="mr-2"><i class="ion-android-add"></i></span>
                                        ورود به پنل کاربری</a>
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong> توجه! </strong>برای مشاهده لینک آزمون لطفا به ناحیه کاربری خود وارد شوید!
                                        <hr >
                                        <strong>  </strong>بعد ورود به ناحیه کاربری لینک را دوباره امتحان کنید!
                                    </div>
                                @else
                                    @if(auth()->user()->level == 'student')
                                        <b>
                                            <a target="_blank" class="btn btn-dark btn--xl mt-5 mt-sm-0" href="/azmoon/start/{{ $azmoon->azmoon_code ?? '' }}">
                                                <span class="mr-2"><i class="ion-android-add"></i></span>
                                                لینک آزمون</a>
                                        </b>

                                    @else
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong> توجه! </strong>برای مشاهده لینک آزمون لطفا با نوع کاربری دانش آموز وارد شوید!
                                            <hr >
                                            <strong>  </strong>بعد ورود به ناحیه کاربری لینک آزمون را دوباره امتحان کنید!
                                        </div>
                                        <a target="_blank" class="btn btn-secondary btn--xl mt-5 mt-sm-0 mb-2"  href="/logout">
                                            <span class="mr-2"><i class="ion-android-add"></i></span>
                                            خروج</a>
                                    @endif
                                @endguest

                            </div>

                            <div class="pro-social-links mt-10">
                                <ul class="d-flex align-items-center">
                                    <li class="share">اشتراک گذاری</li>
                                    <li>
                                        <a href="/azmoon/start/{{ $azmoon->azmoon_code ?? '' }}"><i class="ion-social-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="/azmoon/start/{{ $azmoon->azmoon_code ?? '' }}"><i class="ion-social-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="/azmoon/start/{{ $azmoon->azmoon_code ?? '' }}"><i class="ion-social-google"></i></a>
                                    </li>
                                    <li>
                                        <a href="/azmoon/start/{{ $azmoon->azmoon_code ?? '' }}"><i class="ion-social-pinterest"></i></a>
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
                                role="tablist">
                                <li class="nav-item ">
                                    <a
                                        class="nav-link active"
                                        id="pills-home-tab"
                                        data-toggle="pill"
                                        href="#pills-home"
                                        role="tab"
                                        aria-controls="pills-home"
                                        aria-selected="true">توضیحات</a>
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
                                    >جزئیات</a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        class="nav-link "
                                        id="pills-contact-tab"
                                        data-toggle="pill"
                                        href="#pills-contact"
                                        role="tab"
                                        aria-controls="pills-contact"
                                        aria-selected="false">نظرات</a>
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
                            class="tab-pane fade show active"
                            id="pills-home"
                            role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="single-product-desc">
                                <p>
                                    توضیحات دوره...
                                </p>
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
                                       <h4>در حال بروزرسانی</h4>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- third tab-pane -->
                        <div
                            class="tab-pane "
                            id="pills-contact"
                            role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="single-product-desc">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
