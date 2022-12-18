@extends('layouts.app')
@section('content')
<div class="col">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif
    <table class="table table-hover table-striped table-bordered">
        <thead class="table-active">
          <tr>
            <th scope="col">#</th>
            <th scope="col">#</th>
            <th scope="col">Question</th>
            <th scope="col">Cateogry</th>
            <th scope="col">Bank</th>
            <th scope="col" colspan="4">Answers</th>
          </tr>
        </thead>
        <tbody>
           @foreach($imported_questions as $question) 
          <tr>
            <th></th>
            <th>{{$question->id}}</th>
            <td width='300px'>{{$question->name}}</td>
            <td>{{$question->category->name}}</td>
            <td>{{$question->bank->name}}</td>
            @foreach (explode(',',$question->answers) as $key => $item)
                <td class='d-block text-white @if($key==0) bg-success @else bg-danger @endif'>{{$item}}</td>
            @endforeach
           

          </tr>
          @endforeach
         
        </tbody>
      </table>
</div>
@endsection
