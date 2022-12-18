@extends('lms.layout.master')
@section('content')

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
                <div class="card-header">{{ __('Edit Question Bank') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('question-banks.update',$questionBank->id)}}" method="post" >
                        @csrf
                        @method('PUT')
                        <div class="mb-1">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" value="{{$questionBank->name}}" placeholder="Enter Bank Name">
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="slug">Slug</label>
                            <input type="text" class="form-control  @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{$questionBank->slug}}" placeholder="Enter Bank Slug">
                        </div>
                        <hr>
                        <input type="submit" value="Update Question Bank" class="btn btn-gradient-primary">
                    </form>
                </div>
               
            </div>
        </div>
    </div>
    
</div>

<!-- Update Modal -->
<div class="modal fade" id="quiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Question Bank</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      
    </div>
  </div>
</div>


@endsection
