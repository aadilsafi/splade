    <section id="dashboard-ecommerce">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card card-congratulations">
                    <div class="card-body text-center">
                        <img
                            src="../../../lms/app-assets/images/elements/decore-left.png"
                            class="congratulations-img-left"
                            alt="card-img-left"
                        />
                        <img
                            src="../../../lms/app-assets/images/elements/decore-right.png"
                            class="congratulations-img-right"
                            alt="card-img-right"
                        />
                        <div class="avatar avatar-xl bg-primary shadow">
                            <div class="avatar-content">
                                <i data-feather="award" class="font-large-1"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h1 class="mb-1 text-white">Greetings {{\Illuminate\Support\Str::title(auth()->user()->username)}},</h1>
                            <p class="card-text m-auto w-75">
                                You can manage all LMS activities from this dashboard.
                            </p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$stats->total_users}}</h3>
                                    <span>{{__('lang.commons.total_users')}}</span>
                                </div>
                                <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                              <i data-feather="user" class="font-medium-4"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$stats->active_users}}</h3>
                                    <span>{{__('lang.commons.active_users')}}</span>
                                </div>
                                <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                              <i data-feather="user-check" class="font-medium-4"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$stats->total_courses}}</h3>
                                    <span>{{__('lang.commons.total_courses')}}</span>
                                </div>
                                <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                              <i data-feather="book-open" class="font-medium-4"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <h3 class="fw-bolder mb-75">{{$stats->total_topics}}</h3>
                                    <span>{{__('lang.commons.total_topics')}}</span>
                                </div>
                                <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                              <i data-feather="list" class="font-medium-4"></i>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row match-height">
            <div class="col-lg-8 col-12">
                <div class="card card-company-table">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Last Active / Register On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recently_added_users as $ra_user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar rounded m-1">
                                                        <div class="avatar-content">
                                                            <img src="{{$ra_user->profile->avatar}}" width="30" alt="Toolbar svg" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bolder">{{$ra_user->profile->full_name}}</div>
                                                        <div class="font-small-2 text-muted">{{$ra_user->email}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bolder mb-25">{{$ra_user->last_active_at}}</span>
                                                    <span class="font-small-2 text-muted">{{$ra_user->created_at}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('user.show', $ra_user->username)}}" class="btn">
                                                        <i data-feather="eye" class="text-danger font-medium-1"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                        <tr class="text-right">
                                            <td>...</td>
                                            <td>...</td>
                                            <td>
                                                <a href="{{route('user.index')}}">View All</a>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card card-transaction">
                    <div class="card-header">
                        <h4 class="card-title">Resources</h4>
                    </div>
                    <div class="card-body">
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-primary rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="book" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Quizzes</h6>
                                    <small>Overall System Quizzes</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-danger">{{$activities->quizzes}}</div>
                        </div>
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-success rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Contents</h6>
                                    <small>Overall System Content</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-success">{{$activities->wysiwygs}}</div>
                        </div>
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-danger rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="file" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">Files</h6>
                                    <small>Overall System Files</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-success">{{$activities->resources}}</div>
                        </div>
                        <div class="transaction-item">
                            <div class="d-flex">
                                <div class="avatar bg-light-warning rounded float-start">
                                    <div class="avatar-content">
                                        <i data-feather="archive" class="avatar-icon font-medium-3"></i>
                                    </div>
                                </div>
                                <div class="transaction-percentage">
                                    <h6 class="transaction-title">SCORM</h6>
                                    <small>SCORM Content</small>
                                </div>
                            </div>
                            <div class="fw-bolder text-danger">{{$activities->scorm}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
