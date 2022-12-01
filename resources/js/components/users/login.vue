<script setup lang="ts">
import { ref } from 'vue';
import type { Credentials } from '../../types'
import {store as createAuthStore} from '../../store/authStore';

const authStore = createAuthStore;

//Todo: Remove the temporary email/password
const credentials = ref<Credentials>({ 'email': 'vinzzz001@gmail.com', 'password': 'password' });
const passwordFieldType = ref<'password' | 'current-password'>('password');

const loginForm = () => authStore.actions.login(credentials.value)
const logout = () => authStore.actions.logout();
const switchType = () => passwordFieldType.value = passwordFieldType.value === 'password' ? 'current-password' : 'password';

/**
 * Switches password type between visible and protected text.
 */

</script>

<template>
    <pre>{{authStore.getters.me}}</pre>
    Remove temp password/email later
    <form action="" @submit.prevent="loginForm()">
        Email:
        <input type="text" name="email" id="email" v-model="credentials.email">
        Password:
        <input :type="passwordFieldType" v-model="credentials.password">
        <button type="submit">Submit</button>

        <button @click.prevent='switchType()'>Show Password</button>
        <br />
    </form>
    <button @click="logout()">logout</button>

</template>
