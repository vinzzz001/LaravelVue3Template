<script setup lang="ts">
import { ref } from "vue";
import { useRouter } from "vue-router";

import { ticketStore } from "domains/tickets";
import { Ticket } from "domains/tickets/types";
import ticketFormVue from "domains/tickets/components/editForm.vue";

const router = useRouter();
const ticket = ref(<Ticket>{});

const createTicket = async (ticket: Ticket) => {
  await ticketStore.actions.create(ticket);
  router.push({ name: "ticket.overview" });
};
</script>

<template>
  <h1>Ticket Create Page</h1>
  <ticket-form-vue
    :ticket="ticket"
    @submit-form="(ticket: Ticket) => createTicket(ticket)"
  />
</template>
