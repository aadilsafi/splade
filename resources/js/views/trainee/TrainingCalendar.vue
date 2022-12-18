<template>
  <div>
    <div class="border-radius bg-white overflow-hidden">
      <div class="calendar-header">
        <h5>January 2022</h5>
      </div>
      <div class="ma-4" style="height: 516px">
        <v-calendar></v-calendar>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>

<style scoped>
.calendar-header {
  background-color: rgb(215, 44, 39);
  padding: 1.5rem;
  color: white;
}
.overflow-hidden {
  overflow: hidden;
}
.v-calendar-weekly__day-label {
  text-decoration: none;
  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
  cursor: pointer;
  box-shadow: none;
  text-align: center;
  margin: 30px 0px 45px !important;
}
.v-calendar-weekly__week .v-calendar-weekly__day .v-calendar-weekly__day-label {
  margin: 30px 0px 45px !important;
}
.v-past {
  border-right: none !important;
  border-bottom: none !important;
}
.theme--light.v-calendar-weekly {
  border: none !important;
}
.theme--light.v-calendar-weekly .v-calendar-weekly__head-weekday {
  border-right: none !important;
}
</style>
