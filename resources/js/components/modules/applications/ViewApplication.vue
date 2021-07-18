<template>
  <v-container class="ma-0 ">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Rental Application</h2>
        <p v-if="!loading"><span class="green--text">Application Submitted:</span> <date-format :value="application.created_at"/></p>
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
          <v-card class="pa-2" color="#EEEEEE" v-if="!loading" outlined>
<!--            <v-card-title class="text&#45;&#45;primary "><span class="blue&#45;&#45;text">{{ `  ${application.first_name} ${application.last_name}, ${application.email}` }}</span></v-card-title>-->
            <v-row class="ma-2">
              <v-col cols="12" class="d-flex justify-lg-space-between">
              </v-col>
            </v-row>
            <v-row class="ma-2">
              <v-col cols="12" class="d-flex justify-lg-space-between">
                <h2><span class="green--text">Application Status:</span> {{ application.application_status }}</h2>
                <v-dialog
                    v-model="dialog"
                    persistent
                    max-width="290"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        color="primary"
                        dark
                        v-bind="attrs"
                        v-on="on"
                    >
                      <v-icon class="mr-1">mdi-pencil</v-icon>
                      Edit Status
                    </v-btn>
                  </template>
                  <v-card color="white">
                    <v-card-title class="text-h5">
                      Edit Status
                    </v-card-title>
                    <v-card-text class="pa-2">
                      <v-select
                          class="text-select"
                          :items="statuses"
                          v-model="application.status"
                          item-text="text"
                          item-value="value"
                          filled
                          label="Application status"
                          outlined
                      ></v-select>
                    </v-card-text>
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn
                          color="red darken-1"
                          text
                          @click="dialog = false"
                      >
                        Cancel
                      </v-btn>
                      <v-btn
                          color="green darken-1"
                          text
                          @click="changeStatus"
                      >
                        OK
                      </v-btn>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col cols="6">
                <personal-details :application="application"></personal-details>
              </v-col>
              <v-col cols="6">
                <contact-details :application="application"></contact-details>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col cols="6">
                <address-details title="Physical Address" :address="physical_address"></address-details>
              </v-col>
              <v-col cols="6">
                <address-details title="Postal Address" :address="postal_address"></address-details>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col cols="6">
                <employer :application="application"></employer>
              </v-col>
              <v-col cols="6">
                <next-of-kin-details :application="application"></next-of-kin-details>

              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col v-for="(reference,index) in application.references" :key="index" cols="6">
                <reference :reference="reference"></reference>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col cols="6">
                <expenses :application="application"></expenses>
              </v-col>
              <v-col cols="6">
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
import PersonalDetails from "./components/PersonalDetails";
import ContactDetails from "./components/ContactDetails";
import AddressDetails from "./components/AddressDetails";
import Employer from "./components/Employer";
import Vacancy from "./components/Vacancy";
import NextOfKinDetails from "./components/NextOfKinDetails";
import Reference from "./components/Reference";
import Expenses from "./components/Expense";
import {
  APPLICATION_STATUS_APPROVED, APPLICATION_STATUS_NOT_APPROVED,
  APPLICATION_STATUS_PENDING, APPLICATION_STATUS_SHORTLISTED,
  VACANCY_STATUS_ACTIVE,
  VACANCY_STATUS_EXPIRED,
  VACANCY_STATUS_PENDING
} from "../vacancies/constants";
import DateFormat from "../general/DateFormat";

export default {
  data() {
    return {
      dialog: false,
      show: false,
      application: null,
      loading: true,
      loadingMessage: "Loading application.",
      loadingColor: '#2E86C1',
      statuses:[
        {
          text: 'Pending',
          value: APPLICATION_STATUS_PENDING,
        },
        {
          text: 'Shortlisted',
          value: APPLICATION_STATUS_SHORTLISTED,
        },
        {
          text: 'Approved',
          value: APPLICATION_STATUS_APPROVED,
        },
        {
          text: 'Not Approved',
          value: APPLICATION_STATUS_NOT_APPROVED,
        }
      ],
    };
  },
  components: {
    DateFormat,
    PersonalDetails,
    ContactDetails,
    AddressDetails,
    NextOfKinDetails,
    Reference,
    Employer,
    Vacancy,
    Expenses,
    loading,
  },
  computed: {
    physical_address: function () {
      return {
        street: this.application.physical_address_street,
        suburb: this.application.physical_address_surburb,
        city: this.application.physical_address_city,
        postcode: this.application.physical_address_postcode,
      }
    },
    postal_address: function () {
      if (this.application.postal_equal_to_physical) {
        return this.physical_address;
      }
      return {
        street: this.application.postal_address_street,
        suburb: this.application.postal_address_surburb,
        city: this.application.postal_address_city,
        postcode: this.application.postal_address_postcode,
      }
    }
  },
  methods: {
    getApplication() {
      let result = this.$route.query.result;

      if (result === "saved") {
        this.show = true;
      }
      let id = this.$route.params.id;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get("/applications/" + id, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.application = response.data;
            this.loading = false;
          });
    },
    changeStatus(){
      this.dialog = false;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/applications/${this.application.id}/status/edit`,
          {
            status: this.application.status
          }
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.getApplication()
          });
    },
    showFilter() {
      this.filter = !this.filter;
    },
    searchSomething() {
    },
    resetSnackBar() {
      this.show = false;
    }
  },

  mounted() {
    this.getApplication();
  }
};
</script>

