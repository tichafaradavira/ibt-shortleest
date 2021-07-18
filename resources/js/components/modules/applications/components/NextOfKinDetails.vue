<template>
  <v-card  class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Next of Kin Details</v-card-title>
    <v-divider/>
    <p><span class="body-2 text--secondary">Name</span><br> <span class="font-weight-bold black--text ">{{application.next_of_kin_name}}</span></p>
    <p><span class="body-2 text--secondary">Phone</span><br> <span class="font-weight-bold black--text ">{{application.next_of_kin_phone}}</span></p>
    <p><span class="body-2 text--secondary">Email</span><br> <span class="font-weight-bold black--text ">{{application.next_of_kin_email}}</span></p>
    <p><span class="body-2 text--secondary">Address</span><br><span class="font-weight-bold black--text ">{{application.next_of_kin_address}}</span></p>
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


