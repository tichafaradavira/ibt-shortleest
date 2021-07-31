<template>
  <v-card class="pa-2" flat>
    <v-card-title class="font-weight-bold black--text">Personal Information</v-card-title>
    <v-card-subtitle class=" text-left text-muted black--text">Basic information details</v-card-subtitle>
    <v-divider/>
    <div class="pa-2">
      <v-row>
        <v-col cols="6">
          <p><span class="body-2 text--secondary">Email</span><br> <span
              class="font-weight-bold black--text ">{{ profile.email }}</span></p>
          <p><span class="body-2 text--secondary">First Name</span><br> <span
              class="font-weight-bold black--text ">{{ profile.first_name }}</span></p>
          <p><span class="body-2 text--secondary">Last name</span><br><span
              class="font-weight-bold black--text ">{{ profile.last_name }}</span></p>
          <p><span class="body-2 text--secondary">Language</span><br><span
              class="font-weight-bold black--text ">English(More languages coming soon)</span></p>
        </v-col>
        <v-col cols="6">
          <p><span class="body-2 text--secondary">Company Name</span><br><span
              class="font-weight-bold black--text ">{{ profile.company_name ? profile.company_name : '--:--' }}</span>
          </p>
          <p><span class="body-2 text--secondary">My phone number</span><br><span class="font-weight-bold black--text ">{{
              profile.phone_number ? profile.phone_number : '--:--'
            }}</span>
          </p>
          <p><span class="body-2 text--secondary">Country</span><br><span
              class="font-weight-bold black--text ">{{ profile.country ? profile.country : '--:--' }}</span></p>

        </v-col>
      </v-row>
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


