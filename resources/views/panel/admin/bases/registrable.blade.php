@extends('panel.admin.master')
@section('page_title')جزئیات پایه آموزشی@endsection

@section('style')




@endsection

@section('script')
    <link rel="stylesheet" href="{{ asset('assets/libs/select/msfmultiselect.min.css') }}" />
    <script src="{{ asset('assets/libs/select/msfmultiselect.min.js') }}"></script>


    <script>
        var mySelect = new MSFmultiSelect(
            document.querySelector('#multiselect'),
            {
              //  appendTo: '#example',
                width:350,
                height:30
                // options here
            }
        );

    </script>
@endsection

@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">پایه های آموزشی</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">جزئیات پایه آموزشی و کلاس های آموزشی مربوطه </li>
                        </ol>
                    </div>
                    <div class="col-md-4">
                        <div class="float-right d-none d-md-block">
                            <a href="{{ route('admin.classes.create') }}" class="btn btn-light btn-rounded dropdown-toggle"><i class="dripicons-plus mr-1"></i>
                                <b>افزودن کلاس آموزشی</b>
                            </a>
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
                                <h4 class="header-title">مشاهده جزئیات پایه آموزشی</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>

                                <form action="#" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <div id="example">
                                        <select id="multiselect"  class="" name="languages[]" multiple="multiple">
                                            <option value="1" selected>JavaScript</option>
                                            <option value="2">CSS</option>
                                            <option value="3" selected>HTML</option>
                                            <option value="4">Ruby</option>
                                            <option value="5">Go</option>
                                            <option value="6">PHP</option>
                                            <option value="7">ASP.Net</option>
                                            <option value="8">Java</option>
                                        </select>
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
