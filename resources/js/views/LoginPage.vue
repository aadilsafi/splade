<template>
  <div>
    <div class="overlay"></div>
    <div class="back_gif">
      <div class="login-bg">
        <div class="login-holder">
          <div class="text-center">
            <a href="/">
              <img src="/images/logo-black.png" alt="" width=" 13%" />
            </a>
            <h4>Sign In</h4>

            <v-divider color="primary" class="w-25 mx-auto" />

            <v-text-field
              prepend-inner-icon="mdi-email"
              outlined
              label="Email"
              name="email"
              v-model="email"
              color="primary"
            ></v-text-field>

            <v-text-field
              outlined
              prepend-inner-icon="mdi-lock"
              v-model="password"
              name="password"
              label="Password"
              hint="At least 8 characters"
              color="primary"
            ></v-text-field>
            <v-select :items="types" label="Types" dense outlined></v-select>
            <div class="d-flex justify-content-between align-items-center">
              <small
                ><a href="#" class="text-primary">Forgot password</a></small
              >
              <v-btn color="primary" rounded type="submit">Login</v-btn>
            </div>

            <hr />
            <small class="d-block text-center text-muted"
              >Don't have an account?
              <a href="#" class="text-primary">Register here</a></small
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      types: ["Admin", "Trainer", "Trainee"],
    };
  },
};
</script>


<style scoped>
.back_gif {
  background: url("/images/logo.gif");
  background-repeat: no-repeat, repeat;
  background-size: cover;
  height: 100vh;
  width: 100%;
}
.login-bg {
  padding: 1rem;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.overlay {
  position: fixed;
  width: 100%;
  height: 100%;
  background-color: rgba(186, 191, 255, 0.71);
}

.login-holder {
  /* border-radius: 10px;
  background: white;
  padding: 2rem;
  text-align: center;
  width: 30vw !important; */
  background: rgba(255, 255, 255, 0.65);
  box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
  backdrop-filter: blur(4px);
  padding: 2rem;
  -webkit-backdrop-filter: blur(4px);
  border-radius: 10px;
  border: 1px solid rgba(255, 255, 255, 0.18);
  /* margin-left: auto; */
  /* margin-right: auto; */
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus textarea:-webkit-autofill,
textarea:-webkit-autofill:hover textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {
  -webkit-box-shadow: 0 0 0px 30px #ffffff inset !important;
  box-shadow: 0 0 0px 30px #ffffff inset !important;
}
.v-text-field--outlined {
  border-radius: 10px !important;
}

/********** Small devices only ipad **********/
@media (min-width: 768px) and (max-width: 991px) {
  .login-holder {
    width: 60vw !important;
  }
}

@media (max-width: 767px) {
  .login-holder {
    width: 95vw !important;
  }
}
</style>
