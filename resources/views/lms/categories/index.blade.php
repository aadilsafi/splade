@extends('lms.layout.master')

@section('seo-breadcrumb')
{{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.index', $site_id) }} --}}
@endsection

@section('page-title', isset($category)? $category->name : __('lang.fields.category.singular') . 'List')

@section('page-vendor')
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/plugins/forms/form-validation.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0">{{isset($category)? \App\Utils\Helper::mask($category->name) : __('lang.fields.category.plural')}}</h2>
            <div class="breadcrumb-wrapper">
                {{ isset($category)? Breadcrumbs::render('category.show',$category) : Breadcrumbs::render('category.index') }}
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->isAdmin)
    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
    <div class="mb-1 breadcrumb-right">
        <div class="dropdown">
            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i data-feather="grid"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="{{isset($category)? route('category.course.create',$category->slug): route('category.create')}}">
                    <i class="me-1" data-feather="plus"></i>
                    <span class="align-middle">{{__('lang.commons.add')}}</span>
                </a>
                @if(isset($category))
                    <a class="dropdown-item" href="{{route('category.edit',$category->slug)}}">
                        <i class="me-1" data-feather='edit-3'></i>
                        <span class="align-middle">{{__('lang.commons.edit')}}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h2>{{isset($category)? $category->name : __('lang.fields.category.plural')}}</h2>
                    </div>
                    <div class="card-body">
                        @if(isset($category))
                            <ul class="shadow p-1" style="list-style: none">
                                <li class="single-item" data-id="{{$category->id}}" data-name="{{$category->slug}}" data-parent="{{$category->parent_id}}">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="btn-group p-0 cursor-pointer">
                                                <i data-feather="arrow-down" onclick="move(this,'down',{{$category->position}},{{$category->id}},'{{route('categories.reorder')}}')"></i>
                                                <i data-feather="arrow-up" onclick="move(this,'up',{{$category->position}},{{$category->id}},'{{route('categories.reorder')}}')"></i>
                                            </div>
                                            <p style="font-variant: small-caps" class="text-truncate p-0 m-1">
                                                {{\Illuminate\Support\Str::title($category->name)}}
                                            </p>
                                        </div>
                                        <a class="float-end" href="javascript:void(0)" data-href="{{route('category.course.index',$category->slug)}}" onclick="getCourses(this)">
                                            <small title="Courses" class="text-muted">({{$category->courses()->count()}})</small>
                                            <i data-feather='eye'></i>
                                        </a>
                                    </div>
                                    @include('lms.categories.partials.get-subcategories', ['categories' => $category->subcategories])
                                </li>
                            </ul>
                        @else
                            @include('lms.categories.partials.get-subcategories', ['categories' => $categories])
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="card h-100">
                    <div class="card-header">
                        <h2>{{__('lang.fields.course.plural')}}</h2>
                        <div id="addCourse">
                            @if(isset($courses) && auth()->user()->isAdmin)
                                <a href="{{route('category.course.create', $category)}}" class="m-2 btn btn-relief-outline-danger waves-effect waves-float waves-light">
                                    {{ __('lang.commons.add') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="">
                            <ul class="" style="list-style: none" id="courseList">
                                @if(isset($courses))
                                    @foreach($courses as $course)
                                        <li class="single-item shadow mb-2" data-id="{{$course->id}}">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="btn-group p-0 cursor-pointer">
                                                        <strong class="btn btn-sm" onclick="move(this,'down',{{$course->position}},{{$course->id}},'{{route('courses.reorder')}}')"> &#8595;</strong>
                                                        <strong class="btn btn-sm" onclick="move(this,'up',{{$course->position}},{{$course->id}},'{{route('courses.reorder')}}')"> &#8593;</strong>
                                                    </div>
                                                    <div class="d-flex align-items-center ">
                                                        <a href="{{route('category.course.show', [$category->slug,$course->slug])}}">
                                                            <p style="font-variant: small-caps" class="text-truncate p-0 m-1">
                                                                {{$course->title}}
                                                            </p>
                                                        </a>
                                                        <a class="float-end" href="javascript:void(0)">
                                                            <i data-feather='users'></i>
                                                            <small title="Courses" class="text-muted">({{$course->users()->count()}})</small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li>
                                        <p class="text-muted text-center">{{__('lang.fields.category.messages.select_category_to_show_courses')}}</p>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')

@endsection

@section('page-js')
@endsection

@section('custom-js')
<script>
    function getCourses(ele) {
           let url = $(ele).data('href');
            $.ajax({
                url: url,
                method: "GET",
                success: (res) => {
                    $('#courseList').empty();

                    @if(auth()->user()->isAdmin)
                    $('#addCourse').html(`
                         <a href="${url}/create" class="m-2 btn btn-relief-outline-danger waves-effect waves-float waves-light">
                                {{ __('lang.commons.add') }}
                        </a>
                    `);
                    @endif

                    let items = ``;
                    let old_url = url;
                    res.forEach(course => {
                        let new_url = old_url + "/" + course.slug;
                        let reorder_url = "{{route('courses.reorder')}}";
                        items += `
                            <li class="single-item shadow mb-2" data-id="${course.id}">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div class="btn-group p-0 cursor-pointer">
                                            <strong class="btn btn-sm" onclick="move(this,'down',${course.position},${course.id},'${reorder_url}')"> &#8595;</strong>
                                            <strong class="btn btn-sm" onclick="move(this,'up',${course.position},${course.id},'${reorder_url}')"> &#8593;</strong>
                                        </div>
                                        <a href="${new_url}">
                                            <p style="font-variant: small-caps" class="text-truncate p-0 m-1">
                                                ${course.title}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        `;
                    });
                    if(items === ``){
                        items += `<p class="text-muted text-center">{{__('lang.fields.category.messages.no_courses_in_category')}}</p>`;
                        // items += `<img src="https://cdn.dribbble.com/users/844846/screenshots/2855815/no_image_to_show_.jpg" class="img-fluid" />`;
                    }

                    $('#courseList').html(items);
                }
            })
        }
    </script>
@endsection
