<template>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Checkin number: {{record.check_in_number}} ({{record.status}})</h5>
      <div>
        <table class="table">
          <thead>
          <tr>
            <th scope="col">Department</th>
            <th scope="col">Medical Practitioner</th>
            <th scope="col">Notes</th>
            <th scope="col">Date</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="treatment in record.treatments" :key="treatment.id">
            <th scope="row">{{treatment.department.name}}</th>
            <td>{{treatment.medical_practitioner.name}}</td>
            <td>{{treatment.notes}}</td>
            <td>
              {{ moment(treatment.created_at).format("ddd MMM DD, YYYY [at] HH:mm a") }}
            </td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment'
export default {
  name: "TreatmentRecord",
  props: {
    record: {
      type: Object,
      required: true
    }
  },
  data(){
    return {
      moment: moment
    }
  }
}
</script>

<style scoped>

</style>
