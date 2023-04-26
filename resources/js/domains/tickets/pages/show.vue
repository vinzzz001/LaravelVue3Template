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
import noteOverview from "domains/notes/pages/overview.vue";
import type { Ticket } from "domains/tickets/types";

const route = useRoute();
const ticketId: number = parseInt((<string>route?.params.id) as string) || 0;

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

<!-- todo: Shows the wrong category -->
<template>
  <h1>Show Page!</h1>

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

  <!-- ? Is this the best way? -->
  <response-overview v-if="ticket?.responses" :ticket="ticket" />
  <note-overview v-if="ticket?.notes && me.is_admin == true" :ticket="ticket" />
</template>
