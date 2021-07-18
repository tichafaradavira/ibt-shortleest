<template>
  <v-content>
    <v-container class="fill-height">
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <p v-if="message" class="green--text font-weight-bold">{{message}}</p>
          <p v-if="errorMessage" class="red--text font-weight-bold">{{errorMessage}}</p>
          <v-card raised min-width="500px">
            <v-progress-linear    height="10" color="blue" v-if="loading" indeterminate></v-progress-linear>
            <v-card-title class="header-theme justify-center">
              <span class="white--text darken-3 bold">Verify email</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text class="p-4">
              <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
                <v-form lazy-validation @submit.prevent="handleSubmit(verifyEmail)">

                  <v-row class="mt-0">
                    <v-col>
                      <ValidationProvider name="Email" rules="required|email" v-slot="{ errors }">
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            v-model="email"
                            label="Email">
                        </v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row class="mt-0">
                    <v-col>
                      <ValidationProvider name="OTP" rules="required" v-slot="{ errors }">
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            :error="!!errors[0]"
                            :error-messages="errors[0]"
                            v-model="otp"
                            label="OTP"></v-text-field>
                      </ValidationProvider>
                      <p class="red--text font-weight-bold">A One Time Pin was sent to your email</p>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col>
                      <v-btn large block color="success" @click="verifyEmail" dark>Verify Email</v-btn>
                      <p class="black--text font-weight-bold mt-1">Have an account?
                        <router-link class="text-decoration-none" link :to="{ name: 'signin' }">Sign in
                        </router-link>
                      </p>
                    </v-col>
                  </v-row>
                </v-form>
              </ValidationObserver>
            </v-card-text>
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
      otp: null,
      email: null,
      loading: false,
      message: "",
      errorMessage: ""
    };
  },
  methods: {
    async verifyEmail() {
      this.resetMessages();
      const isValid = await this.$refs.observer.validate();
      this.loading = true;
      await this.$axios.post(`/users/verify/email`,
          {
            email:this.email,
            otp:this.otp,
          },
      ).then(response => {
          this.message = response.data;
          this.loading = false;
      }).catch(error => {
        this.errorMessage = error.response.data;
      }).finally(() => {
        this.loading = false;
      })
      // await this.$store.dispatch("signup", this.user);
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
  },
  mounted(){
    this.email = this.$route.params.email;
  }

};
</script>
<style>
.header-theme {
  background-color: #2E86C1
}
</style>
