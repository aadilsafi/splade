@extends('portal.layout.master')



@section('page-title')



@section('custom-css')

@endsection


@section('content')
<div class="">
  <div class=""> 
    <div class="bg-white rounded shadow p-3 mb-3">
        <div class="row">
            <div class="col-3">
                <div class="square">
                    <img src="images/p1.jpg" class="img-fluid rounded">
                </div>
            </div>
            <div class="col-9">
               
                <h3 class="mb-0">Mujahid Sheikh</h3><small class="text-muted d-block">All Star</small>
                <div class="progress mt-3 mb-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <h5 class="mb-0">680</h5>
                                <small class="text-muted text-small">Total Score</small>
                            </div>

                            <!-- <div>
                                <h5 class="mb-0">27</h5>
                                <small class="text-muted text-small">Quizes taken</small>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div id="achievements" class="col-md-12">
           
            <div class="rounded bg-white shadow p-4">
                <div class="d-flex justify-content-between">
                    <h6>Achievements <span class="badge badge-secondary">4</span></h6>
                    <div class="d-flex justify-content-end w-50">
                        <small class="text-muted mr-1">4/20</small>
                        <div class="progress w-50">
                            <div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

               
                <div class="row mt-5">
                    <div class="col-md-2 offset-md-1">
                        <img src="images/badge-1.png" class="img-fluid w-100 rounded-circle  shadow-sm">
                    </div>
                    <div class="col-md-2">
                        <img src="images/badge-2.png" class="img-fluid w-100 rounded-circle  shadow-sm">
                    </div>
                    <div class="col-md-2">
                        <img src="images/badge-3.png" class="img-fluid w-100 rounded-circle  shadow-sm">
                    </div>
                    <div class="col-md-2">
                        <img src="images/badge-2.png" class="img-fluid w-100 rounded-circle  shadow-sm">
                    </div>
                    <div class="col-md-2">
                        <img src="images/badge-1.png" class="img-fluid w-100 rounded-circle  shadow-sm greyscale">
                    </div>
                </div>
                <div class="collapse" id="ach">

                    <div class="row mt-3">
                        <div class="col-md-2 offset-md-1">
                            <img src="images/badge-1.png" class="img-fluid w-100 rounded-circle  shadow-sm greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-2.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-3.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-2.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-1.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 offset-md-1">
                            <img src="images/badge-1.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-2.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-3.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-2.png" class="img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                        <div class="col-md-2">
                            <img src="images/badge-1.png" class="greyscale img-fluid w-100 rounded-circle  shadow-sm  greyscale">
                        </div>
                    </div>
                </div>

                <p class="text-center mt-5 mb-0 text-primary"><a id="toggler" href="#ach" data-toggle="collapse" class="nav-link">See all</a></p>
            </div>
        </div>
    </div>

   </div>
</div>
@endsection

