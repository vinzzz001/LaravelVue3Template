<script setup>
import { ref } from 'vue';

let counter = ref(0);

</script>
<template>
    'Test'
    {{counter}}
    <button @click="counter++">
        <slot />
    </button>
</template>


