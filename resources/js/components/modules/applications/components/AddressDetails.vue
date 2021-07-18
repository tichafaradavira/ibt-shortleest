<template>
  <v-card class="pa-2" flat>
    <v-card-title class=" blue-grey--text">{{ title }}</v-card-title>
    <v-divider/>
    <div class="pa-2">
      <label class=" black--text darken-4--text">{{ address.street }}</label><br>
      <label class=" black--text darken-4--text">{{ address.suburb }}</label><br>
      <label class=" black--text darken-4--text">{{ address.city }}</label><br>
      <label class=" black--text darken-4--text">{{ address.postcode }}</label><br>
    </div>

  </v-card>
</template>
<script>

export default {
  data() {
    return {};
  },
  props: {
    address: {
      type: Object,
      required: true
    },
    title: {
      type: String,
      default: "Address"
    }
  }
};
</script>


