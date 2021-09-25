@extends('panel.admin.master')
@section('page_title') گزارش آزمون ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">آزمون</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">گزارش لحظه ای آزمون</li>
                            <li class="breadcrumb-item active">{{ $page_header }}</li>
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
                    @if($ty == 'testing')
                        @include('panel.admin.azmoons.quickReports.testing')
                    @elseif($ty == 'completed')
                        @include('panel.admin.azmoons.quickReports.completed')
                    @elseif($ty == 'absent')
                        @include('panel.admin.azmoons.quickReports.absents')
                    @elseif($ty == 'incomplete')
                        @include('panel.admin.azmoons.quickReports.incomplete')
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
