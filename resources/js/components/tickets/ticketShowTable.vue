<script setup lang="ts">
import { ref } from "vue";
import {
  categoryStore,
  statusStore,
  ticketStore,
  userStore,
} from "../../store/factory";
import { store as authStore } from "/resources/js/store/authStore";
import selectInput from "../forms/selectInput.vue";

const props = defineProps(["id"]);
const emits = defineEmits(["updateTicketStatus", "updateTicketAssignment"]);

const me = authStore.getters.me;
const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;
const ticket = ticketStore.getters.byId(props?.id);
const users = userStore.getters.all;

const statusId = ref(ticket.value?.status_id);

const updateStatus = (id: number) => {
  ticket.value.status_id = id;
  emits("updateTicketStatus", ticket);
};
const updateAssingment = (id: number) => {
  ticket.value.assigned_to = id;
  emits("updateTicketAssignment", ticket);
};
</script>

<template>
  {{ ticket }}

  <table>
    <thead>
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
    <tbody v-if="ticket">
      <tr>
        <td>{{ ticket.title }}</td>
        <td>{{ ticket.content }}</td>
        <td>{{ categories[ticket.category_id]?.title }}</td>

        <td :v-if="statuses && ticket">
          <select-input
            :array="statuses"
            property="title"
            :value="statusId"
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
