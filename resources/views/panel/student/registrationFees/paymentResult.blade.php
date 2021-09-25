@extends('panel.student.master')

@section('page_title')نتیجه پرداخت@endsection

@section('content')
    div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1">نتیجه پرداخت</h4>
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
                            <h1 class="font-size-20">جزئیات پرداخت</h1>
                            <!-- Nav tabs -->

                            <ul class="nav nav-tabs nav-justified nav-tabs-custom" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#custom-profile" role="tab" aria-selected="true">
                                        <i class="fas fa-user mr-1 align-middle"></i> <span class="d-none d-md-inline-block">اطلاعات من</span>
                                    </a>
                                </li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="custom-profile" role="tabpanel">
                                    <div class="col-sm-12">
                                        <div class="row justify-content-md-center">
                                            <div class="col-sm-8 text-xs-center text-md-left">
                                                <h4 class="lead">اطلاعات من </h4>
                                                @include('alert_messages.alerts')
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <span class="font-size-18"><strong> آفرین! </strong>تراکنش با موفقیت انجام گردید!</span>
                                                    <br>
                                                    <span class="font-size-18"><strong> </strong>به علم برتر سالار خوش آمدید! </span>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table ">
                                                        <tbody>
                                                        <tr>
                                                            <td>مقدار پرداخت شده:</td>
                                                            <td class="text-xs-right">
                                                                <b>{{ $payment->amount }}</b>
                                                                <span> تومان </span>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>وضعیت پرداخت</td>
                                                            <td class="text-xs-right"><b>{{ $payment->payment == 1 ? 'موفق' : 'ناموفق' }} </b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>کد پیگیری</td>
                                                            <td class="text-xs-right"><b>{{ $payment->resnumber }}</b></td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <a href="{{ route('student.panel') }}" class="btn btn-info btn-block">
                                                    <span class="font-size-24">ادامه</span> <i class="uil uil-money-bill ::before"></i>
                                                </a>
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