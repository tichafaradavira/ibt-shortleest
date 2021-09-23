<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Billing </h2>
        <h3 class="subtitle-1 red--text">Incomplete Billing</h3>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
<!--        <loading-->
<!--            absolute="true"-->
<!--            class="mx-auto"-->
<!--            v-if="loading"-->
<!--            size="60"-->
<!--            :text="loadingMessage"-->
<!--            :color="loadingColor"-->
<!--        ></loading>-->
        <v-card   outlined>
<!--          <loading class="ma-4" v-if="loading" size="60"></loading>-->
          <v-card  class="" color="#EEEEEE" outlined>
              <v-progress-linear
                  v-if="loading"
                  indeterminate
                  :color="loadingColor"
              ></v-progress-linear>
              <div class="ma-2 d-flex justify-end">
              </div>
            <div class="ma-2 d-flex justify-end">
            </div>
              <v-row  v-if="resultText" >
                  <v-col cols="12">
                      <p class="red--text font-weight-bold">{{resultText}}</p>
                  </v-col>
              </v-row>
            <v-row class="ma-2 pa-2">
              <v-col class="d-flex  justify-center" cols="12">
                  <div>
                  <v-card
                      class="ma-4"
                      min-width="800"
                      max-width="800"
                      :key="index"
                  >
                      <v-card-title>
                      </v-card-title>
                      <v-card-text class="red--text">
                          <h2 class="ma-2"><v-icon class="red--text">mdi-credit-card-remove-outline</v-icon>Subscription payment not processed</h2>
                          <p class=""><span class="font-weight-bold">PLEASE NOTE:</span>  Charging you for the subscription was not succesful, therefore access has  been suspended</p>
                          <p class="">To continue using the service, please make sure there is sufficient funds to clear payment.</p>
                          <p class="">Apologies for the inconvinieance</p>
                      </v-card-text>
                  </v-card>
                  </div>
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
import AddressDetails from "../applications/components/AddressDetails";
import ProfileDetails from "./components/ProfileDetails";
import AccountDetails from "./components/AccountDetails";
import SettingsDetails from "./components/SettingsDetails";
export default {
  data() {
    return {
      show: false,
      deactivated: false,
      methods: null,
      loading: true,
      cardLoading: false,
      resultText: '',
      loadingMessage: "Loading your cards.",
      loadingColor: "red",

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
    resetSnackBar() {
      this.show = false;
    },
    editAccount(){
      this.$router.push({name:'profile-form'})
    },
      billingDetails(){
          this.$router.push({name:'billing-form'})
      }
  },

  mounted() {
       this.loading = false;
  }
};
</script>

