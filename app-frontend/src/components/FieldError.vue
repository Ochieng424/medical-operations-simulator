<template>
  <small style="color: red">{{error}}</small>
</template>

<script>
export default {
  name: "FieldError",
  props: {
    error: {
      type: String,
      required: false,
      default: ""
    }
  },
}
</script>

<style scoped>

</style>
