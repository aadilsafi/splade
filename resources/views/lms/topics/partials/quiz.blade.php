<div class="container">
    <div class="row">
        <div class="col">
            <h3>{{$content->name}}</h3>
            
            <p class="demo-inline-spacing">
                <span class="badge bg-primary">Duration: {{\App\Utils\Helper::secondsToRealTime($content->duration)}}</span>
                <span class="badge bg-secondary">Total Marks: {{$content->total_marks}}</span>
                <span class="badge bg-warning">Passing Marks: {{$content->passing_marks}}</span>
                <span class="badge bg-success">Allowed Attempts: {{$content->allowed_attempts}}</span>
                <span class="badge bg-danger">Dates: {{$content->start_date}} ~ {{$content->end_date}}</span>
            </p>
            @if(auth()->user()->isAdmin)
            <ol>
                @foreach($content->questions as $question)
                    <li class="m-1 p-1">
                        {{$question->name?: "Not Set"}}
                        <ul>
                            @foreach($question->answers as $answer)
                                <li>{{$answer->name}}</li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ol>
            
            @endif
        </div>
    </div>
</div>
