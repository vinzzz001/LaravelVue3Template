<script setup lang="ts">
import { ref } from 'vue';
import type { Credentials, User } from '../../types'
import { authStore } from '../../store/authStore';

//Todo: Remove the temporary email/password
const credentials = ref<Credentials>({ 'email': 'vinzzz001@gmail.com', 'password': 'password' });
const loginForm = () => {
    authStore().actions.login(credentials.value)
}

const me = () => {
    authStore().actions.me();
}

const logout = () => {
    authStore().actions.logout();
}


/**
 * Switches password type between visible and protected text. 
 */
const switchType = () => passwordFieldType.value = passwordFieldType.value === 'password' ? 'current-password' : 'password';
const passwordFieldType = ref<'password' | 'current-password'>('password');

</script>

<template>
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
    <button @click="me()">me</button>
    <button @click="logout()">logout</button>

</template>
