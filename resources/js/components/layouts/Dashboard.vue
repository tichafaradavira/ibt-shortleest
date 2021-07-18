<template>
  <v-container  class="pa-4 ma-0">
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-toolbar color="indigo" dark>
            <v-toolbar-title>Property</v-toolbar-title>

            <v-divider class="mx-4" inset vertical></v-divider>

            <span class="subheading">View All</span>
            <v-spacer></v-spacer>

            <v-toolbar-items class="hidden-sm-and-down">
              <v-row>
                <v-col class="mr-4">
                  <v-text-field outlined dense append-icon="mdi-magnify" @click:append="searchSomething"></v-text-field>
                </v-col>
              </v-row>

              <v-divider inset vertical></v-divider>
              <v-btn @click="showFilter" text icon color="white">
                <v-icon>mdi-filter</v-icon>
              </v-btn>

              <v-divider inset vertical></v-divider>

              <v-btn text icon color="white">
                <v-icon>mdi-sync</v-icon>
              </v-btn>

              <v-divider inset vertical></v-divider>

              <v-btn text icon color="white">
                <v-icon>mdi-plus-thick</v-icon>
              </v-btn>

              <v-divider inset vertical></v-divider>
            </v-toolbar-items>
          </v-toolbar>
          <v-card dark outlined v-show="filter" class="ma-4"  transition="slide-x-transition">
            <v-row class="pa-2">
              <v-col>
                <v-text-field outlined label="Search" clearable dense></v-text-field>
              </v-col>
              <v-col>
                <v-text-field outlined label="Search" dense></v-text-field>
              </v-col>
            </v-row>
          </v-card>
            <!-- Data Table -->


            <!-- End Data Table -->
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
// import axios from "axios";
export default {
  data() {
    return {
      name: "",
      place: "",
      filter: false,
    };
  },
  computed: {},
  methods: {
    async logout() {
      await this.$store.router.push("/");
    },
    loadResults() {
      this.loading = true;
      let token = localStorage.getItem("token");
      axios
        .get("http://127.0.0.1:8080/api/user/dashboard", {
          headers: { Authorization: `Bearer ${token}` }
        })
        .then(response => {
          console.log(response.data);
          this.name = response.data.name;
          this.place = response.data.place;
        });
    },
    showFilter() {
      this.filter = !this.filter;
    },
    searchSomething()
    {

    }
  },

  created() {}
};
</script>
<>

