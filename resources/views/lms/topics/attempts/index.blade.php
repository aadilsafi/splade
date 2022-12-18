{{-- @dd($quiz->duration) --}}
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
        <form id="quiz-attempt-form" action="{{route('lms.quiz.attempt.store')}}" method='post'>
            @csrf
            
         <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">
                                <div id="timer" class="d-flex justify-content-end" style="font-size:40px;"></div>
                            {{-- <h3>{{$quiz->name}}</h3> --}}


                                <ol id="questions_div">
                                    @foreach($quiz->questions as $index => $question)
                                        <li class="m-1 p-1 " id="{{$index}}">
                                            {{$question->name}}
                                                @foreach ($question->answers as $key => $answer)
                                                <p id="{{$key}}" class="mt-1">
                                                    <label for="{{$answer->id}}">
                                                        <input class="form-check-input all-answer" type="radio" id="{{$answer->id}}" name="answer_id_{{$question->id}}" value="{{$answer->id}}">
                                                        {{$answer->name}}
                                                    </label>
                                                </p>
                                                @endforeach
                                        </li>
                                    @endforeach
                                </ol>
                                <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                                <input type="hidden" name="topic_id" value="{{$topic->id}}">
                                <input type="hidden" name="activity_id" value="{{$activity->id}}">
                        </div>
                    </div>
              </div>
              <div class="d-flex justify-content-end">
              <button type="button" onclick="formSubmit()" class="btn btn-relief-outline-primary waves-effect waves-float waves-light me-1">Submit Quiz</button>
              </div>
          </div>
        </form>
    </div>
</div>
@endsection

@section('vendor-js')
@endsection

@section('page-js')
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
            let quiz = @json($quiz);
            let display = document.querySelector('#timer');
          
           startTimer(quiz.duration, display);
       });

       function startTimer(duration, display) {

           var timer = duration,
               minutes, seconds;

           // alert(minut);
           let myTimer = setInterval(function() {
               minutes = parseInt(timer / 60, 10);
               seconds = parseInt(timer % 60, 10);

               minutes = minutes < 10 ? "0" + minutes : minutes;
               seconds = seconds < 10 ? "0" + seconds : seconds;

               display.textContent = minutes + ":" + seconds;

               if (timer == 0) {
                   clearInterval(myTimer)

               } else {
                   timer--;
               }
           }, 1000);
}

function formSubmit(){
                let form = $('#quiz-attempt-form');
                let answer_ids = [];
                let allAnswers = document.querySelectorAll('.all-answer:checked');
                console.log('bingoo')
                allAnswers.forEach((answer)=>{
                    answer_ids.push(answer.value)
                    console.log(answer.value);
                });
                console.log('-------------------');
                console.log('answer ids',answer_ids,'count of ids',answer_ids.length);
                answer_ids.forEach((id)=>{
                    let answerContent = `<input type='hidden' value='${id}' name='answer_ids[]'>`;
                    form.append(answerContent);
                    console.log(answerContent);
                    answerContent = null;
                });
                answer_ids = [];
              
                // $('#answer_idss').append(answers)
                form.submit();
                
    }

   
</script>
@endsection