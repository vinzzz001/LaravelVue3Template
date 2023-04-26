<script setup lang="ts">
import { Note } from "domains/notes/types";
import { noteStore } from "domains/notes";
import { authStore } from "domains/auth";
import { ref, defineProps } from "vue";
import { ticketStore } from "domains/tickets";

const props = defineProps(["ticket"]);

//This is how to make an new empty object from a type.
const note = ref({} as Note);

const send = async () => {
  console.log("test");
  //current user
  note.value.user_id = authStore.getters.me?.value.id;
  note.value.ticket_id = props?.ticket.id;

  await noteStore.actions.create(note.value);
  ticketStore.actions.getById(note.value.ticket_id);
};
</script>

<template>
  <div>
    <h5 class="offcanvas-title" id="offcanvasRightLabel">New Note</h5>

    <form class="input-group">
      <textarea class="form-control text" v-model="note.content" />
      <input
        type="submit"
        class="btn btn-outline-primary"
        @click.prevent="send()"
      />
    </form>
  </div>
</template>
