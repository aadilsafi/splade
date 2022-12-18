@extends('lms.layout.master')

@section('seo-breadcrumb')
    {{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.edit', $site_id) }} --}}
@endsection

@section('page-title', 'Edit Type')

@section('page-vendor')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets') }}/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
    {{-- <link rel="stylesheet" type="text/css"
        href="{{ asset('public_assets/admin') }}/vendors/css/forms/select/select2.min.css">I --}}
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
                <h2 class="content-header-title float-start mb-0">{{__('lang.commons.edit')}} {{__('lang.fields.category.singular')}}</h2>
                <div class="breadcrumb-wrapper">
                    {{ Breadcrumbs::render('category.edit', $category) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <form action="{{ route('category.update', $category->id) }}" method="POST">

            <div class="card-header">
            </div>

            <div class="card-body">

                @csrf
                @method('PUT')

                @include('lms.categories.form-fields', ['categories' => $categories, 'category' => $category])

            </div>

            <div class="card-footer d-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-relief-outline-success waves-effect waves-float waves-light me-1">
                    <i data-feather='save'></i>
                    {{__('lang.commons.update')}} {{__('lang.fields.category.singular')}}
                </button>
                <a href="{{ route('category.index') }}"
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
    <script>
        function convertToSlug(text) {
            let slug = $('#slug');
            slug.val(text.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, ''));
            $('#slug').val(slug.val());
        }

        // $('#categoriestree').select2();
    </script>
@endsection
