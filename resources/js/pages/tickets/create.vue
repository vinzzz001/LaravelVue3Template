<script setup lang="ts">
import { ref } from "vue";
import { ticketStore } from "../../store/factory";
import { Ticket } from "../../types";
import ticketFormVue from "../../components/tickets/ticketEditForm.vue";
import { useRouter } from "vue-router";

const router = useRouter();
const ticket = ref(<Ticket>{});

const createTicket = async (ticket: Ticket) => {
  await ticketStore.actions.create(ticket);
  router.push({ name: "ticket.overview" });
};
</script>

<template>
  <h1>Ticket Create Page</h1>
  {{}}
  <ticket-form-vue
    :ticket="ticket"
    @submit-form="(ticket: Ticket) => createTicket(ticket)"
  />
</template>
