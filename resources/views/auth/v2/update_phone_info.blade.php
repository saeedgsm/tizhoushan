@extends('auth.v2.master')
@section('page_title') تایید موبایل و بروزرسانی اطلاعات @endsection
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css"/>
    @endsection
@section('script')
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        $("#birthdate").persianDatepicker(
            {
                observer: true,
                format: 'YYYY/MM/DD',
                altField: '.start_date',
                initialValue: false,
            }
        );
    </script>
@endsection
@section('content')
    <div class="col-md-9 register-right">
        <div class="col-md-3 p-2">
            @include('alert_messages.alerts')
        </div>
        <div class="">
            <h3 class="register-heading">صفحه تایید موبایل و بروزرسانی اطلاعات</h3>
            <form action="{{ route('user.send.sms.phone',['pc'=>$pc]) }}" method="post" class="form-horizontal">
                @csrf
                <div class="row register-form">
                    <div class="col-md-12">
                        <div class="row">
                            @if($cols['first_name'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="first_name" placeholder="نام *"
                                               value="{{ old('first_name') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['last_name'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="last_name"
                                               placeholder="نام خانوادگی *" value="{{ old('last_name') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['father'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="father"
                                               placeholder="نام پدر *" value="{{ old('father') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['school_name'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="school_name"
                                               placeholder="نام مدرسه *" value="{{ old('school_name') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['melli'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="melli" placeholder="کد ملی *"
                                               value="{{ old('melli') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['tel_home'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tel_home" placeholder="تلفن منزل"
                                               value="{{ old('tel_home') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['tel_parent'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="tel_parent" placeholder="تلفن والدین"
                                               value="{{ old('tel_parent') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['hamgam_code'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="hamgam_code" placeholder="کد همگام"
                                               value="{{ old('hamgam_code') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['birthdate'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="تاریخ تولد"
                                              readonly value="{{ old('birthdate') }}"/>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            @if($cols['email'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control " name="email" placeholder="ایمیل "
                                               value="{{ old('email') }}"/>
                                    </div>
                                </div>
                            @endif
                            @if($cols['phone'] == 1)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control is-invalid" name="phone"
                                               placeholder="شماره موبایل *" value="{{ old('phone') }}"/>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12">
                                @if($cols['password'] == 1)
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password"
                                               placeholder="کلمه عبور *" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation"
                                               placeholder="تکرار کلمه عبور *" value=""/>
                                    </div>
                                @endif
                                <input type="submit" class="btnRegister" value="ارسال کد فعال سازی"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
