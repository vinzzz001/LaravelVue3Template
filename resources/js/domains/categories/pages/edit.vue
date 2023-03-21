<script setup lang="ts">
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { categoryStore } from "domains/categories";

const route = useRoute();
const router = useRouter();

const categoryId: number = parseInt(route.params.id);

categoryStore.actions.getById(categoryId);
const category = categoryStore.getters.byId(categoryId);

const newCategoryTitle = ref("");

const categoryUpdate = () => {
  if (!newCategoryTitle.value) return; //No sense in updating if nothing changed.

  let item = { ...category.value };
  item.title = newCategoryTitle.value;

  categoryStore.actions.update(item.id, item);
  router.push({ name: "category.overview" });
};
</script>

<template>
  <h1>Categories Edit Page</h1>
  <table class="table" v-if="category">
    <thead class="table table-primary">
      <tr>
        <th
          col-auto
          v-for="column in ['id', 'title', 'created_at', 'updated_at']"
        >
          {{ column }}
        </th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td>
          <router-link
            :to="{ name: 'category.edit', params: { id: category.id } }"
          >
            {{ category.id }}
          </router-link>
        </td>

        <td>
          <input
            id="title"
            class="input"
            type="text"
            name="title"
            :value="category.title"
            @input="(event) => (newCategoryTitle = event.target.value)"
          />
        </td>

        <td>{{ category.created_at.slice(0, 10) }}</td>
        <td>{{ category.updated_at.slice(0, 10) }}</td>
      </tr>

      <td>
        <button
          class="btn btn-outline-primary"
          type="submit"
          @click="categoryUpdate()"
        >
          Submit
        </button>
      </td>
    </tbody>
  </table>
</template>
<style inline></style>
