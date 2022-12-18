<template>
  <div>
    <div class="main_badge text-center">
      <div class="" :class="{ locked: !unlocked }">
        <v-icon> {{ icon }} </v-icon>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    unlocked: {
      type: Boolean,
      default: false,
    },
    icon: {
      type: String,
      default: "",
    },
  },
  data() {
    return {};
  },
};
</script>
<style scoped>
.locked {
  background: lightgray;
  width: 7.4em;
  height: 7.4em;
  border-radius: 50%;
  display: inline-block;
  top: 0;
  transition: all 0.2s ease;
}
.main_badge {
  margin: 1.5em 3em;
  width: 7.4em;
  height: 7.4em;
  border-radius: 50%;
  display: inline-block;
  top: 0;
  transition: all 0.2s ease;
  background: linear-gradient(
    0deg,
    rgba(34, 193, 195, 1) 0%,
    rgba(253, 187, 45, 1) 100%
  );
}
.v-icon {
  margin-top: 30px;
  font-size: 52px;
}
</style>
