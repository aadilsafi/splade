@extends('lms.layout.master')

@section('seo-breadcrumb')
    {{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.create', $site_id) }} --}}
@endsection

@section('page-title', $topic->title)

@section('page-vendor')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">

@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{__('lang.commons.create')}} {{__('lang.fields.topic.singular')}}</h2>
                <div class="breadcrumb-wrapper">
                    {{-- {{ Breadcrumbs::render('sites.types.create', $site_id) }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <form class="form form-vertical" action="{{ route('course.topic.update',[$topic->course->slug,$topic->id])}}"
            method="POST">
            <div class="card-body">

                @csrf
                @method('PUT')
                @include('lms.topics.form-fields')
            </div>

            <div class="card-footer d-flex align-items-center justify-content-end">
                
                <button type="submit" class="btn btn-relief-outline-success waves-effect waves-float waves-light me-1">
                    <i data-feather='save'></i>
                    {{__('lang.commons.update')}} {{__('lang.fields.topic.singular')}}
                </button>
                <a href="{{ route('course.topic.index',$topic->course->slug) }}"
                    class="btn btn-relief-outline-danger waves-effect waves-float waves-light">
                    <i data-feather='x'></i>
                    {{ __('lang.commons.cancel') }}
                </a>
            </div>

        </form>
    </div>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')

@endsection
