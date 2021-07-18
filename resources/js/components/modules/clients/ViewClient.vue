<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold ">Client</h2>
        <h3 class="subtitle-1 ">Property owner details</h3>
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
        <v-card v-if="!loading" outlined>
          <loading class="ma-4" v-if="loading" size="60"></loading>
          <v-card v-if="!loading" class="" color="#EEEEEE" outlined>
            <v-card-title class="text--primary h2">Property Owner</v-card-title>

            <v-row class="ma-2 pa-2">
              <v-col cols="8">
                <client-details  :client="client"></client-details>
              </v-col>
              <v-col cols="4">
                <address-details title="Physical Address" :address="physical_address"></address-details>
                <v-spacer class="ma-2"/>
                <address-details title="Postal Address" :address="postal_address"></address-details>
              </v-col>
            </v-row>
            <v-row class="ma-2 pa-2">
              <v-col cols="6">
              </v-col>
              <v-col cols="6">
              </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row class="ma-2 pa-2">
              <v-col cols="12">
                <client-properties :client="client.id"></client-properties>
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
import ClientDetails from "./components/ClientDetails";
import ClientProperties from "./components/ClientProperties";
export default {
  data() {
    return {
      show: false,
      client: null,
      loading: true,
      course_id:null,
      loadingMessage: "Loading Client...",
      loadingColor: "#2E86C1",

    };
  },
  components: {
    AddressDetails,
    ClientDetails,
    ClientProperties,
    loading,
  },
  computed:{
    physical_address: function () {
      return {
        street: this.client.physical_address_street,
        suburb: this.client.physical_address_surburb,
        city: this.client.physical_address_city,
        postcode: this.client.physical_address_postcode,
      }
    },
    postal_address: function () {
      if (this.client.postal_equal_to_physical) {
        return this.physical_address;
      }
      return {
        street: this.client.postal_address_street,
        suburb: this.client.postal_address_surburb,
        city: this.client.postal_address_city,
        postcode: this.client.postal_address_postcode,
      }
    }
  },

  methods: {
    getClient() {
      let result = this.$route.query.result;
      let id = this.$route.params.id;
      this.loading = true;
      let token = localStorage.getItem("token");
      this.$axios.get(`clients/${id}`, {
        headers: {Authorization: `Bearer ${token}`}
      })
          .then(response => {
            this.client = response.data;
            this.loading = false;
          });
    },
    resetSnackBar() {
      this.show = false;
    }
  },

  mounted() {
    this.getClient();
  }
};
</script>

