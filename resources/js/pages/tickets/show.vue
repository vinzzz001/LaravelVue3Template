<script setup lang="ts">
import { RouterLink, useRoute } from 'vue-router';
import { ticketStore } from '../../store/factory';


//Get the ID from the route
const route = useRoute();

//@ts-ignore //Typescript has difficulties with params.id since it could also be an array.
const ticketId: number = parseInt(route.params.id) || 0;

ticketStore.actions.getById(ticketId);
const ticket = ticketStore.getters.byId(ticketId);



</script>

<template>

    <h1>Show Page! </h1>
    <br>
    <pre>{{ ticket }}</pre>

    <router-link :to="{ name: 'Tickets' }">return</router-link>
</template>
