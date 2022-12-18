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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Edit Quiz') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{route('update-quiz',$quiz->id)}}" method="post">
                    	@method('PUT')
                        @csrf
                        <div class="form-group ">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Name" value="{{$quiz->name}}">
                            </div> <br>
                            <div class="col">
                                <input type="number" name="duration" class="form-control" placeholder="Duration in minutes"
                                value="{{$quiz->duration}}">
                            </div> <br>
                        </div>
                        <div class="form-group">
                            <label>Start Date</label>
                           <input type="date" name="start_date" class="form-control" value="{{$quiz->start_date}}">
                        </div> <br>
                        <div class="form-group">
                            <label>End Date</label>
                           <input type="date" name="end_date" class="form-control" value="{{$quiz->end_date}}">
                        </div> <br>
                        <div class="form-group row">
                            <div class="col">
                                <input type="number" name="total_marks" class="form-control" placeholder="Total Marks" value="{{$quiz->total_marks}}"> <br>
                                <input type="number" name="passing_marks" class="form-control" placeholder="Passing Marks" value="{{$quiz->passing_marks}}">

                            </div>
                        </div>
                        <hr>
                        <input type="submit" value="Update Quiz" class="btn btn-success float-end">
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
