@extends('panel.admin.master')
@section('page_title') فیلد های سفارشی@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">فیلد های سفارشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">سفارش سازی لیست فیلد ها برای کاربران</li>
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
                                <h4 class="header-title">{{ $field->custom_field_name }}</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.fields.update',$field) }}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        @foreach($cols as $key => $value)
                                            <?php
                                            $ss = "validation.attributes." . $key;
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">{{ __($ss) }}</h5>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="{{ $key }}1" name="{{ $key }}"
                                                               value="1" {{ $value == 1 ? 'checked' : '' }}
                                                               class="custom-control-input">
                                                        <label class="custom-control-label"
                                                               for="{{ $key }}1">فعال</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="{{ $key }}2" name="{{ $key }}"
                                                               value="0" {{ $value == 0 ? 'checked' : '' }}
                                                               class="custom-control-input">
                                                        <label class="custom-control-label"
                                                               for="{{ $key }}2">غیر فعال</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-4 mt-4">
                                        <button type="submit"
                                                class="btn btn-primary waves-effect waves-light">
                                            ثبت اطلاعات
                                        </button>
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
