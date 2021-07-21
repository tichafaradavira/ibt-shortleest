<template>
  <v-container class="pa-4 ma-0">
    <v-row>
      <v-col class="text-left">
        <h2 class="display-1 font-weight-bold">Manual</h2>
        <h3 class="subtitle-1">How to use the application</h3>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-card outlined>
          <v-spacer></v-spacer>
          <v-card flat class=" text-left ma-1 pa-4">
            <p class="blue-grey--text">Shortleest is an application that helps you to recruit prospective tenants for properties you are renting
            out.The application allows you to manage property owners(Clients) and the properties they own.More to that,
            the application allows you to create a vacancy for a vacant property, which in turn gives prospective
              tenants the ability to apply to the vacancy.</p>
            <ol>
              <li class="font-weight-bold ma-2">First of all you need to create a client for a particular property.If
                the property is yours, its
                advisable to add your information as the client(optional)
              </li>
              <v-divider></v-divider>
              <li class="font-weight-bold ma-2">You then add a property or properties for the client.</li>
              <v-img
                  max-height="500"
                  max-width="550"
                  :src="'./images/property.jpg'"
              ></v-img>
              <v-divider></v-divider>

              <li class="font-weight-bold ma-2">Once you have a property, open to view the property and you will see at
                the top right of the property
                view a button that says "Create rental vacancy "
              </li>
              <v-img
                  max-height="500"
                  max-width="550"
                  class="ma-2"
                  :src="'./images/create_vacancy.jpg'"
              ></v-img>
              <v-divider></v-divider>

              <li class="font-weight-bold ma-2">Create the vacancy for the property,NOTE: You can only have one active vacancy for a single
                property.
              </li>
              <v-divider></v-divider>

              <li class="font-weight-bold ma-2">When a vacancy is created, there is a link that is created, copy that link and give it to you
                prospective tenants so that they can apply.
              </li>
              <v-img
                  max-height="500"
                  max-width="550"
                  class="ma-2"
                  :src="'./images/vacancy.jpg'"
              ></v-img>
              <v-divider></v-divider>

              <li class="font-weight-bold ma-2">Whenever an applicant applies you will reiceve an email notification.</li>
              <v-divider></v-divider>

              <li class="font-weight-bold ma-2">On the applications page you can click the vacancy link to view the applications for the particular
                vacancy
              </li>

              <v-img
                  max-height="500"
                  max-width="550"
                  class="ma-2"
                  :src="'./images/vacancy_apps.jpg'"
              ></v-img>
              <v-divider></v-divider>

              <li class="font-weight-bold ma-2">When you open an application, you can edit the status of the application.</li>
            </ol>
          </v-card>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      client_id: null,
      dialogMessage: "Are you sure?",
      pagination: {},
      showSuccess: false,
      toDelete: null,
      showDelete: false,
      deleting: false,
      clients: [],
      name: "",
      place: "",
      filterCriteria: false,
      searchCriteria: "",
      loading: true,
      snackbar: false,
      snackMessage: "Done",
      snackColor: "#2E86C1",
    };
  }
};
</script>
<style>
</style>

