<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">My Account</h2>
        <h3 class="subtitle-1">Manage your information and settings.</h3>
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
        <v-card  v-if="!loading" outlined>
          <loading class="ma-4" v-if="loading" size="60"></loading>
          <v-card v-if="!loading" class="" color="#EEEEEE" outlined>
            <div class="ma-2 d-flex justify-end">
                <v-btn
                    class="ma-1 white--text"
                    color="red"
                    @click="deactivateAccount"
                >
                    <v-icon>
                        mdi-close-octagon
                    </v-icon>
                    Deactivate Account
                </v-btn>
              <v-btn
                  class="ma-1 white--text"
                  color="blue"
                  @click="editAccount"
              >
                <v-icon>
                  mdi-pencil
                </v-icon>
                Edit My Profile
              </v-btn>

            </div>
              <v-row v-if="deactivated" class="ma-2 pa-2">
                  <v-col cols="12">
                      <v-alert
                          text
                          prominent
                          type="error"
                          icon="mdi-cloud-alert"
                      >
                          Account deactivated.You can still login  to your account within 30 days.
                      </v-alert>
                  </v-col>
              </v-row>
            <v-row class="ma-2 pa-2">
              <v-col cols="12">
                <profile-details  :profile="profile"></profile-details>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col cols="12">
                <account-details  :profile="profile"></account-details>
              </v-col>
            </v-row>
            <v-divider></v-divider>
<!--            <v-row class="ma-2 pa-2">-->
<!--              <v-col cols="12">-->
<!--                <settings-details  :setting="profile.settings"></settings-details>-->
<!--              </v-col>-->
<!--            </v-row>-->

          </v-card>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import loading from "../general/loading";
import AddressDetails from "../applications/components/AddressDetails";
import ProfileDetails from "./components/ProfileDetails";
import AccountDetails from "./components/AccountDetails";
import SettingsDetails from "./components/SettingsDetails";
export default {
  data() {
    return {
      show: false,
      deactivated: false,
      profile: null,
      loading: true,
      loadingMessage: "Loading Profile...",
      loadingColor: "#2E86C1",

    };
  },
  components: {
    AccountDetails,
    ProfileDetails,
    SettingsDetails,
    loading,
  },
  computed:{
  },

  methods: {
    getProfile() {
      let result = this.$route.query.result;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`/users/realtor/profile`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.profile = response.data;
            this.loading = false;
          });
    },
      async deactivateAccount() {
          this.loading = true;
          this.loadingColor = "red";
          this.loadingMessage = "Deactivating Account";
          let token = localStorage.getItem("token");
          await this.$axios.post(
              `/users/realtor/deactivate`,
              {},
              {
                  headers: {Authorization: `Bearer ${token}`},
              }
          )
              .then(response => {
                  this.loading = false;
                  this.deactivated = true;
                  setTimeout(() => {
                      this.$router.push({name:'home'})
                  }, 4000)

              }).finally(() => {
              });
      },
    resetSnackBar() {
      this.show = false;
    },
    editAccount(){
      this.$router.push({name:'profile-form'})
    }
  },

  mounted() {
    this.getProfile();
  }
};
</script>

