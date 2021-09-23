<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Billing </h2>
        <h3 class="subtitle-1">Manage your billing details.</h3>
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
                  <v-btn
                      class="ma-1 white--text"
                      color="green"
                      @click="addCard"
                  >
                      <v-icon class="ma-2">
                          mdi-credit-card-plus
                      </v-icon>
                      Add Card
                  </v-btn>
                  <v-btn
                      class="ma-1 white--text"
                      color="orange"
                      @click="getMethods"
                  >
                      <v-icon class="ma-2">
                          mdi-credit-card-refresh
                      </v-icon>
                      Refresh
                  </v-btn>
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
                      v-if="methods && methods.length"
                      v-for="( method, index) in methods"
                      class="ma-4"
                      min-width="800"
                      max-width="800"
                      :key="index"
                  >
                      <v-card-title>
                          <div><v-icon class="blue--text">mdi-credit-card</v-icon>Payment method
                              <v-chip
                                  v-if="method.default"
                                  class="ma-2"
                                  color="primary"
                              >
                                  Default
                              </v-chip>

                          </div>
                      </v-card-title>
                      <v-card-text>

                          <div class="text--primary text-capitalize ">
                              {{`${method.brand}`}} card ending in
                          </div>
                          <p class="text-h4 text--primary ma-4">
                              {{`*****${method.last_four}`}}
                          </p>
                          <p>Expiring  {{`${method.exp_month}/${method.exp_year}`}}</p>
                      </v-card-text>
                      <v-card-actions>
                          <v-btn color="warning" v-if="!method.default" @click="()=>makeDefault(method.id)" >
                              Make default
                          </v-btn>
                          <v-btn color="red" class="white--text"  @click="()=>removeCard(method.id)" >
                              <v-icon class="ma-2">mdi-credit-card-minus</v-icon>
                                Remove card
                          </v-btn>
                      </v-card-actions>

                  </v-card>
                      <p class="red--text font-weight-bold" v-if="methods && !methods.length">
                          <v-icon class="ma-2">mdi-credit-card-search-outline</v-icon>You currently do not have any payment method
                      </p>
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
    getMethods() {
      let result = this.$route.query.result;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`/users/payment-methods`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.methods = response.data;
              this.resultText = null;
              this.loading = false;
          });
    },
      addCard(){
          this.$router.push({name:'billing-form'})
      },
      makeDefault(id) {
          let result = this.$route.query.result;
          this.loading = true;
          let token = localStorage.getItem("token");
          this.$axios.post(`/users/change-default-payment`,
              {
                  id: id
              }
              ,{
              headers: {Authorization: `Bearer ${token}`}
          })
              .then(response => {
                  this.getMethods();
              });
      },
      removeCard(id) {
          window.scrollTo(0, 0);
          this.loading = true;
          this.loadingColor = "red";
          this.loadingMessage = "Remove Card";
          let token = localStorage.getItem("token");
          this.$axios.post(`/users/remove-card`,
              {
                  id: id
              }
              ,{
                  headers: {Authorization: `Bearer ${token}`}
              })
              .then(response => {
                  this.resultText = response.data;
                  this.getMethods();
              }).catch(error => {
              this.resultText = error.response.data;
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
    },
      billingDetails(){
          this.$router.push({name:'billing-form'})
      }
  },

  mounted() {
    this.getMethods();
  }
};
</script>

