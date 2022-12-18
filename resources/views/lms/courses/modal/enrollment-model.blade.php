 <!-- Modal -->
 <form action="{{route('category.course.enroll',['category'=>$category->slug,'course' => $course->slug])}}" method="POST">
    @csrf
 <div class="modal fade" id="enroll_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('lang.fields.course.enroll')}} {{__('lang.fields.user.plural')}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <label class="form-label fs-5" for="user_id">{{__('lang.commons.select')}} {{__('lang.fields.user.plural')}}</label>
          <select name="user_ids[]" id="user_id" multiple class="select2 form-select">
            @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->profile? $user->profile->first_name : $user->username}}</option>
            @endforeach
          </select>

          <label class="form-label fs-5" for="user_id">{{__('lang.commons.select')}} {{__('lang.fields.course.enrollment_type')}}</label>
          <select name="enrollment_type" id="enrollment_type" class="select2 form-select">
            @foreach($enrollment_types as $key => $enrollment_type)
                <option value="{{$key}}">{{$enrollment_type}}</option>
            @endforeach
          </select>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">{{__('lang.fields.course.enroll')}} {{__('lang.fields.user.plural')}}</button>
        </div>
      </div>
    </div>
  </div>
</form>
