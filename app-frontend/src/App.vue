<script setup>
import {RouterView} from 'vue-router'
import NavBar from "./components/NavBar.vue";
</script>

<template>
  <nav-bar v-if="$auth.check()" />
  <div style="min-height: 90vh;">
    <RouterView />
  </div>
  <hr>
  <p class="text-center">
    Collabmed
  </p>
</template>
