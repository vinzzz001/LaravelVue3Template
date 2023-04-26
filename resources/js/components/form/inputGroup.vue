<script setup lang="ts">
import { computed } from "@vue/reactivity";
import baseFormError from "components/form/error.vue";
import { defineProps, ref } from "vue";

// ["array", "property", "modelValue"]
const props = withDefaults(
  defineProps<{
    propertyName: string;
    modelValue: any;
    type?: any;
  }>(),
  {
    type: "string",
  }
);

/*
 * Captializes the first letter of each word.
 */
const formatName = computed(() => {
  const prop: string = props.propertyName;
  if (!prop) return prop;

  let words: string[];
  if (/_/.test(prop)) {
    words = prop.split("_");
  } else {
    words = prop.split(/(?=[A-Z])/);
  }
  if (words.length <= 1) return prop[0].toUpperCase() + prop.slice(1);

  let upperCaseWords: string[] = [];
  words.forEach((word, i) => {
    upperCaseWords[i] = word[0].toUpperCase() + word.slice(1);
    return;
  });

  return upperCaseWords.join(" ");
});
</script>

<template>
  <div>
    <div class="input-group mb-1">
      <span class="input-group-text">{{ formatName }}</span>
      <input
        class="form-control"
        :type="props.type"
        :id="props.propertyName"
        :value="modelValue"
        @input="
          $emit('update:modelValue', ($event.target as HTMLInputElement).value)
        "
      />
    </div>
    <base-form-error :name="props.propertyName" class="invalid-feedback" />
  </div>
</template>
