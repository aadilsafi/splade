<template>
  <div class="">
    <div class="bg-white rounded shadow p-3">
      <div class="row">
        <div class="col-3">
          <div class="square">
            <img :src="User.src" class="img-fluid rounded" />
          </div>
        </div>
        <div class="col-9">
          <h3 class="mb-0">{{ User.name }}</h3>
          <small class="text-muted d-block">All Star</small>
          <v-progress-linear
            class="m1"
            v-model="valueDeterminate"
            color="deep-purple accent-4"
          ></v-progress-linear>

          <div class="row mt-3">
            <div class="col-3">
              <div class="d-flex justify-content-between">
                <div class="">
                  <h5 class="mb-0">{{ User.totalscore }}</h5>
                  <small class="text-muted text-small">Total Score</small>
                </div>
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
            <h6>
              Achievements
              <span class="badge badge-secondary">{{
                User.total_acheivements
              }}</span>
            </h6>
            <div class="d-flex justify-content-end w-50">
              <small class="text-muted mr-1">{{ User.acheivements }}</small>
              <v-progress-linear
                v-model="valueDeterminate"
                color="deep-purple"
              ></v-progress-linear>
            </div>
          </div>
          <div class="row">
            <div class="col-4" v-for="(a, i) in ach" :key="i">
              <Badge :unlocked="a.unlocked" :icon="a.icon" />
            </div>
          </div>
          <div class="collapse" id="badgecollapse">
            <div class="row">
              <div class="col-4" v-for="(a, i) in ach" :key="i">
                <Badge :unlocked="a.unlocked" :icon="a.icon" />
              </div>
            </div>
          </div>

          <!-- <div class="row mt-5">
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
                            </div> -->
          <!-- <div class="collapse" id="ach">

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
                            </div> -->
          <p class="text-center mt-5 mb-0 text-primary">
            <a
              id="toggler"
              href="#badgecollapse"
              data-toggle="collapse"
              class="nav-link"
              >See all</a
            >
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Badge from "../../components/trainee/Badge.vue";
export default {
  components: {
    Badge,
  },
  data() {
    return {
      valueDeterminate: 90,
      User: {
        name: "Mujahid Sheikh",
        totalscore: "680",
        src: "images/userpics/p1.jpg",
        acheivements: "4/20",
        total_acheivements: "4",
      },
      ach: [
        {
          icon: "mdi-trophy",
          unlocked: true,
        },
        {
          icon: "mdi-trophy",
          unlocked: false,
        },
      ],
    };
  },
 
};
</script>

<style scoped>
.square {
  width: 100%;
  padding-top: 100%;
  position: relative;
}
.square img {
  position: absolute;
  top: 0;
  height: 100%;
  object-fit: cover;
}
.rounded {
  border-radius: 20px !important;
  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.badge-secondary {
  color: #fff;
  background-color: #6c757d;
}
.badge {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.v-progress-linear {
  height: 12px !important;
  border-radius: 5px;
}
</style>