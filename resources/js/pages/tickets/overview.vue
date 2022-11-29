<script setup lang="ts">
import { computed } from '@vue/reactivity';
import { RouterLink } from 'vue-router';
import { Category, Status, Ticket, User } from '../../types';
import { categoryStore, statusStore, ticketStore, userStore } from '/resources/js/store/factory';


categoryStore.actions.getAll();
statusStore.actions.getAll();
ticketStore.actions.getAll();
userStore.actions.getAll();

const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;
const tickets = ticketStore.getters.all;
const users = userStore.getters.all;

//Tickets sorted by date updated; Ascending(oldest first)
const sortedTickets = computed(() => {
    return tickets.value.sort((a, b) => {
        var dateA: number = new Date(a.updated_at).getTime();
        var dateB: number = new Date(b.updated_at).getTime();
        return dateA - dateB;
    })
});

const categoryTitle = (id: number) => {
    const category: Category = categories.value.find((element) => element.id == id); //todo: temp, add items by id in factory.
    if (!category) return "?";
    return category.title;
}

const statusTitle = (id: number) => {
    const status: Status = statuses.value.find((element) => element.id == id); //todo: temp, add items by id in factory.
    if (!status) return "?";
    return status.title;
}

const userName = (id: number) => {
    const user: User = users.value.find((element) => element.id == id); //todo: temp, add items by id in factory.
    if (!user) return "?";
    return user.full_name;
}

</script>
<template>
    <h1>Overview Page</h1>
    <table>
        <thead>
            <tr>
                <th
                    v-for="column in ['id', 'title', 'category', 'status', 'owner', 'created_at', 'updated_at', 'assigned_to']">
                    {{ column }}
                </th>
            </tr>
        </thead>
        <tbody v-if="sortedTickets">
            <tr v-for="ticket in sortedTickets">
                <td>
                    <router-link :to="{ name: 'TicketShow', params: { id: <number>ticket.id } }">{{ ticket.id }}
                    </router-link>
                </td>
                <td>{{ ticket.title }}</td>
                <td>{{ categoryTitle(ticket.category_id) }} </td>
                <td>{{ statusTitle(ticket.status_id) }}</td>
                <td>{{ userName(ticket.user_id) }}</td>
                <td>{{ ticket.created_at }}</td>
                <td>{{ ticket.updated_at }}</td>
                <td>{{ userName(ticket.assigned_to) }}</td>
            </tr>
        </tbody>
    </table>

    <router-link :to="{ name: 'TicketCreate' }">Create Ticket</router-link>
</template>
