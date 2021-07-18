<template>
  <v-content>
    <v-container class="fill-height">
      <v-row align="center" justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-row>
            <v-col cols="12">
              <span v-if="errorMessage" class="red--text">{{ errorMessage }}</span>
              <span v-if="message" class="green--text">{{ message }}</span>
            </v-col>
          </v-row>
          <v-card raised min-width="500px">
            <v-progress-linear    height="10" color="blue" v-if="loading" indeterminate></v-progress-linear>
            <v-card-title class="header-theme" >
              <span class="white--text font-weight-bold">Password Reset : Step 1</span>
            </v-card-title>
            <v-card-subtitle class=" header-theme text-left">
              <span class="white--text">* Enter the email you signed up with.</span>
            </v-card-subtitle>
            <v-divider></v-divider>
            <v-card-text class="p-4">
              <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
                <v-form lazy-validation @submit.prevent="handleSubmit(sendEmail)">
                  <v-row>
                    <v-col>
                      <ValidationProvider  name="Email" rules="required|email" v-slot="{ errors }">
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
                  <v-row>
                    <v-col>
                      <v-btn large block color="success" dark @click="sendEmail">Send Email</v-btn>
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
      email: null,
      errorMessage: null,
      message: "",
      loading: false
    };
  },
  methods: {
    async sendEmail() {
      const isValid = await this.$refs.observer.validate();
      if (isValid) {
        this.loading = true;
        this.$axios.post("/users/forgotpassword", {
          email: this.email
        })
            .then(response => {
              this.loading = false
              this.message = "Email sent, check your inbox."
              this.$router.push({name: "reset-password",params:{email: this.email}})
            }).catch(error=>{
              this.errorMessage = error.response.data;
              this.loading = false;
        });
      }
    }
  },
  mounted() {
  }
};
</script>
<style>
.header-theme {
  background-color: #2E86C1
}
</style>
