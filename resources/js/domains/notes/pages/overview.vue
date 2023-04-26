<script setup lang="ts">
import { defineProps } from "vue";
import { userStore } from "domains/users";
import createNote from "./create.vue";
defineProps(["ticket"]);

const users = userStore.getters.all;
</script>

<template>
  <div v-if="ticket.notes != null">
    <!-- Toggle note sidebar button -->
    <button
      class="btn btn-primary"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasRight"
      aria-controls="offcanvasRight"
    >
      Toggle right offcanvas
    </button>

    <!-- Notes Side Canvas -->
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="offcanvasRight"
      aria-labelledby="offcanvasRightLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Notes</h5>

        <!-- Close [X] in top corner -->
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        />
      </div>

      <div class="offcanvas-body text-start">
        <!-- A single Note -->
        <div v-for="note in ticket.notes">
          <p class="fw-bold">
            {{ users.find((u) => u.id == note.user_id)?.full_name }}
          </p>
          <p>{{ note.content }}</p>
          <hr class="dashed" />
        </div>
      </div>

      <create-note :ticket="ticket"></create-note>
    </div>
  </div>
</template>
