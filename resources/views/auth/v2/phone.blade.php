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

        <div class="justify-content-center">
            <h4 class="register-heading">صفحه تایید موبایل و بروزرسانی اطلاعات</h4>
            <form action="{{ route('user.check.phone',['pc'=>$pc]) }}" method="post" class="form-horizontal">
                @csrf
                <div class="row register-form " >
                    <div class="col-md-3 p-2">
                        @include('alert_messages.alerts')
                    </div>
                    <div class="col-md-12 ">
                        <div class="row justify-content-center">
                            <div class="col-md-6 justify-content-center">
                                <div class="form-group">
                                    <input type="text" class="form-control is-invalid" name="phone"
                                           placeholder="شماره موبایل " value="{{ old('phone') }}"/>
                                </div>
                            </div>
                            <div class="col-md-6 justify-content-center">
                                <input type="submit" class="btnRegister" value="ارسال کد فعال سازی"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
