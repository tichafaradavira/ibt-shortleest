<template>
  <v-card  class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Employment Details</v-card-title>
    <v-divider/>
    <p><span class="body-2 text--secondary">Employer Name</span><br> <span class="font-weight-bold black--text ">{{application.employer_name}}</span></p>
    <p><span class="body-2 text--secondary">Gross Salary</span><br> <span class="font-weight-bold black--text">{{application.gross_salary}}</span></p>
    <p><span class="body-2 text--secondary">Employer Phone</span><br> <span class="font-weight-bold black--text">{{application.employer_phone}}</span></p>
    <p><span class="body-2 text--secondary">Employer Email</span><br> <span class="font-weight-bold black--text">{{application.employer_email}}</span></p>
    <p><span class="body-2 text--secondary">Employer Address</span><br> <span class="font-weight-bold black--text">{{application.employer_address}}</span></p>
  </v-card>
</template>
<script>

export default {
  data() {
    return {};
  },
  props: {
    application: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      default: "Application"
    }
  }
};
</script>


