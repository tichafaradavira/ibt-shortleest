<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Profile</h2>
        <h3 class="subtitle-1 font-weight-bold">Update your account</h3>

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
        <v-snackbar
            v-model="snackbar"
            timeout="3000"
            :color="snackColor"
        >
          {{ snackMessage }}
        </v-snackbar>
        <v-card v-if="!loading" outlined class="pa-4">
          <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
            <v-form class="text-left" @submit.prevent="handleSubmit(submitProfile)">
              <v-card class="pa-4 ma-4" outlined>
                <v-card-title class="green--text">Profile Details</v-card-title>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="First name"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="First name"
                          placeholder="First name"
                          :error-messages="errors[0]"
                          v-model="profile.first_name"
                          hint="This is the first name of the profile."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Last name"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Last name"
                          placeholder="Last name"
                          :error-messages="errors[0]"
                          v-model="profile.last_name"
                          hint="Your last name."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Company name"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Company name"
                          placeholder="Company name"
                          v-model="profile.company_name"
                          :error-messages="errors[0]"
                          hint="The name of your company"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Phone number"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Phone number"
                          placeholder="Phone number"
                          :error-messages="errors[0]"
                          v-model="profile.phone_number"
                          hint="Your phone number."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <v-select outlined v-model="profile.country"  :items="countries" filled label="Country"></v-select>
                  </v-col>
                  <v-col cols="6">

                    <v-select v-model="profile.settings.currency"  outlined :items="currencies" filled label="Currency">
                      <template v-slot:item="{item}">
                        <div> <span v-html="item.text" /> - <span>{{item.currency}}</span> </div>
                      </template>
                      <template v-slot:selection="{item}">
                        <div> <span v-html="item.text" /> - <span>{{item.currency}}</span> </div>
                      </template>
                    </v-select>
                  </v-col>
                </v-row>
              </v-card>
              <v-btn class="primary mr-2 " @click="submitProfile">Submit</v-btn>
              <v-btn class="error mr-2" @click="cancel">Cancel</v-btn>
            </v-form>
          </ValidationObserver>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>

import loading from "../general/loading";
import _pick from 'lodash/pick'
import CountrySelect from "../general/CountrySelect";
import CurrencySelect from "../general/CurrencySelect";
import {CURRENCIES,COUNTRIES} from "./constants";

export default {
  data() {
    return {
      profile: {
        first_name: '',
        last_name: '',
        company_name: '',
        country: '',
        language: '',
        phone_number: '',
        settings:{
          language: '',
          currency: '',
        }
      },
      currencies: CURRENCIES,
      countries: COUNTRIES,
      showDialog: false,
      loading: true,
      submitting: false,
      loadingMessage: "Preparing Form...",
      loadingColor: "#2E86C1",
      snackbar: false,
      snackMessage: "Done",
      snackColor: "#2E86C1",
    };
  },
  computed: {},
  components: {
    loading
  },
  methods: {
    async submitProfile() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        this.loadingMessage = "Saving profile...";
        this.loading = true;
        this.saveProfile();

      }
    },
    saveProfile() {
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/users/realtor/edit/profile`,
          this.profile
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.profile = false;
            this.profile = response.data;

            this.snackMessage = "Profile saved";
            this.snackbar = true;
            this.snackColor = 'green';
            setTimeout(() => {
              this.$router.push(
                  {name: 'profile'}
              );
            }, 3000)
          });
    },
    getProfile() {
      let result = this.$route.query.result;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`/users/realtor/profile`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.profile = response.data;
            console.log(this.profile);
            this.loading = false;
          });
    },
    initialise() {
      this.getProfile();
    },
    cancel() {
      this.$router.push({
            name: 'profile'
          }
      );
    }
  },
  mounted() {
    this.initialise();
  }
};
</script>
<style>
.text-input input {
  color: #1A5276 !important;
  font-weight: bold;
}

.text-input textarea {
  color: #1A5276 !important;
  font-weight: bold;
}
</style>

