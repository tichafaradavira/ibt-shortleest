<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold ">User</h2>
        <h3 class="subtitle-1 ">Property owner details</h3>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <loading
            absolute="true"
            class="mx-auto"
            v-if="loading"
            size="60"
            :text="loadingMessage"
            :color="loadingColor"
        ></loading>
        <v-card v-if="!loading" outlined>
          <loading class="ma-4" v-if="loading" size="60"></loading>
          <v-card v-if="!loading" class="" color="#EEEEEE" outlined>
            <v-card-title class="text--primary h2"User</v-card-title>

              <v-row class="ma-2 pa-2">
                  <v-col cols="12">
                      <profile-details  :profile="user"></profile-details>
                  </v-col>
              </v-row>
              <v-divider></v-divider>
              <v-row class="ma-2 pa-2">
                  <v-col cols="12">
                      <account-details  :profile="user"></account-details>
                  </v-col>
              </v-row>
          </v-card>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import loading from "../general/loading";
import ProfileDetails from "./components/ProfileDetails";
import AccountDetails from "./components/AccountDetails";
export default {
  data() {
    return {
      show: false,
      user: null,
      loading: true,
      course_id:null,
      loadingMessage: "Loading User...",
      loadingColor: "#2E86C1",

    };
  },
  components: {
      AccountDetails,
      ProfileDetails,
      loading,
  },
  methods: {
    getUser() {
      let result = this.$route.query.result;
      let id = this.$route.params.id;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`/admin/users/${id}`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.user = response.data;
            this.loading = false;
          });
    },
    resetSnackBar() {
      this.show = false;
    }
  },

  mounted() {
    this.getUser();
  }
};
</script>

