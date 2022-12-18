@extends('lms.layout.master')
@section('page-title', __('lang.fields.question.singular'))

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
                <h2 class="content-header-title float-start mb-0">{{isset($question)? $question->name : __('lang.commons.add')}}</h2>
                <div class="breadcrumb-wrapper">
                    {{isset($question)? Breadcrumbs::render('questions.edit', $questionBank, $question) : Breadcrumbs::render('questions.create', $questionBank)}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card">
        <form class="form form-vertical" action="{{ isset($question)? route('question-banks.questions.update',[$questionBank->slug, $question->id]) : route('question-banks.questions.store',$questionBank->slug)}}" method="POST">
            <div class="card-header">
            </div>
            <div class="card-body">
                @csrf
                @isset($question)
                    @method('PUT')
                @endisset
                @include('lms.questions.form-fields')
                <input type="hidden" name="question_bank_id" value="{{$questionBank->id}}">

                <div class="divider my-2">
                    <div class="divider-text">Answers</div>
                </div>

                <div class="card-body" id="answers_container">
                    @if(isset($question->answers))
                        @foreach($question->answers as $key => $answer)
                            <div class="row d-flex align-items-center single-answer p-2">
                                <div class="form-group col-1">
                                    <button type="button" onclick="deleteItem(this)"  class="btn btn-relief-outline-danger waves-effect waves-float waves-light">X</button>
                                </div>
                                <div class="form-group col">
                                    <input type="text" class="form-control" name="answers[]" value="{{$answer->name}}" placeholder="Enter Answer">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Is Correct? </label>
                                    <input type="radio" name="is_correct[]" {{$answer->is_correct? "checked" : ""}} value="{{$key}}" />
                                </div>
                            </div>
                    @endforeach
                @endif
                <!-- Add Dynamically -->
                </div>
            </div>

            <div class="card-footer d-flex align-items-center justify-content-end">
                <button type="button" onclick="addAnswer()" class="btn btn-relief-outline-primary waves-effect waves-float waves-light me-1">Add Answer</button>
                <button type="submit" class="btn btn-relief-outline-success waves-effect waves-float waves-light me-1">
                    <i data-feather='save'></i>
                    {{isset($question)? __('lang.commons.update') : __('lang.commons.save')}} {{__('lang.fields.question.singular')}}
                </button>
                <a href="{{ route('question-banks.show',$questionBank->slug)}}"
                   class="btn btn-relief-outline-danger waves-effect waves-float waves-light">
                    <i data-feather='x'></i>
                    {{ __('lang.commons.cancel') }}
                </a>
            </div>

        </form>
    </div>
@endsection

@section('page-js')
    <script>
        function addAnswer() {
            $('#answers_container').append(answerTemplate());
        }

        function answerTemplate() {
            let index = $(`#answers_container input[type="radio"]`).length;
            return `
             <div class="row single-answer d-flex align-items-center p-2">
                <div class="form-group col-1">
                    <button type="button" onclick="deleteItem(this)" class="btn btn-relief-outline-danger waves-effect waves-float waves-light">X</button>
                </div>
                <div class="form-group col">
                    <input type="text" class="form-control" name="answers[]" placeholder="Enter Answer">
                </div>
                <div class="form-group col-md-2">
                   <label>Is Correct?</label>
                   <input type="radio" name="is_correct[]" value="${index}" />
                </div>
             </div>
            `;
        }

        function deleteItem(ele) {
            $(ele).parents('.single-answer').remove();

            $(`#answers_container input[name="is_correct[]"]`).each((i, item)=>{
                $(item).val(i);
            });

        }
    </script>
@endsection
