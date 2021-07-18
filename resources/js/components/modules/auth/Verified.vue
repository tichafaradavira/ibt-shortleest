<template>
  <v-content>
    <v-container class="fill-height">
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-alert v-if="message" type="success">{{message}}</v-alert>
          <v-card raised min-width="500px" class="p-2">
            <v-alert v-if="!loading && valid" type="success" class="mt-2 headline">
              Congratulations, Your email was succesfully verified and your account is now active.
              Login and start enjoying the benefits of an amazing platform.
            </v-alert>
            <v-alert
              v-if="!loading && expired"
              type="error"
              class="mt-2 headline"
            >Unfortunately, the verification was not successful because:{{reason}}</v-alert>

            <v-card-actions class="ml-2">
              <v-row v-if="!loading">
                <v-col>
                  <v-progress-circular :size="50" color="primary" indeterminate></v-progress-circular>
                </v-col>
              </v-row>

              <v-row v-if="!loading && valid">
                <v-col>
                  Go ahead and &nbsp
                  <router-link :to="{ name: 'signin' }">Log in</router-link>
                </v-col>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      reason: "Expired",
      expired: false,
      valid: false,
      loading: true
    };
  },
  computed: {},

  methods: {
    verifyEmail() {
      let id = this.$route.params.id;
      axios
        .get("http://127.0.0.1:8080/api/user/verify/email/" + id)
        .then(response => {
          let status = response.data.account_status_code;
          if (status == 600) {
            this.loading = false;
            this.valid = true;
          }
        });
    }
  },
  mounted() {
    this.verifyEmail();
  }
};
</script>

