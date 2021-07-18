<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Clients</h2>
        <h3 class="subtitle-1 ">Clients whose properties you are managing.</h3>

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
        <v-card v-if="!loading"  outlined>
          <div class="ma-2 d-flex justify-end">
            <v-btn
                class="ma-1"
                color="primary"
                @click="loadClients"
            >
              <v-icon class="font-weight-bold">mdi-reload</v-icon>
            </v-btn>
            <v-btn
                class="ma-1"
                outlined
                color="blue"
                @click="addClient"
            >
              <v-icon class="font-weight-bold">mdi-account-multiple-plus</v-icon>
            </v-btn>
          </div>
          <v-card v-if="filterCriteria" class="ma-4">
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
          <v-card outlined class="ma-1">

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
                    <th class="text-center white--text  h6 ">Client Name</th>
                    <th class="text-center white--text  h6 ">Email</th>
                    <th class="text-center white--text  h6 ">Phone</th>
                    <th class="text-center white--text  h6 ">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="client in clients" :key="client.id">
                    <td class="text-center font-weight-bold body-1">
                      <a href="#" class="text-decoration-none" @click.prevent="()=>openClient(client.id)">{{ client.full_name }}</a>
                    </td>
                    <td>{{ client.email }}</td>
                    <td>
                      {{ client.phone_number }}
                    </td>
                    <td>
                      <v-btn
                          icon
                          small
                          class="ma-2"
                          color="warning"
                          @click="()=>editClient(client.id)"><v-icon>mdi-square-edit-outline</v-icon></v-btn>
                      <v-btn
                          icon
                          small
                          class="ma-2"
                          color="error"
                          @click="()=>deleteClient(client.id)"><v-icon>mdi-trash-can</v-icon></v-btn>
                    </td>
                  </tr>
                  <tr v-if="clients.length === 0">
                    <td class="text-center">
                      <p class="red--text font-weight-bold">-- No clients yet --</p>
                    </td>
                  </tr>
                  </tbody>
                </v-simple-table>
                <v-row>
                  <v-col cols="12">
                    <v-pagination
                        v-model="pagination.current_page"
                        :length="pagination.total_pages"
                        @input="loadClients"
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
      client_id: null,
      dialogMessage: "Are you sure?",
      pagination: {},
      message: "",
      loadingMessage: "Loading Clients....",
      loadingColor: "#2E86C1",
      showSuccess: false,
      toDelete: null,
      showDelete: false,
      deleting: false,
      clients: [],
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
    async loadClients() {
      //to mixin
      if (!this.property) {
        window.scrollTo(0, 0);
      }

      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.get(
          `/clients`,
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              search: this.searchCriteria
            }
          }
      )
          .then(response => {
            this.clients = response.data.data;
            this.pagination = response.data.pagination;
            this.loading = false;
            this.resetMessages();
          });
    },
    async deleteClient(id) {
      this.loadingMessage = "Deleting client...";
      this.loadingColor = "red";
      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.post(
          `/clients/${id}/delete`,
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
            this.snackMessage = "Client deleted";
            this.snackbar = true;
            this.snackColor = 'red';
            this.resetMessages();
          }).finally(() => {
            this.loadClients();
          });
    },
    addClient() {
      this.$router.push('clients/form')
    },
    editClient(id) {
      this.$router.push('clients/form/'+id)
    },
    openClient(id) {
      this.$router.push('clients/'+id)
    },

    showCriteria() {
      this.filterCriteria = !this.filterCriteria;
    },
    searchSomething() {
      this.loadClients();
    },
    resetMessages() {
      this.loadingMessage = "Loading clients....";
      this.loadingColor = "blue";
      this.toDelete = null;
    },
    refresh() {
      this.loadClients();
    }
  },

  mounted() {
    this.client_id = this.$route.params.client_id;
    this.loadClients();
  }
};
</script>
<style>
</style>

