<!-- Modal -->
<form action="{{route('category.course.disenroll',['category'=>$category->slug,'course' => $course->slug])}}"
  method="POST">
  @csrf
  <div class="modal fade" id="participants_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- list and filter start -->
        <div class="card">
          <div class="card-body border-bottom">
            <section id="basic-datatable">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <table class="table table-responsive">
                      <thead>
                        <tr>
                          <th><input type="checkbox" onchange="checkall()"></th>
                          <th>Avatar</th>
                          <th>User</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($enrolled_users as $user)
                        <tr>
                          <td>
                            <input type="checkbox" name="user_ids[]" value="{{$user->id}}" id="">
                          </td>
                          <td>
                            <div class="avatar me-50">
                              <img src="{{$user->profile->avatar}}" alt="Avatar" width="38" height="38">
                            </div>
                          </td>
                          <td>
                            {{$user->profile->full_name}}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                    <button class="btn btn-primary pull-right">Disenroll</button>
                </div>
              </div>
            </section>
          </div>
        </div>
        <!-- list and filter end -->
      </div>
    </div>
  </div>
</form>

<script>
  function checkall(){

   let chk =  $('input[type="checkbox"]').prop('checked');
   console.log(chk);
   if(chk){
    $("input[type='checkbox']").prop('checked',true);
  }else{
    $("input[type='checkbox']").prop('checked',false);
  }
  }
</script>