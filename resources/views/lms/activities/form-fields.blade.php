<div class="mb-1">
    <label class="form-label" for="title">{{__('lang.fields.activity.title')}}</label>
    <input type="text" class="form-control" id="title" name="title"
        value="{{isset($activity)? $activity->title : old('title')}}" placeholder="Enter title" onkeyup="convertToSlug(this.value)">
</div>
{{-- @dd(old('type')) --}}
<div class="mb-1">
    <label class="form-label" for="type">{{__('lang.fields.activity.type')}}</label>
    <select name="type" id="type" class="select2-size-lg form-select">
        @foreach ($activity_types as $key => $type)
        <option {{isset($activity) && $key==$activity->type->id? 'selected' : (old('type') == $key? 'selected' : '')}} value="{{$key}}">{{$type}}</option>
        @endforeach
    </select>
</div>

<div class="mb-1">
    <label class="form-label" for="slug">{{__('lang.fields.activity.slug')}}</label>
    <input type="text" class="form-control" id="slug" name="slug"
        value="{{isset($activity)? $activity->slug : old('slug')}}" placeholder="Enter slug" />
</div>