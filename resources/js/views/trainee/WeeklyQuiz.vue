<template>
  <div>
    <div class="bg-white border-radius px-5 pt-5 pb-3">
      <h3>Weekly Quizzes</h3>
      <p>
        {{ Quizstatus.text }}
      </p>
    </div>
    <div class="row mt-5">
      <div
        class="col-md-4 col-4 mb-4"
        v-for="quiz in Quizproperties"
        :key="quiz.id"
      >
        <div>
          <Quiz :Color="quiz.background" :weekno="quiz.week_no" />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Quiz from "../../components/trainee/QuizCard.vue";
export default {
  components: {
    Quiz,
  },
  data() {
    return {
      Quizstatus: {
        text: "See which quiz is currently active and view your progress on previous quizzes!",
      },
      Quizproperties: [
        {
          background: "url(images/red_background.svg)",
          week_no: "1",
        },
        {
          background: "url(images/green_background.svg)",
          week_no: "2",
        },
        {
          background: "url(images/blue_background.svg)",
          week_no: "3",
        },
      ],
    };
  },
};
</script>

<style scoped>
h3 {
  font-weight: bold;
}
</style>
