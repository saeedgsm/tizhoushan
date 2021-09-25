@extends('panel.student.master')

@section('page_title')لیست پرداخت ها@endsection

@section('content')
    div class="page-content">
    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="page-title mb-1"> پرداخت ها</h4>
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

                            @if($fees->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>مقدار پرداختی </th>
                                            <th>وضعیت</th>
                                            <th>کد پیگیری</th>
                                            <th>تاریخ </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                                <td>{{ $fee->amount }}</td>
                                                <td>{{ $fee->payment }}</td>
                                                <td>{{ $fee->resnumber }}</td>
                                                <td>{{ $fee->create_at }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            @else
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong>توجه!</strong> لیست پرداختی خالی می باشد!
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection