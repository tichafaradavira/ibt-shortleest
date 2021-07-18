<template>
  <v-card class="pa-2" flat>
    <v-card-title class=" blue-grey--text">Property Details</v-card-title>
    <v-divider/>
    <div class="pa-2">
    <p><span class="body-2 text--secondary">Property Type</span><br><span class="font-weight-bold black--text ">{{property.property_type}}</span></p>
    <p><span class="body-2 text--secondary">Area(sq meteres)</span><br><span class="font-weight-bold black--text ">{{property.area ? property.area : "--:--"}}</span></p>
    <p><span class="body-2 text--secondary">Rental Price</span><br><span class="font-weight-bold black--text">${{property.rental_price}}</span></p>
    <p><span class="body-2 text--secondary">Description</span><br><span class="font-weight-bold black--text ">{{property.description ? property.description : "--:--"}}</span></p>
    </div>
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
    property: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      default: "Property"
    }
  }
};
</script>


