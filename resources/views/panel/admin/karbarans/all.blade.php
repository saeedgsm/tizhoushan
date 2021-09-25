@extends('panel.admin.master')
@section('page_title') دانش آموزان@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">دانش آموزان</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست دانش آموزان</li>
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
                                <h4 class="header-title">لیست دانش آموزان</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($karbarans->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>شناسه</th>
                                                <th>نام</th>
                                                <th>نام </th>
                                                <th>فامیلی </th>
                                                <th>نام</th>
                                                <th>نام کاربری</th>
                                                <th>کلمه عبور</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($karbarans as $student)
                                                <tr>
                                                    <th scope="row">{{ $student->id }}</th>
                                                    <td>{{ $student->name }} </td>
                                                    <td>{{ $student->getname }} </td>
                                                    <td>{{ $student->getfamily }} </td>
                                                    <td>{{ $student->username }} </td>
                                                    <td>
                                                        {{ $student->pass }}
                                                    </td>

                                                    <td>

                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $karbarans->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست دانش آموزان خالی می باشد!
                                        </div>

                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
