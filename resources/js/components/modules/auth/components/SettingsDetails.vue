<template>
  <v-card class="pa-2" flat>
    <v-card-title class="font-weight-bold black--text">Settings</v-card-title>
    <v-card-subtitle class="font-weight-bold black--text text-left">Your settings</v-card-subtitle>
    <p><span class="body-2 text--secondary">Language</span><br> <span class="font-weight-bold black--text ">{{setting.language}}</span></p>
    <p><span class="body-2 text--secondary">Currency</span><br><span class="font-weight-bold black--text ">{{setting.currency}}</span></p>
  </v-card>
</template>
<script>
import DateFormat from "../../general/DateFormat";

export default {
  components: {},
  data() {
    return {};
  },
  props: {
    setting: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      default: "Setting"
    }
  }
};
</script>


