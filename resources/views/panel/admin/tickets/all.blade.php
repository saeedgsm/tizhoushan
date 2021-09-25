@extends('panel.admin.master')
@section('page_title')  تیکت ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1"> تیکت ها</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"> تیکت</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <a href="{{ route('admin.tickets.create') }}"
                               class="btn btn-light btn-rounded dropdown-toggle"><i class="dripicons-plus mr-1"></i>
                                <b>افزودن تیکت جدید</b>
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
                                <h4 class="header-title">لیست تیکت</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($tickets->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>موضوع </th>
                                                <th>دسته </th>
                                                <th>کاربر </th>
                                                <th>اولویت </th>
                                                <th>وضعیت </th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tickets as $ticket)
                                                <tr>
                                                    <td>{{ $ticket->title }}</td>
                                                    <td>{{ $ticket->category->ticket_category_name }}</td>
                                                    <td>{{ $ticket->user->first_name }} {{ $ticket->user->last_name }}</td>
                                                    <td>{{ $ticket->priority }}</td>
                                                    <td>{{ $ticket->status }}</td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="#" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">

                                                                    @can('role-edit')
                                                                    <button onclick="return confirm('از حذف تیکت مطمئن هستید؟')" type="submit" class="btn btn-danger" title="حذف ">
                                                                        <i class="ti-trash"></i>
                                                                        <b>حذف</b>
                                                                    </button>
                                                                    @endcan
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $tickets->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست تیکت خالی می باشد!
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
