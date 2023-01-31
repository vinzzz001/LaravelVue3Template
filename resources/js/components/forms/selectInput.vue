<script setup lang="ts">
import { ref } from "vue";
import { type PropType } from "vue";

// ["array", "property", "value"]
const props = withDefaults(
  defineProps<{
    array: Array<{ id: number; [property: string]: any }>; //# This way of defining the prop seems wrong...
    property: string;
    value?: number;
  }>(),
  {
    value: -1,
  }
);

const emits = defineEmits(["change-id"]);

const idValue = ref(props.value) || -1; //Editable value.
</script>

<template v-if="idValue">
  <select v-model="idValue" @change="emits('change-id', idValue)">
    <option v-for="element in array" :key="element.id" :value="element.id">
      {{ element[property] }}
    </option>
  </select>
</template>

<style scoped>
/* Styling here! */
</style>
