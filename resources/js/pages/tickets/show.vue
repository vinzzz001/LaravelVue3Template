<script setup lang="ts">
import { RouterLink, useRoute } from "vue-router";
import {
  categoryStore,
  statusStore,
  ticketStore,
  userStore,
} from "../../store/factory";
import { store as authStore } from "/resources/js/store/authStore";
import ticketTable from "../../components/tickets/ticketShowTable.vue"; //todo: rename!
import responseIndex from "../responses/index.vue";
import type { Ticket } from "../../types";
import { ref } from "vue";

const route = ref(useRoute()).value; //@ts-ignore
const ticketId: number = parseInt(route?.params.id) || 0;

ticketStore.actions.getById(ticketId);
const ticket = ticketStore.getters.byId(ticketId);
const me = authStore.getters.me;
const users = userStore.getters.all;
const statuses = statusStore.getters.all;
const categories = categoryStore.getters.all;

const updateTicketStatus = (t: Ticket) => {
  ticketStore.actions.updateTicketStatus(t);
};

const assignTicket = (t: Ticket) => {
  ticketStore.actions.updateTicketAssignment(t);
};
</script>

<template>
  <h1>Show Page!</h1>

  <pre>{{ ticket }}</pre>
  <br />
  <br />

  <ticket-table
    v-if="ticket && me && users && statuses && categories"
    :id="ticketId"
    @update-ticket-status="(t: Ticket) => updateTicketStatus(t)"
    @update-ticket-assignment="(t: Ticket) => assignTicket(t)"
  />

  <router-link
    v-if="me.is_admin == true || me.id == ticket?.user_id"
    :to="{ name: 'ticket.edit', params: { id: <number>ticketId } }"
  >
    Edit
  </router-link>

  <!-- Todo: Is this the best way? -->
  <response-index></response-index>
</template>
