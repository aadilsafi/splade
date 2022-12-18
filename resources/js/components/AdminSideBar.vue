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
          <!-- <v-list-group
            v-for="navitem in Navitems"
            :key="navitem.title"
            v-model="navitem.active"
            :prepend-icon="navitem.icon"
            no-action
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title v-text="navitem.title"></v-list-item-title>
              </v-list-item-content>
            </template>

            <v-list-item
              v-for="child in navitem.Navitems"
              :key="child.title"
              link
            >
              <a link :href="child.url" class="d-flex text-decoration-none">
                <v-list-item-content>
                  <v-list-item-title v-text="child.title"></v-list-item-title>
                </v-list-item-content>
              </a>
            </v-list-item>
          </v-list-group> -->
          <div v-for="(item, i) in Navitems" :key="i">
            <v-list-item
              v-if="!item.subNavitems"
              :href="item.to"
              class="v-list-item"
            >
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>

              <v-list-item-title v-text="item.text" />
            </v-list-item>

            <v-list-group
              v-else
              :key="item.text"
              no-action
              :prepend-icon="item.icon"
              :value="false"
            >
              <template v-slot:activator>
                <v-list-item-title>{{ item.text }}</v-list-item-title>
              </template>

              <v-list-item
                v-for="sublink in item.subNavitems"
                :href="sublink.to"
                :key="sublink.text"
              >
                <v-list-item-icon>
                  <v-icon>{{ sublink.icon }}</v-icon>
                </v-list-item-icon>
                <v-list-item-title>{{ sublink.text }}</v-list-item-title>
              </v-list-item>
            </v-list-group>
          </div>
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
        {
          to: "#",
          icon: "mdi-view-dashboard",
          text: "Dashboard",
        },
        {
          icon: "mdi-folder",
          text: "Users",
          subNavitems: [
            {
              text: "User List",
              to: "/admin-userslist",
              icon: "mdi-view-list",
            },
            {
              text: "User Creation",
              to: "/admin-usercreation",
              icon: "mdi-plus",
            },
          ],
        },
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
  top: 9vh;
}
</style>