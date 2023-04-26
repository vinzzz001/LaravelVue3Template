<script setup lang="ts">
import inputGroup from "components/form/inputGroup.vue";
import { defineProps, ref } from "vue";
import { deepCopy } from "../../../helpers/copy";
import { userStore } from "domains/users";
import { useRouter } from "vue-router";

const router = useRouter();
const props = defineProps(["user"]);

// const foo = { ...props.user };
const foo = ref(JSON.parse(JSON.stringify(props.user)));
// const foo = ref(deepCopy(props.user));

const editUser = async () => {
  await userStore.actions.update(foo.value.id, foo.value);
  router.push({ name: "user" });
};
</script>

<template>
  <div v-if="foo != null">
    <form class="form">
      <input-group propertyName="first_name" v-model="foo.first_name" />
      <input-group propertyName="last_name" v-model="foo.last_name" />
      <input-group propertyName="email" v-model="foo.email" type="email" />
      <input-group
        propertyName="phone number"
        v-model="foo.telephone_number"
        type="number"
      />

      <button class="btn btn-outline-primary" @click.prevent="editUser()">
        Submit
      </button>
    </form>
  </div>
</template>
