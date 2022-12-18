@extends('lms.layout.master')
@section('page-title', __('lang.fields.question-bank.singular') . 'List')

@section('page-vendor')
@endsection

@section('page-css')
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-11">
                <h2 class="content-header-title float-start mb-0">{{__('lang.fields.question-bank.plural')}}</h2>
                <div class="breadcrumb-wrapper">
                    {{Breadcrumbs::render('question-bank.index')}}
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
        <div class="mb-1 breadcrumb-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i data-feather="grid"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addQuestionBank">
                        <i class="me-1" data-feather="plus"></i>
                        <span class="align-middle">{{__('lang.commons.add')}}</span>
                    </a>
                    <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#bulkUpload">
                        <i class="me-1" data-feather="upload"></i>
                        <span class="align-middle">{{__('lang.commons.bulk-upload')}}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <section class="app-user-list">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Question Bank') }}</div>
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Total Questions</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            {{-- @dd($questionBanks) --}}
                            @if($questionBanks)
                                @foreach($questionBanks as $questionBank)
                                    <tr>
                                        <td>{{$questionBank->id}}</td>
                                        <td>{{$questionBank->name}}</td>
                                        <td>{{$questionBank->slug}}</td>
                                        <td>{{$questionBank->questions}}</td>

                                        <td>
                                            <a href="{{route('question-banks.show', $questionBank->slug)}}" class="btn btn-success btn-sm"><i data-feather="eye"></i></a>
                                            <a href="{{route('question-banks.edit', $questionBank->slug)}}" class="btn btn-primary btn-sm"><i data-feather="edit"></i></a>
                                            <a href="javascript:void(0);" onclick="deleteByID('{{route('question-banks.destroy', $questionBank->slug)}}')" class="btn btn-danger btn-sm"><i data-feather="trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">{{'No Data Found'}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('lms.common.modals.bulk_upload',[
                'modal_id'      =>'bulkUpload',
                'sample_file'   => asset('samples/sample_file_for_bulk_question_bank_upload.csv'),
                'route'         => route('question-banks.bulk.upload'),
    ])
    <!-- Add Modal -->
    <div class="modal fade" id="addQuestionBank" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Question Bank</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('question-banks.store')}}" method="post" >
                        @csrf
                        <div class="mb-1">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control" id="name" onkeyup="convertToSlug(this.value)" name="name" value="{{old('name')}}" placeholder="Enter Bank Name">
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="slug">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')}}" placeholder="Enter Bank Slug">
                        </div>
                        <hr>
                        <input type="submit" value="Add Question Bank" class="btn btn-gradient-primary">
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
