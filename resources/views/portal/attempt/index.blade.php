{{-- @extends('lms.layout.master')
@section('seo-breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}
@endsection

@section('page-title', 'Dashboard')

@section('page-vendor')
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/vendors/css/charts/apexcharts.css">
@endsection

@section('page-css')
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/pages/dashboard-ecommerce.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('lms/app-assets') }}/css/plugins/charts/chart-apex.min.css">
@endsection

@section('custom-css')
@endsection

@section('seo-breadcrumb')
{{ Breadcrumbs::view('breadcrumbs::json-ld', 'home') }}
@endsection

@section('breadcrumbs')
<div class="content-header-left col-md-9 col-12 mb-2">
    <div class="row breadcrumbs-top">
        <div class="col-12">
            <h2 class="content-header-title float-start mb-0">Add {{ __('lang.commons.attempt') }}
            </h2>
            <div class="breadcrumb-wrapper">
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h4 class="alert-heading"><i data-feather="info" class="me-50"></i>Information!</h4>
    <div class="alert-body">
        Hello
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<div class="container mt-5">
    <div class="d-flex justify-content-center row">
        <div class="col-md-10 col-lg-10">
            <div class="border">
                <div class="question bg-white p-3 border-bottom">
                    <div class="d-flex flex-row justify-content-between align-items-center mcq">
                        <h4>MCQ Quiz</h4>
                        <span>
                            <div id="timer" style="font-size:40px;"></div>

                        </span>
                    </div>
                </div>
                <div class="bg-white p-3 border-bottom">
                    <div class="d-flex flex-row align-items-center">
                        <h3 class="text-danger">Q.</h3>
                        <h5 class="mt-1 ml-2" id="questionTitle"></h5>

                    </div>
                    <div id="question"></div>

                </div>

                <button onclick="nextQuestion()" class="btn btn-primary border-success align-items-center btn-success" type="button">Next<i class="fa fa-angle-right ml-2"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
<style>
    label.radio {
        cursor: pointer;
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none;
    }

    label.radio span {
        padding: 4px 19px;
        border: 1px solid red;
        display: inline-block;
        color: black;
        width: 400px;
        border-radius: 3px;
        margin-top: 7px;
    }

    label.radio input:checked+span {

        background-color: rgb(115, 103, 240);
        border: none;
        color: #fff;
    }

    .ans {
        margin-left: 36px !important;
    }

    .btn:focus {
        outline: 0 !important;
        box-shadow: none !important;
    }

    .btn:active {
        outline: 0 !important;
        box-shadow: none !important;
    }
</style>
@endsection
@section('custom-js')
<script>
    var defaultIndex = 0;
    let attempts = @json($attempts);
    let quizLength = attempts.questions.length;

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
    $(document).ready(function() {
        //showing timer start
        display = document.querySelector('#timer');
        startTimer(attempts.quiz.duration, display);
        //showing timer end

        nextQuestion(0);
    });


    //
    function nextQuestion() {
        var index = defaultIndex;
        let request = {};
        let answer_id = $('#answer_id:checked').val();

        if (index < quizLength) {
            var selectedQuestion = attempts.questions[index].question;

            let questionTitle = $('#questionTitle');
            questionTitle.empty()

            questionTitle.append(selectedQuestion.name);
            let contentBody = $('#question');
            contentBody.empty()
            selectedQuestion.answers.forEach((item) => {
                let answer = `<div class="answer ml-2">
                                <label class="radio">
                                    <input type="radio" name="answer_id" value="${item.id}" id='answer_id'>
                                    <span>${item.name}</span>
                                </label>
                            </div>`;

                contentBody.append(answer)
            });
        }
        if (index != 0) {
            request = {
                'answer_id': answer_id,
                'quiz_id': attempts.quiz.id,
                'question_id': attempts.questions[index - 1].question.id
            };
            sendAttempt(request);
        }
        defaultIndex++;

    }

    function sendAttempt(request) {
        $.ajax({
            url: "/quiz-attempt",
            type: "post",
            data: request,
            success: function(response) {
                console.log(response.remaining_time)
                startTimer(response.remaining_time, display);
            },
            fail: function(error) {
                console.log(error);
            }
        });
    }
</script>
@endsection

@section('custom-css')

@endsection --}}

@extends('portal.layout.master')
@section('custom-css')
<style>
    .answers form {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
    }

    .answers label {
        display: flex;
        cursor: pointer;
        font-weight: 500;
        position: relative;
        overflow: hidden;
        margin-bottom: 0.375em;
        /* Accessible outline */
        /* Remove comment to use */
        /*
        &:focus-within {
                outline: .125em solid $primary-color;
        }
    */
    }

    .answers label input {
        position: absolute;
        left: -9999px;
    }

    .answers label input:checked+span {
        background-color: #d6d6e5;
    }

    .answers label input:checked+span:before {
        box-shadow: inset 0 0 0 0.4375em rgb(44, 47, 137);
    }

    .answers label span {
        display: flex;
        align-items: center;
        padding: 0.375em 0.75em 0.375em 0.375em;
        border-radius: 99em;
        transition: 0.25s ease;
    }

    .answers label span:hover {
        background-color: #d6d6e5;
    }

    .answers label span:before {
        display: flex;
        flex-shrink: 0;
        content: "";
        background-color: #fff;
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
        margin-right: 0.375em;
        transition: 0.25s ease;
        box-shadow: inset 0 0 0 0.125em rgb(44, 47, 137);
    }

    #questions {
        width: 100%;
        /* overflow: hidden; */
        display: flex;
        /* flex-wrap: wrap; */
    }

    .question {
        /* width: 95%; */
        margin-left: auto;
        margin-right: auto;
    }

    .buttons {
        width: 95%;
        display: flex;
        margin-left: auto;
        margin-right: auto;
        justify-content: end;
    }

    .carousel-inner {
        overflow: visible !important;
    }
</style>
@endsection

@section('content')
@if(Session::has('message'))
    <div class="alert alert-success">{{Session::get('message')}}</div>
    @endif

    <div>


    <div id="questions-holder">
        <div id="questions" data-interval="false" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @if(count($attempts) > 0)
                @foreach($attempts['questions'] as $key => $question)
                <div class="carousel-item {{$key == 0 ? 'active' : '' }}" id={{$key}}>
                    <div class="bg-white rounded p-5 question">
                        <h5>
                            {{$question->question['name']}}
                        </h5>
                        <div class="answers mt-4">
                            <form>

                                @foreach($question->question['answers'] as $answer)

                                <label class="radio">
                                    <input type="radio" name="{{'question_'.$key}}" id="{{'question_'.$key}}" value="{{$answer['id']}}" />
                                    <span>{{$answer['name']}}</span>
                                </label>

                                @endforeach



                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6">
                <span>
                    <div id="timer" style="font-size:40px;"></div>
                </span>
            </div>
            <div class="col-md-6 text-right">
                <div class="buttons mt-4">
                    <button id="submit" class="btn btn-primary d-none" onclick="submitQuestions()">
                        Submit
                    </button>
                    <button id="right" class="btn btn-primary" onclick="next()">
                        Next
                    </button>
                </div>
            </div>
        </div>
        @endif


        <!-- <div id="questions-holder border-radius">

                <div id="questions" class="carousel slide" data-interval="false" data-ride="carousel">
                    <div class="carousel-inner ">
                      



                    </div>
                </div>
                <div class="buttons mt-4">
                    <button id="submit" class="btn btn-primary d-none" onclick="submitQuestions()">Submit</button>
                    <button id="right" class="btn btn-primary" type="button" onclick="nextQuestion()">Next</button>

                </div>
            </div> -->

       




    </div>
    <div id="done" class="bg-white rounded p-5 d-none">
            <div id="loader">
                <img class="mx-auto d-block" src="images/loader.gif">
            </div>
            <div id="results" class="text-center">
                <canvas id="my-canvas"></canvas>
                <h4>
            Congratulations! <br>
                   Oops!
                </h4>
                <p>You {passed/failed} this week's quiz!</p>

                <!-- <div class="mt-5">
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <img src="images/Frame 1.png" class="img-fluid">
                    </div>
                    <div class="col-md-3 mb-4">
                        <img src="images/Frame 2.png" class="img-fluid">
                    </div>
                    <div class="col-md-3 mb-4">
                        <img src="images/Frame 3.png" class="img-fluid">
                    </div>
                    <div class="col-md-3 mb-4">
                        <img src="images/Frame 4.png" class="img-fluid">
                    </div>
                </div>
            </div> -->
            </div>
        </div>


    
    @endsection
    @section('custom-js')

    <script>
        var attempts = @json($attempts);
        let quizLength = attempts.questions.length;

        let lastIndex = quizLength - 1;

        $(".carousel")
            .carousel({
                wrap: false,
            })
            .on("slide.bs.carousel", function() {
                let curSlide = $(".carousel-item.active")
                gsap.to(curSlide, {
                    opacity: 0,
                    scale: 0,
                    duration: 1,
                    ease: 'ease'
                })
            })
            .on("slid.bs.carousel", function() {
                let curSlide = $(".carousel-item.active");
                gsap.fromTo(curSlide, {
                    scale: 5,
                    duration: 0.1,
                    ease: 'ease'
                }, {
                    scale: 1
                })
                if (curSlide.is(":last-child")) {
                    $("#right").text('Submit');
                    // $("#submit").removeClass("d-none");
                    return;
                }


            });

        function next() {
            let curSlide = $(".carousel-item.active");
           
            let questionIndex = $(curSlide).attr('id')
            let answer_id = $(`input[name='question_${questionIndex}']:checked`).val();
            let attempts = @json($attempts);

            let request = {
                'answer_id': answer_id,
                'quiz_id': attempts.quiz.id,
                'question_id': attempts.questions[questionIndex].question.id
            };
            console.log(request);
            sendAttempt(request);
            if (curSlide.is(":last-child")) {
                submitQuestions()
                return;
            }
            $(".carousel").carousel("next");
        }

        function submitQuestions() {
            $("#questions-holder").hide();
            $("#done").removeClass("d-none");
            $("#results").hide();
            setTimeout(function() {
                showResults();
            }, 1000);
        }
        var confettiElement = document.getElementById("my-canvas");
        var confettiSettings = {
            target: confettiElement,
        };
        var confetti = new ConfettiGenerator(confettiSettings);

        function showResults() {
            $("#loader").hide();
            $("#results").show();
            renderConfetti();
            setTimeout(function() {
                stopConfetti();
            }, 5000);
        }

        function renderConfetti() {
            var confettiElement = document.getElementById("my-canvas");
            var confettiSettings = {
                target: confettiElement,
            };
            var confetti = new ConfettiGenerator(confettiSettings);
            confetti.render();
            setTimeout(function() {
                confetti.clear();
            }, 3000);
        }

        function stopConfetti() {
            confetti.clear();
        }

        //my code
        var defaultIndex = 0;
        var attempts = @json($attempts);
        // let quizLength = attempts.questions.length;

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
        $(document).ready(function() {
            //showing timer start
            display = document.querySelector('#timer');
            startTimer(attempts.quiz.duration, display);
            //showing timer end

            // nextQuestion(0);
        });

        //
        function nextQuestion() {
            var index = defaultIndex;
            let request = {};
            let answer_id = $('#answer_id:checked').val();

            if (index < quizLength) {
                var selectedQuestion = attempts.questions[index].question;

                let questionTitle = $('#questionTitle');
                questionTitle.empty()

                questionTitle.append(selectedQuestion.name);
                let contentBody = $('#question');
                contentBody.empty()
                selectedQuestion.answers.forEach((item) => {
                    let answer = `<div class="answer ml-2">
                                <label class="radio">
                                    <input type="radio" name="answer_id" value="${item.id}" id='answer_id'>
                                    <span>${item.name}</span>
                                </label>
                            </div>`;

                    contentBody.append(answer)
                });
            }
            if (index != 0) {
                request = {
                    'answer_id': answer_id,
                    'quiz_id': attempts.quiz.id,
                    'question_id': attempts.questions[index - 1].question.id
                };
                sendAttempt(request);
            }
            defaultIndex++;

        }

        function sendAttempt(request) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });

            $.ajax({
                url: "/quiz-attempt",
                type: "post",
                data: request,
                success: function(response) {
                    console.log(response.remaining_time)
                    startTimer(response.remaining_time, display);
                },
                fail: function(error) {
                    console.log(error);
                }
            });
        }
    </script>


    @endsection