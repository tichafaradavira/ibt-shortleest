<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">{{ property.id ? "Edit" : "Add" }} Property</h2>
        <h3 class="subtitle-1 font-weight-bold">Add or Update property details.</h3>
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
        <v-card class="pa-4" v-if="!loading" >
          <loading class="ma-4" v-if="loading" size="60" color="blue"></loading>
          <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
            <v-form class="text-left" @submit.prevent="handleSubmit(submitProperty)">
              <v-card class="pa-4 ma-4" outlined>
                <v-card-title class="green--text">Property Details</v-card-title>
                <v-row>
                  <v-col cols="12">
                    <ValidationProvider
                        name="Client"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-select
                          class="text-select"
                          :items="clients"
                          v-model="property.client"
                          item-text="full_name"
                          item-value="id"
                          filled
                          label="Client"
                          outlined
                      ></v-select>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="property type"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-select
                          class="text-select"
                          :items="propertyTypes"
                          v-model="property.type"
                          filled
                          label="Property type"
                          :error-messages="errors[0]"
                          outlined
                      ></v-select>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Floor area"
                        rules="number"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Area(floor)"
                          placeholder="Property area"
                          v-model="property.area"
                          hint="This is the  floor area."
                          :error-messages="errors[0]"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Rental price"
                        rules="required|number"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Property rental price"
                          placeholder="Property rental price"
                          v-model="property.rental_price"
                          :error-messages="errors[0]"
                          hint="This is the rental price of the property."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Property description"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-textarea
                          class="text-input"
                          outlined
                          label="Property description"
                          placeholder="Property description"
                          v-model="property.description"
                          :error-messages="errors[0]"
                          hint="This is the description  of the property."
                      ></v-textarea>
                    </ValidationProvider>
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
                              v-model="property.physical_address_street"
                              hint="Physical street address."
                              :error-messages="errors[0]"
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
                              v-model="property.physical_address_city"
                              :error-messages="errors[0]"
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
                              v-model="property.physical_address_surburb"
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
                              v-model="property.physical_address_postcode"
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
                            vid="property.postal_equal_to_physical"
                        >
                          <v-switch
                              v-model="property.postal_equal_to_physical"
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
              <v-card v-if="!property.postal_equal_to_physical"   class="pa-4 ma-4" outlined>
                <v-card-title class="green--text">Postal address</v-card-title>
                <v-row>
                  <v-col cols="12">
                    <v-row>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Postal street address"
                            rules="required_if:property.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Street address"
                              placeholder="Street address"
                              :error-messages="errors[0]"
                              v-model="property.postal_address_street"
                              hint="Postal address street address."
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Postal address city"
                            rules="required_if:property.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="City"
                              placeholder="City"
                              :error-messages="errors[0]"
                              v-model="property.postal_address_city"
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
                            rules="required_if:property.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label=""
                              placeholder="Suburb"
                              :error-messages="errors[0]"
                              v-model="property.postal_address_surburb"
                              hint="Suburb"
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                      <v-col cols="6">
                        <ValidationProvider
                            name="Postal address postcode"
                            rules="required_if:property.postal_equal_to_physical,false"
                            v-slot="{ errors }"
                        >
                          <v-text-field
                              class="text-input"
                              outlined
                              label="Postcode"
                              placeholder="Postcode"
                              :error-messages="errors[0]"
                              v-model="property.postal_address_postcode"
                              hint="Postcode"
                          ></v-text-field>
                        </ValidationProvider>
                      </v-col>
                    </v-row>
                  </v-col>
                </v-row>
              </v-card>
              <v-btn class="primary mr-2 " @click="submitProperty">Submit</v-btn>
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
      property: {
        id: null,
        full_name: '',
        phone_number: '',
        area: null,
        rental_price: null,
        email: '',
        client: this.client,
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
      propertyTypes:[
        {value:1,text:"Residental"},
        {value:2,text:"Industrial"},
        {value:3,text:"Commercial"},
        {value:4,text:"Raw land"}
      ],
      clients: [],
      client: null,
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
    async submitProperty() {
      const isValid = await this.$refs.observer.validate();

      if (isValid) {
        this.loadingMessage = "Saving property...";
        this.loading = true;

        if (this.id) {
          this.saveProperty();
        } else {
          this.addProperty();
        }
      }
    },
    addProperty() {
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/properties/add`,
          this.property
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.property = false;
            let property = response.data;

            this.snackMessage = "Property added";
            this.snackbar = true;
            this.snackColor = 'green';
            setTimeout(() => {
              this.$router.push(
                  {name: 'properties'}
              );
            }, 3000)

          });
    },
    saveProperty() {
      let token = localStorage.getItem("token");
      this.$axios.post(
          `/properties/${this.property.id}/edit`,
          this.property
          ,
          {headers: {Authorization: `Bearer ${token}`}},
          {
            emulateJSON: true
          }
      )
          .then(response => {
            this.property = false;
            this.property = response.data;

            this.snackMessage = "Property saved";
            this.snackbar = true;
            this.snackColor = 'green';
            setTimeout(() => {
              this.$router.push(
                  {name: 'properties'}
              );
            }, 3000)
          });
    },
    getProperty() {
      let result = this.$route.query.result;
      if (result === "saved") {
        this.show = true;
      }
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`/properties/${this.id}`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.property = response.data;
            this.client = this.property.client.id
            this.loading = false;
          });
    },
    getClients() {
      let token = localStorage.getItem("token");
      this.$axios.get(`/clients/list`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.clients = response.data;
            this.loading = false;
          });
    },
    initialise() {
      this.id = this.$route.params.id;
      this.property.client = this.$route.params.client;
      this.getClients();
      if (this.id) {
        this.getProperty(this.id);
      } else {
        this.loading = false;
      }
    },
    cancel() {
      this.$router.push({
            name: 'properties'
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

 select {
  color: #1A5276 !important;
  font-weight: bold;
}
</style>

