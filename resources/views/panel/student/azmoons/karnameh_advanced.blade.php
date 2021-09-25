<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
      xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>کارنامه</title>
    <link rel="stylesheet" href="/assets/karnameh/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/karnameh/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="/assets/karnameh/css/style.css">
    <!--javascript-->
    <script src="/assets/karnameh/js/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="/assets/karnameh/js/bootstrap.js"></script>

</head>
<body>

<div class="container my-3" id="print-view">
    <div class="box">
        <div class="col-6 col-md-3 mt-3">
            <p>کد کاربر : <span>{{ $user->id }}</span></p>
        </div>
        <div class="col-md-6 d-md-block d-lg-block">
            <div class="btn btn-outline-pink w-100">مشاهده نتیجه</div>
        </div>
        <div class="col-6 col-md-3">
            <img src="/assets/karnameh/img/logo-jpg.jpg" class="img-fluid d-block ml-auto"
                 style="width: 100px;height: 70px">
        </div>
    </div>


    <div class="box my-2 justify-content-md-between">
        <div class="col-5 col-md-3 my-1">
            <img src="{{ asset('/assets/karnameh/img/img_401900.png') }}" class="img-fluid" style="width: 90px; height: 90px">
        </div>
        <div class="col-12 col-md-5 col-lg-4 my-1">
            <div class="btn btn-outline-pink w-100"><p>سیستم آزمون:<span class="font-s">جامع(با ضریب)</span></p></div>
        </div>
    </div>


    <div class="row my-3 mx-0">
        <div class="col-12 col-md-3 col-lg-2 my-1">
            <p>نام : <span>{{ $user->first_name }}</span></p>
        </div>
        <div class="col-12 col-md-3 col-lg-2 my-1">
            <p>نام خانوادگی : <span>{{ $user->last_name }}</span></p>
        </div>
        <div class="col-12 col-md-3 col-lg-2 my-1">
            <p>پایه : <span>{{ $regClassStudent->educationBase->base_title ?? '' }}</span></p>
        </div>
        <div class="col-12 col-md-3 col-lg-2 my-1">
            <p>کلاس : <span>{{ $regClassStudent->educationClass->class_title ?? '' }}</span></p>
        </div>
        <div class="col-12 col-md-3 col-lg-2 my-1">
            <p>نام آزمون : <span>{{ $azmoon->azmoon_title }}</span></p>
        </div>
        <div class="col-12 col-md-3 col-lg-2 my-1">
            <p>تاریخ آزمون : <span>{{ $azmoonDate['start'] }}</span></p>
        </div>
    </div>


    <div class="container my-5">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>کتاب</th>
                <th>تعداد درست</th>
                <th>تعداد نادرست</th>
                <th>بدون جواب</th>
                <th>نمره درس از</th>
                <th>درصد</th>
                <th>حداکثر درصد</th>
                <th>میانگین درصد</th>
            </tr>
            </thead>
            <tbody>
            @foreach($last_data as $data)
            <tr>
                <td>{{ $data['book_name'] }}</td>
                <td>{{ $data['correct'] }}</td>
                <td>{{ $data['incorrect'] }}</td>
                <td>{{ $data['empty'] }}</td>
                <td>{{ $data['book_nomreh'] }}</td>
                <td>{{ $data['Percentage'] }}</td>
                <td>{{ $data['max'] }}</td>
                <td>{{ $data['min'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="box justify-content-center">
        <p class="px-2">درصد</p>
        <p class="px-2">حداکثر درصد</p>
        <p class="px-2">میانگین درصد</p>
        <p class="px-2">حداقل درصد</p>
    </div>


    <div class="row justify-content-end my-3">
        <div class="col-7 bor-percent">
        </div>
        <div class="col-3">
            <p class="Percent-height">حداکثر درصد</p>
            <p class="Percent-height pt-5">میانگین درصد</p>
            <p class="Percent-height pt-5 ">حداقل درصد</p>
        </div>
    </div>

    <div class="container pt-4">
        <table class="table table-bordered ">
            <thead>
            <tr>
                <th>تعداد شرکت کنندگان در آزمون</th>
                <th class="font-weight-bold">تصویر پاسخنامه</th>

            </tr>
            </thead>
            <tbody>
            <tr>
                <td width="30%">-</td>
                <td>
                    <div class="row">
                        <h5>در حال آماده سازی</h5>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('/assets/karnameh/js/custom-js.js') }}"></script>

</body>
</html>
