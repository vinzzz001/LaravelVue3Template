<script setup lang="ts">
import { useRoute, useRouter } from "vue-router";
import { ticketStore } from "../../store/factory";
import ticketFormVue from "../../components/tickets/ticketForm.vue";
import { Ticket } from "../../types";

const route = useRoute();
const router = useRouter();

// @ts-ignore //Typescript has difficulties with params.id since it could also be an array.
const ticketId = parseInt(route.params.id) || 0;
const ticket = ticketStore.getters.byId(ticketId);

ticketStore.actions.getById(ticketId);

const updateForm = (ticket: Ticket) => {
  ticketStore.actions.update(ticket.id, ticket);
  router.push({ name: "Tickets" });
};
</script>

<template>
  <h1>Ticket Edit Page</h1>

  <div v-if="ticketId > 0 && ticket">
    <ticket-form-vue
      :ticket="ticket"
      @submit-form="(ticket: Ticket) => updateForm(ticket)"
    />
  </div>
  <div v-else>
    <p>Ticket Not Found!</p>
  </div>

  <br />
  <router-link :to="{ name: 'Tickets' }">return</router-link>
</template>
