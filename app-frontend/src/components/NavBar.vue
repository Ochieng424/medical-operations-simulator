<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <router-link :to="{name: 'patients'}" class="navbar-brand" href="#">CollabMed</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <router-link :to="{name: 'patients'}" class="nav-link active" aria-current="page" href="#">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link :to="{name: 'reports'}" class="nav-link" href="#">Reports</router-link>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="$auth.logout()">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "NavBar"
}
</script>

<style scoped>

</style>
