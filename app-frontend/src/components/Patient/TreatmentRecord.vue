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
          </tr>
          </thead>
          <tbody>
          <tr v-for="treatment in record.treatments" :key="treatment.id">
            <th scope="row">{{treatment.department.name}}</th>
            <td>{{treatment.medical_practitioner.name}}</td>
            <td>{{treatment.notes}}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TreatmentRecord",
  props: {
    record: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
