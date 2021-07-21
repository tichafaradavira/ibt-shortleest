<template>
  <div class="light-blue  accent-2 pa-2">
    <v-row>
      <v-col cols="12" class="d-flex justify-center">
        <v-card flat color="#fff" max-width="300" v-if="loading">
          <loading
              absolute="true"
              class="mx-auto"
              size="60"
              :text="loadingMessage"
              :color="loadingColor"
          ></loading>
        </v-card>
      </v-col>
    </v-row>


    <v-row v-if="vacancy && !loading">
      <v-col align="center"
             justify="center" cols="12">

        <v-card outlined class="pa-4" color="#EEE" max-width="1000">
          <v-row>
            <v-col class="text-center">
              <h2 class="text-h2 blue--text m-2 font-weight-bold">ShortLeest</h2>
              <v-divider></v-divider>
              <h2 class="display-1 blue-grey--text mt-2 font-weight-bold">Application for Rental</h2>
            </v-col>
          </v-row>
          <v-row>
            <v-col class="text-center">
              <application-head :property="property"></application-head>
              <div class="text-center ml-4">
                <router-link class="mr-2 caption blue--text" :to="{name: 'privacy-policy'}">Privacy Policy</router-link>
                <router-link class="caption blue--text " :to="{name: 'terms-conditions'}">Terms and conditions
                </router-link>
              </div>
            </v-col>
          </v-row>
          <v-row v-if="errorMessage">
            <v-col class="d-flex justify-center align-center" cols="12">
              <v-alert
                  max-width="1000"
                  dense
                  outlined
                  type="error"
              >
                <strong>{{ errorMessage }}</strong>
              </v-alert>
            </v-col>
          </v-row>
          <ValidationObserver ref="observer" immediate v-slot="{ handleSubmit }">
            <v-form class="text-left" @submit.prevent="handleSubmit(submitApplication)">
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">1. Application Details</v-card-title>
                <v-card-subtitle class="green--text">Basic personal details</v-card-subtitle>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="First name"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="First Name"
                          placeholder="First Name"
                          :error-messages="errors[0]"
                          v-model="application.first_name"
                          hint="This is the first name of the application."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Last name"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Last Name"
                          placeholder="Last Name"
                          :error-messages="errors[0]"
                          v-model="application.last_name"
                          hint="This is the last name of the application."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Nationality"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Nationality"
                          placeholder="Nationality"
                          :error-messages="errors[0]"
                          v-model="application.nationality"
                          hint="This is the nationality of the application."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Citizenship"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Citizenship"
                          placeholder="Citizenship"
                          :error-messages="errors[0]"
                          v-model="application.citizenship"
                          hint="This is the citizenship of the application."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!---->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Date of birth"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Date of birth"
                          placeholder="Date of birth"
                          :error-messages="errors[0]"
                          v-model="application.dob"
                          hint="DD-MM-YYYY"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="National ID/Social Security number"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="National ID"
                          placeholder="Citizenship"
                          :error-messages="errors[0]"
                          v-model="application.national_id"
                          hint="Your  national ID/Social Security Number"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Gender"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-select
                          class="text-select"
                          :items="gender"
                          :error="errors[0] !== undefined"
                          v-model="application.gender"
                          :error-messages="errors[0]"
                          item-text="text"
                          item-value="value"
                          filled
                          label="Gender"
                          outlined
                      ></v-select>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                  </v-col>
                </v-row>
                <!---->
              </v-card>
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">2. Contact Details</v-card-title>
                <v-card-subtitle class="green--text">Your contact information.</v-card-subtitle>

                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Mobile Number"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Mobile Number"
                          placeholder="Mobile number"
                          :error-messages="errors[0]"
                          v-model="application.mobile_number"
                          hint="Your cellphone number"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Home Number"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Home Number"
                          placeholder="Home number"
                          :error-messages="errors[0]"
                          v-model="application.home_number"
                          hint="Your home number."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Work Number"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Work Number"
                          placeholder="Work number"
                          :error-messages="errors[0]"
                          v-model="application.work_number"
                          hint="Your work number."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Email"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Email"
                          placeholder="Email"
                          v-model="application.email"
                          :error-messages="errors[0]"
                          hint="Your email address."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Fax"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          label="Fax"
                          placeholder="Fax"
                          v-model="application.fax"
                          :error-messages="errors[0]"
                          hint="This is the fax of the application."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                  </v-col>
                </v-row>

              </v-card>
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">3. Physical Address</v-card-title>
                <v-card-subtitle class="green--text">Your current physical address.</v-card-subtitle>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Street address"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Street address"
                          placeholder="Street address"
                          :error-messages="errors[0]"
                          v-model="application.physical_address_street"
                          hint="Street address"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Physical address Suburb"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Suburb"
                          placeholder="Suburb"
                          :error-messages="errors[0]"
                          v-model="application.physical_address_surburb"
                          hint="Suburb"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Physical address City"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="City"
                          placeholder="City"
                          v-model="application.physical_address_city"
                          :error-messages="errors[0]"
                          hint="City"
                      ></v-text-field>
                    </ValidationProvider>

                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Address Postcode"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Post code"
                          placeholder="Post code"
                          :error-messages="errors[0]"
                          v-model="application.physical_address_postcode"
                          hint="Address postcode"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Equal"
                        rules="required"
                        v-slot="{ errors }"
                        vid="application.postal_equal_to_physical"
                    >
                      <v-switch
                          v-model="application.postal_equal_to_physical"
                          label="Is this is the same as the postal address?"
                      ></v-switch>
                      <span class="red--text font-weight-bold">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                  </v-col>
                </v-row>
                <!--                -->
              </v-card>
              <v-card v-if="!application.postal_equal_to_physical" class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">3. Postal Address</v-card-title>
                <v-card-subtitle class="green--text">The address to which mail should be delivered</v-card-subtitle>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Postal street address"
                        rules="required_if:application.postal_equal_to_physical,false"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Street address"
                          placeholder="Street address"
                          :error-messages="errors[0]"
                          v-model="application.postal_address_street"
                          hint="Postal Street address"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Postal address suburb"
                        rules="required_if:application.postal_equal_to_physical,false"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Suburb"
                          placeholder="Suburb"
                          :error-messages="errors[0]"
                          v-model="application.postal_address_surburb"
                          hint="Postal address suburb"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Postal address city"
                        rules="required_if:application.postal_equal_to_physical,false"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="CIty"
                          placeholder="City"
                          :error-messages="errors[0]"
                          v-model="application.postal_address_city"
                          hint="Postal address city"
                      ></v-text-field>
                      <span class="red--text font-weight-bold">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Postal address postcode"
                        rules="required_if:application.postal_equal_to_physical,false"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Post code"
                          placeholder="Post code"
                          :error-messages="errors[0]"
                          v-model="application.postal_address_postcode"
                          hint="Postal address post code."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
              </v-card>
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">3. Employment Details</v-card-title>
                <v-card-subtitle class="green--text">Employment information.</v-card-subtitle>

                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Employment Status"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Employment Status"
                          placeholder="Employment Status"
                          :error-messages="errors[0]"
                          v-model="application.employment_status"
                          hint="Your employment status."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Employer name"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Employer name"
                          placeholder="Employer name"
                          :error-messages="errors[0]"
                          v-model="application.employer_name"
                          hint="Who is your employer."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Employer phone"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Employer phone"
                          placeholder="Employer phone"
                          :error-messages="errors[0]"
                          v-model="application.employer_phone"
                          hint="Your employer's phone"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Employer Email"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Employer Email"
                          placeholder="Email"
                          :error-messages="errors[0]"
                          v-model="application.employer_email"
                          hint="Your employers's email address."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Gross salary"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Gross salary"
                          placeholder="Gross salary"
                          :error-messages="errors[0]"
                          v-model="application.gross_salary"
                          hint="How much do you earn?"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Employer address"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-textarea
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Employer address"
                          placeholder="Employer address"
                          :error-messages="errors[0]"
                          v-model="application.employer_address"
                          hint="This is the application address of the client."
                      ></v-textarea>
                    </ValidationProvider>
                  </v-col>
                </v-row>
              </v-card>
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">4. Other Details</v-card-title>
                <v-card-subtitle class="green--text">More information about you.</v-card-subtitle>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Dependants"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          type="number"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Number of dependants"
                          placeholder="Number of dependants"
                          v-model="application.dependants"
                          hint="This is the number of dependants of the application."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Reason for moving"
                        rules=""
                        v-slot="{ errors }"
                    >
                      <v-textarea
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Reason for moving"
                          placeholder="Reason for moving"
                          :error-messages="errors[0]"
                          v-model="application.reason_for_moving"
                          hint="This is the reason for moving."
                      ></v-textarea>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="I am a smoker"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-switch
                          v-model="application.is_smoker"
                          label="I am a smoker"
                      ></v-switch>
                      <span class="red--text font-weight-bold">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="I have pets"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-switch
                          v-model="application.has_pets"
                          label="I have pets"
                      ></v-switch>
                      <span class="red--text font-weight-bold">{{ errors[0] }}</span>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <!--                -->
              </v-card>
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">5. Next Of Kin</v-card-title>
                <v-card-subtitle class="green--text">An emergency contact.</v-card-subtitle>

                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Next of kin name"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Next of kin name"
                          placeholder="Next of kin name"
                          :error-messages="errors[0]"
                          v-model="application.next_of_kin_name"
                          hint="Who is your next of kin?"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Next of kin email"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Next of kin email"
                          placeholder="Next of kin email"
                          :error-messages="errors[0]"
                          v-model="application.next_of_kin_email"
                          hint="This is the next of kin email of the application."
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                </v-row>
                <v-row>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Next of kin phone"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-text-field
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Next of kin phone"
                          placeholder="Next of kin phone"
                          :error-messages="errors[0]"
                          v-model="application.next_of_kin_phone"
                          hint="What is your next of kin's phone"
                      ></v-text-field>
                    </ValidationProvider>
                  </v-col>
                  <v-col cols="6">
                    <ValidationProvider
                        name="Next of kin address"
                        rules="required"
                        v-slot="{ errors }"
                    >
                      <v-textarea
                          class="text-input"
                          outlined
                          :error="errors[0] !== undefined"
                          label="Next of kin address"
                          placeholder="Next of kin address"
                          :error-messages="errors[0]"
                          v-model="application.next_of_kin_address"
                          hint="Next of kin address."
                      ></v-textarea>
                    </ValidationProvider>
                  </v-col>
                </v-row>

              </v-card>
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">6. References</v-card-title>
                <v-card-subtitle class="green--text">People we can ask about you (preferably previous landlords).
                </v-card-subtitle>
                <v-card class="pa-4" flat color="#FFF">
                  <p v-if="application.references.length === 0 " class="font-weight-bold blue-grey--text">-- No
                    references
                    added yet -- </p>
                </v-card>
                <v-card outlined class="ma-2 pa-2" v-for="(reference,index) in application.references" :key="index">
                  <v-row>
                    <v-col cols="6">
                      <ValidationProvider
                          name="Reference name"
                          rules="required"
                          v-slot="{ errors }"
                      >
                        <v-text-field
                            class="text-input"
                            outlined
                            :error="errors[0] !== undefined"
                            label="Reference's name"
                            placeholder="Reference's name"
                            :error-messages="errors[0]"
                            v-model="application.references[index].name"
                            hint="Reference name"
                        ></v-text-field>
                      </ValidationProvider>
                    </v-col>
                    <v-col cols="6">
                      <ValidationProvider
                          name="Name"
                          rules="required"
                          v-slot="{ errors }"
                      >
                        <v-text-field
                            class="text-input"
                            outlined
                            :error="errors[0] !== undefined"
                            label="Reference email"
                            placeholder="Reference email"
                            :error-messages="errors[0]"
                            v-model="application.references[index].email"
                            hint="Reference's email"
                        ></v-text-field>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col cols="6">
                      <ValidationProvider
                          name="Phone"
                          rules="required"
                          v-slot="{ errors }"
                      >
                        <v-text-field
                            class="text-input"
                            outlined
                            :error="errors[0] !== undefined"
                            label="Reference phone"
                            placeholder="Reference phone"
                            :error-messages="errors[0]"
                            v-model="application.references[index].phone"
                            hint="Reference phone"
                        ></v-text-field>
                      </ValidationProvider>
                    </v-col>
                    <v-col cols="6">
                      <ValidationProvider
                          name="Reference address"
                          rules="required"
                          v-slot="{ errors }"
                      >
                        <v-textarea
                            class="text-input"
                            outlined
                            :error="errors[0] !== undefined"
                            label="Reference address"
                            placeholder="Reference address"
                            :error-messages="errors[0]"
                            v-model="application.references[index].address"
                            hint="This is the reference email of the application."
                        ></v-textarea>
                      </ValidationProvider>
                    </v-col>
                  </v-row>
                  <v-card-actions class="d-flex flex-row justify-end">
                    <v-btn v-if="index != 0" class="error mr-2" @click="()=>removeReference(index)">
                      Remove
                    </v-btn>
                    <v-chip v-else class="ma-2" color="primary">
                      Default
                    </v-chip>
                  </v-card-actions>
                </v-card>

                <v-card-actions>
                  <v-btn class="mr-2 white--text" color="teal" @click="addReference">
                    Add reference
                  </v-btn>

                </v-card-actions>

              </v-card>
              <v-card class="pa-4 ma-4" flat>
                <v-card-title class="green--text font-weight-bold">7. Expenses</v-card-title>
                <v-card-subtitle class="green--text">Your living expenses.</v-card-subtitle>
                <v-card flat class="ma-2 pa-1" v-for="(expense,index) in application.expenses" :key="index">
                  <v-row>
                    <v-col cols="5">
                      <ValidationProvider
                          name="Expense"
                          rules="required"
                          v-slot="{ errors }"
                      >
                        <v-text-field
                            class="text-input"
                            dense
                            outlined
                            :error="errors[0] !== undefined"
                            label="Expense"
                            placeholder="Expense"
                            :error-messages="errors[0]"
                            v-model="application.expenses[index].expense"
                            hint="Expense"
                        ></v-text-field>
                      </ValidationProvider>
                    </v-col>
                    <v-col cols="5">
                      <ValidationProvider
                          name="Cost"
                          rules="required|number"
                          v-slot="{ errors }"
                      >
                        <v-text-field
                            class="text-input"
                            dense
                            outlined
                            :error="errors[0] !== undefined"
                            label="Cost"
                            placeholder="$0.0"
                            v-model="application.expenses[index].cost"
                            hint="How much is the expense"
                        ></v-text-field>
                      </ValidationProvider>
                    </v-col>
                    <v-col cols="2">
                      <v-btn v-if="index != 0" class="error" @click="()=>removeExpense(index)">
                        Remove
                      </v-btn>
                      <v-chip v-else class="ma-2" color="primary">
                        Default
                      </v-chip>


                    </v-col>
                    <hr>
                  </v-row>
                </v-card>
                <v-card-actions>
                  <v-btn class="mr-2 white--text" color="teal" @click="addExpense">
                    Add Expense
                  </v-btn>
                </v-card-actions>

                <!--                -->
                <hr>
                <v-card-actions class="pa-4">
                  <v-btn class="primary mr-2" large @click="submitApplication">Submit Application</v-btn>
                </v-card-actions>
              </v-card>
            </v-form>
          </ValidationObserver>
        </v-card>
      </v-col>

    </v-row>
  </div>
</template>
<script>

import loading from "../../general/loading";
import ApplicationHead from "../components/ApplicationHead";
import {FEMALE, MALE} from "./constants";

export default {

  data() {
    return {
      application: {
        first_name: 'Liana',
        middle_name: 'Bella',
        last_name: 'Hadid',
        nationality: 'Zimbabwean',
        citizenship: 'Zimbabwean',
        dob: '3-3-1991',
        national_id: '243536363L78',
        gender: MALE,

        mobile_number: '096373733',
        home_number: '096373333',
        work_number: '093373733',
        email: 'bella@gmail.com',
        fax: '42424242424',

        physical_address_street: '24 Cortney',
        physical_address_surburb: 'Hullevile',
        physical_address_city: 'Randburg',
        physical_address_postcode: '3222',
        postal_equal_to_physical: false,

        postal_address_street: '25 Buller',
        postal_address_surburb: 'Koliville',
        postal_address_city: 'Bulawayo',
        postal_address_postcode: '88877',

        next_of_kin_name: 'Dazzling',
        next_of_kin_email: 'dazling@gmail.com',
        next_of_kin_phone: '099939333',
        next_of_kin_address: '23 Del avenue, Hukai lop',

        employment_status: 'Employed',
        employer_name: 'VRED inc',
        employer_email: 'hr@vred.com',
        employer_phone: '0423423423',
        employer_address: '067373737',
        gross_salary: '636363',

        dependants: 2,
        reason_for_moving: '"Sed ut perspiciatis unde omnis iste natus error ' +
            'sit voluptatem accusantium doloremque laudantium, totam rem' +
            ' aperiam, eaque ipsa quae ab illo inventore veritatis' +
            'et quasi architecto beatae vitae dicta sunt explicabo. ' +
            'Nemo enim ipsam voluptatem quia voluptas sit aspernatur' +
            ' aut odit aut fugit, sed quia consequuntur magni dolores' +
            ' eos qui ratione voluptatem sequi nesciunt. Neque porro' +
            ' quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, ' +
            'adipisci velit, sed quia non numquam eius modi tempora incidunt ut ' +
            'labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima' +
            ' veniam, quis nostrum exercitationem ullam corporis suscipit ' +
            '\n',
        is_smoker: false,
        has_pets: false,

        references: [
          {
            name: 'Benard',
            email: 'bnard@gmail.com',
            phone: '03423423',
            address: '12 Noliut backou Loupod',
          }
        ],
        expenses: [
          {
            expense: 'Bacon',
            cost: 344,
          }
        ]
      },
      gender: [
        {
          text: 'Male',
          value: MALE
        },
        {
          text: 'Female',
          value: FEMALE,
        }
      ],
      errorMessage: null,
      realtor: null,
      vacancy: null,
      property: null,
      token: null,
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
    ApplicationHead,
    loading
  },
  methods: {
    async submitApplication() {
      const isValid = await this.$refs.observer.validate();

      window.scrollTo(0, 0);
      this.loadingMessage = "Submitting application...";


      if (isValid) {
        this.loading = true;
        this.$axios.post(
            `/apply/${this.realtor}/${this.token}`,
            this.application
        )
            .then(response => {
              this.application = false;
              let application = response.data;
              this.loading = false;
              this.$router.push({name: 'apply-submitted'})
            }).catch(error => {
          this.errorMessage = error.response.data;
          this.loading = false;
        });
      }
    },
    addReference() {
      this.application.references.push({
        name: '',
        email: '',
        phone: '',
        address: ''
      });
    },
    removeReference(index) {
      this.application.references.splice(index, 1);
    },
    addExpense() {
      this.application.expenses.push({
        expense: '',
        cost: null,
      });
    },
    removeExpense(index) {
      this.application.expenses.splice(index, 1);
    },
    initialise() {
      this.realtor = this.$route.params.id;
      this.token = this.$route.params.token;
      this.$axios.get(
          `/apply/${this.realtor}/${this.token}`
      )
          .then(response => {
            this.vacancy = response.data;
            this.property = this.vacancy.property;
            this.loading = false;
          }).catch(error => {
        this.errorMessage = error.response.data;
        this.loading = false;
      });
    }
  },
  mounted() {
    this.initialise();
  }

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
  background-image: linear-gradient(to bottom, #03A9F4, #1A237E);
}

</style>

