@extends('panel.student.master')
@section('page_title')وقت آزمون@endsection
@section('style')
    <link href="/assets/css/button.css" rel="stylesheet" type="text/css"/>
    <style>

        body {
            font-family: Vazir !important;
        }

        .ex-time {
            /* text-align: center; */
            border: 5px solid #004853;
            display: inline;
            padding: 5px;
            color: #004853;
            font-family: Verdana, sans-serif, Arial;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            position: fixed;
            z-index: 1;
        }

        .table td, .table th {
            padding: .10rem;
            vertical-align: top;
            border-top: 1px solid #eff2f7;
        }
    </style>
@endsection


@section('content')
    <form id="formpost">
        <div class="page-content">

            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <h4 class="page-title mb-1">وقت آزمون</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">آزمون شروع شده است لطفا صفحه را نبندید!</li>
                            </ol>
                        </div>
                        <div class="col-md-8 mt-4">
                            <div class="float-left " id="btn-end" style="float: left !important;">
                                <button onclick=" endAzmoon()" class="btn btn-light btn-rounded dropdown-toggle">پایان
                                    آزمون
                                </button>
                            </div>
                            <div class="float-left d-none" id="btn-res" style="float: left !important;">
                                <a href="{{ route('student.azmoons.karnameh',$azmoon) }}"
                                   class="btn btn-success btn-rounded dropdown-toggle">مشاهده نتایج</a>
                            </div>
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
                                    <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">
                                    <div class="row align-content-center">
                                        <div class="col-12 col-lg-6">
                                            @foreach($files as $file)
                                                <div class="mb-3">
                                                    <img src="{{ asset($file->image) }}"
                                                         style="width: 100%;height: auto" class="img-fluid" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-12 col-md-6 my-4">
                                            <div class="col-12 px-0">
                                                <div class="box" style="background-color: #ffd008;border-radius: 3px">
                                                    <div class="row text-center py-3" style="align-items: center">
                                                        <div class="col">
                                                            <p class="mb-0">سوال</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="mb-0">گزینه 1</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="mb-0">گزینه 2</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="mb-0">گزینه 3</p>
                                                        </div>
                                                        <div class="col">
                                                            <p class="mb-0">گزینه 4</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $pi = 1;
                                            for ($loop = 1;$loop <= $soal->soal_count;$loop++) { ?>
                                            <div class="col-12 px-0 mt-4">
                                                <div class="boxone" style="background-color: pink ;border-radius: 3px">
                                                    <div class="row text-center py-2 mx-0" style="align-items: center">
                                                        <div class="col">
                                                            <p class="mb-0 ">{{ $loop }}</p>
                                                        </div>
                                                        <?php for ($loopRadio = 1;$loopRadio <= 4;$loopRadio++) {
                                                        $radioStr = $loop . "_" . $loopRadio; ?>
                                                        <div class="col">
                                                            <div class="chiller_cb">
                                                                <label for="myCheckbox{{ $radioStr }}">
                                                                    <input id="myCheckbox{{ $radioStr }}" type="radio"
                                                                           name="{{ $loop }}" value="{{ $loopRadio }}">
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
            integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>

        let inpRadio = [];
        const counts = {{ $soal->soal_count }};
        let loop = 1;
        for (loop; loop <= counts; loop++) {
            for (let loopRadio = 1; loopRadio <= 4; loopRadio++) {
                let radioStr = "myCheckbox" + loop + '_' + loopRadio;
                inpRadio.push(document.getElementById(radioStr));
            }
        }
        for (let i of inpRadio){
            i.addEventListener('click',function () {
                var $radio = $(this);
                if ($radio.data('waschecked') === true) {
                    $radio.prop('checked', false);
                    $radio.data('waschecked', false);
                }else {
                    $radio.data('waschecked', true);
                }
            })
        }

        function endAzmoon(azmoon_id) {
            const form = document.querySelector('form');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                let stName = " {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} ";
                mss = " دانش آموز عزیز! " + stName;
                Swal.fire({
                    title: mss,
                    text: "شما در حال آزمون دادن هستید! برای خروج از آزمون مطمئن هستید؟",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'بله می خواهم!',
                    cancelButtonText: 'خیر دستم خورد!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/student/azmoon/end', formData)
                            .then(function (response) {
                                let btnS = document.getElementById('btn-end');
                                btnS.classList.add('d-none');
                                let btnR = document.getElementById('btn-res');
                                btnR.classList.remove('d-none');
                                Swal.fire(
                                    'خیلی خب!',
                                    response.data.msg,
                                    response.data.type
                                );

                                let inpRadio = [];
                                const counts = {{ $soal->soal_count }};
                                let loop = 1;
                                for (loop; loop <= counts; loop++) {
                                    for (let loopRadio = 1; loopRadio <= 4; loopRadio++) {
                                        let radioStr = "myCheckbox" + loop + '_' + loopRadio;
                                        inpRadio.push(document.getElementById(radioStr));
                                    }
                                }

                                for (let i of inpRadio){
                                    i.readOnly = true;
                                    i.disabled = true;
                                    console.log(i);
                                }


                            })
                            .catch(function (error) {
                                console.log(error);
                            })
                            .then(function () {
                                // always executed
                            });
                    }
                });
            });
        }




        function countdown(elementName, minutes, seconds) {
            var element, endTime, hours, mins, msLeft, time;

            function twoDigits(n) {
                return (n <= 9 ? "0" + n : n);
            }

            function updateTimer() {
                msLeft = endTime - (+new Date);
                if (msLeft < 1000) {
                    element.innerHTML = "پایان آزمون";
                } else {
                    time = new Date(msLeft);
                    hours = time.getUTCHours();
                    mins = time.getUTCMinutes();
                    element.innerHTML = (hours ? hours + ':' + twoDigits(mins) : mins) + ':' + twoDigits(time.getUTCSeconds());
                    setTimeout(updateTimer, time.getUTCMilliseconds() + 500);
                }
            }

            element = document.getElementById(elementName);
            endTime = (+new Date) + 1000 * (60 * minutes + seconds) + 500;
            updateTimer();
        }

        let cc = {{ $azmoon->azmoon_time }}
        countdown("ten-countdown", cc, 0);

    </script>
@endsection
