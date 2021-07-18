<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">{{ vacancy.id ? "Edit" : "Add" }} Vacancy</h2>
        <h3 class="subtitle-1 font-weight-bold">Add or Update vacancy.</h3>
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
        <v-card v-if="!loading">
          <loading class="ma-4" v-if="loading" size="60" :text="action" color="blue"></loading>

          <v-row v-if="errorMessage">
            <v-col class="mb-2">
              <span  class="red--text font-weight-bold">{{ errorMessage }}</span>
            </v-col>
          </v-row>
          <v-card v-if="!loading" outlined class="pa-4">
            <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
              <v-form class="text-left" @submit.prevent="handleSubmit(submitVacancy)">
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Vacancy Status"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-select
                          class="text-select"
                          :items="statuses"
                          v-model="vacancy.status"
                          item-text="text"
                          item-value="value"
                          filled
                          label="Vacancy Status"
                          outlined
                      ></v-select>
                      <span class="red--text font-weight-bold">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="available from date"
                        rules="required|date"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          outlined
                          label="Available from date"
                          placeholder="DD-MM-YYYY"
                          v-model="vacancy.available_from"
                          :error-messages="errors[0]"
                          hint="The date at which the property is available fro rental."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="vacancy reference"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          :disabled="disabled"
                          outlined
                          label="Vacancy reference"
                          placeholder="Vacancy reference"
                          v-model="vacancy.reference"
                          :error-messages="errors[0]"
                          hint="Vacancy reference"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <v-btn class="primary mr-2 " @click="submitVacancy">Submit</v-btn>
                <v-btn class="error mr-2" @click="cancel">Cancel</v-btn>
              </v-form>
            </ValidationObserver>
          </v-card>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>

import loading from "../general/loading";
import _pick from 'lodash/pick'
import {VACANCY_STATUS_ACTIVE,VACANCY_STATUS_EXPIRED} from "./constants";

export default {
  data() {
    return {
      vacancy: {
        id: null,
        status: VACANCY_STATUS_ACTIVE,
        available_from:'',
        reference:'',
        property: null
      },
      statuses:[
        {
          text: 'Active',
          value: VACANCY_STATUS_ACTIVE,
        },
        {
          text: 'Expired',
          value: VACANCY_STATUS_EXPIRED,
        }
      ],
      showDialog: false,
      loading: true,
      errorMessage: null,
      submitting: false,
      loadingMessage: "Preparing Form...",
      loadingColor: "#2E86C1",
      snackbar: false,
      snackMessage: "Done",
      snackColor: "#2E86C1",
    };
  },
  computed: {
    disabled: function (){
      if (this.id) {
        return true;
      } else {
        return false;
      }
    }
  },
  components: {
    loading
  },
  methods: {
    async submitVacancy() {
      const isValid = await this.$refs.observer.validate();

      if (isValid) {
        this.loadingMessage = "Saving vacancy...";
        this.loading = true;

        if (this.id) {
          this.saveVacancy();
        } else {
          this.addVacancy();
        }
      }
    },
    addVacancy() {
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/vacancies/add`,
          this.vacancy
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.vacancy = false;
            this.snackMessage = "Vacancy added";
            this.snackbar = true;
            this.snackColor = 'green';
            setTimeout(() => {
              this.$router.push(
                  {name: 'vacancies'}
              );
            }, 3000)

          }).catch(error=>{
            this.errorMessage = error.response.data;
            this.loading = false;
      });
    },
    saveVacancy() {
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/vacancies/${this.vacancy.id}/edit`,
          this.vacancy
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.vacancy = false;
            this.vacancy = response.data;

            this.snackMessage = "Vacancy saved";
            this.snackbar = true;
            this.snackColor = 'green';
            setTimeout(() => {
              this.$router.push(
                  {name: 'vacancies'}
              );
            }, 3000)
          });
    },
    getVacancy() {
      let result = this.$route.query.result;
      if (result === "saved") {
        this.show = true;
      }
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`/vacancies/${this.id}`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.vacancy = response.data;
            this.loading = false;
          });
    },
    initialise() {
      this.vacancy.property = this.$route.params.property;
      this.id = this.$route.params.id;
      if (this.id) {
        this.getVacancy(this.id);
      } else {
        this.loading = false;
      }
    },
    cancel() {
      this.$router.push({
            name: 'vacancies'
          }
      );
    }
  },
  mounted() {
    this.initialise();
  }
};
</script>

