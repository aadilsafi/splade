@extends('lms.layout.master')

@section('seo-breadcrumb')
{{-- {{ Breadcrumbs::view('breadcrumbs::json-ld', 'sites.types.create', $site_id) }} --}}
@endsection

@section('page-title', $course->title)

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0" title="{{$course->title}}">{{\App\Utils\Helper::mask($course->title)}}</h2>
            <h2 class="content-header-title float-start mb-0" title="{{$course->title}}">{{\App\Utils\Helper::mask($course->title)}}</h2>
            <div class="breadcrumb-wrapper">
                {{Breadcrumbs::render('course.show', $category, $course) }}
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
                <a class="dropdown-item" href="{{route('course.topic.create',$course->slug)}}">
                    <i class="me-1" data-feather="plus"></i>
                    <span class="align-middle">{{__('lang.commons.add')}}</span>
                </a>
                <a class="dropdown-item" href="{{route('category.course.edit',[$category->slug, $course->slug])}}">
                    <i class="me-1" data-feather='edit-3'></i>
                    <span class="align-middle">{{__('lang.commons.edit')}}</span>
                </a>
                <hr>
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#enroll_model">
                    <i class="me-1" data-feather='book-open'></i>
                    <span class="align-middle">{{__('lang.fields.course.enroll')}}</span>
                </a>
                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#participants_modal">
                    <i class="me-1" data-feather='book-open'></i>
                    <span class="align-middle">{{__('lang.fields.course.disenroll')}}</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@section('content')
    <section>
         <div class="row">
            <div class="col">
                <div class="card card-user-timeline">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i data-feather="book" class="user-timeline-title-icon"></i>
                            <h4 class="card-title">{{$course->title}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="timeline ms-50">
                            @php
                                $indicator_class = ['info','success','primary','secondary','warning','danger'];
                            @endphp
                            @foreach($course->topics as $topic)
                                @php
                                    $selected_color = $indicator_class[rand(0,5)];
                                @endphp
                                <li class="timeline-item single-item">
                                    <span class="timeline-point timeline-point-indicator timeline-point-{{$selected_color}}"></span>
                                    <div class="timeline-event">
                                        <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                            <h6><a href="{{route('course.topic.show', [$course->slug, $topic->slug])}}">{{$topic->title}}</a></h6>
                                            <span class="timeline-event-time me-1">
                                                <div class="btn-group cursor-pointer">
                                                    @if(auth()->user()->isAdmin)
                                                        <i data-feather="arrow-down" onclick="move(this,'down',{{$topic->position}},{{$topic->id}})"></i>
                                                        <i data-feather="arrow-up" onclick="move(this,'up',{{$topic->position}},{{$topic->id}})"></i>
                                                    @else
                                                        <div class="d-flex align-items-center">
                                                            <small>{{round($topic->user_topic_progress,1)}}%</small>
                                                            <div class="m-1 progress" style="width: 50px; height: 5px">
                                                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{$selected_color}}" role="progressbar" style="width: {{$topic->user_topic_progress}}%"></div>
                                                            </div>
                                                        </div>
                                                @endif
                                                </div>
                                            </span>
                                        </div>
                                        <p>{{$topic->description}}</p>
                                        @foreach($topic->activities as $activity)
                                            <div class="d-flex flex-row align-items-center justify-content-between mb-1 single-item">
                                                <div class="d-flex align-items-center">
                                                    @if($activity->type->id == \App\Utils\Common\ActivityTypes::RESOURCE)
                                                        <img class="me-1" src="{{asset('lms/app-assets/images/icons/doc.png')}}" alt="data.json" height="23" />
                                                    @elseif($activity->type->id == \App\Utils\Common\ActivityTypes::QUIZ)
                                                        <img class="me-1" src="{{asset('lms/app-assets/images/icons/speaker.svg')}}" alt="data.json" height="23" />
                                                    @else
                                                        <img class="me-1" src="{{asset('lms/app-assets/images/icons/book.svg')}}" alt="data.json" height="23" />
                                                    @endif
                                                    <h6 class="mb-0"><a href="{{route('topic.activity.show',[$topic->slug, $activity->slug])}}">{{$activity->title}}</a></h6>
                                                </div>
                                                <span class="timeline-event-time me-1">
                                                    <div class="btn-group cursor-pointer">
                                                        @if(auth()->user()->isAdmin)
                                                            <i data-feather="arrow-down" onclick="move(this,'down',{{$activity->position}},{{$activity->id}})"></i>
                                                            <i data-feather="arrow-up" onclick="move(this,'up',{{$activity->position}},{{$activity->id}})"></i>
                                                        @else
                                                            <i data-bs-toggle="tooltip" data-bs-placement="top" title="Activity {{$activity->marked_completed? 'Completed' : 'Incomplete'}}" data-feather="{{$activity->marked_completed? 'check-' : ''}}circle" class="text-{{$activity->marked_completed? 'success' : 'danger'}}" ></i>
                                                        @endif
                                                    </div>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-end">
                        <a href="{{ route('category.show',$course->category->slug) }}"
                           class="btn btn-relief-outline-danger waves-effect waves-float waves-light">
                            <i data-feather='x'></i>
                            {{ __('lang.commons.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @include('lms.courses.modal.enrollment-model')
        @include('lms.courses.modal.participants-model')

    </section>
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
            // $('#type_slug').val(slug.val());
        }

        // $('#categoriestree').select2();
</script>
@endsection
