<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Property</h2>
        <h3 class="subtitle-1 ">Property details.</h3>
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

        <v-card v-if="!loading" color="#EEEEEE" outlined>
          <div class="ma-2 d-flex justify-end">
            <v-btn
                class="ma-1 white--text"
                color="cyan"
                @click="addVacancy"
            >
              Create rental vacancy
            </v-btn>
          </div>
          <loading class="ma-4" v-if="loading" size="60"></loading>
          <v-card v-if="!loading" color="#EEEEEE" outlined>

            <v-card-title class="blue-grey--text font-weight-bold"><span class="black--text font-weight-bold">UUID:</span> {{ property.uuid }}</v-card-title>

            <v-row class="ma-2 pa-2">
              <v-col cols="6">
                <property-details :property="property"></property-details>
              </v-col>
              <v-col cols="6">
                <client-details v-if="client" :client="client"></client-details>
                <own v-else></own>
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col cols="6">
                <address-details title="Physical Address" :address="physical_address"></address-details>
                <v-spacer class="ma-2"/>
                <address-details title="Postal Address" :address="postal_address"></address-details>

              </v-col>
              <v-col cols="6">
                <vacancy-details v-if="property.vacancy" :vacancy="property.vacancy"></vacancy-details>
                <v-card flat class="pa-4" v-else>
                  <p class="body-1 red--text font-weight-bold">There is no active vacancy for this property</p>

                </v-card>
              </v-col>
            </v-row>
          </v-card>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
import loading from "../general/loading";
import AddressDetails from "../applications/components/AddressDetails";
import PropertyDetails from "../properties/components/PropertyDetails";
import ClientDetails from "../clients/components/ClientDetails";
import Own from "../properties/components/Own";
import VacancyDetails from "../vacancies/components/VacancyDetails";

export default {
  data() {
    return {
      show: false,
      property: null,
      client: null,
      loading: true,
      course_id: null,
      loadingMessage: "Loading Property...",
      loadingColor: "#2E86C1",

    };
  },
  components: {
    AddressDetails,
    PropertyDetails,
    ClientDetails,
    VacancyDetails,
    Own,
    loading,
  },
  computed: {
    physical_address: function () {
      return {
        street: this.property.physical_address_street,
        suburb: this.property.physical_address_surburb,
        city: this.property.physical_address_city,
        postcode: this.property.physical_address_postcode,
      }
    },
    postal_address: function () {
      if (this.property.postal_equal_to_physical) {
        return this.physical_address;
      }
      return {
        street: this.property.postal_address_street,
        suburb: this.property.postal_address_surburb,
        city: this.property.postal_address_city,
        postcode: this.property.postal_address_postcode,
      }
    }
  },

  methods: {
    addVacancy() {
      // this.$router.push('vacancies/form/'+this.property.id)
      this.$router.push({name: 'vacancy-form', params: {property: this.property.id}})
    },
    getProperty() {
      let result = this.$route.query.result;
      let course = this.$route.params.course_id;
      let id = this.$route.params.id;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`properties/${id}`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.property = response.data;
            this.client = this.property.client;
            this.loading = false;
          });
    },
    resetSnackBar() {
      this.show = false;
    }
  },

  mounted() {
    this.getProperty();
  }
};
</script>

