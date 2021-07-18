<template>
  <v-container class="ma-0">
    <v-row>
      <v-col class="text-left ma-2">
        <h3 class="black--text">{{statusTitle}}</h3>
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

        <v-card v-if="!loading" class="pa-1">
          <div class="ma-2 d-flex justify-end">
            <v-btn
                class="ma-1"
                color="primary"
                @click="loadApplications"
            >
              <v-icon class="font-weight-bold">mdi-reload</v-icon>
            </v-btn>
          </div>
          <v-spacer></v-spacer>
          <!-- Data Table -->
          <v-card class="" outlined>
            <v-row align-center justify-center class="pa-2">
              <v-col>
                <loading
                    absolute="true"
                    class="mx-auto"
                    v-if="loading"
                    size="60"
                    :text="loadingMessage"
                    :color="loadingColor"
                ></loading>
                <v-simple-table>
                  <thead>
                  <tr class="green">
                    <th class="text-center white--text h6">Applicant Name</th>
                    <th class="text-center white--text h6">Phone number</th>
                    <th class="text-center white--text h6">Email</th>
                    <th class="text-center white--text h6">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="application in applications" :key="application.id">
                    <td class="text-center font-weight-bold body-1 ">
                      <a href="#" class="text-decoration-none" @click.prevent="()=>openApplication(application.id)">  {{ `${application.first_name} ${application.middle_name} ${application.last_name}` }}</a>
                    </td>
                    <td>{{ application.mobile_number }}</td>
                    <td>{{ application.email }}</td>
                    <td>
                      <v-btn
                          icon
                          small
                          color="success"
                          @click="()=>openApplication(application.id)">
                        <v-icon class="font-weight-bold">mdi-eye</v-icon>
                      </v-btn>
                      <v-btn
                          icon
                          small
                          class="ma-1"
                          color="error"
                          @click="()=>deleteApplication(application.id)">
                        <v-icon class="font-weight-bold">mdi-trash-can</v-icon>
                      </v-btn>
                    </td>
                  </tr>
                  </tbody>
                </v-simple-table>
                <v-row>
                  <v-col cols="12">
                    <v-pagination
                        v-model="pagination.current_page"
                        :length="pagination.total_pages"
                        @input="loadApplications"
                    ></v-pagination>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-card>
          <!-- End Data Table -->
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
// import axios from "axios";
import Loading from "../../general/loading";
import DateFormat from "../../general/DateFormat";

export default {
  props:{
    application:{
      type: Number,
      required:true
    },
    statusTitle:{
      type: String,
      default:'Applications'
    },
    vacancy:{
      type: Number,
      required:true
    }
  },
  data() {
    return {
      dialogMessage: "Are you sure?",
      pagination: {},
      message: "",
      loadingMessage: "Loading Applications....",
      loadingColor: "#2E86C1",
      showSuccess: false,
      toDelete: null,
      showDelete: false,
      deleting: false,
      applications: [],
      name: "",
      place: "",
      filterCriteria: false,
      searchCriteria: "",
      loading: true,
      snackbar: false,
      snackMessage: "Done",
      snackColor: "#2E86C1",
    };
  },
  components: {
    Loading,
  },
  computed: {},
  methods: {
    async loadApplications() {
      this.loading = true;
      let token = await localStorage.getItem("token");
      await this.$axios.get(
          "/applications",
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              vacancy: this.vacancy,
              application_status: this.application,
              page: this.pagination.current_page,
              search: this.searchCriteria
            }
          }
      )
          .then(response => {
            this.applications = response.data.data;
            this.pagination = response.data.pagination;
            this.loading = false;
            this.resetMessages();
          });
    },
    async deleteApplication(id) {
      this.loadingMessage = "Deleting Application...";
      this.loadingColor = "red";
      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.post(
          `/applications/${id}/delete`,
          {},
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              search: this.searchCriteria
            }
          }
      )
          .then(response => {
            this.snackMessage = "Application deleted";
            this.snackbar = true;
            this.snackColor = 'red';
            this.loading = false;
            this.resetMessages();
          }).finally(() => {
            this.loadApplications();
          });
    },
    openApplication(id) {
      this.$router.push('/account/application/' + id)
    },
    showCriteria() {
      this.filterCriteria = !this.filterCriteria;
    },
    searchSomething() {
      this.loadApplications();
    },
    resetMessages() {
      this.loadingMessage = "Loading applications....";
      this.loadingColor = "#2E86C1";
      this.toDelete = null;
    },
    refresh() {
      this.loadApplications();
    }
  },

  mounted() {
    this.loadApplications();
  }
};
</script>
<style>
</style>

