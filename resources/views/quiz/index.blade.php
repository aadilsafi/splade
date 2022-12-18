@extends('layouts.app')
@section('content')
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
    <div class="alert alert-success alert-dismissible fade show col-10 offset-md-1" role="alert">
      {{Session::get('success')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Quiz') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#quiz">Add New Quiz</button> <br><br>
    
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Duration</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Total Marks</th>
                            <th>Passing Marks</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @if($quizzes)
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td>{{$quiz->id}}</td>
                                        <td>{{$quiz->name}}</td>
                                        <td>{{$quiz->duration}}</td>
                                        <td>{{$quiz->start_date}}</td>
                                        <td>{{$quiz->end_date}}</td>
                                        <td>{{$quiz->total_marks}}</td>
                                        <td>{{$quiz->passing_marks}}</td>
                                        <td>
                                            <a href="{{route('edit-quiz',$quiz->id)}}">Edit</a> |
                                            <form action="{{route('delete-quiz',$quiz->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete">
                                            </form>
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
    
</div>
<!-- Modal -->
<div class="modal fade" id="quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Quiz</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('make-quiz')}}" method="post">
            @csrf
            <div class="form-group ">
                <div class="col">
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div> <br>
                <div class="col">
                    <input type="number" name="duration" class="form-control" placeholder="Duration in minutes">
                </div> <br>
            </div>
            <div class="form-group">
                <label>Start Date</label>
               <input type="date" name="start_date" class="form-control">
            </div> <br>
            <div class="form-group">
                <label>End Date</label>
               <input type="date" name="end_date" class="form-control">
            </div> <br>
            <div class="form-group row">
                <div class="col">
                    <input type="number" name="total_marks" class="form-control" placeholder="Total Marks"> <br>
                    <input type="number" name="passing_marks" class="form-control" placeholder="Passing Marks">

                </div>
            </div>
            <hr>
            <input type="submit" value="Add Quiz" class="btn btn-success float-end">
        </form>
      </div>
      
    </div>
  </div>
</div>
@endsection
