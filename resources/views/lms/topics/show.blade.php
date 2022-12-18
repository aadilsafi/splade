@extends('lms.layout.master')

@section('seo-breadcrumb')
{{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.create', $site_id) }} --}}
@endsection

@section('page-title', $topic->title)


@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0" title="{{$topic->title}}">{{\App\Utils\Helper::mask($topic->title)}}</h2>
            <div class="breadcrumb-wrapper">
                 {{ Breadcrumbs::render('topic.show', $course, $topic) }}
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
                <a class="dropdown-item" href="{{route('topic.activity.create',$topic->slug)}}">
                    <i class="me-1" data-feather="plus"></i>
                    <span class="align-middle">{{__('lang.commons.add')}}</span>
                </a>
                <a class="dropdown-item" href="{{route('course.topic.edit',[$course->slug, $topic->slug])}}">
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
    <section id="accordion-with-margin">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{__('lang.fields.activity.plural')}}</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                           <!-- Add Activity Description If Any --->
                        </p>
                        <div class="accordion accordion-margin" id="accordionMargin">
                            @foreach ($topic->activities as $key => $activity)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingMarginOne">
                                        <button
                                            class="accordion-button collapsed"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#activitySection{{$key}}"
                                            aria-expanded="false"
                                            aria-controls="activitySection{{$key}}"
                                        >
                                            {{$activity->title}}
                                        </button>
                                    </h2>
                                    <div
                                        id="activitySection{{$key}}"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="activitySection{{$key}}"
                                        data-bs-parent="#accordionMargin"
                                    >
                                        <div class="accordion-body">
                                            @if($activity->type->id != \App\Utils\Common\ActivityTypes::QUIZ || auth()->user()->isAdmin)
                                                <a class="float-end" href="{{ route('topic.activity.show',[$topic->slug, $activity->slug])}}">Go To Activity</a>
                                            @else
                                                <a class="float-end" href="{{route('lms.quiz.attempt.index',[$topic->slug,$activity->slug])}}">Attempt Quiz</a>
                                            @endif


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
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                   
                    <div class="card-footer d-flex align-items-center justify-content-end">
                        <a href="{{ route('category.course.show',[$course->category->slug, $course->slug])}}"
                           class="btn btn-relief-outline-danger waves-effect waves-float waves-light">
                            <i data-feather='x'></i>
                            {{ __('lang.commons.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
@endsection
