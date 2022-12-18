@extends('lms.layout.master')
@section('page-title', __('lang.fields.user.plural'))

@section('page-vendor')
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="../../../lms/app-assets/vendors/css/file-uploaders/dropzone.min.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
@endsection

@section('content')
    <section class="app-user-list">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">21,459</h3>
                            <span>Total {{__('lang.fields.user.plural')}}</span>
                        </div>
                        <div class="avatar bg-light-primary p-50">
                            <span class="avatar-content">
                              <i data-feather="user" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">4,567</h3>
                            <span>{{__('lang.fields.trainer.plural')}}</span>
                        </div>
                        <div class="avatar bg-light-danger p-50">
                            <span class="avatar-content">
                              <i data-feather="user-plus" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">19,860</h3>
                            <span>{{__('lang.fields.trainee.plural')}}</span>
                        </div>
                        <div class="avatar bg-light-success p-50">
                            <span class="avatar-content">
                              <i data-feather="user-check" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h3 class="fw-bolder mb-75">237</h3>
                            <span>{{__('lang.fields.course.plural')}}</span>
                        </div>
                        <div class="avatar bg-light-warning p-50">
                            <span class="avatar-content">
                              <i data-feather="book-open" class="font-medium-4"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-4 offset-md-9 float-end">
                <a href="javascript:;" class="btn btn-relief-outline-success waves-effect waves-float waves-light" data-bs-target="#bulkUpload" data-bs-toggle="modal">
                    Bulk Upload
                </a>
                <a href="{{route('user.create')}}" class="btn btn-relief-outline-primary waves-effect waves-float waves-light">
                    Add
                </a>
            </div>
        </div>
        <!-- list and filter start -->
        <div class="card">
            <div class="card-body border-bottom">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Last Active</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="avatar me-50">
                                                        <img src="{{$user->profile->avatar}}" alt="Avatar" width="38" height="38">
                                                    </div>
                                                </td>
                                                <td>
                                                    {{$user->username}}
                                                </td>
                                                <td>
                                                    {{$user->profile->full_name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    {{$user->last_active_at}}
                                                </td>
                                                <td>
                                                    <a href="{{route('user.show', $user->username)}}" class="btn btn-success btn-sm"><i data-feather="eye"></i></a>
                                                    <a href="{{route('user.edit', $user->username)}}" class="btn btn-primary btn-sm"><i data-feather="edit"></i></a>
                                                    <a href="javascript:void(0);" onclick="deleteByID('{{route('user.destroy', $user->username)}}')" class="btn btn-danger btn-sm"><i data-feather="trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Modal to add new record -->
                    <div class="modal modal-slide-in fade" id="modals-slide-in">
                        <div class="modal-dialog sidebar-sm">
                            <form class="add-new-record modal-content pt-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title" id="exampleModalLabel">New Record</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
                                        <input
                                            type="text"
                                            class="form-control dt-full-name"
                                            id="basic-icon-default-fullname"
                                            placeholder="John Doe"
                                            aria-label="John Doe"
                                        />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-post">Post</label>
                                        <input
                                            type="text"
                                            id="basic-icon-default-post"
                                            class="form-control dt-post"
                                            placeholder="Web Developer"
                                            aria-label="Web Developer"
                                        />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-email">Email</label>
                                        <input
                                            type="text"
                                            id="basic-icon-default-email"
                                            class="form-control dt-email"
                                            placeholder="john.doe@example.com"
                                            aria-label="john.doe@example.com"
                                        />
                                        <small class="form-text"> You can use letters, numbers & periods </small>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="basic-icon-default-date">Joining Date</label>
                                        <input
                                            type="text"
                                            class="form-control dt-date"
                                            id="basic-icon-default-date"
                                            placeholder="MM/DD/YYYY"
                                            aria-label="MM/DD/YYYY"
                                        />
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label" for="basic-icon-default-salary">Salary</label>
                                        <input
                                            type="text"
                                            id="basic-icon-default-salary"
                                            class="form-control dt-salary"
                                            placeholder="$12000"
                                            aria-label="$12000"
                                        />
                                    </div>
                                    <button type="button" class="btn btn-primary data-submit me-1">Submit</button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- list and filter end -->
    </section>
    @include('lms.common.modals.bulk_upload',['modal_id'=>'bulkUpload', 'sample_file' => asset('samples/sample_file_for_bulk_user_upload.csv'), 'route' => route('user.bulk.upload')])
@endsection
@section('page-js')
    <script src="../../../lms/app-assets/vendors/js/file-uploaders/dropzone.min.js"></script>
{{--    <script src="../../../lms/app-assets/js/scripts/forms/form-file-uploader.min.js"></script>--}}
@endsection
