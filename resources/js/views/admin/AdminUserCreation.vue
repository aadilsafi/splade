<template>
  <div class="bg-white border-radius shadow p-5">
    <h1>User Creation</h1>
    
    <div class="row mt-3">
      <div class="col-6">
        <v-text-field v-model="name" label="Name" outlined dense></v-text-field>
      </div>
      <div class="col-6">
        <v-text-field
          v-model="email"
          label="Email"
          outlined
          dense
        ></v-text-field>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <v-text-field
          v-model="password"
          label="Password"
          outlined
          dense
        ></v-text-field>
      </div>
    </div>
    <div class="pb-3">
      <v-btn class="float-right" color="primary" @click="createuser">
        Create User
      </v-btn>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
    };
  },
  methods: {
    createuser() {
      let data = {
        name: this.name,
        email: this.email,
        password: this.password,
      };
      axios
        .post("create-user", data)
        .then(function (res) {
          console.log(res);
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>
<style scoped>
</style>
