<script setup lang="ts">
import { categoryStore, statusStore, userStore } from "../../store/factory";
import { store as authStore } from "../../store/authStore";
const props = defineProps(["ticket"]);

const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;
const users = userStore.getters.all;
const me = authStore.getters.me;
const ticket = JSON.parse(JSON.stringify(props.ticket)); // todo: use something like this.

userStore.actions.getAll();
statusStore.actions.getAll();
categoryStore.actions.getAll();
</script>

<template>
  <table>
    <thead>
      <tr>
        <th
          v-for="column in [
            'title',
            'content',
            'category',
            'status',
            'assigned to',
          ]"
          :key="column"
        >
          {{ column }}
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
          <input id="title" name="title" type="text" v-model="ticket.title" />
        </td>
        <td>
          <input
            id="content"
            name="content"
            type="text"
            v-model="ticket.content"
          />
        </td>
        <td>
          <select id="category" :v-if="categories" v-model="ticket.category_id">
            <option
              v-for="category in categories"
              :key="category.id"
              :value="category.id"
            >
              {{ category.title }}
            </option>
          </select>
        </td>
        <td>
          <select id="status" :v-if="statuses" v-model="ticket.status_id">
            <option
              v-for="status in statuses"
              :key="status.id"
              :value="status.id"
            >
              {{ status.title }}
            </option>
          </select>
        </td>
        <!-- Only allow for changing assigned_to if admin.  -->
        <td v-if="me.is_admin">
          <select id="assigned_to" v-model="ticket.assigned_to">
            <option v-for="user in users" :key="user.id" :value="user.id || 0">
              {{ user.full_name }}
            </option>
          </select>
        </td>

        <button @click="$emit('submitForm', ticket)">Submit</button>
      </tr>
    </tbody>
  </table>
</template>
