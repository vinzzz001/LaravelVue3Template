<script setup lang="ts">
import { ref } from "vue";
import { RouterLink, useRoute } from "vue-router";

//todo: Re-create all stores?
import { categoryStore } from "domains/categories";
import { ticketStore } from "domains/tickets";
import { userStore } from "domains/users";
import { TICKETSTATUS as statuses } from "constants/index";
import { authStore } from "domains/auth";
import ticketTable from "domains/tickets/components/showTable.vue"; //todo: rename!
import responseOverview from "domains/responses/pages/overview.vue";
import type { Ticket } from "domains/tickets/types";

const route = ref(useRoute()).value;
const ticketId: number = parseInt(<string>route?.params.id) || 0;

categoryStore.actions.getAll();
ticketStore.actions.getById(ticketId);

const ticket = ticketStore.getters.byId(ticketId);
const me = authStore.getters.me;
const users = userStore.getters.all;
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

  <!-- //todo: set v-if back on the table -->
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
  <response-overview v-if="ticket?.responses" :responses="ticket?.responses" />
</template>
