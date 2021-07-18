<template>
  <v-card class="pa-2" flat>
    <v-card-title class="font-weight-bold black--text">Account Information</v-card-title>
    <v-card-subtitle class=" text-left text-muted black--text">Information about your account</v-card-subtitle>
    <v-divider/>
    <div class="pa-2">
    <p><span class="body-2 text--secondary">Account created</span><br> <span class="font-weight-bold black--text "><date-time-format :value="profile.created_at"/></span></p>
    <p><span class="body-2 text--secondary">Email verfied</span><br> <span class="font-weight-bold black--text "><date-time-format :value="profile.email_verified_at"/></span></p>
    <p><span class="body-2 text--secondary">Last updated at</span><br> <span class="font-weight-bold black--text "><date-time-format :value="profile.updated_at"/></span></p>
    </div>
  </v-card>
</template>
<script>
import DateFormat from "../../general/DateFormat";
import DateTimeFormat from "../../general/DateTimeFormat";
export default {
  components: {DateTimeFormat},
  data() {
    return {};
  },
  props: {
    profile: {
      type: Object,
      required: true
    },
    name: {
      type: String,
      default: "Profile"
    }
  }
};
</script>


