<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1">Client Properties</h2>
        <h3 class="subtitle-1">These are the properties for the client.</h3>
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
          <v-card v-if="filterCriteria" class="ma-2">
            <v-row class="pa-3">
              <v-col cols="6">
                <v-text-field outlined label="Search" clearable dense></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field outlined label="Search" dense></v-text-field>
              </v-col>
            </v-row>
          </v-card>
          <v-spacer></v-spacer>

          <!-- Data Table -->
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
                  <tr class="green ">
                    <th class="text-center white--text font-weight-bold h6">Property Type</th>
                    <th class="text-center white--text font-weight-bold h6">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="property in properties" :key="property.id">
                    <td>{{ property.property_type }}</td>
                    <td>
                      <v-btn
                          icon
                          small
                          class="ma-1"
                          color="success"
                          @click="()=>openProperty(property.id)"><v-icon class="font-weight-bold">mdi-eye</v-icon></v-btn>
                      <v-btn
                          icon
                          small
                          class="ma-1"
                          color="warning"
                          @click="()=>editProperty(property.id)"><v-icon class="font-weight-bold">mdi-square-edit-outline</v-icon></v-btn>
                      <v-btn
                          icon
                          small
                          class="ma-1"
                          color="error"
                          @click="()=>deleteProperty(property.id)"><v-icon class="font-weight-bold">mdi-trash-can</v-icon></v-btn>
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
import Loading from "../../general/loading";

export default {
  props:{
    client:{
      type:Number,
      default: null
    }
  },
  data() {
    return {
      dialogMessage: "Are you sure?",
      pagination: {},
      message: "",
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
      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.get(
          `/properties`,
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              page: this.pagination.current_page,
              search: this.searchCriteria,
              client: this.client
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
          }).finally(() => {
            this.loadProperties();
          });
    },
    addProperty() {
      this.$router.push({name:'property-form',params:{client: this.client}})
    },

    editProperty(id) {
      this.$router.push({name:'property-form', params:{client: this.client.id, id:id}})
    },
    openProperty(id) {
      this.$router.push({name:"view-property", params:{id: id}})
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
    this.loadProperties();
  }
};
</script>
<style>
</style>

