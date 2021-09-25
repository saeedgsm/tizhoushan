@extends('panel.admin.master')
@section('page_title') آزمون ها@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-1">آزمون</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">لیست آزمون</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">لیست آزمون</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($azmoons->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-striped table-hover mx-auto ">
                                            <thead>
                                            <tr class="text-center">

                                                <th> نام </th>
                                                <th>نوع </th>
                                                <th>زمان شروع</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($azmoons as $azmoon)
                                                <tr>

                                                    <th scope="row">
                                                        <a href="{{ route('admin.azmoons.show',$azmoon) }}" class="btn btn-outline-info btn-sm" title="مشاهده جزئیات آزمون">
                                                            <i class="ti-eye"></i>
                                                            <b>{{ $azmoon->azmoon_title }}</b>
                                                        </a>
                                                    </th>
                                                    <td>{{ $azmoon->azmoon_type == 'normal' ? 'عادی' : 'پیشرفته'}}</td>
                                                    <td>{{ convertNumbers(new Verta($azmoon->azmoon_start)) }}</td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.azmoons.destroy',$azmoon) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group">

                                                                    @can('role-edit')
                                                                    <button onclick="return confirm('از حذف پایه مطمئن هستید؟')" type="submit" class="btn btn-danger  btn-sm" title="حذف ">
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
                                    {{ $azmoons->appends($_GET)->links() }}
                                @else
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <strong>توجه!</strong> لیست آزمون خالی می باشد!
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
