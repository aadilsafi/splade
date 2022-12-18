@extends('layouts.app')
@section('content')
<style>
	table{
		border: 2px solid black;
		width: 80%;
	}
</style>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('success'))
	<div class="alert alert-success">{{Session::get('success')}}</div>
@endif
<div class="row">
	<div class="col-2">
		<h2>Questions</h2>
	</div>
	<div class="col-4 offset-md-8">
		<a class="btn btn-info	" href="{{route('question.create')}}">Add new Question</a>
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#import">
		  Import Questions
		</button>

	</div>
</div>


{{-- <div>{!!$questions[1]->description!!} --}}
<table class="table table-striped table-hover">
	<thead>
		<th>id</th>
		<th>Question</th>
		<th>Category</th>
		<th>Difficulty Level</th>
		<th>Answer</th>
		<th>Actions</th>
	</thead>
	<tbody>
		@foreach($questions as $question)
		<tr>
			<td>{{$question->id}}</td>
			<td>{!!$question->description!!}</td>
			<td>{{App\Utils\Common\QuestionCategory::Types[$question->category_id]}}</td>
			<td>{{App\Utils\Common\DifficultyLevel::Types[$question->difficulty_level]}}</td>
			<td>{{$question->answers[0]->title ?? ''}}</td>
			<td>
				<a href="{{route('edit-question',$question->id)}}">Edit</a>
				<form action="{{route('delete-question',$question->id)}})" method="post">
					@csrf
					@method('DELETE')
					<input type="submit" value="Delete">
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('import-questions')}}" method="post" enctype="multipart/form-data">
        	@csrf
        	<input type="number" name="choicesForQuestion" class='form-control' placeholder="How much choices you want to attach with question"><br>
        	<input type="file" name="question_csv" class='form-control' title="Please Attached Files for Merged Question and Answers">
        	<input type="submit" class="btn btn-primary offset-md-1" value="Upload">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
{{-- Modal --}}
@endsection

@section('scripts');
<script>
    $('table').addClass('table table-striped table-hover');
</script>
@endsection
