@extends('panel.admin.master')
@section('page_title')افزودن گزینه سوالات@endsection
@section('content')

    @if($azmoon->azmoon_type == 'normal')
        @include('panel.admin.azmoonPoreshnamehs.create_normal')
    @elseif($azmoon->azmoon_type == 'advanced')
        @include('panel.admin.azmoonPoreshnamehs.create_advanced')
    @endif
@endsection
