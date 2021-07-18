<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Properties</h2>
        <h3 class="subtitle-1">Properties that you are managing.</h3>
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
                @click="loadProperties"
            >
              <v-icon class="font-weight-bold">mdi-reload</v-icon>
            </v-btn>
            <v-btn
                class="ma-1"
                outlined
                color="blue"
                @click="addProperty"
            >
              <v-icon class="font-weight-bold">mdi-bank-plus</v-icon>
            </v-btn>

          </div>
          <v-spacer></v-spacer>
          <!-- Data Table -->
          <span v-if="errorMessage" class="font-weight-bold red--text">{{errorMessage}}</span>
          <v-card class="ma-1" outlined>
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
                    <th class="text-center white--text  h6">UUID</th>
                    <th class="text-center white--text  h6">Property owner</th>
                    <th class="text-center white--text  h6">Property Type</th>
                    <th class="text-center white--text  h6">Property Rent</th>
                    <th class="text-center  white--text  h6">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="property in properties" :key="property.id">
                    <td><a class="text-decoration-none font-weight-bold" href="#" @click.prevent="()=>openProperty(property.id)">{{ property.uuid }}</a></td>
                    <td class="text-center font-weight-bold body-1 ">
                      {{ property.client ? property.client.full_name : 'OWN' }}
                    </td>
                    <td>{{ property.property_type }}</td>
                    <td>{{ property.rental_price }}</td>
                    <td>
                      <v-btn
                          icon
                          class="ma-1"
                          color="warning"
                          @click="()=>editProperty(property.id)"><v-icon class="font-weight-bold">mdi-square-edit-outline</v-icon></v-btn>
                      <v-btn
                          icon
                          class="ma-1"
                          color="error"
                          @click="()=>deleteProperty(property.id)"><v-icon class="font-weight-bold">mdi-trash-can</v-icon></v-btn>
                    </td>
                  </tr>
                  <tr v-if="properties.length === 0">
                    <td class="text-center">
                      <p class="red--text font-weight-bold">-- No properties yet --</p>
                    </td>
                  </tr>
                  </tbody>
                </v-simple-table>
                <v-row>
                  <v-col cols="12">
                    <v-pagination
                        v-model="pagination.current_page"
                        :length="pagination.total_pages"
                        @input="loadProperties"
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
      course_id: null,
      dialogMessage: "Are you sure?",
      pagination: {},
      message: "",
      errorMessage: "",
      loadingMessage: "Loading Properties....",
      loadingColor: "#2E86C1",
      showSuccess: false,
      toDelete: null,
      showDelete: false,
      deleting: false,
      properties: [],
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
    async loadProperties() {
      //to mixin
      if (!this.property) {
        window.scrollTo(0, 0);
      }

      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.get(
          `/properties`,
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              page: this.pagination.current_page,
              search: this.searchCriteria
            }
          }
      )
          .then(response => {
            this.properties = response.data.data;
            this.pagination = response.data.pagination;
            this.loading = false;
            this.resetMessages();
          });
    },
    async deleteProperty(id) {
      this.loadingMessage = "Deleting Property...";
      this.loadingColor = "red";
      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.post(
          `/properties/${id}/delete`,
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
            this.snackMessage = "Property deleted";
            this.snackbar = true;
            this.snackColor = 'red';
            this.resetMessages();
          }).catch(error=>{
            this.errorMessage = error.response.data;
            this.loading = false;
          }).finally(() => {
            this.loadProperties();
          });
    },
    addProperty() {
      this.$router.push({name:'property-form'})
    },
    editProperty(id) {
      this.$router.push({name:'property-form', params:{id:id}})
    },
    openProperty(id) {
      this.$router.push({name:"view-property", params:{id:id}})
    },
    showCriteria() {
      this.filterCriteria = !this.filterCriteria;
    },
    searchSomething() {
      this.loadProperties();
    },
    resetMessages() {
      this.loadingMessage = "Loading properties....";
      this.loadingColor = "blue";
      this.toDelete = null;
    },
    refresh() {
      this.loadProperties();
    }
  },

  mounted() {
    this.course_id = this.$route.params.course_id;
    this.loadProperties();
  }
};
</script>
<style>
</style>

