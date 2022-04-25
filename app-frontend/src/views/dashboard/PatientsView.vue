<template>
  <div class="container pt-3">
    <div class="mb-3">
      <patient-modal @created="fetchPatients "/>
    </div>
    <div class="mb-3">
      <search-field/>
    </div>
    <table class="table">
      <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Residence</th>
        <th scope="col">More</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="patient in patients.data" :key="patient.id">
        <th scope="row">{{patient.patient_number}}</th>
        <td>{{patient.name}}</td>
        <td>{{patient.email}}</td>
        <td>{{patient.phone}}</td>
        <td>{{patient.residence}}</td>
        <td>
          <router-link :to="{name: 'patient', params: {id: patient.patient_number}}" class="btn btn-primary btn-sm">
            More
          </router-link>
        </td>
      </tr>
      </tbody>
    </table>
    <div v-if="patients.data && !patients.data.length" class="alert alert-warning" role="alert">
      No patients found.
    </div>
  </div>
</template>

<script>
import SearchField from "../../components/SearchField.vue";
import PatientModal from "../../components/Patient/PatientModal.vue";

export default {
  name: "PatientsView",
  components: {PatientModal, SearchField},
  data() {
    return {
      patients: {},
    }
  },
  methods: {
    fetchPatients() {
      this.axios.get('/patients').then(response => {
        this.patients = response.data;
      });
    },
  },
  mounted() {
    this.fetchPatients();
    console.log(this.$auth.user());
  }
}
</script>

<style scoped>

</style>
