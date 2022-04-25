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
     </div>
     <div class="col-sm-7 card p-3">
       <patient-treatment :patient="patient" :title="'Check in Patient - Receptionist'"></patient-treatment>
       <hr>
       <patient-treatment :patient="patient" :title="'Findings and notes'"></patient-treatment>
     </div>
   </div>
   <div class="mt-3" v-if="fetched">
     <treatment-record :record="patient.current_check_in"></treatment-record>
   </div>
 </div>
</template>

<script>
import PatientTreatment from "../../components/Patient/PatientTreatment.vue";
import TreatmentRecord from "../../components/Patient/TreatmentRecord.vue";
export default {
  name: "PatientView",
  components: {TreatmentRecord, PatientTreatment},
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
      ],
      fetched: false
    }
  },
  methods: {
    getPatient() {
      this.axios.get('/patients/' + this.$route.params.id)
        .then(response => {
          this.patient = response.data
          this.fetched = true
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
