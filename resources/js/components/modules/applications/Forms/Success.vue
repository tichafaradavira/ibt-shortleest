<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col align="center"
             justify="center" cols="12">
        <v-card outlined class="pa-4" color="" max-width="1000">
          <v-row>
            <v-col class="text-center">
              <v-alert
                  dense
                  text
                  type="success"
              >
                Your application for rental has been <strong>successfully</strong> <strong>submitted</strong>.
                Thank you very much for using Shortleest.If you have any queries, suggestions and concerns please feel
                free to contact
                the admin at <span class="font-weight-bold" >enquiries@shortleest.com</span>.
              </v-alert>
            </v-col>
          </v-row>
          <v-divider></v-divider>
          <v-card-actions >
            <div class="text-center">
            <router-link class="mr-2 caption " :to="{name:'privacy-policy'}">Privacy Policy</router-link>
            <router-link class="caption "   :to="{name:'terms-conditions'}">Terms and conditions</router-link>
            </div>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  data() {
    return {};
  },
  computed: {},
  components: {},


};
</script>
<style>
.text-input input {
  color: #000000 !important;
  font-weight: bold;
}

.text-input textarea {
  color: #000000 !important;
  font-weight: bold;
}

.bg-application {
  background-color: #EEEEEE;
}


.link{
  text-decoration: none;
}

</style>

