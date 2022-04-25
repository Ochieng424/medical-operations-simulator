<template>
  <div class="row g-3">
    <div class="col-sm-10">
      <input v-model="search" type="text" class="form-control" placeholder="Search by name, phone or email">
    </div>
    <div class="col-sm">
      <button @click="onSearch" type="button" class="btn btn-primary">Search</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchField",
  data() {
    return {
      search: ''
    }
  },
  methods: {
    onSearch() {
      this.$emit('search', this.search)
    }
  }
}
</script>

<style scoped>

</style>
