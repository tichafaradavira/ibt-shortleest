<template>
  <v-content>
    <v-container class="fill-height ">
      <v-row justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-alert min-width="500px" v-if="message" class="orange white--text">{{ message }}</v-alert>
          <v-row>
            <v-col class="mb-2">
              <span  class="red--text font-weight-bold">{{ errorMessage }}</span>
            </v-col>
          </v-row>
          <v-card raised min-width="500px">
            <v-progress-linear    height="10" color="blue" v-if="loading" indeterminate></v-progress-linear>
            <v-card-title  class="header-theme text-left">
              <span class="white--text  font-weight-bold">Sign In</span>
            </v-card-title>
            <v-card-subtitle class="header-theme text-left">
              <span class="white--text">Manage your clients,properties and prospective tenants.</span>
            </v-card-subtitle>
            <v-divider></v-divider>

            <v-card-text class="p-4">
              <v-row>
                <v-col cols="12 p-2">
                  <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
                    <v-form lazy-validation @submit.prevent="handleSubmit(signinUser)">
                      <v-row>
                        <v-col>
                          <ValidationProvider name="Email" rules="required|email" v-slot="{ errors }">
                            <v-text-field
                                dense
                                class="text-input"
                                outlined
                                :error="errors[0] !== undefined"
                                :error-messages="errors[0]"
                                v-model="user.email"
                                label="Email">
                            </v-text-field>
                          </ValidationProvider>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <ValidationProvider lazy name="Password" rules="required" v-slot="{ errors }">
                            <v-text-field
                                dense
                                class="text-input"
                                outlined
                                :error="errors[0] !== undefined"
                                :error-messages="errors[0]"
                                type="password"
                                label="Password"
                                v-model="user.password"
                            ></v-text-field>
                          </ValidationProvider>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <v-btn large block color="success" dark @click="signinUser">Sign In</v-btn>
                        </v-col>
                      </v-row>
                      <v-divider class="mt-2" dark ></v-divider>
                      <v-row>
                        <v-col class="text-left mt-2">
                          <p class="black--text font-weight-bold">
                            <router-link class="text-decoration-none font-weight-bold" link
                                         :to="{ name: 'resetemail' }">Forgot password?
                            </router-link>
                          </p>
                        </v-col>
                      </v-row>
                    </v-form>
                  </ValidationObserver>

                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
          <v-row>
            <v-col class="text-center pa-4">
              <p class="black--text font-weight-bold">Don't have an account?
                <router-link class="text-decoration-none" link :to="{ name: 'signup' }">Sign Up
                </router-link>
              </p>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </v-content>

</template>
<script>
import loading from "../general/loading";

export default {
  data() {
    return {
      user: {
        email: "",
        password: ""
      },
      errorMessage: "",
      message: "",
      loading: false
    };
  },
  computed: {
    token() {
      return this.$store.state.token;
    }
  },

  methods: {
    async signinUser() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        this.loading = true;
        await this.$axios.post(`/users/signin`,
            this.user,
        ).then(async response => {
            await localStorage.setItem("token", response.data.token);
            await this.$store.commit('updateUser', response.data.user)
            await this.$store.commit('updateToken', response.data.token)
            this.$router.push({name: 'applications'})
        }).catch(error => {
            this.errorMessage = error.response.data;
        }).finally(() => {
          this.loading = false;
        })
      }
    },
  },

};
</script>
<style>
.header-theme{
  background-color: #2E86C1
}
</style>
