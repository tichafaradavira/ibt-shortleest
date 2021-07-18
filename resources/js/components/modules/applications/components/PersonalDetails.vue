<template>
  <v-card  rounded flat>
    <v-card-title class=" blue-grey--text">
    Personal Details</v-card-title>
    <v-divider/>
    <v-row>
      <v-col cols="6">
        <p><span class="body-2 text--secondary">First Name</span><br> <span
            class="font-weight-bold black--text">{{ application.first_name }}</span></p>
        <p><span class="body-2 text--secondary">Middlename</span><br><span
            class="font-weight-bold black--text">{{ application.middle_name ? application.middle_name : '--' }}</span>
        </p>
        <p><span class="body-2 text--secondary">Last Name</span><br><span
            class="font-weight-bold black--text">{{ application.last_name ? application.last_name : '--' }}</span>
        </p>
        <p><span class="caption text--secondary">Date of Birth</span><br><span class="font-weight-bold black--text"><date-format
            :value="application.dob"/></span></p>
        <p><span class="body-2 text--secondary">Nationality</span><br><span
            class="font-weight-bold black--text">{{ application.nationality }}</span></p>

      </v-col>
      <v-col cols="6">
        <p><span class="body-2 text--secondary">Citizenship</span><br><span
            class="font-weight-bold black--text">{{ application.citizenship }}</span></p>

        <p><span class="caption text--secondary">National ID/SSN</span><br><span
            class="font-weight-bold black--text">{{ application.national_id }}</span></p>
        <p><span class="caption text--secondary">Gender</span><br><span
            class="font-weight-bold black--text">{{ application.gender }}</span></p>

      </v-col>
    </v-row>
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


