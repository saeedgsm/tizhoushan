@extends('panel.student.master')
@section('page_title') آزمون ها@endsection
@section('style')
    <!-- Lightbox css -->
    <link href="/assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css"/>

    <style>
        @-webkit-keyframes click-wave {
            0% {
                height: 40px;
                width: 40px;
                opacity: 0.35;
                position: relative;
            }
            100% {
                height: 200px;
                width: 200px;
                margin-left: -80px;
                margin-top: -80px;
                opacity: 0;
            }
        }

        @-moz-keyframes click-wave {
            0% {
                height: 40px;
                width: 40px;
                opacity: 0.35;
                position: relative;
            }
            100% {
                height: 200px;
                width: 200px;
                margin-left: -80px;
                margin-top: -80px;
                opacity: 0;
            }
        }

        @keyframes click-wave {
            0% {
                height: 40px;
                width: 40px;
                opacity: 0.35;
                position: relative;
            }
            100% {
                height: 200px;
                width: 200px;
                margin-left: -80px;
                margin-top: -80px;
                opacity: 0;
            }
        }

        .option-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            position: relative;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            height: 40px;
            width: 40px;
            -webkit-transition: all 0.15s ease-out 0s;
            -moz-transition: all 0.15s ease-out 0s;
            transition: all 0.15s ease-out 0s;
            background: #cbd1d8;
            border: none;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            margin-right: 0.5rem;
            outline: none;
            position: relative;
            z-index: 1000;
        }

        .option-input:hover {
            background: #9faab7;
        }

        .option-input:checked {
            background: #40e0d0;
        }

        .option-input:checked::before {
            height: 40px;
            width: 40px;
            position: absolute;
            content: "\2716";
            display: inline-block;
            font-size: 26.6666666667px;
            text-align: center;
            line-height: 40px;
        }

        .option-input:checked::after {
            -webkit-animation: click-wave 0.65s;
            -moz-animation: click-wave 0.65s;
            animation: click-wave 0.65s;
            background: #40e0d0;
            content: "";
            display: block;
            position: relative;
            z-index: 100;
        }

        .option-input.radio {
            border-radius: 50%;
        }

        .option-input.radio::after {
            border-radius: 50%;
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
                        <h4 class="page-title mb-1">آزمون ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">مشاهده نتایج</li>
                        </ol>
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

                                <div class="row">
                                    <div class="col-sm-4 align-content-center p-2">
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>تعداد پاسخ صحیح</th>
                                                    <th>تعداد پاسخ غلط</th>
                                                    <th>تعداد بدونه پاسخ</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="text-center table-success">
                                                    <th scope="row">{{ $trueCk }}</th>
                                                    <th scope="row">{{ $falseCk }}</th>
                                                    <th scope="row">{{ $emptyCk }}</th>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="align-content-center p-2">
                                            <a href="{{ route('student.azmoons.karnameh',$azmoon) }}"
                                               class="btn btn-success">مشاهده کارنامه </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 align-content-center p-2">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>شماره سوال</th>
                                                    <th>گزینه اول</th>
                                                    <th>گزینه دوم</th>
                                                    <th>گزینه سوم</th>
                                                    <th>گزینه چهارم</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $pi = 1;
                                                for ($loop = 1;$loop <= $soal->soal_count;$loop++) {
                                                    ?>
                                                <tr>
                                                    <th scope="row">{{ $loop }}</th>
                                                    <?php for ($loopRadio = 1;$loopRadio <= 4;$loopRadio++) {
                                                    $checked = null;
                                                    if (array_key_exists($loop, $studentAnswers)) {
                                                        $st_ans = $studentAnswers[$loop];
                                                        if ($loopRadio == $st_ans) {
                                                            $checked = "checked";
                                                        }
                                                    }
                                                    $radioStr = $loop . "_" . $loopRadio;?>
                                                    <td>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" readonly disabled
                                                                   id="custominlineRadio{{ $radioStr }}"
                                                                   name="{{ $loop }}"
                                                                   {{ $checked }} value="{{ $loopRadio }}"
                                                                   class="option-input radio">
                                                            <label class="custom-control-label"
                                                                   for="custominlineRadio{{ $radioStr }}"></label>
                                                        </div>
                                                    </td>
                                                    <?php } ?>
                                                </tr>
                                                <?php } ?>
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
        </div>
    </div>

@endsection
