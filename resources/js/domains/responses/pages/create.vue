<script setup lang="ts">
import { ref } from "vue";
import { useRoute } from "vue-router";
import { responseStore } from "domains/responses";
import { authStore } from "domains/auth";
import type { Response } from "domains/responses/types";
import baseFormError from "components/form/error.vue";
import { ticketStore } from "domains/tickets";

const newResponseContent = ref<string>("");

const route = ref(useRoute()).value;
const ticketId: number = parseInt(<string>route?.params.id) || 0;
const me = authStore.getters.me;

const submitResponse = async (content: string) => {
  const response = <Response>{};
  response.content = content;
  response.ticket_id = ticketId;
  response.user_id = me.value.id;

  if (!response) return;
  await responseStore.actions.createResponse(response);
  ticketStore.actions.getById(ticketId); //Reload the ticket with responses

  newResponseContent.value = "";
};
</script>

<template>
  <div v-if="me.id > 0">
    <h1>Create Response</h1>
    <div id="responseInputGroup" class="input-group">
      <span class="input-group-text">Response</span>
      <textarea
        id="newResponseContent"
        class="form-control"
        placeholder="Fill out response here."
        v-model="newResponseContent"
      />
      <button
        type="submit"
        class="btn btn-outline-primary"
        @click="submitResponse(newResponseContent)"
      >
        Submit
      </button>
    </div>
  </div>
  <base-form-error name="content" />

  <!-- //todo: remove this whitespacing. -->
  <br /><br /><br />
</template>

<style>
#responseInputGroup {
  min-height: 200px;
}
</style>
