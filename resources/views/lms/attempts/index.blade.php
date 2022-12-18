{{-- @dd($quiz) --}}
@extends('lms.layout.master')

@section('seo-breadcrumb')
@endsection

@section('page-title', $quiz->name)


@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets') }}/css/plugins/forms/form-validation.css">
@endsection

@section('custom-css')
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-11">
            <h2 class="content-header-title float-start mb-0" title="{{$quiz->name}}">{{\App\Utils\Helper::mask($quiz->name)}}</h2>
            <div class="breadcrumb-wrapper">
                 {{-- {{ Breadcrumbs::render('topic.show', $course, $topic) }} --}}
            </div>
        </div>
    </div>
</div>

@endsection

@section('content')
<div class="container">
    <div class="card">
        <form action=""></form>
         <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h3>{{$quiz->name}}</h3>
                           
                            <ol>
                                @foreach($quiz->questions as $index => $question)
                                    <li class="m-1 p-1" id="{{$index}}">
                                        {{$question->name}}
                                            @foreach ($question->answers as $key => $answer)
                                            <p id="{{$key}}">
                                                <label for="{{$answer->id}}">
                                                    <input class="form-check-input" type="radio" name="answer_{{$question->id}}" id="{{$answer->id}}" value="{{$answer->id}}">
                                                    {{$answer->name}}
                                                </label>
                                            </p>
                                            @endforeach
                                    </li>
                                @endforeach
                            </ol>
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
@endsection
