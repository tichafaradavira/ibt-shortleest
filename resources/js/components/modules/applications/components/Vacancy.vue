<template>
  <v-card class="pa-2" flat>
    <v-card-title class="font-weight-bold blue-grey--text">Vacancy</v-card-title>
    <p><span class="body-2 text--secondary">Status</span><br><span class="font-weight-bold black--text ">Active</span></p>
    <p><span class="body-2 text--secondary">Available from</span><br> <span class="font-weight-bold black--text "><date-format :value="application.available_from" /></span></p>
    <p><span class="body-2 text--secondary">Vacancy link</span><br><a class="font-weight-bold black--text " :href="application.link" target="_blank">Application Link</a></p>
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


