@extends('panel.student.master')
@section('page_title')جزئیات پرداخت@endsection
@section('content')
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">جزئیات پرداخت</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>

            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="font-size-20">انتقال به درگاه</h1>
                                <!-- Nav tabs -->

                                <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#custom-profile" role="tab"
                                           aria-selected="true">
                                            <i class="fas fa-user mr-1 align-middle"></i> <span
                                                    class="d-none d-md-inline-block">اطلاعات من</span>
                                        </a>
                                    </li>

                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content p-3">
                                    <div class="tab-pane active" id="custom-profile" role="tabpanel">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <a href="" itemprop="contentUrl" data-size="480x360">
                                                                <img width="180"
                                                                     class=" img-thumbnail"
                                                                     src="{{ asset(auth()->user()->userAvatar()) }}"
                                                                     alt="Image description"/>
                                                            </a>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="col-sm-8 text-xs-center text-md-left">
                                                    <h4 class="lead">اطلاعات من </h4>
                                                    <div class="table-responsive">
                                                        <table class="table ">
                                                            <tbody>
                                                            <tr>
                                                                <td>نام کامل</td>
                                                                <td class="text-xs-right"><b>
                                                                        {{ auth()->user()->first_name  }} {{ auth()->user()->last_name  }}
                                                                    </b></td>
                                                            </tr>

                                                            <tr>
                                                                <td>کد کاربری</td>
                                                                <td class="text-xs-right">
                                                                    <b>{{ auth()->user()->usercode == null ? 'نا مشخص' :  auth()->user()->usercode }}</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>موبایل</td>
                                                                <td class="text-xs-right">
                                                                    <b>{{ auth()->user()->phone == null ? 'نا مشخص' :  auth()->user()->phone }}</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>پایه</td>
                                                                <td class="text-xs-right">
                                                                    <b>{{ auth()->user()->studentBaseClass->educationBase->base_title }}</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>مبلغ پرداختی</td>
                                                                <td class="text-xs-right">
                                                                    <b>{{ $reg->cost == null ? 'نا مشخص' : $reg->cost }}</b>
                                                                    <strong>تومان</strong></td>
                                                            </tr>
                                                            @if($reg->desc != null || $reg->desc != '')
                                                                <tr>
                                                                    <td>پیام مدیریت</td>
                                                                    <td class="text-xs-right"><span
                                                                                class="text-danger font-weight-bolder font-size-18">{{ $reg->desc == null ? 'نا مشخص' : $reg->desc }}</span>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @include('alert_messages.alerts')
                                                    <div class="alert alert-info alert-dismissible fade show"
                                                         role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <span class="font-size-18"><strong> توجه! </strong>برای ادامه و تکمیل اطلاعات دکمه پرداخت فشار دهید!</span>
                                                        <br>
                                                        <span class="font-size-18"><strong> توجه! </strong>لطفا بعد از تکمیل شدن عملیات پرداخت، دکمه بازگشت به سایت را بزنید.</span>
                                                    </div>
                                                    <form action="{{ route('student.registration.fee.request') }}"
                                                          method="get">
                                                        <input type="hidden" name="amount" value="{{ $reg->cost }}">
                                                        <input type="hidden" name="desc" value="فعال سازی پنل کاربری">
                                                        <input type="hidden" name="phone"
                                                               value="{{ auth()->user()->phone }}">
                                                        <div class="btn-group  btn-block">
                                                            <button type="submit" class="btn btn-info">
                                                                <span class="font-size-24">پرداخت</span> <i
                                                                        class="uil uil-money-bill ::before"></i>
                                                            </button>
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
    </div>
@endsection