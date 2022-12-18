<template>
  <div>
    <a href="#" class="nav-link p-0">
      <div
        class="text-white border-radius shadow p-5 text-center card-image"
        :style="{ backgroundImage: Color }"
      >
        <h4>Quiz {{ weekno }}</h4>
        <div class="status"></div>
        <span>Passed</span>
      </div>
    </a>
  </div>
</template>
<script>
export default {
  props: {
    Color: {
      type: String,
      default: "",
    },
    weekno: {
      type: String,
      default: "",
    },
  },
};
</script>
<style scoped>
h4 {
  font-weight: bold;
}
.status {
  width: 10px;
  height: 10px;
  display: inline-block;
  border-radius: 50%;
  background-color: #6ba342;
  margin-right: 10px;
}
</style>
