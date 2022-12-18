@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Attempt') }}
                	<div class="float-end">
                		<div id="clockdiv">
                		  <span>Timing</span>

                		  <div>
                		    <span class="minutes"></span> :
                		    <span class="seconds"></span>
                		  </div>
                		</div>
                	</div>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form id="quiz-form">
                	@csrf
    			<div id="questions"></div>
    			<div id="answers"></div>
    			<div class="float-end">
    				<button type="button" class="btn btn-warning" onclick="previousQuestion()">Back</button>
    				<button type="submit" class="btn btn-info" onclick="">Next</button>
    			</div>
	    		</form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script>
	let counter = -1;
	let attempts = @json($attempts);
	let duration = "{{$quiz->duration}}";
	let correct_answer = null;
	let attempt_id = null;
	$(document).ready(function(){
		nextQuestion();
	});
	$('#quiz-form').on('submit', function(e) {

	  e.preventDefault();
	  $('#quiz-form .answer_radio').each((i,el) => {
	  
	  	if($(el).is(":checked"))
	  	{	

	  		attempt_id = $(el).data('attempt_id');
	  		correct_answer = parseInt($(el).val());

	  	}

	  	
	  });
	  axios.put('/update-attempt/'+attempt_id,{'answer':correct_answer})
	  .then(res=>{
	  		console.log(res);	
	  })
	  .catch(err=>{console.log(err)});

	  console.log(correct_answer);
	  nextQuestion();
	  
	 

	});
	function nextQuestion()
	{
		// $('#quiz-form').preventDefault();
		//call axios
		if(attempts.length != 0){
			counter++;
			if(counter > attempts.length - 1){
				counter = attempts.length - 1
			}
		  createQuestion();
		  console.log({attempt_id,correct_answer});
		  correct_answer=0;
		}
		
	}


	function previousQuestion()
	{
		if(attempts.length != 0){
			counter--;
			if(counter < 0 || counter > attempts.length - 1){
				counter = 0
			}
			console.log({attempt_id,correct_answer});
			createQuestion();
		}
	}

	function createQuestion(){
		$('#questions').empty();
		$('#answers').empty();

		let attempt  = attempts[counter];
		let question = attempt.question;
		let answers  = attempt.answers;
		attempt_id = attempt.attempt_id;

		$('#questions').append(`<h4>${question}</h4>`);

		let answer_template = ``;

		answers.forEach((answer, index) => {
			answer_template += `<div class="form-check">
	    					      <input class="form-check-input answer_radio" type="radio" name="answer" id="answer_${index}" value='${answer.id}' data-attempt_id='${attempt.attempt_id}'>
	    					  <label class="form-check-label" for="answer_${index}">
	    					    ${answer.title}
	    					  </label>
	    					</div>`;
		});

		$('#answers').append(answer_template);

	}

	function getTimeRemaining(endtime) 
	{
	  const total = Date.parse(endtime) - Date.parse(new Date());
	  const seconds = Math.floor((total / 1000) % 60);
	  const minutes = Math.floor((total / 1000 / 60) % 60);
	  
	  return {
	    total,
	    minutes,
	    seconds
	  };
	}

	function initializeClock(id, endtime) {
	  const clock = document.getElementById(id);
	  const minutesSpan = clock.querySelector('.minutes');
	  const secondsSpan = clock.querySelector('.seconds');

	  function updateClock() {
	    const t = getTimeRemaining(endtime);

	    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
	    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

	    if (t.total <= 0) {
	      clearInterval(timeinterval);
	    }
	  }

	  updateClock();
	  const timeinterval = setInterval(updateClock, 1000);
	}

	const deadline = new Date(Date.parse(new Date()) +  duration * 60 * 1000);
	initializeClock('clockdiv', deadline);
</script>
@endsection