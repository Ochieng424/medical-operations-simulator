<template>
  <div class="container">
    <div class="row d-flex aligns-items-center justify-content-center">
      <div class="col-md-6 col-md-offset-3 mt-5">
        <b-card
            header-tag="header"
            title="Login"
        >
        <b-card-body>
          <b-form @submit.prevent="login" aria-autocomplete="none">
            <b-form-group
                id="input-group-1"
                label="Email address:"
                label-for="input-1"
            >
              <b-form-input
                  id="input-1"
                  v-model="form.email"
                  type="email"
                  placeholder="Enter email"
                  required
              ></b-form-input>
              <field-error v-if="errors.email" :error="errors.email[0]"></field-error>
            </b-form-group>

            <b-form-group id="input-group-2" label="Password:" label-for="input-2">
              <b-form-input
                  id="input-2"
                  v-model="form.password"
                  placeholder="Enter password"
                  required
                  type="password"
              ></b-form-input>
              <field-error v-if="errors.password" :error="errors.password[0]"></field-error>
            </b-form-group>

            <b-button :disabled="loading" type="submit" variant="primary">Submit</b-button>
          </b-form>
        </b-card-body>
        </b-card>
      </div>
    </div>
  </div>
</template>

<script>
import FieldError from "../../components/FieldError.vue";
export default {
  name: "LoginView",
  components: {FieldError},
  data () {
    return {
      form: {
        email: "",
        password: ""
      },
      loading: false,
      errors: []
    }
  },
  methods: {
    login() {
      this.loading = true;
      this.$auth.login({
        data: this.form,
        redirect: {name: 'patients'},
        staySignedIn: true,
        fetchUser: true,
      }).catch(resp => {
        this.errors = resp.response.data.errors;
        this.loading = false;
      });
    }
  }
}
</script>

<style scoped>

</style>
