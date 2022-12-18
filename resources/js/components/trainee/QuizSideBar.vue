<template>
  <div class="container-fluid">
    <div class="sidebar-content icon-styling">
      <v-navigation-drawer
        class="border-radius"
        v-model="drawer"
        app
        :permanent="$vuetify.breakpoint.mdAndUp"
      >
        <v-list class="pt-0">
          <div class="sidebar-header">
            <div class="row p-3">
              <div class="col-4">
                <img
                  src="/images/logo/logo-u-white.png"
                  alt="unilever-logo"
                  class="img-fluid"
                />
              </div>
              <div class="col-8">
                <h3 class="mb-0">Learning Platform</h3>
              </div>
            </div>
          </div>
          <v-list-item v-for="item in Navitems" :key="item.title" link>
            <a link :href="item.url" class="d-flex text-decoration-none">
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>

              <v-list-item-content>
                <v-list-item-title>{{ item.title }}</v-list-item-title>
              </v-list-item-content>
            </a>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    </div>
  </div>
</template>
    
<script>
export default {
  data() {
    return {
      drawer: null,
      Navitems: [
        { icon: "mdi-account", title: "Profile", url: "/student-profile" },
        {
          icon: "mdi-calendar-blank",
          title: "My Training Calendar",
          url: "/training-calendar",
        },
        { icon: "mdi-trophy", title: "Leaderboard", url: "/leader-board" },
        { icon: "mdi-alarm-check", title: "Weekly Quiz", url: "/weekly-quiz" },
      ],
    };
  },
};
</script>
<style scoped>
.theme--light.v-navigation-drawer:not(.v-navigation-drawer--floating)
  .v-navigation-drawer__border {
  background-color: transparent !important;
}
.v-sheet.v-card:not(.v-sheet--outlined) {
  box-shadow: none;
}
.v-navigation-drawer__border {
  background-color: black !important;
}
.sidebar-height {
  height: calc(100vh - 32px);
  overflow: hidden;
}
.sidebar-content-height {
  height: calc(100vh - 145px);
}
.v-navigation-drawer {
  margin-left: 0.9rem;
  margin-top: 0.9rem;
  margin-bottom: 0.9rem;
  max-height: calc(100% - 30px) !important;
  width: 270px !important;
}
.v-application a {
  color: black !important;
}
.icon-styling {
  position: absolute;
  top: 10vh;
}
</style>