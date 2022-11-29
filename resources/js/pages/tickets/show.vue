<script setup lang="ts">
import { RouterLink, useRoute } from 'vue-router';
import { ticketStore } from '../../store/factory';


//Get the ID from the route 
const route = useRoute();
const id: number = parseInt(route.params.id);

ticketStore.actions.getById(id);
const ticket = ticketStore.getters.byId(id);



</script>

<template>

    <h1>Show Page! </h1>
    <br>
    <pre>{{ ticket }}</pre>

    <router-link :to="{ name: 'Tickets' }">return</router-link>
</template>
