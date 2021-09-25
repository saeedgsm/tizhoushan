@extends('auth.v2.master')
@section('page_title') صفحه بررسی شماره موبایل @endsection

@section('content')

    <div class="col-md-9 register-right">
        <div class="col-md-3 p-2">
            @include('alert_messages.alerts')
        </div>
        <h3 class="register-heading">صفحه تایید کد ارسال شده!</h3>
        <form action="{{ route('register.confirm.code') }}" method="post" class="form-horizontal">
            @csrf
            <div class="row register-form">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="number" class="form-control" name="scode" placeholder="کد تایید *" value="{{ old('scode') }}"/>
                            </div>
                        </div>
                        <input type="submit" class="btnRegister" value="تایید"/>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
