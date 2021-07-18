<template>
  <v-content>
    <v-container class="fill-height">
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-row>
            <v-col>
              <v-row>
                <v-col>
                  <span v-if="errorMessage" class="red--text">{{ errorMessage }}</span>
                  <span v-if="message" class="green--text">{{ message }}</span>
                </v-col>
              </v-row>
            </v-col>
          </v-row>
          <v-card raised max-width="500px">
            <v-progress-linear height="10" color="blue" v-if="loading" indeterminate></v-progress-linear>
            <v-card-title class="header-theme">
              <span class="white--text">Password Reset: Step 2</span>
            </v-card-title>
            <v-card-subtitle class=" header-theme text-left">
              <span class="white--text">Enter your credentials, and the OTP send to your email.</span>
            </v-card-subtitle>

            <v-card-text class="pa-4">
              <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
                <v-form @submit.prevent="handleSubmit(resetPassword)">
                  <v-row>
                    <v-col>
                      <ValidationProvider name="Email" rules="required|email" v-slot="{ errors }">
                        <span class="red--text font-weight-bold">{{ errors[0] }}</span>
                        <v-text-field
                            dense
                            class="text-input"
                            outlined :error="!!errors[0]" v-model="email" label="Email"></v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <ValidationProvider name="Password" rules="required|confirmed:confirm_password"
                                          v-slot="{ errors }">
                        <v-text-field
                            dense
                            outlined
                            class="text-input"
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            type="password"
                            label="Password"
                            v-model="password"
                        ></v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <ValidationProvider
                          class="text-input"
                          name="Confirm Password"
                          rules="required"
                          v-slot="{ errors }"
                          vid="confirm_password"
                      >
                        <v-text-field
                            dense
                            outlined
                            class="text-input"
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            type="password"
                            label="Confirm Password"
                            v-model="confirm_password"
                        ></v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row class="mt-0">
                    <v-col>
                      <ValidationProvider name="OTP" rules="required" v-slot="{ errors }">
                        <v-text-field
                            class="text-input"
                            dense
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            v-model="otp"
                            label="OTP"></v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <v-btn block large color="success" dark @click="resetPassword">Reset Password</v-btn>
                    </v-col>
                  </v-row>
                </v-form>
              </ValidationObserver>
            </v-card-text>
            <v-card-actions class="ml-2 black--text  font-weight-bold">
              Have an account?
              <router-link class="text-decoration-none" :to="{ name: 'signin' }"> Sign in</router-link>
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
      password: null,
      email: null,
      otp: null,
      confirm_password: null,
      errorMessage: null,
      message: null,
      loading: false
    };
  },
  methods: {
    async resetPassword() {
      this.resetMessages();

      const isValid = await this.$refs.observer.validate();
      if (isValid && this.match()) {
        this.loading = true;
        let token = this.$route.params.token;
        await this.$axios.post(
            "/users/password/reset/",
            {
              password: this.password,
              confirm_password: this.confirm_password,
              email: this.email,
              otp: this.otp,
            }
        )
            .then(response => {
              this.loading = false;
              this.message = "Password reset,  you can sign in."
              setTimeout(()=>{},3000)
              this.$router.push({name: "signin"})

            }).catch(error => {
              this.errorMessage = error.response.data;
              this.loading = false;
            });
      }
    },
    match() {
      if (this.confirm_password == this.password) {
        return true;
      } else {
        this.errorMessage = "Passwords do not match!";
        return false;
      }
    },
    resetMessages() {
      this.message = '';
      this.errorMessage = '';
    }
  },
  mounted() {
    this.email = this.$route.params.email;
  }
};
</script>
<style>
.header-theme {
  background-color: #2E86C1
}
</style>

