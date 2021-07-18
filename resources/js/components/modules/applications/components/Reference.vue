<template>
  <v-card  class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Reference</v-card-title>
    <v-divider/>
    <p><span class="body-2 text--secondary">Full name:</span><br> <span class="font-weight-bold black--text ">{{reference.name}}</span></p>
    <p><span class="body-2 text--secondary">Phone:</span><br> <span class="font-weight-bold black--text ">{{reference.phone}}</span></p>
    <p><span class="body-2 text--secondary">Email:</span><br> <span class="font-weight-bold black--text ">{{reference.email}}</span></p>
    <p><span class="body-2 text--secondary">Address:</span><br> <span class="font-weight-bold black--text ">{{reference.address}}</span></p>
  </v-card>
</template>
<script>

export default {
  data() {
    return {};
  },
  props: {
    reference: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      default: "Reference"
    }
  }
};
</script>


