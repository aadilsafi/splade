<template>
  <div class="container-fluid py-4 bg-white border-radius shadow-sm">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <v-app-bar-nav-icon
          @click="drawerclick((drawer = !drawer))"
        ></v-app-bar-nav-icon>
        <div class="float-right">
          <button>Log In</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  // props: {
  //   drawer: {
  //     type: Boolean,
  //     default: false,
  //   },

  // },
  data() {
    return {
      drawer: false,
    };
  },
  methods: {
    drawerclick(value) {
      this.$emit((drawer = value));
    },
  },
};
</script>
<style scoped>
</style>