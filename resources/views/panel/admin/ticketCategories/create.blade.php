@extends('panel.admin.master')
@section('page_title')افزودن دسته بندی تیکت@endsection

@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دسته بندی تیکت </h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">فرم افزودن دسته بندی تیکت جدید</li>
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
                                <h4 class="header-title"> فرم افزودن دسته بندی تیکت</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                <form action="{{ route('admin.ticketCategories.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="ticket_category_name">عنوان دسته بندی تیکت</label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="ticket_category_name"
                                                   value="{{ old('ticket_category_name') }}"
                                                   id="ticket_category_name" placeholder="عنوان دسته بندی تیکت را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان دسته بندی تیکت را وارد کنید</li>
                                            </ul>
                                            @enderror
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="ticket_category_latin"><span>عنوان دسته بندی تیکت </span> <span class="text-danger">به لاتین</span></label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="ticket_category_latin"
                                                   value="{{ old('ticket_category_latin') }}"
                                                   id="ticket_category_latin" placeholder="عنوان دسته بندی تیکت را وارد کنید">
                                            @error('error')
                                            <ul class="parsley-errors-list is-invalid"
                                                id="parsley-id-5" aria-hidden="false">
                                                <li class="parsley-required">عنوان دسته بندی تیکت را وارد کنید</li>
                                            </ul>
                                            @enderror
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
