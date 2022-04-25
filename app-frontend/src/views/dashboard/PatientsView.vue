<template>
  <div class="container pt-3">
    <div class="mb-3" v-if="user.role === 'Receptionist'">
      <patient-modal @created="fetchPatients "/>
    </div>
    <div class="mb-3">
      <search-field @search="onSearch"/>
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
        <th scope="row">{{ patient.patient_number }}</th>
        <td>{{ patient.name }}</td>
        <td>{{ patient.email }}</td>
        <td>{{ patient.phone }}</td>
        <td>{{ patient.residence }}</td>
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
    <div>
      <b-pagination
          v-model="page"
          :total-rows="rows"
          :per-page="perPage"
          aria-controls="my-table"
          v-on:input="handleClick(page)"
      ></b-pagination>
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
      search: "",
      page: 1,
      perPage: 10,
      rows: 0,
      user: {}
    }
  },
  watch: {
    page() {
      this.fetchPatients();
    }
  },
  methods: {
    handleClick(page) {
      console.log(page);
      this.page = page;
      this.fetchPatients();
    },
    onSearch(search) {
      this.search = search;
      this.page = 1;
      this.fetchPatients();
    },
    fetchPatients() {
      this.axios.get('/patients?search=' + this.search + "&page=" + this.page).then(response => {
        this.patients = response.data;
        this.rows = response.data.total;
        this.perPage = response.data.per_page;
      });
    },
    fetchUser() {
      this.axios.get('/auth/user').then(response => {
        this.user = response.data;
      });
    }
  },
  mounted() {
    this.fetchPatients();
    this.fetchUser();
  }
}
</script>

<style scoped>

</style>
