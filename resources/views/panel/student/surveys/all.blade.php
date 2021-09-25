@extends('panel.student.master')
@section('page_title') نظرسنجی ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">نظرسنجی ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست نظرسنجی</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-12 mt-4">
                        @include('alert_messages.alerts')
                        <h5 class="mt-5 mb-3">نظرسنجی های فعال شما</h5>
                        <div class="card-deck-wrapper">
                            <div class="card-deck">

                                @forelse($surveys as $survey)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <a href="{{ route('student.surveys.show',$survey['id']) }}"><img class="card-img-top img-fluid" src="{{ asset(check_default_cover($survey->soal->soal_cover,'azmoon_cover')) }}" alt="{{ $survey['azmoon_title'] }}"></a>
                                            <div class="card-body">
                                                <a href="{{ route('student.surveys.show',$survey['id']) }}"><h4 class="card-title font-size-16 mt-0">{{ $survey['azmoon_title'] }}</h4></a>

                                                <p class="card-text">
                                                    نوع نظرسنجی : <span>{{ $survey['azmoon_type'] == 'normal' ? 'عادی' : 'پیشرفته' }}</span><br>
                                                    تاریخ نظرسنجی : <span>{{ convertNumbers(Verta::instance($survey->azmoon_start)->format('H:i Y/m/d')) }}</span><br>
                                                </p>
                                                <p class="card-text">
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
