
    <!-- Statistics Card -->
    <div class="col-xl-12 col-md-12 col-12">
        <div class="card card-statistics">
          <div class="card-header">
            <h4 class="card-title">Statistics</h4>
            <div class="d-flex align-items-center">
              <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
            </div>
          </div>
          <div class="card-body statistics-body">
            <div class="row">
              <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                <div class="d-flex flex-row">
                  <div class="avatar bg-light-primary me-2">
                    <div class="avatar-content">
                      <i data-feather="trending-up" class="avatar-icon"></i>
                    </div>
                  </div>
                  <div class="my-auto">
                    <h4 class="fw-bolder mb-0">230k</h4>
                    <p class="card-text font-small-3 mb-0">Enrolled in Course</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                <div class="d-flex flex-row">
                  <div class="avatar bg-light-info me-2">
                    <div class="avatar-content">
                      <i data-feather="user" class="avatar-icon"></i>
                    </div>
                  </div>
                  <div class="my-auto">
                    <h4 class="fw-bolder mb-0">8.549k</h4>
                    <p class="card-text font-small-3 mb-0">Quiz Attempted</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                <div class="d-flex flex-row">
                  <div class="avatar bg-light-danger me-2">
                    <div class="avatar-content">
                      <i data-feather="box" class="avatar-icon"></i>
                    </div>
                  </div>
                  <div class="my-auto">
                    <h4 class="fw-bolder mb-0">1.423k</h4>
                    <p class="card-text font-small-3 mb-0">Remaining Quiz</p>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 col-12">
                <div class="d-flex flex-row">
                  <div class="avatar bg-light-success me-2">
                    <div class="avatar-content">
                      <i data-feather="dollar-sign" class="avatar-icon"></i>
                    </div>
                  </div>
                  <div class="my-auto">
                    <h4 class="fw-bolder mb-0">$9745</h4>
                    <p class="card-text font-small-3 mb-0">Total Score</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Statistics Card -->
<!-- Knowledge base Jumbotron -->
<section id="knowledge-base-search">
    <div class="row">
        <div class="col-12">
            <div class="card knowledge-base-bg text-center"
                 style="background-image: url('../../../lms/app-assets/images/banner/banner.png')">
                <div class="card-body">
                    <h2 class="text-primary">Let's Learn Together!</h2>
                    <p class="card-text mb-2">
                        <span>Searches: </span>
                        <span class="fw-bolder">enrolled courses</span>
                    </p>
                    <form class="kb-search-input">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i data-feather="search"></i></span>
                            <input type="text" class="form-control" id="searchbar" placeholder="Ask a question..."/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Knowledge base Jumbotron -->
<!-- Knowledge base -->
<section id="knowledge-base-content">
    <div class="row kb-search-content-info match-height">
        <!-- sales card -->
        @forelse($courses as $course)
            <div class="col-md-4 col-sm-6 col-12 kb-search-content">
                <div class="card">
                    <a href="{{route('category.course.show', [$course->category->slug, $course->slug])}}">
                        <img
                            src="{{$course->cover_image}}"
                            class="card-img-top"
                            alt="knowledge-base-image"
                        />

                        <div class="card-body text-center">
                            <h4>{{$course->title}}</h4>
                            <p class="text-body mt-1 mb-0">
                                {{$course->description}}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 ">
                <div class="card">
                    <a href="#">
                        <div class="card-body text-center">
                            <h4>Not Enrolled In Any Course Yet!</h4>
                        </div>
                    </a>
                </div>
            </div>
        @endforelse

    <!-- no result -->
        <div class="col-12 text-center no-result no-items">
            <h4 class="mt-4">Search result not found!!</h4>
        </div>

    </div>
</section>
<!-- Knowledge base ends -->
