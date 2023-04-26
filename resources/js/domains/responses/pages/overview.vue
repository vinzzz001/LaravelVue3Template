<script setup lang="ts">
import { ref, defineProps } from "vue";
import createResponse from "./create.vue";

import { userStore } from "domains/users";
import { responseStore } from "domains/responses";
import { authStore } from "domains/auth";

import type { Response } from "domains/responses/types";
import type { User } from "domains/users/types";

const props = defineProps(["ticket"]);

// Turning this in a deepcopy breaks the repsonses.
const users = userStore.getters.all;

const me = authStore.getters.me;
const isAdmin = me.value.is_admin;

const selectetEditListItem = ref(0); //Todo: Show only editable comments. (owner/admin)

/**
 * The color of the responses. The response uses bootstrap default colors:
 * default->White for owner, primary->Blue for the assigned user, light->slightly grayish-white for unkowns.
 * @param id The id of the owner of the response.
 */
const listItemClass = (id: number) => {
  const ticket = props.ticket;
  const color = ref("list-group-item-background");

  if (ticket.assigned_to == id) color.value = "list-group-item-secondary";
  else if (ticket.user_id == id) color.value = "list-group-item-primary";

  return color.value;
};

const updateResponse = async (response: Response) => {
  if (response == undefined) return;

  await responseStore.actions.updateResponse(response);
  selectetEditListItem.value = 0;
};
</script>

<template>
  <div>
    <ol class="list-group list-group-numbered">
      <!-- A single response -->
      <!-- //! This uses ticket.response instead of responses, since this needs to be reactive to ticket reloads. -->
      <li
        v-for="response in ticket.responses"
        class="list-group-item d-flex align-items-center text-start"
        :class="listItemClass(response.user_id)"
      >
        <!-- Response as normally displayed -->
        <div class="ms-2 me-auto">
          <div class="fw-bold">
            {{ users.find((u: User) => u.id == response.user_id)?.full_name }}
          </div>
          <div
            class="container-fluid"
            v-if="selectetEditListItem != response.id"
          >
            {{ response.content }}
          </div>
        </div>

        <!-- Editable input for responses -->
        <div class="input-group" v-if="selectetEditListItem == response.id">
          <textarea
            class="form-control"
            aria-label="with textarea"
            v-model="response.content"
            style="min-height: 150px"
          />

          <!-- The save and close buttons -->
          <div class="btn-group-vertical">
            <button
              class="btn btn-outline-variant btn-outline-primary attached-group-right"
              @click="updateResponse(response)"
            >
              Save
            </button>
            <button
              class="btn btn-outline-secondary attached-group-right"
              @click="selectetEditListItem = 0"
            >
              Close
            </button>
          </div>
        </div>

        <!-- Switch to edit link -->
        <a
          v-else
          v-if="isAdmin || me.id == response.user_id"
          class="link"
          style="align-self: end"
          @click="selectetEditListItem = response.id"
          >Edit</a
        >
      </li>
    </ol>

    <create-response />
  </div>
</template>

<style scoped lang="scss">
/* Ensures the corners of the save/close buttons nicely attach to the text area. */
.attached-group-right {
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
}
</style>
