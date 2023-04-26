<script setup lang="ts">
import { userStore } from "domains/users";
import { authStore } from "domains/auth";
import { RouterLink } from "vue-router";

const me = authStore.getters.me;
userStore.actions.getAll();
const users = userStore.getters.all;

const deleteUser = (id: number) => {
  console.log(id);
  userStore.actions.delete(id);
};
</script>

<template>
  <div id="userStore" v-if="me.is_admin">
    <div>
      <router-link :to="{ name: 'user.create' }"> Create New User </router-link>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Admin</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Options</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users">
          <td>
            <router-link :to="{ name: 'user.edit', params: { id: user.id } }">{{
              user.id
            }}</router-link>
          </td>
          <td>{{ user.first_name }}</td>
          <td>{{ user.last_name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.is_admin }}</td>
          <td>{{ user.telephone_number }}</td>
          <td>
            <button
              type="button"
              class="btn-close"
              style="color: red"
              @click="deleteUser(user.id)"
            ></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
