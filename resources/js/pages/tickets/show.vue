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
import { Ticket } from "../../types";
import { ref } from "vue";

const route = ref(useRoute()).value; //@ts-ignore
const ticketId: number = parseInt(route?.params.id) || 0;

const ticket = ticketStore.getters.byId(ticketId);
const me = authStore.getters.me;
const users = userStore.getters.all;
const statuses = statusStore.getters.all;
const categories = categoryStore.getters.all;

const updateTicketStatus = (ticket: Ticket) => {
  ticketStore.actions.updateTicketStatus(ticket);
};

const assignTicket = (ticket: Ticket) => {
  ticketStore.actions.updateTicketAssignment(ticket);
};
</script>

<template>
  <h1>Show Page!</h1>

  <br />
  <br />

  <ticket-table
    v-if="ticket && me && users && statuses && categories"
    :id="ticketId"
    @update-ticket-status="(ticket: Ticket) => updateTicketStatus(ticket)"
    @update-ticket-assignment="(ticket: Ticket) => assignTicket(ticket)"
  />

  <router-link
    v-if="me.is_admin == true || me.id == ticket?.user_id"
    :to="{ name: 'ticket.edit', params: { id: <number>ticketId } }"
  >
    Edit
  </router-link>
</template>
