<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">{{ client.id ? "Edit" : "Add" }} Client</h2>
        <h3 class="subtitle-1 font-weight-bold">Add or Update client details.</h3>

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
        <v-card v-if="!loading" outlined class="pa-4">
          <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
            <v-form class="text-left" @submit.prevent="handleSubmit(submitClient)">
              <v-card class="pa-4 ma-4" outlined>
                <v-card-title class="green--text">Client Details</v-card-title>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Client name"
                            rules="required"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Client name"
                              placeholder="Client full name"
                              v-model="client.full_name"
                              :error-messages="errors[0]"
                              hint="This is the full name of the client."
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Client email"
                            rules="required|email"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Client email"
                              placeholder="Client email"
                              v-model="client.email"
                              :error-messages="errors[0]"
                              hint="This is the email  of the client."
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Client phone"
                            rules="required"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Client phone"
                              placeholder="Client phone"
                              v-model="client.phone_number"
                              :error-messages="errors[0]"
                              hint="This is the phone number of the client."
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Client description"
                            rules=""
                            v-slot="{ errors }"
                        >
                          <v-textarea
                              class="text-input"
                              outlined
                              label="Client description"
                              placeholder="Client description"
                              v-model="client.description"
                              :error-messages="errors[0]"
                              hint="This is the description  of the client."
                          ></v-textarea>
                        </ValidationProvider>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>

              </v-card>
              <v-card class="pa-4 ma-4" outlined>
                <v-card-title class="green--text">Physical address</v-card-title>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Physical address street"
                            rules="required"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Street address"
                              placeholder="Physical street address"
                              :error-messages="errors[0]"
                              v-model="client.physical_address_street"
                              hint="Physical street address."
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="City"
                            rules="required"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="City"
                              placeholder="City"
                              :error-messages="errors[0]"
                              v-model="client.physical_address_city"
                              hint="City"
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Physical address suburb"
                            rules="required"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Suburb"
                              placeholder="Suburb"
                              :error-messages="errors[0]"
                              v-model="client.physical_address_surburb"
                              hint="Physical address suburb."
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Physical address postcode"
                            rules="required"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Postcode"
                              placeholder="Postcode"
                              :error-messages="errors[0]"
                              v-model="client.physical_address_postcode"
                              hint="Postcode"
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Equal"
                            rules="required"
                            v-slot="{ errors }"
                            vid="client.postal_equal_to_physical"
                        >
                          <v-switch
                              v-model="client.postal_equal_to_physical"
                              label="Same as postal address"
                          ></v-switch>
                          <span class="red--text font-weight-bold">{{ errors[0] }}</span>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
              </v-card>

              <v-card v-if="!client.postal_equal_to_physical"   class="pa-4 ma-4" outlined>
                <v-card-title class="green--text">Postal address</v-card-title>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Postal street address"
                            rules="required_if:client.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Street address"
                              placeholder="Street address"
                              :error-messages="errors[0]"
                              v-model="client.postal_address_street"
                              hint="Postal address street address."
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Postal address city"
                            rules="required_if:client.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="City"
                              placeholder="City"
                              :error-messages="errors[0]"
                              v-model="client.postal_address_city"
                              hint="City"
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Postal address Suburb"
                            rules="required_if:client.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label=""
                              placeholder="Suburb"
                              :error-messages="errors[0]"
                              v-model="client.postal_address_surburb"
                              hint="Suburb"
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Postal address postcode"
                            rules="required_if:client.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Postcode"
                              placeholder="Postcode"
                              :error-messages="errors[0]"
                              v-model="client.postal_address_postcode"
                              hint="Postcode"
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
              </v-card>
              <v-btn class="primary mr-2 " @click="submitClient">Submit</v-btn>
              <v-btn class="error mr-2" @click="cancel">Cancel</v-btn>
            </v-form>
          </ValidationObserver>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>

import loading from "../general/loading";
import _pick from 'lodash/pick'

export default {
  data() {
    return {
      client: {
        id: null,
        full_name: '',
        phone_number: '',
        email: '',
        description: '',
        physical_address_street: '',
        physical_address_city: '',
        physical_address_surburb: '',
        physical_address_postcode: '',
        postal_equal_to_physical: false,
        postal_address_street: '',
        postal_address_city: '',
        postal_address_surburb: '',
        postal_address_postcode: '',
      },
      showDialog: false,
      loading: true,
      submitting: false,
      loadingMessage: "Preparing Form...",
      loadingColor: "#2E86C1",
      snackbar: false,
      snackMessage: "Done",
      snackColor: "#2E86C1",
    };
  },
  computed: {},
  components: {
    loading
  },
  methods: {
    async submitClient() {
      const isValid = await this.$refs.observer.validate();

      if (isValid) {
        this.loadingMessage = "Saving client...";
        this.loading = true;

        if (this.id) {
          this.saveClient();
        } else {
          this.addClient();
        }
      }
    },
    addClient() {
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/clients/add`,
          this.client
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.client = false;
            let client = response.data;
            this.snackMessage = "Client added";
            this.snackbar = true;
            this.snackColor = 'green';
            setTimeout(() => {
              this.$router.push(
                  {name: 'clients'}
              );
            }, 3000)

          });
    },
    saveClient() {
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/clients/${this.client.id}/edit`,
          this.client
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.client = false;
            this.client = response.data;
            this.snackMessage = "Client saved";
            this.snackbar = true;
            this.snackColor = 'green';
            setTimeout(() => {
              this.$router.push(
                  {name: 'clients'}
              );
            }, 3000)
          });
    },
    getClient() {
      let result = this.$route.query.result;
      if (result === "saved") {
        this.show = true;
      }
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`/clients/${this.id}`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.client = response.data;
            this.loading = false;
          });
    },
    initialise() {
      this.id = this.$route.params.id;
      if (this.id) {
        this.getClient(this.id);
      } else {
        this.loading = false;
      }
    },
    cancel() {
      this.$router.push({
            name: 'clients'
          }
      );
    }
  },
  mounted() {
    this.initialise();
  }
};
</script>
<style>
.text-input input {
  color: #1A5276 !important;
  font-weight: bold;
}

.text-input textarea {
  color: #1A5276 !important;
  font-weight: bold;
}
</style>

