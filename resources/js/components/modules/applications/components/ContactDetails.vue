<template>
  <v-card class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Contact Details</v-card-title>
    <v-divider/>
    <p><span class="body-2 text--secondary mt-2">Mobile number</span><br> <span class="font-weight-bold black--text darken-4--text">{{application.mobile_number}}</span></p>
    <p><span class="body-2 text--secondary">Home Number</span><br><span class="font-weight-bold black--text darken-4--text">{{application.home_number ? application.home_number: '--'}}</span></p>
    <p><span class="body-2 text--secondary">Work Number</span><br><span class="font-weight-bold black--text darken-4--text">{{application.work_number ? application.work_number : '--'}}</span></p>
    <p><span class="body-2 text--secondary">Email</span><br><span class="font-weight-bold black--text darken-4--text">{{application.email ?application.email: '--' }}</span></p>
    <p><span class="body-2 text--secondary">Fax</span><br><span class="font-weight-bold black--text darken-4--text">{{application.fax ? application.fax : "--:--"}}</span></p>
  </v-card>
</template>
<script>
import DateFormat from "../../general/DateFormat";

export default {
  components: {DateFormat},
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


