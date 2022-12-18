@extends('lms.layout.master')

@section('page-title', $user->username)

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection


@section('content')
<section class="app-user-view-account">
    <div class="row">
        <!-- User Sidebar -->
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
            <!-- User Card -->
            <div class="card">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mt-3 mb-2" src="{{$user->profile->avatar}}" height="110"
                                width="110" alt="User avatar" />
                            <div class="user-info text-center">
                                <h4>{{$user->profile->full_name}}</h4>
                                <span class="badge bg-light-secondary">Score: {{$user->profile->score}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around my-2 pt-75">
                        <div class="d-flex align-items-start me-2">
                            <span class="badge bg-light-primary p-75 rounded">
                                <i data-feather="check" class="font-medium-2"></i>
                            </span>
                            <div class="ms-75">
                                <h4 class="mb-0">{{count($user->courses)}}</h4>
                                <small>{{__('lang.fields.course.enrolled')}}</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-start">
                            <span class="badge bg-light-primary p-75 rounded">
                                <i data-feather="briefcase" class="font-medium-2"></i>
                            </span>
                            {{-- @dd($courses) --}}
                            <div class="ms-75">
                                <h4 class="mb-0">{{$user->topics}}</h4>
                                <small>{{__('lang.fields.topic.completed')}}</small>
                            </div>
                        </div>
                    </div>
                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                    <div class="info-container">
                        <ul class="list-unstyled">
                            <li class="mb-75 d-flex align-items-center justify-content-between">
                                <span class="fw-bolder me-25">{{__('lang.fields.user.username')}}:</span>
                                <span>{{$user->username}}</span>
                            </li>
                            <li class="mb-75 d-flex align-items-center justify-content-between">
                                <span class="fw-bolder me-25">{{__('lang.fields.user.email')}}:</span>
                                <span>{{$user->email}}</span>
                            </li>
                            @if($user->profile->secondary_email)
                            <li class="mb-75 d-flex align-items-center justify-content-between">
                                <span class="fw-bolder me-25">{{__('lang.fields.user.secondary_email')}}:</span>
                                <span>{{$user->profile->secondary_email}}</span>
                            </li>
                            @endif
                            @if($user->profile->contact_number)
                            <li class="mb-75 d-flex align-items-center justify-content-between">
                                <span class="fw-bolder me-25">{{__('lang.fields.user.contact_number')}}:</span>
                                <span>{{$user->profile->contact_number}}</span>
                            </li>
                            @endif
                            <li class="mb-75 d-flex align-items-center justify-content-between">
                                <span class="fw-bolder me-25">Status:</span>
                                <span class="badge bg-light-success">Active</span>
                            </li>
                        </ul>
                        @if(auth()->user()->isAdmin)
                            <div class="d-flex justify-content-center pt-2">
                                <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser"
                                    data-bs-toggle="modal">
                                    Edit
                                </a>
                                <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspended</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /User Card -->
        </div>
        <!--/ User Sidebar -->

        <!-- User Content -->
        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
            <!-- Activity Timeline -->
            <div class="card">
                <h4 class="card-header">Enrolled Courses</h4>
                <div class="card-body pt-1">
                    <ul class="timeline ms-50">
                        @php
                            $indicator_class = ['info','success','primary','secondary','warning','danger'];
                        @endphp
                        @foreach ($user->courses as $course)
                        @php
                            $selected_color = $indicator_class[rand(0,5)];
                        @endphp
                        <li class="timeline-item">
                            <span class="timeline-point timeline-point-{{$selected_color}} timeline-point-indicator"></span>
                            <div class="timeline-event">
                                <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
                                    <a href="{{route('category.course.show',['category'=>$course->category->slug,'course'=>$course->slug])}}">
                                        <h6>{{$course->title}}</h6>
                                    </a>
                                    <span class="timeline-event-time me-1">
                                         <div class="d-flex align-items-center">
                                            <small>{{round($course->user_course_progress,1)}}%</small>
                                            <div class="m-1 progress" style="width: 50px; height: 5px">
                                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{$selected_color}}" role="progressbar" style="width: {{$course->user_course_progress}}%"></div>
                                            </div>
                                        </div>
                                    </span>
                                </div>
                                @if(isset($course->user_last_topic))
                                    <a href="{{route('topic.activity.show',['topic'=>$course->user_last_topic->slug,'activity'=>$course->user_last_topic->user_last_activity->slug])}}">
                                        <p>{{$course->user_last_topic->user_last_activity->title}}</p>
                                    </a>
                                @else
                                    <small>You Haven't Start This Topic</small>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- /Activity Timeline -->
        </div>
        <!--/ User Content -->
    </div>
</section>
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{__('lang.fields.user.messages.edit_user_info')}}</h1>
                </div>
                <form id="editUserForm" class="row gy-1 pt-75" method="post"
                    action="{{route('user.update.profile', $user->username)}}">
                    @csrf
                    @method('PUT')
                    @include('lms.profile.partials.profile_fields', ['profile' => $user->profile])
                    <div class="col-12 text-center mt-2 pt-50">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Discard
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
