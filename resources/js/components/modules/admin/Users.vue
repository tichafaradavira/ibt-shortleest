<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Users</h2>
        <h3 class="subtitle-1 ">Your users.</h3>

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
                @click="loadUsers"
            >
              <v-icon class="font-weight-bold">mdi-reload</v-icon>
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
                    <th class="text-center white--text  h6 ">Full Name</th>
                    <th class="text-center white--text  h6 ">Email</th>
                    <th class="text-center white--text  h6 ">Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="user in users" :key="user.id">
                    <td class="text-center font-weight-bold body-1">
                      <a href="#" class="text-decoration-none" @click.prevent="()=>openUser(user.id)">{{`${user.first_name} ${user.last_name}` }}</a>
                    </td>
                    <td>{{ user.email }}</td>
                    <td>
                      <v-btn
                          v-if="!user.suspended_at"
                          icon
                          small
                          class="ma-2"
                          color="error"
                          @click="()=>deleteUser(user.id)">Suspend</v-btn>

                        <v-btn
                          v-if="user.suspended_at"
                          icon
                          small
                          class="ma-2"
                          color="success"
                          @click="()=>activateUser(user.id)">Activate</v-btn>
                    </td>
                  </tr>
                  <tr v-if="users.length === 0">
                    <td class="text-center">
                      <p class="red--text font-weight-bold">-- No users yet --</p>
                    </td>
                  </tr>
                  </tbody>
                </v-simple-table>
                <v-row>
                  <v-col cols="12">
                    <v-pagination
                        v-model="pagination.current_page"
                        :length="pagination.total_pages"
                        @input="loadUsers"
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
      user_id: null,
      dialogMessage: "Are you sure?",
      pagination: {},
      message: "",
      loadingMessage: "Loading Users....",
      loadingColor: "#2E86C1",
      showSuccess: false,
      toDelete: null,
      showDelete: false,
      deleting: false,
      users: [],
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
    async loadUsers() {
      //to mixin
      if (!this.property) {
        window.scrollTo(0, 0);
      }

      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.get(
          `/admin/users`,
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {
              search: this.searchCriteria
            }
          }
      )
          .then(response => {
            this.users = response.data.data;
            this.pagination = response.data.pagination;
            this.loading = false;
            this.resetMessages();
          });
    },
    async deleteUser(id) {
      this.loadingMessage = "Suspending user...";
      this.loadingColor = "red";
      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.post(
          `/admin/users/${id}/suspend`,
          {},
          {
            headers: {Authorization: `Bearer ${token}`},
            params: {}
          }
      )
          .then(response => {
            this.loading = false;
            this.snackMessage = "User suspended";
            this.snackbar = true;
            this.snackColor = 'red';
            this.resetMessages();
          }).finally(() => {
            this.loadUsers();
          });
    },
      async activateUser(id) {
          this.loadingMessage = "Activating user...";
          this.loadingColor = "green";
          this.loading = true;
          let token = localStorage.getItem("token");
          await this.$axios.post(
              `/admin/users/${id}/activate`,
              {},
              {
                  headers: {Authorization: `Bearer ${token}`},
                  params: {}
              }
          )
              .then(response => {
                  this.loading = false;
                  this.snackMessage = "User activated";
                  this.snackbar = true;
                  this.snackColor = 'green';
                  this.resetMessages();
              }).finally(() => {
                  this.loadUsers();
              });
      },
    openUser(id) {
      this.$router.push({name:"view-user", params : {id: id }});
    },

    showCriteria() {
      this.filterCriteria = !this.filterCriteria;
    },
    searchSomething() {
      this.loadUsers();
    },
    resetMessages() {
      this.loadingMessage = "Loading users....";
      this.loadingColor = "blue";
      this.toDelete = null;
    },
    refresh() {
      this.loadUsers();
    }
  },

  mounted() {
    this.user_id = this.$route.params.user_id;
    this.loadUsers();
  }
};
</script>
<style>
</style>

