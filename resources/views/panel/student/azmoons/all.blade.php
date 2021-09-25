@extends('panel.student.master')
@section('page_title') آزمون ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">آزمون ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست آزمون</li>
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
                        <h5 class="mt-5 mb-3">آزمون های فعال شما</h5>
                        <div class="card-deck-wrapper">
                            <div class="card-deck">
                                @forelse($azmoons as $azmoon)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <?php
                                            $azObj = \App\Azmoon::query()->where('id',$azmoon['id'])->first();
                                            ?>
                                            <a href="{{ route('student.azmoons.show',$azmoon['id']) }}"><img class="card-img-top img-fluid" src="{{ asset($azObj->soal->azmoonImage()) }}" alt="Card image cap"></a>
                                            <div class="card-body">
                                                <a href="{{ route('student.azmoons.show',$azmoon['id']) }}"><h4 class="card-title font-size-16 mt-0">{{ $azmoon['azmoon_title'] }}</h4></a>

                                                <p class="card-text">
                                                    نوع آزمون : <span>{{ $azmoon['azmoon_type'] == 'normal' ? 'عادی' : 'پیشرفته' }}</span><br>
                                                    تاریخ آزمون : <span>{{ $azmoon['azmoon_start'] }}</span><br>
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
