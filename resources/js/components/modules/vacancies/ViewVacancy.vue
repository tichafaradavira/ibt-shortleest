<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Rental Vacancy</h2>
        <h3 class="subtitle-1 blue-grey--text ">This represents a property that is available for rental.</h3>
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
            <v-card-title class="text--primary font-weight-bold h2">Vacancy Ref: <span class="font-weight-bold green--text"> {{ vacancy.reference }}</span></v-card-title>

            <v-row class="ma-2 pa-2">
              <v-col cols="6">
                <vacancy-details :vacancy="vacancy"></vacancy-details>
              </v-col>
              <v-col cols="6">
                <property-details :property="property"></property-details>

              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
              <v-col class="text-left ma-4">
                <h2 class="blue-grey--text font-weight-bold">Vacancy applications</h2>
                <h5 class="blue-grey--text font-weight-bold">These are the applications you reiceved for this vacancy</h5>
              </v-col>
            </v-row>
            <v-row class="ma-2 pa-2">
              <v-col cols="12">
                <v-tabs
                    v-model="tab"
                    background-color="primary"
                    dark
                >
                  <v-tab
                      :key="application_statuses.STATUS_PENDING"
                  >
                    Pending
                  </v-tab>
                  <v-tab
                      :key="application_statuses.STATUS_SHORTLISTED"
                  >
                    Shortlisted
                  </v-tab>
                  <v-tab
                      :key="application_statuses.STATUS_APPROVED"
                  >
                    Approved
                  </v-tab>
                  <v-tab
                      :key="application_statuses.STATUS_NOT_APPROVED"
                  >
                    Not Approved
                  </v-tab>
                </v-tabs>

                <v-tabs-items v-model="tab">
                  <v-tab-item
                      :key="application_statuses.STATUS_PENDING"
                  >
                    <vacancy-applications status-title="Pending applications" :key="Math.random()" :application="application_statuses.STATUS_PENDING" :vacancy="vacancy.id"/>
                  </v-tab-item>
                  <v-tab-item
                      :key="application_statuses.STATUS_SHORTLISTED"
                  >
                    <vacancy-applications status-title="Shortlisted applications" :key="Math.random()" :application="application_statuses.STATUS_SHORTLISTED" :vacancy="vacancy.id"/>
                  </v-tab-item>
                  <v-tab-item
                      :key="application_statuses.STATUS_APPROVED"
                  >
                    <vacancy-applications status-title="Approved applications" :key="Math.random()" :application="application_statuses.STATUS_APPROVED" :vacancy="vacancy.id"/>
                  </v-tab-item>
                  <v-tab-item
                      :key="application_statuses.STATUS_NOT_APPROVED"
                  >
                    <vacancy-applications status-title="Not approved applications" :key="Math.random()" :application="application_statuses.STATUS_NOT_APPROVED" :vacancy="vacancy.id"/>
                  </v-tab-item>
                </v-tabs-items>

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
import PropertyDetails from "../properties/components/PropertyDetails";
import VacancyDetails from "./components/VacancyDetails";
import VacancyApplications from "./components/VacancyApplications";

export default {
  data() {
    return {
      tab: null,
      show: false,
      vacancy: null,
      property: null,
      loading: true,
      course_id: null,
      loadingMessage: "Loading Vacancy...",
      loadingColor: "#2E86C1",
      application_statuses: {
        STATUS_PENDING: 1,
        STATUS_SHORTLISTED: 2,
        STATUS_APPROVED: 3,
        STATUS_NOT_APPROVED: 4,
      }

    };
  },
  components: {
    PropertyDetails,
    VacancyDetails,
    VacancyApplications,
    loading,
  },
  computed: {},

  methods: {
    getVacancy() {
      let result = this.$route.query.result;
      let id = this.$route.params.id;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`vacancies/${id}`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.vacancy = response.data;
            this.property = this.vacancy.property;
            this.loading = false;
          });
    },
    resetSnackBar() {
      this.show = false;
    }
  },

  mounted() {
    this.getVacancy();
  }
};
</script>

