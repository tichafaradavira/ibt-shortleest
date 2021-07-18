<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Vacancies</h2>
        <h3 class="subtitle-1  ">Vacancies for the rental properties.</h3>
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
        <v-card v-if="!loading" outlined>
          <div class="ma-2 d-flex justify-end">
            <v-btn
                class="ma-1"
                color="primary"
                @click="loadVacancies"
            >
              <v-icon class="font-weight-bold">mdi-reload</v-icon>
            </v-btn>
          </div>
              <!-- Data Table -->
          <v-card outlined class="ma-1">
            <v-card-subtitle class="text-left">
              <label class="font-weight-bold green--text caption">To add  vacancy, open a property you need to create a vacancy for and click the "CREATE RENTAL VACANCY" button</label>
            </v-card-subtitle>
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
                    <th class="text-center white--text  h6">Vacancy Reference</th>
                    <th class="text-center white--text  h6">Status</th>
                    <th class="text-center white--text  h6">Available From</th>
                    <th class="text-center white--text  h6">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="vacancy in vacancies" :key="vacancy.id">
                    <td class="font-weight-bold"><a class="text-decoration-none " href="#" @click.prevent="()=>openVacancy(vacancy.id)">{{vacancy.reference}}</a></td>
                    <td>{{vacancy.vacancy_status}}</td>
                    <td>{{vacancy.available_from}}</td>
                    <td>
                      <v-btn
                          icon
                          small
                          class="ma-1"
                          color="warning"
                          @click="()=>editVacancy(vacancy.id)">  <v-icon>mdi-square-edit-outline</v-icon></v-btn>
                      <v-btn
                          icon
                          class="ma-1"
                          color="error"
                          @click="()=>deleteVacancy(vacancy.id)"> <v-icon>mdi-trash-can</v-icon></v-btn>
                    </td>
                  </tr>
                  <tr v-if="vacancies.length === 0">
                    <td class="text-center">
                      <p class="red--text font-weight-bold">-- No vacancies yet --</p>
                    </td>
                  </tr>
                  </tbody>
                </v-simple-table>
                <v-row>
                  <v-col cols="12">
                    <v-pagination
                        v-model="pagination.current_page"
                        :length="pagination.total_pages"
                        @input="loadVacancies"
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
import Loading from "../general/loading";
import DateFormat from "../general/DateFormat";
import DateTimeFormat from "../general/DateTimeFormat";

export default {
  data() {
    return {
      vacancy_id: null,
      dialogMessage: "Are you sure?",
      pagination: {},
      message: "",
      loadingMessage: "Loading Vacancies....",
      loadingColor: "#2E86C1",
      showSuccess: false,
      toDelete: null,
      showDelete: false,
      deleting: false,
      vacancies: [],
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
    async loadVacancies() {
      //to mixin
      if (!this.vacancy) {
        window.scrollTo(0, 0);
      }

      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.get(
          `/vacancies`,
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              page: this.pagination.current_page,
              search: this.searchCriteria
            }
          }
      )
          .then(response => {
            this.vacancies = response.data.data;
            this.pagination = response.data.pagination;
            this.loading = false;
            this.resetMessages();
          });
    },
    async deleteVacancy(id) {
      this.loadingMessage = "Deleting Vacancy...";
      this.loadingColor = "red";
      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.post(
          `/vacancies/${id}/delete`,
          {},
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              search: this.searchCriteria
            }
          }
      )
          .then(response => {
            this.loading = false;
            this.snackMessage = "Vacancy deleted";
            this.snackbar = true;
            this.snackColor = 'red';
            this.resetMessages();
          }).finally(() => {
            this.loadVacancies();
          });
    },
    editVacancy(id) {
      this.$router.push({name:'vacancy-form',params:{property: null,id:id}})
    },
    openVacancy(id) {
      this.$router.push('vacancies/'+id)
    },
    showCriteria() {
      this.filterCriteria = !this.filterCriteria;
    },
    searchSomething() {
      this.loadVacancies();
    },
    resetMessages() {
      this.loadingMessage = "Loading vacancies....";
      this.loadingColor = "blue";
      this.toDelete = null;
    },
    refresh() {
      this.loadVacancies();
    }
  },

  mounted() {
    this.vacancy_id = this.$route.params.vacancy_id;
    this.loadVacancies();
  }
};
</script>
<style>
</style>

