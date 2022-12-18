<div class="row mb-1">
    <div class="form-group col-6">
        <label class="form-label" for="title">{{__('lang.fields.topic.title')}}</label>
        <input type="text" class="form-control" id="title" name="title" onkeyup="convertToSlug(this.value);" value="{{isset($topic)? $topic->title : old('title')}}" placeholder=" {{__('lang.commons.enter')}} {{__('lang.fields.topic.title')}}">
    </div>
    <div class="form-group col-6">
        <label class="form-label" for="slug">{{__('lang.fields.topic.slug')}}</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{isset($topic)? $topic->slug : old('slug')}}" placeholder="{{__('lang.commons.enter')}} {{__('lang.fields.topic.slug')}}" />
    </div>
</div>
<div class="row">
    <div class="form-group">
        <label class="form-label" for="description">{{__('lang.fields.topic.description')}}</label>
        <textarea class="form-control" id="description" rows="3" placeholder=" {{__('lang.commons.enter')}} {{__('lang.fields.topic.description')}}"  name="description">{{isset($topic)? $topic->description : old('description')}}</textarea>
    </div>
</div>



