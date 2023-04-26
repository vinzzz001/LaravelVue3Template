<script setup lang="ts">
import { computed } from "@vue/reactivity";
import { RouterLink } from "vue-router";
import { TICKETSTATUS as statuses } from "constants/index";

import { categoryStore } from "domains/categories";
import { ticketStore } from "domains/tickets";
import { userStore } from "domains/users";

userStore.actions.getAll();
ticketStore.actions.getAll();
categoryStore.actions.getAll();

const categories = categoryStore.getters.all;
const tickets = ticketStore.getters.all;
const users = userStore.getters.all;
//Tickets sorted by date updated; Oldest first;
const sortedTickets = computed(() => {
  return tickets.value.sort((a, b) => {
    var dateA: number = new Date(a.updated_at).getTime();
    var dateB: number = new Date(b.updated_at).getTime();
    return dateA - dateB;
  });
});

const categoryTitle = (id: number) => {
  const category = categories.value.find((element) => element.id == id);
  if (!category) return "?";
  return category.title;
};

const statusTitle = (id: number) => {
  const status = statuses.find((element) => element.id == id);
  if (!status) return "?";
  return status.title;
};

const userName = (id: number) => {
  const user = users.value.find((element) => element.id == id);
  if (!user) return;
  return user.full_name;
};
</script>

<template>
  <div id="Ticket_Overview" v-if="users && tickets && cate">
    <h1>Overview Page</h1>

    <p>
      <router-link :to="{ name: 'ticket.create' }">Create Ticket</router-link>
    </p>

    <table class="table">
      <thead class="table-primary">
        <tr>
          <th
            v-for="column in [
              'id',
              'title',
              'category',
              'status',
              'owner',
              'created_at',
              'updated_at',
              'assigned_to',
            ]"
          >
            {{ column }}
          </th>
        </tr>
      </thead>
      <tbody v-if="sortedTickets">
        <tr v-for="ticket in sortedTickets">
          <td>
            <router-link
              :to="{ name: 'ticket.show', params: { id: <number>ticket.id } }"
              >{{ ticket.id }}
            </router-link>
          </td>
          <td>{{ ticket.title }}</td>
          <td>{{ categoryTitle(ticket.category_id) }}</td>
          <td class="text-nowrap">
            {{ statusTitle(ticket.status_id) }}
          </td>
          <!-- <td>{{ userName(ticket.user_id) || "???" }}</td> -->
          <!-- todo: repair this. -->
          <td>{{ users[ticket.user_id] || "???" }}</td>

          <!-- This is a quick and dirty way to get shorter time annotation. -->
          <td>{{ ticket.created_at.slice(0, 10) }}</td>
          <td>{{ ticket.updated_at.slice(0, 10) }}</td>

          <td>{{ userName(ticket.assigned_to) || "???" }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped></style>
