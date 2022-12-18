@extends('lms.layout.master')
@section('page-title', __('lang.fields.question-bank.singular'))

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
                <h2 class="content-header-title float-start mb-0">{{$questionBank->name}}</h2>
                <div class="breadcrumb-wrapper">
                    {{Breadcrumbs::render('question-bank.show', $questionBank)}}
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
                    <a class="dropdown-item" href="{{route('question-banks.questions.create', $questionBank->slug)}}">
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
                    <div class="card-header">
                        <h2 class="card-title">{{$questionBank->name}}</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answers</th>
                                    <th>Difficulty Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($questionBank->questions as $question)
                                    <tr>
                                        <td>
                                            {{$question->name}}
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach($question->answers as $answer)
                                                    <li>{{$answer->name}} {!! $answer->is_correct == true? "<small>(CORRECT)</small>" : "" !!}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            {{$question->difficulty_level->name}}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('question-banks.questions.edit', [$questionBank->slug, $question->id])}}" class="btn btn-primary btn-sm"><i data-feather="edit"></i></a>
                                                <a href="javascript:void(0);" onclick="deleteByID('{{route('question-banks.questions.destroy', [$questionBank->slug, $question->id])}}')" class="btn btn-danger btn-sm"><i data-feather="trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('lms.common.modals.bulk_upload',[
            'modal_id'              =>  'bulkUpload',
            'sample_file'           => asset('samples/sample_file_for_bulk_questions_upload.csv'),
            'route'                 => route('questions.bulk.upload'),
            'hidden_fields'         => ['question_bank_id' => $questionBank->id, 'slug' => $questionBank->slug],
        ])
@endsection
