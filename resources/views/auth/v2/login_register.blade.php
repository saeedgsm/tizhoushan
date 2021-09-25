@extends('auth.v2.master')
@section('page_title') صفحه ورود و ثبت نام @endsection
@section('script')
    <script>
        function selectTab() {
            let params = "{{ $request['keyword'] }}";
            if (params === "login") {
                let tabContent = document.getElementById('login-tab').classList.add('active');
                let tabPanel = document.getElementById('login').classList.add('show', 'active');
            } else if (params === "reg") {
                let tabContent = document.getElementById('register-tab').classList.add('active');
                let tabPanel = document.getElementById('register').classList.add('show', 'active');
            } else {
                let tabContent = document.getElementById('login-tab').classList.add('active');
                let tabPanel = document.getElementById('login').classList.add('show', 'active');
            }
        }

        selectTab();
    </script>
@endsection
@section('content')
    <div class="col-md-9 register-right">
        @include('alert_messages.alerts')
        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab"
                   aria-controls="login" aria-selected="true">ورود</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                   aria-controls="register" aria-selected="false">ثبت نام</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">
                <h3 class="register-heading">صفحه ورود به پنل کاربری</h3>
                <form action="{{ route('login') }}" method="post" class="form-horizontal">
                    @csrf
                    <div class="row register-form">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="کد کاربری"
                                       name="inId" id="inId"
                                       autocomplete="off"
                                       required/>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="کلمه عبور" name="password"
                                       id="userpassword"/>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">مرا به خاطر بسپار</label>
                            </div>


                            <input type="submit" class="btnRegister" value="ورود"/>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('رمز عبور خود را فراموش کرده اید؟') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade show" id="register" role="tabpanel" aria-labelledby="register-tab">
                <h3 class="register-heading">ایجاد حساب کاربری</h3>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="row register-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">نام</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="نام را به فارسی وارد کنید"
                                           value="{{ old('first_name') }}" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">نام خانوادگی</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                           placeholder="نام خانوادگی را به فارسی وارد کنید" value="{{ old('last_name') }}" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">تلفن موبایل</label>
                                    <input type="text" class="form-control is-invalid" name="phone" id="phone" dir="ltr"
                                           placeholder="09**" value="{{ old('phone') }}" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">کلمه عبور</label>
                                    <input type="password" class="form-control" name="password"
                                           placeholder="کلمه عبور *" value="" autocomplete="off"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">تکرار کلمه عبور</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="تکرار کلمه عبور *" value="" autocomplete="off"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" class="btnRegister" value="ثبت نام "/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
