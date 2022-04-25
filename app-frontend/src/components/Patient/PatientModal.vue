<template>
  <div>
    <b-button class="btn-sm" @click="modalShow = !modalShow">New Patient</b-button>

    <b-modal v-model="modalShow" title="New Patient" :hide-footer="true">
      <b-form @submit.prevent="submit">
        <b-form-group
            id="input-group-1"
            label="Name:"
            label-for="input-1"
        >
          <b-form-input
              id="input-1"
              v-model="form.name"
              type="text"
              placeholder="Enter name"
              required
          ></b-form-input>
          <field-error v-if="errors.name" :error="errors.name[0]"></field-error>
        </b-form-group>
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
        <b-form-group
            id="input-group-1"
            label="Phone:"
            label-for="input-1"
        >
          <b-form-input
              id="input-1"
              v-model="form.phone"
              type="text"
              placeholder="Enter phone"
              required
          ></b-form-input>
          <field-error v-if="errors.phone" :error="errors.phone[0]"></field-error>
        </b-form-group>
        <b-form-group
            id="input-group-1"
            label="Residence:"
            label-for="input-1"
        >
          <b-form-input
              id="input-1"
              v-model="form.residence"
              type="text"
              placeholder="Enter residence"
              required
          ></b-form-input>
          <field-error v-if="errors.residence" :error="errors.residence[0]"></field-error>
        </b-form-group>
        <b-button :disabled="loading" type="submit">Submit</b-button>
      </b-form>
    </b-modal>
  </div>
</template>

<script>
import FieldError from "../../components/FieldError.vue";
export default {
  name: "PatientModal",
  components: {
    FieldError
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        residence: '',
      },
      errors: [],
      loading: false,
      modalShow: false
    }
  },
  methods: {
    submit() {
      this.loading = true;
      this.axios.post('patients', this.form)
        .then(() => {
          this.loading = false;
          this.modalShow = false;
          this.$emit('created');
          this.form = {}
        })
        .catch(resp => {
          this.loading = false;
          this.errors = resp.response.data.errors;
        });
    }
  }
}
</script>

<style scoped>

</style>
