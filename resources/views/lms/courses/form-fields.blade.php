<div class="mb-1">
    <label class="form-label" for="title">{{__('lang.fields.course.title')}}</label>
    <input type="text" class="form-control" id="title" name="title" value="{{isset($course)? $course->title : ''}}" placeholder="Enter title">
</div>

<div class="mb-1">
    <label class="form-label" for="course_code">{{__('lang.fields.course.course_code')}}</label>
    <input type="text" class="form-control" id="course_code" name="course_code" value="{{isset($course)?
        $course->course_code : ''}}" placeholder="Enter course code" />
</div>

<div class="mb-1">
    <label class="form-label" for="description">{{__('lang.fields.course.description')}}</label>
    <textarea class="form-control" id="description" rows="3" placeholder="Textarea"  name="description">{{isset($course)? $course->description : ''}}</textarea>
</div>

<div class="mb-1">
    <label class="form-label" for="slug">{{__('lang.fields.course.slug')}}</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{isset($course)? $course->slug : ''}}"
    placeholder="Enter slug" />
</div>


<div class="mb-1">
    <label class="form-label" for="author">{{__('lang.fields.course.author')}}</label>
    <input type="text" class="form-control" id="author" name="author" value="{{isset($course)? $course->author : ''}}"
    placeholder="Enter author" />
</div>
<div class="mb-1">
    <label for="coverimage" class="form-label">{{__('lang.fields.category.cover_image')}}</label>
    <input class="form-control" type="file" id="coverimage" name="cover_image"  onchange="image_upload(event)"/>
</div>
<input type="hidden" name="redirect_to_show" value="false" id="redirect_to_show">