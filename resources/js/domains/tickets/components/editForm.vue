<script setup lang="ts">
import { TICKETSTATUS as statuses } from "constants/index";
import { categoryStore } from "domains/categories";
import { userStore } from "domains/users";
import { authStore } from "domains/auth";

import baseFormError from "components/form/error.vue";
import selectInput from "../../../components/form/selectInput.vue";
import { ref } from "vue";

const props = defineProps(["ticket"]);

categoryStore.actions.getAll();
userStore.actions.getAll();
authStore.actions.me();

const categories = categoryStore.getters.all;
const users = userStore.getters.all;
const me = authStore.getters.me;

const ticket = ref(JSON.parse(JSON.stringify(props.ticket)));
</script>

<template>
  <table class="table">
    <thead class="table-primary">
      <tr>
        <th
          v-for="column in ['title', 'content', 'category', 'status']"
          :key="column"
        >
          {{ column }}
        </th>
        <th v-if="me.is_admin">assigned to</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <input
            id="title"
            class="form-control"
            name="title"
            type="text"
            v-model="ticket.title"
          />
          <base-form-error name="title" />
        </td>

        <td>
          <input
            id="content"
            class="form-control"
            name="content"
            type="text"
            v-model="ticket.content"
          />
          <base-form-error name="content" />
        </td>

        <td>
          <select-input
            :array="categories"
            property="title"
            :value="ticket.category_id"
            @change-id="(id: number) => (ticket.category_id = id)"
          />
          <base-form-error name="category_id" />
        </td>

        <td>
          <select-input
            :array="statuses"
            property="title"
            :value="ticket.status_id"
            @change-id="(id: number) => (ticket.status_id = id)"
          />
          <base-form-error name="status_id" />
        </td>

        <!-- Only allow for changing assigned_to if admin.  -->
        <td v-if="me.is_admin">
          <select-input
            :array="users"
            property="full_name"
            :value="ticket.assigned_to"
            @change-id="(id: number) => (ticket.assigned_to = id)"
          />
          <base-form-error name="assigned_to_id" />
        </td>

        <td>
          <button
            class="btn btn-outline-primary"
            @click="$emit('submitForm', ticket)"
          >
            Submit
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped>
.table {
  width: unset;
  margin: auto;
  text-align: center;
}
</style>
