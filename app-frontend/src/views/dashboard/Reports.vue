<template>
 <div class="container">
   <div class="row">
     <div class="col-sm-4">
       <label>Search Patient</label>
       <input type="text" placeholder="Patient name" v-model="search" class="form-control">
     </div>
     <div class="col-sm-3">
       <label>Choose a date</label>
       <input type="date" v-model="date" class="form-control">
     </div>
     <div class="col-sm-3">
       <label>Choose a department</label>
       <b-form-group
           id="input-group-1"
           label-for="input-1"
       >
         <b-form-select required value-field="id" text-field="name" v-model="department" :options="departments"></b-form-select>
       </b-form-group>
     </div>
     <div class="col-sm-2">
       <label>Get</label>
       <div>
         <b-button @click="report" variant="outline-primary">Get</b-button>
       </div>
     </div>
   </div>
   <ul class="list-group">
     <li class="list-group-item" v-for="report in reports" :key="report.id">
       <h3>{{report.name}}</h3>
       <table class="table">
         <thead>
         <tr>
           <th scope="col">Department</th>
           <th scope="col">Medical Practitioner</th>
           <th scope="col">Notes</th>
           <th scope="col">DateTime</th>
         </tr>
         </thead>
         <tbody>
         <tr v-for="treatment in report.treatments" :key="report.id">
           <th scope="row">{{treatment.department.name}}</th>
           <td>{{treatment.medical_practitioner.name}}</td>
           <td>{{treatment.notes}}</td>
           <td>{{ moment(treatment.created_at).format("ddd MMM DD, YYYY [at] HH:mm a") }}</td>
         </tr>
         </tbody>
       </table>
     </li>
   </ul>
 </div>
</template>

<script>
import TreatmentRecord from "../../components/Patient/TreatmentRecord.vue";
import moment from 'moment'
export default {
  name: "Reports",
  components: {TreatmentRecord},
  data() {
    return {
      search: '',
      department: '',
      date: '',
      departments: [],
      reports: [],
      moment
    }
  },
  methods: {
    report(){
      this.axios.post('/reports', {
        search: this.search,
        department: this.department,
        date: this.date,
      }).then(response => {
        this.reports = response.data;
      });
    },
    getDepartments() {
      this.axios.get('/reports/departments').then(response => {
        this.departments = response.data;
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
