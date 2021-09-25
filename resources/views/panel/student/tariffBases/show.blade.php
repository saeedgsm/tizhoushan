@extends('panel.student.master')
@section('page_title')جزئیات پرداخت@endsection
@section('style')
    <style>
        option {
            font-family: "b Yekan", serif;
        }
    </style>
@endsection
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
                                                <form action="{{ route('student.tariff.bases.request') }}">
                                                <div class="col-sm-12 text-xs-center text-md-left">
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
                                                                <td>نوع کلاس</td>
                                                                <td class="text-xs-right">
                                                                    <select name="tariff_id" id="tariff_id" class="form-control">
                                                                        <option value="">نوع هزینه را انتخاب کنید!</option>
                                                                        @foreach($ables as $item)
                                                                            <option value="{{ $item->id }}">{{ $item->tariff_label }}  -- {{ $item->tariff_amount }} <span>تومان</span> -- {{ $item->tariff_desc }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                            </tr>


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
                                                        <input type="hidden" name="desc" value="فعال سازی پنل کاربری">
                                                        <div class="btn-group  btn-block">
                                                            <button type="submit" class="btn btn-info">
                                                                <span class="font-size-24">پرداخت</span> <i
                                                                        class="uil uil-money-bill ::before"></i>
                                                            </button>
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
@endsection