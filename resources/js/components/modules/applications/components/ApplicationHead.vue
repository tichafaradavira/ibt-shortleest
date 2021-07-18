<template>
  <v-card rounded   flat>
    <div class="pa-2 border-primary">
    <p class=" blue-grey--text">
      <span class="font-weight-bold black--text">{{`${property.physical_address_street}, ${property.physical_address_surburb},${property.physical_address_city},${property.physical_address_postcode}`}}</span></p>

      <p class="font-weight-bold  black--text">Price:  <span class="green--text font-weight-bold">${{property.rental_price}}</span></p>
    </div>
  </v-card>
</template>
<script>

export default {
  data() {
    return {};
  },
  props: {
    property: {
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



