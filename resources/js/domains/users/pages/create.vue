<script setup lang="ts">
import baseFormError from "components/form/error.vue";
import { userStore } from "domains/users";
import { Credentials } from "domains/auth/types";
import { NewUser } from "domains/users/types";
import { ref } from "vue";
import { useRouter } from "vue-router";
import inputGroup from "components/form/inputGroup.vue";

const router = useRouter();
const newUser = ref({} as NewUser); //While not the correct way, it works here for now.
const credentials = ref({} as Credentials);

const CreateUser = async () => {
  //Need the password to be the same as the confirmation password.
  if (credentials.value.password != credentials.value.passwordConfirmation) {
    return;
  }

  newUser.value.password = credentials.value.password;
  await userStore.actions.createUser(newUser.value);

  router.push({ name: "login" });
};
</script>
<template>
  <div id="Create New User">
    <h1>Create a New User</h1>

    <form class="form">
      <input-group propertyName="first_name" v-model="newUser.first_name" />
      <input-group propertyName="last_name" v-model="newUser.last_name" />
      <input-group propertyName="email" v-model="newUser.email" type="email" />

      <input-group
        propertyName="password"
        v-model="credentials.password"
        type="password"
      />

      <input-group
        propertyName="passwordConfirmation"
        v-model="credentials.passwordConfirmation"
        type="password"
      />

      <input-group
        propertyName="phone number"
        v-model="newUser.telephone_number"
        type="number"
      />

      <button class="btn btn-outline-primary" @click.prevent="CreateUser()">
        Submit
      </button>
    </form>
  </div>
</template>

<style scoped>
.form {
  width: unset;
  margin: auto;
  text-align: center;
}
</style>
