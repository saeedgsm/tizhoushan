@extends('panel.admin.master')
@section('page_title') دسته بندی محصولات@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1">دسته بندی محصولات</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active">دسته بندی محصول</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <a href="{{ route('admin.productCategories.create') }}"
                               class="btn btn-light btn-rounded dropdown-toggle"><i class="dripicons-plus mr-1"></i>
                                <b>افزودن دسته جدید</b>
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
                                <h4 class="header-title">لیست محصول</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($categories->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>عنوان </th>
                                                <th>لاتین</th>
                                                <th>سرگروه</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $category)
                                                <tr>
                                                    <td>{{ $category->product_category_name }}</td>
                                                    <td>{{ $category->product_category_latin }}</td>
                                                    <td>{{ $category->checkLevelProductCategory() }}</td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.productCategories.destroy',$category) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">

                                                                    <a href="{{ route('admin.productCategories.edit',$category) }}" class="btn btn-warning" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>ویرایش</b>
                                                                    </a>
                                                                    @can('role-edit')
                                                                    <button onclick="return confirm('از حذف دسته محصول مطمئن هستید؟')" type="submit" class="btn btn-danger" title="حذف ">
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
                                    {{ $categories->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست دسته بندی محصول خالی می باشد!
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
