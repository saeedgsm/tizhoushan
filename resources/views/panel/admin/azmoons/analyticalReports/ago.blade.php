@extends('panel.admin.master')

@section('content')
    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">گزارش تحلیل </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">قبل شروع آزمون</li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>
                    <div class="col-md-8">

                    </div>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">مشاهده جزئیات آزمون</h4>

                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')

                                </p>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>سوال </th>
                                            <th>کلید</th>
                                            <th> تعداد کل</th>
                                            <th> گزینه 1</th>
                                            <th>گزینه 2</th>
                                            <th> گزینه 3</th>
                                            <th> گزینه 4</th>
                                            <th> نزده</th>
                                            <th> درصد</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
