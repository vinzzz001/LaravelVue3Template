<script setup lang="ts">
import { ref } from "vue";
import { categoryStore } from "../../store/factory";
import { Category } from "../../types";
import { useRouter } from "vue-router";

const router = useRouter();

const newCategoryTitle = ref<string>("");

const categoryCreate = async (title: string) => {
  const category = <Category>{};
  category.title = title;

  await categoryStore.actions.create(category);
  router.push({ name: "category.overview" });
};
</script>

<template>
  <h1>Categories Create Page</h1>
  <form>
    <!-- Category Input -->
    <div class="form-floating">
      <input
        id="inputCategory"
        class="form-control"
        type="text"
        placeholder="Title"
        v-model="newCategoryTitle"
      />
      <label for="inputCategory">Category Title</label>
    </div>

    <!-- Submit -->
    <input
      type="submit"
      class="btn btn-outline-primary"
      @click.prevent="categoryCreate(newCategoryTitle)"
    />
  </form>
</template>

<style inline></style>
