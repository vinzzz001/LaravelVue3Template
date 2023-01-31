<script setup lang="ts">
import { ref } from "vue";
import { ticketStore } from "../../store/factory";
import { Ticket } from "../../types";
import { useRouter } from "vue-router";
import ticketFormVue from "../../components/tickets/ticketEditForm.vue";

const ticket = ref(<Ticket>{});
const router = useRouter();

const createForm = async (ticket: Ticket) => {
  await ticketStore.actions.create(ticket);
};
</script>

<template>
  <h1>Ticket Create Page</h1>
  {{}}
  <ticket-form-vue
    :ticket="ticket"
    @submit-form="(ticket: Ticket) => createForm(ticket)"
  />
</template>
