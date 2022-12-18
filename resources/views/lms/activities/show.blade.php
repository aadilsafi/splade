@extends('lms.layout.master')

@section('seo-breadcrumb')
{{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.create', $site_id) }} --}}
@endsection

@section('page-title', $activity->title)

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0" title="{{$activity->title}}">
                {{\App\Utils\Helper::mask($activity->title)}}</h2>
            <div class="breadcrumb-wrapper">
                {{ Breadcrumbs::render('activity.show', $topic, $activity) }}
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->isAdmin)
<div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
    <div class="mb-1 breadcrumb-right">
        <div class="dropdown">
            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                data-bs-toggle="dropdown">
                <i data-feather="grid"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">
                    <i class="me-1" data-feather="plus"></i>
                    <span class="align-middle">{{__('lang.commons.add')}}</span>
                </a>
                <a class="dropdown-item" href="{{route('topic.activity.edit',[$topic->slug, $activity->slug])}}">
                    <i class="me-1" data-feather='edit-3'></i>
                    <span class="align-middle">{{__('lang.commons.edit')}}</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            @if($activity->type->id == \App\Utils\Common\ActivityTypes::RESOURCE)
            @include('lms.topics.partials.resource', ['content' => $activity->content])
            @elseif($activity->type->id == \App\Utils\Common\ActivityTypes::QUIZ)
            @include('lms.topics.partials.quiz', ['content' => $activity->content])
            @elseif($activity->type->id == \App\Utils\Common\ActivityTypes::SCORM)
            @include('lms.topics.partials.scorm', ['content' => $activity->content])
            @else
            @include('lms.topics.partials.wysiwyg', ['content' => $activity->content])
            @endif
        </div>
       
        <div class="card-footer d-flex align-items-center justify-content-end">
            <a href="{{ route('course.topic.show',[$topic->course->slug, $topic->slug])}}"
                class="btn btn-relief-outline-danger waves-effect waves-float waves-light mr-2">
                <i data-feather='x'></i>
                {{ __('lang.commons.cancel') }}
            </a>
        </div>
    </div>
</div>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
@endsection