<script setup lang="ts">
import { categoryStore, statusStore } from '../../store/factory';

categoryStore.actions.getAll();
statusStore.actions.getAll();

const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;


</script>


<template>
    <h1>Create Ticket Page</h1>
    <table>
        <thead>
            <tr>
                <th v-for="column in ['title', 'category', 'status', 'assigned_to']">
                    {{ column }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input id="title" type="text">
                </td>
                <td>
                    <select id="category" :v-if="categories">
                        <template v-for="category in categories">
                            <option :value="category.id">{{ category.title }}</option>
                        </template>
                    </select>
                </td>
                <td>
                    <!-- //todo: Something is wrong with the statuses. -->
                    <select id="status" :v-if="statuses">
                        <template v-for="status in statuses">
                            <option :value="status.id">{{ status.title }}</option>
                        </template>
                    </select>
                </td>
                <td>
                    <input id="assigned_to" type="search">
                    <!-- //todo: is this the correct type? -->
                </td>
            </tr>
            <input type="submit">
        </tbody>

    </table>
    <router-link :to="{ name: 'Tickets' }">return</router-link>
</template>
