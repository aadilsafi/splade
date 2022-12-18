<template>
  <div class="container-fluid">
    <div class="sidebar-content">
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

          <div v-for="(item, i) in Navitems" :key="i">
            <v-list-item
              v-if="!item.children"
              :key="item.name"
              :href="item.path"
            >
              <v-list-item-icon>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ item.name }}</v-list-item-title>
            </v-list-item>
            <!-- else if it has children -->
            <v-list-group v-else :group="item.path">
              <!-- this template is for the title of top-level items with children -->
              <template #activator>
                <v-list-item-content>
                  <v-list-item-title>
                    <v-icon>{{ item.icon }}</v-icon>
                    {{ item.name }}
                  </v-list-item-title>
                </v-list-item-content>
              </template>
              <!-- this template is for the children/sub-items (2nd level) -->
              <template v-for="subItem in item.children">
                <!-- another v-if to determine if there's a 3rd level -->
                <!-- if there is NOT a 3rd level -->
                <v-list-item
                  v-if="!subItem.children"
                  class="ml-5"
                  :key="subItem.name"
                  :href="subItem.path"
                >
                  <v-list-item-icon class="mr-4">
                    <v-icon>{{ subItem.icon }}</v-icon> />
                  </v-list-item-icon>
                  <v-list-item-title class="ml-0">
                    {{ subItem.name }}
                  </v-list-item-title>
                </v-list-item>
                <!-- if there is a 3rd level -->
                <v-list-group v-else :group="subItem.path" sub-group>
                  <template #activator>
                    <v-list-item-content>
                      <v-list-item-title>
                        <!-- <v-icon>{{ subItemicon }}</v-icon> -->
                        {{ subItem.name }}
                      </v-list-item-title>
                    </v-list-item-content>
                  </template>
                  <template v-for="(subSubItem, k) in subItem.children">
                    <v-list-item
                      :key="`subheader-${k}`"
                      color="indigo"
                      :value="true"
                      :href="subSubItem.path"
                    >
                      <v-list-item-title>{{
                        subSubItem.name
                      }}</v-list-item-title>
                      <v-list-item-icon>
                        <v-icon>{{ subSubItem.icon }}</v-icon>
                      </v-list-item-icon>
                    </v-list-item>
                  </template>
                </v-list-group>
              </template>
            </v-list-group>
          </div>
        </v-list>
      </v-navigation-drawer>
      <v-app-bar-nav-icon @click.stop="drawer"></v-app-bar-nav-icon>
    </div>
  </div>
</template>
    
<script>
export default {
    props: {
    drawer: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      // drawer: null,
      Navitems: [
        {
          path: "#",
          icon: "mdi-view-dashboard",
          name: "Dashboard",
        },
        {
          icon: "mdi-account",
          name: "Users",
          children: [
            {
              name: "Admin",
              // path: "/admin-userslist",
              children: [
                {
                  name: "User List",
                  path: "/admin-userslist",
                  icon: "mdi-view-list",
                },
                {
                  name: "User Creation",
                  path: "/admin-usercreation",
                  icon: "mdi-plus",
                },
              ],
            },
            {
              name: "Trainers",
              // path: "/admin-usercreation",
              children: [
                {
                  name: "User List",
                  path: "/admin-userslist",
                  icon: "mdi-view-list",
                },
                {
                  name: "User Creation",
                  path: "/admin-usercreation",
                  icon: "mdi-plus",
                },
              ],
            },
            {
              name: "Trainees",
              // path: "/admin-usercreation",
              children: [
                {
                  name: "User List",
                  path: "/admin-userslist",
                  icon: "mdi-view-list",
                },
                {
                  name: "User Creation",
                  path: "/admin-usercreation",
                  icon: "mdi-plus",
                },
              ],
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