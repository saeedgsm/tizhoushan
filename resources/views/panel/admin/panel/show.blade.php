@extends('panel.admin.master')

@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">ناحیه کاربری</h4>
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
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">ناحیه کاربری من</h4>
                                <p class="card-title-desc"></p>

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
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <a href="" itemprop="contentUrl" data-size="480x360">
                                                                <img width="100%"
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
                                                                <td class="text-xs-right"> <b>
                                                                        {{ auth()->user()->first_name  }} {{ auth()->user()->last_name  }}
                                                                    </b></td>
                                                            </tr>

                                                            <tr>
                                                                <td>ایمیل</td>
                                                                <td class="text-xs-right"><b>{{ auth()->user()->email == null ? 'نا مشخص' :  auth()->user()->email }}</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>موبایل</td>
                                                                <td class="text-xs-right"><b>{{ auth()->user()->phone == null ? 'نا مشخص' :  auth()->user()->phone }}</b></td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.panel.edit') }}" class="btn btn-info"> <span>ویرایش اطلاعات</span> <i class="ti ti-pencil ::before"></i> </a>
                                                    </div>
                                                    @include('alert_messages.alerts')
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
