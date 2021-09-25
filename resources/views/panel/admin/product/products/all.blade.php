@extends('panel.admin.master')
@section('page_title') محصولات@endsection
@section('content')

    <div class="page-content">
        <!-- Page-Title -->
        <div class="page-title-box">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h4 class="page-title mb-1"> محصولات</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"> محصول</li>
                        </ol>
                    </div>
                    <div class="col-md-8">
                        <div class="float-right d-md-block">
                            <a href="{{ route('admin.products.create') }}"
                               class="btn btn-light btn-rounded dropdown-toggle"><i class="dripicons-plus mr-1"></i>
                                <b>افزودن محصول جدید</b>
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
                                <h4 class="header-title">لیست محصولات</h4>
                                <p class="card-title-desc">
                                    @include('alert_messages.alerts')
                                </p>
                                @if($products->isNotEmpty())
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>عنوان </th>
                                                <th>کد محصول</th>
                                                <th>دسته بندی</th>
                                                <th>روش پرداخت</th>
                                                <th>وضعیت</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td><a href="{{ route('admin.products.show',$product) }}" class="btn btn-outline-info">{{ $product->product_name }}</a></td>
                                                    <td>{{ $product->product_code }}</td>
                                                    <td>{{ $product->productCategory->product_category_name }}</td>
                                                    <td>{{ $product->product_type_payment == 'free' ? 'رایگان'  : 'نقدی' }}</td>
                                                    <td>{{ $product->product_status == 1 ? 'فعال' : 'غیر فعال'}}</td>
                                                    <td>
                                                        <div class="btn btn-group-lg">
                                                            <form action="{{ route('admin.products.destroy',$product) }}" method="post">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="btn-group btn-group-xs">

                                                                    <a href="{{ route('admin.products.edit',$product) }}" class="btn btn-warning" title="ویرایش ">
                                                                        <i class="ti-pencil-alt"></i>
                                                                        <b>ویرایش</b>
                                                                    </a>
                                                                    @can('role-edit')
                                                                    <button onclick="return confirm('از حذف  محصول مطمئن هستید؟')" type="submit" class="btn btn-danger" title="حذف ">
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
                                    {{ $products->appends($_GET)->links() }}
                                @else
                                    <div class="">

                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <strong>توجه!</strong> لیست  محصول خالی می باشد!
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
