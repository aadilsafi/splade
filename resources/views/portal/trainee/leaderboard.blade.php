@extends('portal.layout.master')

@section('content')
  <div class="">
    
    <div class="">

      <div class="rounded bg-white shadow overflow-hidden mb-3 pb-0">
          <div class="leader-list">
              <div class="leaders">
                  <div class="leader">
                      <div class="leader-content">
                          <div class="leader-img">
                              <img src="images/p2.jpg" alt="Marium Khan" class="rounded-circle img-fluid">
                          </div>
                          <small class="text-muted">Marium Khan</small>
                          <p class="mb-0">500</p>
                          <div id="leaderboardSecond" class="leader-bottom"></div>
                      </div>
                  </div>
                  <div class="leader">
                      <div class="leader-content">
                          <div class="crown">
                              <img class="img-fluid w-100" src="images/crown.png">
                          </div>
                          <div class="leader-img">
                              <img src="images/p1.jpg" alt="Mujahid Sheikh" class="rounded-circle img-fluid">
                          </div>
                          <small class="text-muted">Mujahid Sheikh</small>
                          <p class="mb-0">680</p>
                          <div id="leaderboardFirst" class="leader-bottom" ></div>
                      </div>
                  </div>
                  <div class="leader">
                      <div class="leader-content">
                          <div class="leader-img">
                              <img src="images/p3.jpg" alt="Alex Lionarons" class="rounded-circle img-fluid">
                          </div>
                          <small class="text-muted">Alex Lionarons</small>
                          <p class="mb-0">420</p>
                          <div id="leaderboardThird" class="leader-bottom"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="all-leaders">

          <div class="my-1 p-3">
              <div class="row">
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0"><b>Rank</b></p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex justify-content-start align-items-center">
                          <p class="mb-0"><b>Name</b></p>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0"><b>Score</b></p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex h-100 align-items-center">
                          <p class="mb-0"><b>Achievements</b></p>
                      </div>
                  </div>
              </div>

          </div>
          <div class="bg-white rounded my-1 shadow p-3">
              <div class="row">
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <img width="40px" src="images/first.png" class="">

                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex justify-content-start align-items-center">
                          <div class="square" style="width: 50px; padding-top: 50px;">
                              <img src="images/p1.jpg" class="img-fluid rounded-circle d-md-block d-none">
                          </div>
                          <p class="mb-0 ml-2">Mujahid Sheikh</p>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0 ml-2 text-danger">680</p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex h-100 align-items-center">
                          <img width="30px" src="images/badge-3.png">
                      </div>
                  </div>
              </div>

          </div>

          <div class="bg-white rounded my-1 shadow p-3">
              <div class="row">
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <img width="40px" src="images/second.png">

                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex justify-content-start align-items-center">
                          <div class="square" style="width: 50px; padding-top: 50px;">
                              <img src="images/p2.jpg" class="img-fluid rounded-circle d-md-block d-none">
                          </div>
                          <p class="mb-0 ml-2">Marium Khan</p>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0 ml-2 text-success">500</p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex h-100 align-items-center">
                          <img width="30px" src="images/badge-1.png">
                      </div>
                  </div>
              </div>
          </div>
          <div class="bg-white rounded my-1 shadow p-3">
              <div class="row">
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <img width="40px" src="images/third.png">

                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex justify-content-start align-items-center">
                          <div class="square" style="width: 50px; padding-top: 50px;">
                              <img src="images/p3.jpg" class="img-fluid rounded-circle d-md-block d-none">
                          </div>
                          <p class="mb-0 ml-2">Alex Lionarons</p>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0 ml-2 text-primary">420</p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex h-100 align-items-center">
                          <img width="30px" src="images/badge-2.png">
                      </div>
                  </div>
              </div>
          </div>
          <div class="bg-white rounded my-1 shadow p-3">
              <div class="row">
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0">4th</p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex justify-content-start align-items-center">
                          <div class="square" style="width: 50px; padding-top: 50px;">
                              <img src="images/p4.jpg" class="img-fluid rounded-circle d-md-block d-none">
                          </div>
                          <p class="mb-0 ml-2">Mehak Imtiaz</p>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0 ml-2">400</p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex h-100 align-items-center">
                          <!-- <img width="30px" src="images/badge-1.png"> -->
                      </div>
                  </div>
              </div>
          </div>


          <div class="bg-white rounded my-1 shadow p-3">
              <div class="row">
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0">5th</p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex justify-content-start align-items-center">
                          <div class="square" style="width: 50px; padding-top: 50px;">
                              <img src="images/p5.png" class="img-fluid rounded-circle d-md-block d-none">
                          </div>
                          <p class="mb-0 ml-2">Salman Gilani</p>
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="d-flex h-100 justify-content-start align-items-center">
                          <p class="mb-0 ml-2">400</p>
                      </div>
                  </div>
                  <div class="col-4">
                      <div class="d-flex h-100 align-items-center">
                          <!-- <img width="30px" src="images/badge-1.png"> -->
                      </div>
                  </div>
              </div>
          </div>
      </div>


      <div class="rounded bg-white overflow-hidden shadow d-none">


          <div class="leader-list">
              <div class="leaders">
                  <div class="leader">
                      <div class="leader-content">
                          <div class="leader-img">
                              <img src="images/p2.jpg" alt="Marium Khan" class="rounded-circle img-fluid">
                          </div>
                          <small class="text-muted">Marium Khan</small>
                          <p class="mb-0">500</p>
                          <div id="leaderboardSecond" class="leader-bottom"></div>
                      </div>
                  </div>
                  <div class="leader">
                      <div class="leader-content">
                          <div class="crown">
                              <img class="img-fluid w-100" src="images/crown.png">
                          </div>
                          <div class="leader-img">
                              <img src="images/p1.jpg" alt="Mujahid Sheikh" class="rounded-circle img-fluid">
                          </div>
                          <small class="text-muted">Mujahid Sheikh</small>
                          <p class="mb-0">680</p>
                          <div id="leaderboardFirst" class="leader-bottom"></div>
                      </div>
                  </div>
                  <div class="leader">
                      <div class="leader-content">
                          <div class="leader-img">
                              <img src="images/p3.jpg" alt="Alex Lionarons" class="rounded-circle img-fluid">
                          </div>
                          <small class="text-muted">Alex Lionarons</small>
                          <p class="mb-0">420</p>
                          <div id="leaderboardThird" class="leader-bottom"></div>
                      </div>
                  </div>
              </div>
          </div>
          <hr>
          <div class="p-4">

              <table class="table table-borderless">
                  <tr>
                      <td>
                          <img width="40px" src="images/first.png">
                      </td>
                      <td>
                          <div class="d-flex justify-content-start align-items-center">
                              <div class="square" style="width: 50px; padding-top: 50px;">
                                  <img src="images/p1.jpg" class="img-fluid rounded-circle">
                              </div>
                              <p class="mb-0 ml-2">Mujahid Sheikh</p>
                          </div>
                      </td>
                      <td>
                          <p class="mb-0 text-danger">680</p>

                      </td>

                      <td>
                          <div class="d-flex justify-content-end">
                              <!-- <img class="mr-1" width="30px" src="images/badge.png"> -->
                              <img width="30px" src="images/badge-1.png">
                          </div>
                      </td>
                  </tr>
                  <tr>
                      <td>
                          <img width="40px" src="images/second.png">
                      </td>
                      <td>
                          <div class="d-flex justify-content-start align-items-center">
                              <div class="square" style="width: 50px; padding-top: 50px;">

                                  <img src="images/p2.JPG" class="img-fluid rounded-circle">
                              </div>
                              <p class="mb-0 ml-2">Marium Khan</p>
                          </div>
                      </td>
                      <td>
                          <p class="mb-0 text-success">500</p>

                      </td>
                      <td>
                          <div class="d-flex justify-content-end">
                              <!-- <img class="mr-1" width="30px" src="images/badge.png"> -->
                              <img width="30px" src="images/badge-3.png">
                          </div>
                      </td>
                  </tr>

                  <tr>
                      <td>
                          <img width="40px" src="images/third.png">
                      </td>
                      <td>
                          <div class="d-flex justify-content-start align-items-center">
                              <div class="square" style="width: 50px; padding-top: 50px;">
                                  <img src="images/p3.JPG" class="img-fluid rounded-circle">
                              </div>
                              <p class="mb-0 ml-2">Alex Lionarons</p>
                          </div>
                      </td>
                      <td>
                          <p class="mb-0 text-primary">420</p>

                      </td>
                      <td>
                          <div class="d-flex justify-content-end">
                              <!-- <img class="mr-1" width="30px" src="images/badge.png"> -->
                              <img width="30px" src="images/badge.png">
                          </div>
                      </td>
                  </tr>

                  <tr>
                      <td>
                          <p class="mb-0">4th</p>

                      </td>
                      <td>
                          <div class="d-flex justify-content-start align-items-center">
                              <div class="square" style="width: 50px; padding-top: 50px;">
                                  <img src="images/p4.jpg" class="img-fluid rounded-circle w-100">
                              </div>
                              <p class="mb-0 ml-2">Mehak Imtiaz</p>
                          </div>
                      </td>
                      <td>
                          <p class="mb-0 text-">400</p>

                      </td>
                      <td>
                          <div class="d-flex justify-content-end">
                              <!-- <img class="mr-1" width="30px" src="images/badge.png"> -->
                              <img width="30px" src="images/badge-2.png">
                          </div>
                      </td>
                  </tr>



                  <tr>
                      <td>
                          <p class="mb-0">5th</p>

                      </td>
                      <td>
                          <div class="d-flex justify-content-start align-items-center">
                              <div class="square" style="width: 50px; padding-top: 50px;">
                                  <img src="images/p5.png" class="img-fluid rounded-circle w-100">
                              </div>
                              <p class="mb-0 ml-2">Salman Gilani</p>
                          </div>
                      </td>
                      <td>
                          <p class="mb-0">400</p>

                      </td>
                      <td>
                          <div class="d-flex justify-content-end">
                              <!-- <img class="mr-1" width="30px" src="images/badge.png"> -->
                              <img width="30px" src="images/badge.png">
                          </div>
                      </td>
                  </tr>
              </table>
          </div>
      </div>



  </div>
  </div>
@endsection

@section('custom-js')
<script>
var tl = gsap.timeline();
tl.to("#leaderboardFirst", { height: 100, duration: 0.5 });
tl.to("#leaderboardSecond", { height: 75, duration: 0.5 }, ">-0.3");
tl.to("#leaderboardThird", { height: 50, duration: 0.5 }, ">-0.5");

const displays = document.querySelectorAll('.note-display');
const transitionDuration = 900;

displays.forEach(display => {
    let note = parseFloat(display.dataset.note);
    // let [int, dec] = display.dataset.note.split('.');
    // [int, dec] = [Number(int), Number(dec)];

    let int = display.dataset.note;

    strokeTransition(display, note);

    increaseNumber(display, int, 'int');
    // increaseNumber(display, dec, 'dec');
});

function strokeTransition(display, note) {
    let progress = display.querySelector('.circle__progress--fill');
    let radius = progress.r.baseVal.value;
    let circumference = 2 * Math.PI * radius;
    let offset = circumference * (10 - note) / 10;

    progress.style.setProperty('--initialStroke', circumference);
    progress.style.setProperty('--transitionDuration', `${transitionDuration}ms`);

    setTimeout(() => progress.style.strokeDashoffset = offset, 100);
}

function increaseNumber(display, number, className) {
    let element = display.querySelector(`.percent__${className}`),
        decPoint = className === 'int' ? '.' : '',
        interval = transitionDuration / number,
        counter = 0;

    let increaseInterval = setInterval(() => {
        if (counter === number) { window.clearInterval(increaseInterval); }

        element.textContent = counter + decPoint;
        counter++;
    }, interval);
}
</script>
@endsection

