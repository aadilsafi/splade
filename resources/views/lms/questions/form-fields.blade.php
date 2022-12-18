<div class="mb-1">
    <label class="form-label" for="name">{{__('lang.fields.question.name')}}</label>
    <input type="text" class="form-control" id="name" name="name"
           value="{{isset($question)? $question->name : old('name')}}" placeholder="Enter Question">
</div>

<div class="mb-1">
    <label class="form-label" for="difficulty_level_id">{{__('lang.fields.question.difficulty_level')}}</label>
    <select name="difficulty_level_id" id="difficulty_level_id" class="select2-size-lg form-select">
        @foreach ($difficultyLevels as $difficultyLevel)
            <option {{isset($question) && $difficultyLevel->id==$question->difficulty_level->id? 'selected' : ''}} value="{{$difficultyLevel->id}}">{{$difficultyLevel->name}}</option>
        @endforeach
    </select>
</div>
