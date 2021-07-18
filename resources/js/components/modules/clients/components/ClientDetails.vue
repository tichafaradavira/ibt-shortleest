<template>
  <v-card class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Client Details</v-card-title>
    <v-divider/>
    <div class="pa-2">
    <p><span class="body-2 text--secondary">Full name</span><br> <span class="font-weight-bold black--text ">{{client.full_name}}</span></p>
    <p><span class="body-2 text--secondary">Email</span><br><span class="font-weight-bold black--text ">{{client.email}}</span></p>
    <p><span class="body-2 text--secondary">Phone number</span><br><span class="font-weight-bold black--text ">{{client.phone_number}}</span></p>
    <p><span class="body-2 text--secondary">Description</span><br><span class="font-weight-bold black--text ">{{client.description ? client.description : "--:--"}}</span></p>
    </div>
  </v-card>
</template>
<script>

export default {
  data() {
    return {};
  },
  props: {
    client: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      default: "client"
    }
  }
};
</script>


