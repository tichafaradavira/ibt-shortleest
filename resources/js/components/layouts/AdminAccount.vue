<template>
  <v-app class="pa-2 grey lighten-3" id="inspire">
    <v-navigation-drawer color="#154360" v-model="drawer" app>
      <v-list>
        <v-list-item>
          <v-list-item-title class="text-left display-1 font-weight-bold white--text">ShortLeest</v-list-item-title>
        </v-list-item>
        <v-divider thickness="2"></v-divider>
        <v-list-item link :to="{ name: 'users' }">
          <v-list-item-icon>
            <v-icon class="white--text font-weight-bold">
              mdi-account-group
            </v-icon>
            <v-list-item-title class=" white--text ml-2">Users</v-list-item-title>
          </v-list-item-icon>
        </v-list-item>
        <v-divider></v-divider>
      </v-list>
      <v-divider></v-divider>
      <v-row>
        <v-col>
          <v-row>
            <v-col>
              <v-list>
                <v-list-group :value="false">
                  <template v-slot:activator>
                    <v-list-item-title
                        class="text-left  blue--text subtitle-1"
                    >Account
                    </v-list-item-title>
                  </template>
                  <v-list-item link>
                    <v-list-item-title>
                      <v-btn text color="error" @click="logout">
                        <v-icon class="red--text">
                          mdi-logout
                        </v-icon>
                        Logout
                      </v-btn>
                    </v-list-item-title>
                  </v-list-item>
                </v-list-group>
              </v-list>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-navigation-drawer>

    <v-app-bar app color="#2E86C1" dark>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-icon></v-app-bar-nav-icon>

      <v-toolbar-title>Admin Dashboard</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container fluid>
        <v-row v-if="loading">
          <v-col class="text-center m-16" cols="12 ">
            <v-progress-circular :size="70" :width="10" color="red" indeterminate></v-progress-circular>
          </v-col>
        </v-row>
        <v-row v-if="loading">
          <v-col class="text-center m-16" cols="12 ">
            <span class="red--text darken-4">Logging out ....</span>
          </v-col>
        </v-row>
        <router-view v-if="!loading"></router-view>
      </v-container>
    </v-main>
    <v-footer color="#2E86C1" app>
      <span class="white--text">&copy;IBT Technologies 2020</span>
    </v-footer>
  </v-app>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  props: {
    source: String
  },
  data: () => ({
    drawer: null,
    loading: false
  }),
  computed: {},
  methods: {
    async logout() {
      this.loading = true;
      let token = localStorage.getItem("token");
      await this.$axios.post("/users/logout", {}, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.loading = false;
            localStorage.removeItem("token");
            this.$store.commit("resetState");
            this.$router.push('/signin')
          });
    }
  }
};
</script>
<style>
.title-color {
  color: "#2E86C1";
}
</style>
