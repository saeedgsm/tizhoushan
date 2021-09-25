@extends('panel.student.master')
@section('page_title')وقت آزمون@endsection
@section('style')
    <!-- Include this in your blade layout -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    <style>

        body{
            font-family: Vazir !important;
        }

        .ex-time {
            /* text-align: center; */
            border: 5px solid #004853;
            display:inline;
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
    <form action="{{ route('student.azmoons.end',$azmoon) }}" method="post">

        @csrf
        @method('post')
    <div class="page-content">
    @include('sweet::alert')
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
                    <div class="col-md-8 mt-4" >
                        <div class="float-left d-md-block" style="float: left !important;">
                            <button data type="submit" class="btn btn-light btn-rounded dropdown-toggle finish-az">پایان آزمون</button>
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
                                <div class="row align-content-center">
                                    <div class="col-12 col-lg-6">
                                        @foreach($files as $file)
                                            <div class="mb-3">
                                                <img src="{{ asset($file->image) }}" style="width: 100%;height: auto" class="img-fluid" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-sm-6  p-2">
                                        <div class="table-responsive align-content-center">
                                            <table class="table table-borderless mb-0" style="width: 0">
                                                <thead class="pb-4">
                                                <tr class="text-center mb-3">
                                                    <th width="10%"> سوال</th>
                                                    <th>گزینه 1</th>
                                                    <th>گزینه 2</th>
                                                    <th>گزینه 3</th>
                                                    <th>گزینه 4</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                <?php
                                                $pi=1;
                                                for ($loop=1;$loop<=$soal->soal_count;$loop++) { ?>
                                                <tr class="text-center">

                                                    <th scope="row">{{ $loop }}</th>
                                                    <?php for ($loopRadio=1;$loopRadio<=4;$loopRadio++) {
                                                    $radioStr = $loop . "_" . $loopRadio;?>
                                                    <td class="text-center">
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input type="radio" id="custominlineRadio{{ $radioStr }}" name="{{ $loop }}" value="{{ $loopRadio }}" class="option-input radio">

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
    </form>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script language="JavaScript">
        /*window.onbeforeunload = confirmExit;
        function confirmExit() {
            return "شما در حال آزمون دادن هستید! برای خروج از آزمون مطمئن هستید؟";
        }*/

        $("body").on("click",".finish-az",function(e){
            e.preventDefault();
            var current_object = $(this);
            let stName = " {{ auth()->user()->first_name }} {{ auth()->user()->last_name }} ";

                mss = " دانش آموز عزیز! " + stName + " ";

            swal({
                title: mss ,
                text: "شما در حال آزمون دادن هستید! برای خروج از آزمون مطمئن هستید؟",
                type: "error",
                showCancelButton: true,
                dangerMode: true,
                cancelButtonClass: '#DD6B55',
                confirmButtonColor: '#35dc80',
                confirmButtonText: 'بله !',
                cancelButtonText: 'خیر دستم خورد!'
            },function (result) {
                if (result) {
                    var action = current_object.attr('data-action');
                    var token = jQuery('meta[name="csrf-token"]').attr('content');
                    var id = current_object.attr('data-id');
                    console.log(current_object)
                //    $('body').html("<form class='form-inline remove-form' method='post' action='"+action+"'></form>");
                 //   $('body').find('.remove-form').append('<input name="_method" type="hidden" value="delete">');
                 //   $('body').find('.remove-form').append('<input name="_token" type="hidden" value="'+token+'">');
                 //   $('body').find('.remove-form').append('<input name="id" type="hidden" value="'+id+'">');
                  //  $('body').find('.remove-form').submit();
                }
            });
        });

    </script>

    <!-- alertifyjs js -->
    <script src="/assets/libs/alertifyjs/build/alertify.min.js"></script>

    <script src="/assets/js/pages/alertifyjs.init.js"></script>

    <!-- Magnific Popup-->
    <script src="/assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Tour init js-->
    <script src="/assets/js/pages/lightbox.init.js"></script>

    <script>
        let bb = document.getElementById('#custominlineRadio7_2');
        console.log(bb);

        function countdown( elementName, minutes, seconds )
        {
            var element, endTime, hours, mins, msLeft, time;

            function twoDigits( n )
            {
                return (n <= 9 ? "0" + n : n);
            }

            function updateTimer()
            {
                msLeft = endTime - (+new Date);
                if ( msLeft < 1000 ) {
                    element.innerHTML = "Time is up!";
                } else {
                    time = new Date( msLeft );
                    hours = time.getUTCHours();
                    mins = time.getUTCMinutes();
                    element.innerHTML = (hours ? hours + ':' + twoDigits( mins ) : mins) + ':' + twoDigits( time.getUTCSeconds() );
                    setTimeout( updateTimer, time.getUTCMilliseconds() + 500 );
                }
            }

            element = document.getElementById( elementName );
            endTime = (+new Date) + 1000 * (60*minutes + seconds) + 500;
            updateTimer();
        }

        let cc = {{ $azmoon->azmoon_time }}
        countdown( "ten-countdown", cc, 0 );

    </script>
@endsection
