<script setup lang="ts"></script>

<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="navbar-nav">
      <li class="nav-item">
        <router-link class="nav-link" :to="{ name: 'login' }"
          >Login
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" :to="{ name: 'ticket.overview' }">
          Ticket Overview
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" :to="{ name: 'category.overview' }">
          Category Overview
        </router-link>
      </li>
    </div>
  </nav>
</template>

<style scoped>
/* Underline the active link. Bootstrap auto applies the class. */
.router-link-active {
  text-decoration: underline;
}
</style>
