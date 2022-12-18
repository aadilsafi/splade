@extends('lms.layout.master')
@section('seo-breadcrumb')
{{--    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}--}}
@endsection

@section('page-title', __('lang.commons.create').' '.__('lang.fields.course.singular'))

@section('page-vendor')
    <link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/vendors/css/charts/apexcharts.css">
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/pages/dashboard-ecommerce.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/plugins/charts/chart-apex.min.css">
@endsection

@section('custom-css')
<style>
    .align{
        text-align: right
    }
</style>
@endsection

@section('seo-breadcrumb')
{{--    {{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}--}}
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">{{__('lang.commons.add')}} {{ __('lang.commons.course') }} </h2>
            <div class="breadcrumb-wrapper">
                 {{ Breadcrumbs::render('course.create',$category) }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
   <section id="add-course">
               <div class="card p-3">
            <h4>{{ __('lang.commons.course') }} Info</h4>

            <div class="row match-height">
                <div class="col-xl-5 col-md-6 col-12">
                    <form id="course_create" method="post" action="{{route('category.course.store',$category->id)}}" enctype="multipart/form-data">
                        @csrf
                        @include('lms.courses.form-fields')
                    </form>
                </div>
                <div class="col-xl-7 col-md-6 col-12">
                    <img id="image_output" class="d-none" width="50%" height="50%"/>
                </div>
            </div>

        </div>
            <div class="float-right pb-4 align">
                <button type="button" class="btn btn-gradient-success" form="course_create" onclick="saveAndShow()">Save + show list</button>
                <button type="submit" class="btn btn-gradient-primary" form="course_create">Save + show this course</button>

            </div>
   </section>

@endsection
@section('custom-js')
<script>

    $('#title').on('keyup', function(event){
            let val = event.target.value;
            val = val.toLowerCase().replace(/\s\s+/g, ' ').replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(val);
        });
</script>
        <script>
            var image_upload = function(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image_output');
                output.classList.remove('d-none')
                output.classList.add('d-block')
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
            };
        </script>
@endsection

