@extends('panel.admin.master')
@section('page_title')ویرایش آزمون@endsection
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css"/>

@endsection
@section('script')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>

    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

    <script type="text/javascript">


        $(document).ready(function () {
            $("#start_date_alt").persianDatepicker(
                {
                    observer: true,
                    format: 'YYYY/MM/DD H:m',
                    altField: '.start_date',
                    minDate: new persianDate().add('day', -1).valueOf(),
                    initialValue: false,
                    timePicker: {
                        enabled: true,
                        meridiem: {
                            enabled: false
                        },
                        second:false
                    }
                }
            );
            $("#end_date_alt").persianDatepicker(
                {
                    observer: true,
                    format: 'YYYY/MM/DD H:m',
                    altField: '.end_date',
                    initialValue: false,
                    minDate: new persianDate().add('day', -1).valueOf(),
                    timePicker: {
                        enabled: true,
                        meridiem: {
                            enabled: false
                        },
                        second:false
                    }
                }
            );
        });
    </script>
@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">آزمون</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم ویرایش آزمون </li>
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
                                <h4 class="header-title"> فرم ویرایش آزمون</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.azmoon.date.update',$azmoon) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 p-2">
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <strong> توجه! </strong>لطفا تاریخ جدید را انتخاب کنید!
                                            </div>
                                           <table class="table">
                                               <tbody><tr>
                                                   <th>زمان شروع</th>
                                                   <td class="text-xs-right ml-2 pl-2"><b>{{ $azmoonDate['start']  }}</b></td>
                                                   <th></th>
                                                   <th>زمان پایان</th>
                                                   <td class="text-xs-right"><b>{{ $azmoonDate['end'] }}</b></td>
                                               </tr></tbody>
                                               <tr>

                                               </tr>
                                           </table>
                                        </div>
                                        <div class="row p-5">
                                            <div class="col-lg-4 mb-3">
                                                <label for="start_date_alt"> تاریخ شروع</label>
                                                <input type="hidden" name="start_date" class="start_date">
                                                <input type="text" readonly autocomplete="off"
                                                       class="form-control"
                                                       value="{{ old('start_date_alt') }}"
                                                       id="start_date_alt" placeholder="تاریخ شروع آزمون">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">تاریخ شروع را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="end_date_alt"> تاریخ پایان</label>
                                                <input type="hidden" name="end_date" class="end_date">
                                                <input type="text" readonly autocomplete="off"
                                                       class="form-control"
                                                       value="{{ old('end_date_alt') }}"
                                                       id="end_date_alt" placeholder="تاریخ پایان آزمون">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">تاریخ پایان آزمون</li>
                                                </ul>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <label for="azmoon_time">مدت آزمون به دقیقه </label>
                                                <input type="number" autocomplete="off"
                                                       min="1"
                                                       max="2000"
                                                       class="form-control"
                                                       name="azmoon_time"
                                                       value="{{ old('azmoon_time',$azmoon->azmoon_time) }}"
                                                       id="azmoon_time" title="مدت آزمون به دقیقه"
                                                       placeholder="">
                                                @error('error')
                                                <ul class="parsley-errors-list is-invalid"
                                                    id="parsley-id-5" aria-hidden="false">
                                                    <li class="parsley-required">مدت آزمون را وارد کنید</li>
                                                </ul>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mt-4">
                                            <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light">
                                                ثبت اطلاعات
                                            </button>
                                            <button type="reset"
                                                    class="btn btn-secondary waves-effect m-l-5">
                                                تازه سازی فرم
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
