<template>
  <div>
    <b-button @click="modalShow = !modalShow" variant="primary">{{title}}</b-button>

    <b-modal v-model="modalShow" :title="title" :hide-footer="true">
      <b-form @submit.prevent="submit">
        <b-form-group
            id="input-group-1"
            label="Notes:"
            label-for="input-1"
        >
        <b-form-textarea
            id="textarea"
            v-model="form.notes"
            placeholder="Enter notes"
            rows="3"
            max-rows="6"
        ></b-form-textarea>
        <field-error v-if="errors.notes" :error="errors.notes[0]"></field-error>
        </b-form-group>
        <b-form-group label="Options" v-slot="{ ariaDescribedby }">
          <b-form-radio v-model="form.type" :aria-describedby="ariaDescribedby" name="some-radios" value="A">Refer to department</b-form-radio>
          <b-form-radio v-model="form.type" :aria-describedby="ariaDescribedby" name="some-radios" value="B">Close off treatment</b-form-radio>
        </b-form-group>
        <b-form-group
            id="input-group-1"
            label="Refer to department:"
            label-for="input-1"
            v-if="form.type === 'A'"
        >
          <b-form-select required value-field="id" text-field="name" v-model="form.department_id" :options="departments"></b-form-select>
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
  name: "PatientTreatment",
  components: {
    FieldError
  },
  props: {
    patient: {
      type: Object,
      required: true
    },
    title: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      form: {
        patient_id: '',
        department_id: '',
        notes: '',
        type: 'A',
      },
      departments: [],
      errors: [],
      loading: false,
      modalShow: false
    }
  },
  methods: {
    getDepartments() {
      this.axios.get('/departments')
        .then(response => {
          this.departments = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    submit() {
      this.form.patient_id = this.patient.id;
      this.axios.post('/treatment/checkin', this.form)
        .then(response => {
          this.modalShow = false;
          this.form.notes = '';
          this.form.department_id = '';
          this.$emit('treatment-added');
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  },
  mounted() {
    this.getDepartments();
  }
}
</script>

<style scoped>

</style>
