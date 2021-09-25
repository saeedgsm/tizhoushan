@extends('panel.student.master')
@section('page_title') کتاب ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">کتاب ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست کتاب</li>
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
                                <h4 class="header-title">لیست کتاب</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($books->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>کتاب </th>
                                                <th>ضریب</th>
                                                <th>نمره منفی</th>
                                                <th>نمره </th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($books as $book)
                                                <tr>
                                                    <td>{{ $book->book_name }}</td>
                                                    <td>{{ $book->zarib }}</td>
                                                    <td>{{ $book->nomreh_manfi }}</td>
                                                    <td>{{ $book->nomreh }}</td>
                                                    <td>
                                                        #
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست کتاب خالی می باشد!
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
