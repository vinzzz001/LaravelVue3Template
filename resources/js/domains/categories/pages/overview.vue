<script setup lang="ts">
import { computed, ref, onMounted } from "vue";
import { categoryStore } from "domains/categories";
import baseFormError from "components/form/error.vue";
import { Category } from "../types";

// import alertMessage from "../../components/errors/alertMessage.vue";

const selectedCategory = ref<Category>();

categoryStore.actions.getAll();
const categories = categoryStore.getters.all;
const categoriesAlphabetical = computed(() => {
  //Make a sorted copy of the categories array.

  //slice(0) creates a copy.
  return categories.value.slice(0).sort((a, b) => {
    if (a.title < b.title) return -1;
    if (a.title > b.title) return 1;
    return 0;
  });
});

const alertPlaceholder = ref();
const alertApp = ref();
onMounted(() => {
  alertPlaceholder.value = document.getElementById("alert-container");
});

const alert = (message: string) => {
  if (alertApp.value) alertApp.value.unmount();

  // alertApp.value = createApp(alertMessage, { message: message });
  alertApp.value.mount(alertPlaceholder.value);
};

const categoryDelete = async (category: Category) => {
  if (category == null) return;
  try {
    await categoryStore.actions.delete(category);
  } catch (e: any) {
    alert(e.response.data.message || "test");
  }
};

const setSelectedCategory = (category: Category) => {
  selectedCategory.value = category;
};
</script>

<template>
  <h1>Categories Overview Page</h1>
  <base-form-error name="id" />

  <p>
    <router-link :to="{ name: 'category.create' }">Create Category</router-link>
  </p>

  <!-- Confirm Deletion Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <!-- Modal Header Text -->
          <h1 class="modal-title fs-5">
            Are you sure you want to delete this category?
          </h1>

          <!-- Modal Close (X) -->
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          />
        </div>

        <!-- Modal Body Text -->
        <div class="modal-body">
          <pre>{{ categories.find((x) => x.id === selectedCategory?.id) }}</pre>
        </div>

        <!-- Modal Cancel/Delete Buttons -->
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button
            type="button"
            class="btn btn-danger"
            @click="categoryDelete(selectedCategory)"
            data-bs-dismiss="modal"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Warning Message -->
  <div id="alert-container"></div>

  <!-- Category Overview Table -->
  <table v-if="categoriesAlphabetical" class="table justify-content-center">
    <thead class="table-primary">
      <tr>
        <th
          col-auto
          v-for="column in [
            'id',
            'title',
            'created_at',
            'updated_at',
            'actions',
          ]"
        >
          {{ column }}
        </th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="category in categoriesAlphabetical" key="category.id">
        <td class="col-1">
          <router-link
            :to="{
              name: 'category.edit',
              params: { id: category.id },
            }"
            >{{ category.id }}</router-link
          >
        </td>
        <td class="col-6">{{ category.title }}</td>

        <td class="col-1">{{ category.created_at.slice(0, 10) }}</td>
        <td class="col-1">{{ category.updated_at.slice(0, 10) }}</td>
        <td class="col-1">
          <b
            href=""
            @click="setSelectedCategory(category)"
            class="link-danger"
            data-bs-toggle="modal"
            data-bs-target="#exampleModal"
          >
            X
          </b>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<style inline></style>
