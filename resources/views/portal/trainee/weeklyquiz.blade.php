@extends('portal.layout.master')
@section('content')
<div class="">
    <div class="bg-white rounded px-5 pt-5 pb-3">
        <h3>Weekly Quizzes</h3>
        <p>See which quiz is currently active and view your progress on previous quizzes!</p>
    </div>
    <div class="row mt-5">
        @foreach($quizzes as $key => $quiz)
        <div class="col-md-4 mb-4">
            <div class="quiz-card">
                <a href="{{route('my-attempt',$quiz->slug)}}" class="nav-link p-0">
                    <div class="bg-white rounded shadow p-5 text-center card-image {{$key % 2 == 0 ? 'card-red' : 'card-blue'}} ">
                        <h4>{{$quiz->name}}</h4>
                        <div class="status"></div><span>Passed</span>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
        gsap.from(".quiz-card", {
            duration: 0.3,
            scale: 0.1,
            y: 40,
            ease: "none",
            stagger: 0.1
        });
    });
</script>
@endsection