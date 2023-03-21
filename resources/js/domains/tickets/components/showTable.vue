<script setup lang="ts">
import { TICKETSTATUS as statuses } from "constants/index";
import { categoryStore } from "domains/categories";
import { ticketStore } from "domains/tickets";
import { authStore } from "domains/auth";
import { userStore } from "domains/users";

import selectInput from "../../../components/form/selectInput.vue";
// import { Ticket } from "domains/tickets/types";
const props = defineProps(["id"]);
const emits = defineEmits(["updateTicketStatus", "updateTicketAssignment"]);

authStore.actions.me();
categoryStore.actions.getAll();
userStore.actions.getAll();
ticketStore.actions.getById(props?.id);

const me = authStore.getters.me;
const categories = categoryStore.getters.all;
const users = userStore.getters.all;
const ticket = ticketStore.getters.byId(props?.id);

const updateStatus = (id: number) => {
  const updateTicket = { ...ticket.value };
  updateTicket.status_id = id;

  emits("updateTicketStatus", updateTicket);
};

const updateAssingment = (id: number) => {
  const updateTicket = { ...ticket.value };
  updateTicket.assigned_to = id;

  emits("updateTicketAssignment", updateTicket);
};
</script>

<template>
  <table v-if="ticket" class="table">
    <thead class="table-primary">
      <tr>
        <th
          v-for="column in ['title', 'content', 'category', 'status']"
          :key="column"
        >
          {{ column }}
        </th>
        <th v-if="me.is_admin == true">assigned to</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ ticket.title }}</td>
        <td>{{ ticket.content }}</td>
        <td>{{ categories[ticket.category_id]?.title }}</td>

        <td :v-if="statuses && ticket">
          <select-input
            :array="statuses"
            property="title"
            :value="ticket?.status_id"
            @change-id="(id: number) => updateStatus(id)"
          />
        </td>

        <!-- Only visable if admin.  -->
        <td v-if="users && ticket && me.is_admin == true">
          <select-input
            :array="users"
            property="full_name"
            :value="ticket.assigned_to"
            @change-id="(id: number) => updateAssingment(id) "
          />
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style scoped></style>
