<script setup lang="ts">
import { ref } from 'vue';
import { categoryStore, statusStore, ticketStore } from '../../store/factory';
import { Ticket } from '../../types';
import {store as createAuthStore} from '../../store/authStore';



const authStore = createAuthStore;
const categories = categoryStore.getters.all;
const statuses = statusStore.getters.all;
const newTicket = ref(<Ticket>{});

statusStore.actions.getAll();
categoryStore.actions.getAll();

const createForm = async() => {
    const userId: number = authStore.getters.me.value.id || 0 ;
    newTicket.value.user_id = userId;


    const loggable = await ticketStore.actions.create(newTicket.value);
};

</script>


<template>
    <h1>Ticket Create Page</h1>
    <pre>...{{authStore.getters.me}}...</pre>
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
                    <input id="title" name="title" type="text" v-model="newTicket.title">
                </td>
                <td>
                    <select id="category" :v-if="categories" v-model="newTicket.category_id">
                        <template v-for="category in categories">
                            <option :value="category.id">{{ category.title }}</option>
                        </template>
                    </select>
                </td>
                <td>
                    <select id="status" :v-if="statuses" v-model="newTicket.status_id">
                        <template v-for="status in statuses">
                            <option :value="status.id">{{ status.title }}</option>
                        </template>
                    </select>
                </td>
                <td>
                    <!-- //? is search a correct type? -->
                    <input id="assigned_to" type="number" v-model="newTicket.assigned_to">
                </td>
                <button @click="createForm()">Submit</button>

            </tr>
        </tbody>

    </table>
    {{newTicket}}
    <br>
    <router-link :to="{ name: 'Tickets' }">return</router-link>
</template>
