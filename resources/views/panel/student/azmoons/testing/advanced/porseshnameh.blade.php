@extends('panel.student.master')
@section('page_title')وقت آزمون@endsection
@section('style')
    <link href="{{ asset('assets/css/button.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/azmoon/css/testing.css') }}" rel="stylesheet" type="text/css"/>
@endsection


@section('content')
    <form id="formpost">
        <div class="page-content">
            <!-- Page-Title -->
            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="page-title mb-1">وقت آزمون</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">آزمون شروع شده است لطفا صفحه را نبندید!</li>
                            </ol>
                        </div>
                        <div class="col-md-8 mt-4">
                        </div>
                    </div>
                </div>
                <div class="container-fluid bg-white mt-1"
                     style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 5px">
                    <div class="row py-4" style="font-size: 14px">
                        <div class="col-6 col-md-3 my-2">
                            <p class="mb-0">نام کاربر: <span
                                    class="font-weight-bold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                            </p>
                        </div>
                        <div class="col-6 col-md-4 my-2">
                            <p class="mb-0">نام آزمون: <span class="font-weight-bold">{{ $azmoon->azmoon_title }}</span>
                            </p>
                        </div>
                        <div class="col-6 col-md-3 my-2">
                            <p class="mb-0">زمان آزمون: <span
                                    class="font-weight-bold">{{ $azmoon->azmoon_time }} دقیقه</span></p>
                        </div>
                        <div class="col-6 col-md-2 my-2">
                            <p class="mb-0">تعداد سوال: <span
                                    class="font-weight-bold">{{ $soal->soal_count }} عدد</span></p>
                        </div>
                        <div class="col-12 col-md-12 my-2">
                            <hr>
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <strong> توجه! </strong>جهت مشاهده سوالات با کیفیت فایل های pdf سوالات را دانلود
                                    کنید!
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    @foreach($files as $item)
                                        <a href="{{ asset($item->pdf_file) }}" download="{{ $item->title }}"
                                           class="btn btn-success btn-rounded p-1">
                                            <i class="fa fa-download"></i>
                                            دانلود {{ $item->title }}
                                        </a>
                                    @endforeach
                                </div>
                                <div class="col-md-12 mt-3">
                                    <hr>
                                    <button onclick=" endAzmoon()" id="btn-end"
                                            class="btn btn-danger btn-rounded">پایان
                                        آزمون
                                    </button>
                                    <a href="{{ route('student.azmoons.karnameh',$azmoon) }}"
                                       style="margin-right: auto;"
                                       class="btn btn-success btn-rounded d-none" id="btn-res">مشاهده نتایج</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid bg-info mt-4"
                     style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 5px">
                    <h5 class="text-center text-white py-4">
                        @foreach($azmoon->azmoonBooks as $eachBook)
                            {{ $eachBook->book->book_name }} ,
                        @endforeach
                    </h5>
                </div>
            </div>
            <!-- end page title end breadcrumb -->
            <div class="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"> برگه آزمون</h5>

                                    <hr>
                                    <p class="card-title-desc">
                                        @include('alert_messages.alerts')
                                    </p>
                                    <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">
                                    <div class="row align-content-center">
                                        <div class="col-12 col-md-6 col-xl-7 my-4 overflow-auto">
                                            <div class="" id="overflowTest">
                                                @foreach($files as $file)
                                                    <div class="mb-3">
                                                        <img src="{{ asset($file->image) }}"
                                                             style="width: 100%;height: auto" class="img-fluid" alt="">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-5 my-4 overflow-auto">
                                            <div id="overflowTest">
                                                <?php $inputName = 0; ?>
                                                @foreach($advancedPorseshnamehs as $advancedPorseshnameh)
                                                    <div id="dom-target" style="display: none;">
                                                        <?php
                                                        $output = "$advancedPorseshnameh"; // Again, do some operation, get the output.
                                                        echo htmlspecialchars($output); /* You have to escape because the result
                                           will not be valid HTML otherwise. */
                                                        ?>
                                                    </div>
                                                    <div class="col-12 px-0 mt-5">
                                                        <hr>
                                                        <h4 class="text-center">{{ $advancedPorseshnameh->book->book_name }}</h4>
                                                    </div>
                                                    <div class="col-12 px-0">
                                                        <div class="box"
                                                             style="background-color: #ffd008;border-radius: 3px">
                                                            <div class="row text-center py-3"
                                                                 style="align-items: center">
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
                                                    // $inputName++;
                                                    $inputName = $advancedPorseshnameh->book->id;
                                                    $pi = 1;
                                                    for ($loop = 1; $loop <= $advancedPorseshnameh->number_of_question; $loop++) {?>
                                                    <div class="col-12 px-0 mt-1">
                                                        <div class="boxone"
                                                             style="background-color: pink ;border-radius: 3px">
                                                            <div class="row text-center py-2 mx-0"
                                                                 style="align-items: center">
                                                                <div class="col">
                                                                    <p class="mb-0 ">{{ $loop }}</p>
                                                                </div>
                                                                <?php for ($loopRadio = 1;$loopRadio <= 4;$loopRadio++) {
                                                                $radioStr = $loop . "_" . $loopRadio;?>
                                                                <div class="col">
                                                                    <div class="chiller_cb">
                                                                        <label
                                                                            for="myCheckbox{{ $inputName }}_{{ $radioStr }}">
                                                                            <input
                                                                                id="myCheckbox{{ $inputName }}_{{ $radioStr }}"
                                                                                type="radio"
                                                                                name="{{ $inputName }}_{{ $loop }}"
                                                                                value="{{ $loopRadio }}">
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <?php }?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php }?>
                                                @endforeach
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
    </form>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.0/axios.min.js"
            integrity="sha512-DZqqY3PiOvTP9HkjIWgjO6ouCbq+dxqWoJZ/Q+zPYNHmlnI2dQnbJ5bxAHpAMw+LXRm4D72EIRXzvcHQtE8/VQ=="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        let inputRadios = [];
        let inputName = 0;
        let ch = axios.get('/api/azmoon/count/soal/' + {{ $azmoon->id }})
            .then(function (response) {
                var book_data = response.data;
                book_data.forEach(el => {
                    inputName++;
                    let soal_count = el['soal_count'];
                    let soal_loop = 1;
                    for (soal_loop; soal_loop <= soal_count; soal_loop++) {
                        for (let loopRadio = 1; loopRadio <= 4; loopRadio++) {
                            let radioStr = "myCheckbox" + el['book_id'] + '_' + soal_loop + '_' + loopRadio;
                            inputRadios.push(document.getElementById(radioStr));
                        }
                    }
                });
                let tempArraySoals = [];
                for (let eachInputRadio of inputRadios) {
                    eachInputRadio.addEventListener('click', function () {
                        let $radio = $(this);
                        let lio = null;
                        for (lio of $radio) {}
                        if ($radio.data('waschecked') === true) {
                            // unchecked
                            if (tempArraySoals.includes(lio.name) === true) {
                                tempArraySoals = jQuery.grep(tempArraySoals, function (value) {
                                    return value !== lio.name;
                                });
                            }
                        } else {
                            // checked
                            if (tempArraySoals.includes(lio.name) === false) {
                                tempArraySoals.push(lio.name);
                            }
                        }
                        //   console.log($radio.data('waschecked'));
                        if ($radio.data('waschecked') === true) {
                            $radio.data('waschecked', false);
                            $radio.prop('checked', false);
                        } else {
                            $radio.data('waschecked', true);
                        }

                        let objForm = {};
                        objForm.name = $radio[0]['name'];
                        objForm.value = $radio[0]['value'];
                        objForm.status = $radio[0]['checked'];
                        objForm.azmoon_id = {{ $azmoon->id }};
                        objForm.user_id = {{ auth()->user()->id}};
                        //console.log(objForm)
                        axios.post('/student/azmoon/advanced/result/update', objForm)
                            .then(function (response) {
                                //console.log(response.data)
                            })
                            .catch(function (error) {
                                console.log(error)
                            })
                    })
                }
            }).catch(function (error) {
            console.log(error)
            });

        function endAzmoon() {
            const form = document.getElementById('formpost');
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                let stName = " {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} ";
                mss = " دانش آموز عزیز! " + stName;

                let firstLineStr = "شما در حال آزمون دادن هستید! برای خروج از آزمون مطمئن هستید؟ ";
                Swal.fire({
                    title: mss,
                    text: firstLineStr,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'بله می خواهم!',
                    cancelButtonText: 'خیر دستم خورد!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('/student/azmoon/advanced/end', formData)
                            .then(function (response) {
                               // console.log(response.data);
                                let btnS = document.getElementById('btn-end');
                                btnS.classList.add('d-none');
                                let btnR = document.getElementById('btn-res');
                                btnR.classList.remove('d-none');
                                window.addEventListener('beforeunload', function (e) {

                                });
                                Swal.fire(
                                    'خیلی خب!',
                                    response.data.msg,
                                    response.data.type
                                );

                                window.location = "{{ route('student.azmoons.karnameh.advanced',$azmoon) }}";
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

        function endedAzmoon() {
            const form = document.querySelector('form');
            //form.addEventListener('submit', (e) => {
            // e.preventDefault();
            const formData = new FormData(form);
            let stName = " {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} ";
            mss = " دانش آموز عزیز! " + stName;
            const counts = {{ $soal->soal_count }};
            let countChecked = tempArraySoals.length;
            let countUnchecked = counts - countChecked;

            let firstLineStr = "آزمون به پایان رسید! لطفا بروی پایان آزمون کلیک کنید! ";
            let secondLineStr = "\r تعداد نزده : " + countUnchecked + " و تعداد زده شده: " + countChecked;
            let finalLine = firstLineStr + "\n" + secondLineStr;
            Swal.fire({
                title: mss,
                text: finalLine,
                icon: 'warning',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'پایان آزمون!',
                //cancelButtonText: 'خیر دستم خورد!',
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/student/azmoon/end', formData)
                        .then(function (response) {

                            // console.log(response)
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

                            let loop = 1;
                            for (loop; loop <= counts; loop++) {
                                for (let loopRadio = 1; loopRadio <= 4; loopRadio++) {
                                    let radioStr = "myCheckbox" + loop + '_' + loopRadio;
                                    inpRadio.push(document.getElementById(radioStr));
                                }
                            }
                            for (let i of inpRadio) {
                                i.readOnly = true;
                                i.disabled = true;

                            }
                            window.location = "{{ route('student.azmoons.karnameh',$azmoon) }}";
                        })
                        .catch(function (error) {
                            // console.log(error);
                        })
                        .then(function () {
                            // always executed
                        });
                }
            });
            // });
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
        // countdown("ten-countdown", cc, 0);

        // Credit: Mateusz Rybczonec

        const FULL_DASH_ARRAY = 283;
        const WARNING_THRESHOLD = 50;
        const ALERT_THRESHOLD = 20;

        const COLOR_CODES = {
            info: {
                color: "white"
            },
            warning: {
                color: "orange",
                threshold: WARNING_THRESHOLD
            },
            alert: {
                color: "red",
                threshold: ALERT_THRESHOLD
            }
        };

        let convertToSecond = cc * 60;
        const TIME_LIMIT = convertToSecond;
        let timePassed = 0;
        let timeLeft = TIME_LIMIT;
        let timerInterval = null;
        let remainingPathColor = COLOR_CODES.info.color;

        document.getElementById("app").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>
  <span id="base-timer-label" class="base-timer__label">${formatTime(
            timeLeft
        )}</span>
</div>
`;

        startTimer();

        function onTimesUp() {
            clearInterval(timerInterval);
        }

        function startTimer() {
            timerInterval = setInterval(() => {
                timePassed = timePassed += 1;
                timeLeft = TIME_LIMIT - timePassed;
                document.getElementById("base-timer-label").innerHTML = formatTime(
                    timeLeft
                );
                setCircleDasharray();
                setRemainingPathColor(timeLeft);

                if (timeLeft === 0) {
                    onTimesUp();
                }
            }, 1000);
        }

        function formatTime(time) {
            const minutes = Math.floor(time / 60);
            let seconds = time % 60;

            if (seconds < 10) {
                seconds = `0${seconds}`;
            }

            return `${minutes}:${seconds}`;
        }

        function setRemainingPathColor(timeLeft) {
            const {alert, warning, info} = COLOR_CODES;

            if (timeLeft <= alert.threshold) {
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.remove(warning.color);
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.add(alert.color);
            } else if (timeLeft <= warning.threshold) {
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.remove(info.color);
                document
                    .getElementById("base-timer-path-remaining")
                    .classList.add(warning.color);
            }
            if (timeLeft === 1) {

               // endedAzmoon()
            }
        }

        function calculateTimeFraction() {
            const rawTimeFraction = timeLeft / TIME_LIMIT;
            return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
        }

        function setCircleDasharray() {
            const circleDasharray = `${(
                calculateTimeFraction() * FULL_DASH_ARRAY
            ).toFixed(0)} 283`;
            document
                .getElementById("base-timer-path-remaining")
                .setAttribute("stroke-dasharray", circleDasharray);
        }

        // disabled header menus
        let navLink = document.getElementsByClassName('nav-link');
        for (let item of navLink) {
            item.classList.add('disabled');
        }

    </script>


@endsection
