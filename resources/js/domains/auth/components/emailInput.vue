<script setup lang="ts">
defineProps(["modelValue"]);
defineEmits(["update:modelValue"]);
</script>

<template>
  <div class="input-group">
    <label for="emailInput" class="input-group-text">Email</label>
    <input
      id="emailInput"
      class="form-control"
      type="text"
      name="email"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    />
  </div>
</template>
