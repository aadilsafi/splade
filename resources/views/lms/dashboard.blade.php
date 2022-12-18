@extends('lms.layout.master')
@section('page-title', 'Dashboard')

@section('page-vendor')
    <link rel="stylesheet" type="text/css" href="../../../lms/app-assets/css/pages/page-knowledge-base.min.css">
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection


@section('content')
    @if(auth()->user()->isAdmin)
        @include('lms.dashboards.admin')
    @else
        @include('lms.dashboards.user')
    @endif
@endsection
@section('custom-js')
    <script src="../../../lms/app-assets/js/scripts/pages/page-knowledge-base.min.js"></script>
{{--    <script src="../../../lms/app-assets/vendors/js/charts/apexcharts.min.js"></script>--}}
{{--    <script src="../../../lms/app-assets/js/scripts/pages/dashboard-ecommerce.min.js"></script>--}}
@endsection
