<template>
 <div class="container">
   <div class="lead mt-3">
     <b-breadcrumb :items="items"></b-breadcrumb>
   </div>
   <div class="row">
     <div class="col-sm-5 card p-3">
       <div>
         <p class="mb-0">Patient Number</p>
         <strong>{{patient.patient_number}}</strong>
       </div>
       <div>
         <p class="mb-0">Name</p>
         <strong>{{patient.name}}</strong>
       </div>
       <div>
         <p class="mb-0">Email</p>
         <strong>{{patient.email}}</strong>
       </div>
       <div>
         <p class="mb-0">Phone</p>
         <strong>{{patient.phone}}</strong>
       </div>
       <div>
         <p class="mb-0">Residence</p>
         <strong>{{patient.residence}}</strong>
       </div>
       <hr>
       <patient-treatment :patient="patient" :title="'Check in Patient'"></patient-treatment>
     </div>
   </div>
 </div>
</template>

<script>
import PatientTreatment from "../../components/Patient/PatientTreatment.vue";
export default {
  name: "PatientView",
  components: {PatientTreatment},
  data() {
    return {
      patient: {},
      items: [
        {
          text: "Home",
          to: { name: "patients" }
        },
        {
          text: "Patients",
          to: { name: "patients" }
        },
        {
          text: this.$route.params.id
        }
      ]
    }
  },
  methods: {
    getPatient() {
      this.axios.get('/patients/' + this.$route.params.id)
        .then(response => {
          this.patient = response.data
        })
        .catch(error => {
          console.log(error)
        })
    }
  },
  mounted() {
    this.getPatient()
  }
}
</script>

<style scoped>

</style>
