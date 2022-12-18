<template>
  <div>
    <div class="border-radius shadow mb-3 pb-0">
      <div class="leader-list">
        <div class="leaders">
          <div class="leader">
            <div class="leader-content">
              <div class="leader-img">
                <img
                  :src="Secondposition.src"
                  class="rounded-circle img-fluid"
                />
              </div>
              <small class="text-muted">{{ Secondposition.name }}</small>
              <p class="mb-0">{{ Secondposition.score }}</p>
              <div
                id="leaderboardSecond"
                class="leader-bottom secondposition"
              ></div>
            </div>
          </div>
          <div class="leader">
            <div class="leader-content">
              <div class="crown">
                <img class="img-fluid w-100" src="images/crown.png" />
              </div>
              <div class="leader-img">
                <img
                  :src="Firstposition.src"
                  class="rounded-circle img-fluid"
                />
              </div>
              <small class="text-muted">{{ Firstposition.name }}</small>
              <p class="mb-0">{{ Firstposition.score }}</p>
              <div
                id="leaderboardFirst"
                class="leader-bottom firstposition"
              ></div>
            </div>
          </div>
          <div class="leader">
            <div class="leader-content">
              <div class="leader-img">
                <img
                  :src="Thirdposition.src"
                  class="rounded-circle img-fluid"
                />
              </div>
              <small class="text-muted">{{ Thirdposition.name }}</small>
              <p class="mb-0">{{ Thirdposition.score }}</p>
              <div
                id="leaderboardThird"
                class="leader-bottom thirdposition"
              ></div>
            </div>
          </div>
        </div>
      </div>
    </div>

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

    <div class="bg-white border-radius my-1 shadow p-3">
      <div class="row">
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <img width="40px" :src="firstrank.src" />
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex justify-content-start align-items-center">
            <div class="square" style="width: 50px">
              <img :src="Firstposition.src" class="img-fluid rounded-circle" />
            </div>
            <p class="mb-0 ml-2">{{ Firstposition.name }}</p>
          </div>
        </div>
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <p class="mb-0 ml-2 text-danger">{{ Firstposition.score }}</p>
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex h-100 align-items-center">
            <img width="30px" :src="firstacheivements.src" />
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white border-radius my-1 shadow p-3">
      <div class="row">
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <img width="40px" :src="secondrank.src" />
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex justify-content-start align-items-center">
            <div class="square" style="width: 50px">
              <img :src="Secondposition.src" class="img-fluid rounded-circle" />
            </div>
            <p class="mb-0 ml-2">{{ Secondposition.name }}</p>
          </div>
        </div>
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <p class="mb-0 ml-2 text-success">{{ Secondposition.score }}</p>
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex h-100 align-items-center">
            <img width="30px" :src="secondacheivements.src" />
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white border-radius my-1 shadow p-3">
      <div class="row">
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <img width="40px" :src="thirdrank.src" />
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex justify-content-start align-items-center">
            <div class="square" style="width: 50px">
              <img :src="Thirdposition.src" class="img-fluid rounded-circle" />
            </div>
            <p class="mb-0 ml-2">{{ Thirdposition.name }}</p>
          </div>
        </div>
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <p class="mb-0 ml-2 text-primary">{{ Thirdposition.score }}</p>
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex h-100 align-items-center">
            <img width="30px" :src="thirdacheivements.src" />
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white border-radius my-1 shadow p-3">
      <div class="row">
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <p class="mb-0">4th</p>
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex justify-content-start align-items-center">
            <div class="square" style="width: 50px">
              <img :src="Fourthposition.src" class="img-fluid rounded-circle" />
            </div>
            <p class="mb-0 ml-2">{{ Fourthposition.name }}</p>
          </div>
        </div>
        <div class="col-2">
          <div class="d-flex h-100 justify-content-start align-items-center">
            <p class="mb-0 ml-2">{{ Fourthposition.score }}</p>
          </div>
        </div>
        <div class="col-4">
          <div class="d-flex h-100 align-items-center"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      Firstposition: {
        name: "Mujahid Sheikh",
        score: "680",
        src: "images/p1.jpg",
      },
      Secondposition: {
        name: "Marium Khan",
        score: "500",
        src: "images/p2.jpg",
      },
      Thirdposition: {
        name: "Alex Lionarons",
        score: "420",
        src: "images/p3.jpg",
      },
      Fourthposition: {
        name: "Mehak Imtiaz",
        score: "400",
        src: "images/p4.jpg",
      },
      firstrank: {
        src: "images/first.png",
      },
      secondrank: {
        src: "images/second.png",
      },
      thirdrank: {
        src: "images/third.png",
      },
      firstacheivements: {
        src: "images/badge-3.png",
      },
      secondacheivements: {
        src: "images/badge-1.png",
      },
      thirdacheivements: {
        src: "images/badge-2.png",
      },
    };
  },
};
</script>

<style scoped>
.leader-circle {
  width: 80px;
  height: 80px;
  text-align: center;
  /* border-radius: 50%; */
}

.leader-holder {
  width: 100px;
  text-align: center;
  margin: 50px;
}

.leader-bottom {
  width: 100%;
  background-color: rgb(44, 47, 137);
  border-top-right-radius: 5px;
  border-top-left-radius: 5px;
}

#leaderboardThird {
  background-color: #2184c5;
}

#leaderboardFirst {
  background-color: #d72c27;
}

#leaderboardSecond {
  background-color: #6ba342;
}

.leader-cirle img {
  height: 100%;
  object-fit: cover;
}

.leader-left {
  position: absolute;
  top: 55%;
  left: 0;
}

.leader-list {
  padding: 0.5rem;
  background: white;
  height: 300px;
  border-radius: 10px;
}

.leaders {
  display: flex;
  justify-content: space-between;
  width: 30%;
  margin-left: auto;
  margin-right: auto;
  height: 100%;
  position: relative;
}

.leader {
  width: 30%;
  text-align: center;
  height: 100%;
  position: relative;
  /* margin-right: 20px; */
}

.leader-content {
  position: absolute;
  bottom: 0;
  text-align: center;
  font-size: small;
}

.leader-img {
  width: 100%;
  margin-left: auto;
  margin-right: auto;
}

.leader-img img {
  object-fit: cover;
  width: 100%;
}

.crown {
  display: inline-block;
  text-align: center;
  width: 30px;
  top: 0;
  left: calc(50% - 15px);
}
.firstposition {
  height: 100px;
}
.secondposition {
  height: 75px;
}
.thirdposition {
  height: 50px;
}
</style>
