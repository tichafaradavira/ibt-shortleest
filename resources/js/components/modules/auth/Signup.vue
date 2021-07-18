<template>
  <v-content>
    <v-container class="fill-height">
      <v-snackbar
          v-model="showWarning"
          timeout="3000"
          color="red"
      >
        Please accept the terms and conditions
      </v-snackbar>
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card raised min-width="500px">
            <v-progress-linear height="10" color="blue" v-if="loading" indeterminate></v-progress-linear>
            <v-card-title class="header-theme justify-center">
              <span class="white--text darken-3 bold">Create Account</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-row>
              <v-col>
                <span v-if="errorMessage" class="red--text">{{ errorMessage }}</span>
                <span v-if="message" class="green--text">{{ message }}</span>
              </v-col>
            </v-row>
            <v-card-text class="p-4">
              <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
                <v-form lazy-validation @submit.prevent="handleSubmit(signupClient)">
                  <v-row class="mt-0">
                    <v-col>
                      <ValidationProvider name="First Name" rules="required" v-slot="{ errors }">
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            v-model="user.first_name"
                            label="First Name"></v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row class="mt-0">
                    <v-col>
                      <ValidationProvider name="Last Name" rules="required" v-slot="{ errors }">
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            v-model="user.last_name"
                            label="Last Name">
                        </v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row class="mt-0">
                    <v-col>
                      <ValidationProvider name="Email" rules="required|email" v-slot="{ errors }">
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            v-model="user.email"
                            label="Email">
                        </v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row class="mt-0">
                    <v-col>
                      <ValidationProvider name="Password" rules="required|confirmed:user.confirm_password"
                                          v-slot="{ errors }">
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            type="password"
                            label="Password"
                            ref="password"
                            v-model="user.password">
                        </v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <ValidationProvider
                          name="Confirm Password"
                          rules="required"
                          v-slot="{ errors }"
                          vid="user.confirm_password"
                      >
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            type="password"
                            label="Confirm Password"
                            v-model="user.confirm_password"
                        ></v-text-field>
                      </ValidationProvider>

                      <v-checkbox v-model="terms"
                                  dense
                                  :label="`I accept the terms and conditions.`"
                                  class="black--text font-weight-bold"
                      >
                      </v-checkbox>

                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <v-btn large block color="success" @click="signupClient" dark>Create Account</v-btn>
                      <p class="black--text font-weight-bold mt-1">Have an account?
                        <router-link class="text-decoration-none" link :to="{ name: 'signin' }">Sign in
                        </router-link>
                      </p>
                    </v-col>
                  </v-row>
                </v-form>
              </ValidationObserver>
            </v-card-text>
            <v-card-actions class="ml-2">
              <v-row>
                <v-col class="text-center">
                  <router-link class="text-decoration-none" link :to="{ name: 'terms-conditions' }">Terms and conditions
                  </router-link>
                </v-col>
              </v-row>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-content>
</template>
<script>
export default {
  data() {
    return {
      terms: false,
      showWarning: false,
      user: {
        email: null,
        password: null,
        confirm_password: null,
        first_name: null,
        last_name: null,
        dob: null,
        country: null,
        phone_number: null,
      },
      loading: false,
      message: "",
      errorMessage: ""
    };
  },
  components: {},
  computed: {},

  methods: {
    async signupClient() {
      this.resetMessages();
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        if (!this.terms) {
          this.showWarning = true;
          return;
        }

        this.loading = true;

        await this.$axios.post(`/users/signup`,
            this.user,
        ).then(response => {
            this.message = response.data;

            this.$router.push({
              name: 'verifyemail',
              params: {
                email: this.user.email
              }
            })


        }).catch(error => {
          this.errorMessage = error.response.data;
        }).finally(() => {
          this.loading = false;
        })
        // await this.$store.dispatch("signup", this.user);
      }
    },
    cancel() {
      this.$router.push("/");
    },
    showDialog() {
      this.terms = true;
    },
    resetMessages() {
      this.errorMessage = "";
      this.message = "";
    }
  }
};
</script>
<style>
.header-theme {
  background-color: #2E86C1
}

.text-input input {
  color: #1A5276 !important;
  font-weight: bold;
}

</style>
