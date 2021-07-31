<template>
    <v-app light>
        <v-app-bar absolute app color="#FFF" dark>
            <router-link class="text-decoration-none" :to="{name: 'home'}">
                <v-toolbar-title class="blue--text display-1 font-weight-bold">ShortLeest<sup
                    class=" caption red--text">Beta</sup></v-toolbar-title>
            </router-link>
            <v-spacer></v-spacer>
            <div>
                <v-btn :to="{name:'signin'}" class="mr-2" outlined color="blue">Login</v-btn>
                <v-btn :to="{name:'signup'}" class="mr-2" color="blue">Sign Up</v-btn>
            </div>
        </v-app-bar>
        <v-content>
            <section class="amber lighten-5">
                <v-parallax :src="'./images/condominium.jpg'" height="800">
                    <v-layout column align-center justify-center class="white--text">
                        <h1 class="white--text mb-2 display-1 text-xs-center"
                            style="font-weight: 900; text-shadow: 3px 2px #000000">
                            Find someone a home, easily...</h1>
                        <div class="whit--text subheading mb-3 text-xs-center"
                             style="font-weight: 900; text-shadow: 2px 2px #000000">Manage properties, prospective
                            tenants, rental
                            applications and rental vacancies with ease.
                        </div>
                        <v-btn class="green  mt-5" dark x-large :to="{name:'signup'}">
                            Get Started
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section class="amber lighten-5">
                <v-layout
                    column
                    class=""
                    align-center
                >
                    <v-flex xs12 sm4 class="my-3">
                        <div class="text-xs-center pa-4">
                            <!--     V Dialog          -->
                            <v-dialog
                                v-model="dialog"
                                width="500"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        color="red"
                                        plain
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        What is beta mode?
                                    </v-btn>
                                </template>

                                <v-card>
                                    <v-card-title class="text-h5 grey lighten-2">
                                        Please Note
                                    </v-card-title>

                                    <v-card-text>
                                        Beta mode is a testing mode, which allows us to get feedback from you in a safe
                                        way.This helps us with improving the product(BEFORE AYONE PAYS FOR THE SERVICE).
                                        While its highly unlikely, you might encounter some problems while using the
                                        application.The good thing is you are not charged anything when the application
                                        still in beta mode.
                                        If you encounter any issues, or if you have any queries, suggestions, etc please
                                        contact <a>enquiries@shortleest.com</a>
                                    </v-card-text>

                                    <v-divider></v-divider>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="dialog = false"
                                        >
                                            OK
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                            <!--              -->
                            <h2 class="display-1 green--text font-weight-bold m-2">Track rental applications easily</h2>
                            <span class=" body-1 blue-grey--text font-weight-bold">
                Reduce your carbon footprint
              </span>
                        </div>
                    </v-flex>
                    <v-flex xs12>
                        <v-container grid-list-xl>
                            <v-layout row wrap align-center>
                                <v-flex xs12 md4>
                                    <v-card class="white">
                                        <v-card-text class="text-xs-center">
                                            <span class="display-1 font-weight-bold blue--text">Simple</span>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Easy to use</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Shortleest is easy to understand and use, you will be productive in no time.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="white">
                                        <v-card-text class="text-xs-center">
                                            <span class="display-1 font-weight-bold blue--text">Convenient</span>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Use from anywhere.</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Since Shortleest is web based, you dont need to have any particular computer
                                            with you.Any computer
                                            with a web browser can get you well on your way to finding someone a home.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="white">
                                        <v-card-text class="text-xs-center">
                                            <span class="display-1 font-weight-bold blue--text">No Installation</span>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline">Just plug and play</div>
                                        </v-card-title>
                                        <v-card-text>
                                            You dont need to setup or install anything because the application is web
                                            based.
                                        </v-card-text>
                                    </v-card>

                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

            <section>
                <v-parallax :src="'./images/architecture.jpg'" height="650">
                    <v-layout column align-center justify-center>
                    </v-layout>
                </v-parallax>
            </section>

            <section class="amber lighten-5">
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex xs12 text-xs-center class="mt-5">
                            <p class=" text-h2 red--text font-weight-bold">Pricing</p>
                            <br>
                            <div>
                                Manage your real estate business from anywhere, at any time with efficiency.
                            </div>
                        </v-flex>
                        <v-flex xs8 offset-xs2>
                            <v-card class="elevation-0  ma-4 transparent">
                                <v-row>
                                    <v-col cols="6">
                                        <v-card
                                            class="mx-auto"
                                            max-width="344"
                                        >
                                            <v-card-text>
                                                <div class="font-weight-black">Trial</div>
                                                <p class="text-h4 blue--text font-weight-bold">
                                                    1 Month
                                                </p>
                                                <p class="green--text font-weight-bold text-h2">Free<br><span
                                                    class="caption font-weight-bold">(No Credit card required)</span>
                                                </p>
                                                <div class="text--primary">
                                                    <p class="blue-grey--text">If you are not sure whether Shortleest is
                                                        for you, try for one
                                                        month.</p>
                                                    <v-divider/>
                                                    <v-list
                                                    >
                                                        <v-list-item>

                                                            <v-list-item-content>
                                                                    <v-list-item-title class="font-weight-bold">
                                                                        <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                        Manage clients
                                                                    </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-list-item-title class="font-weight-bold">
                                                                    <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                    Manage vacancies
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-list-item-title class="font-weight-bold">
                                                                    <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                    Manage client properties
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-list-item-title class="font-weight-bold">
                                                                    <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                    Manage   applications
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                        <v-list-item>
                                                            <v-list-item-content>
                                                                <v-list-item-title class="font-weight-bold">
                                                                    <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                    Manage tenants
                                                                </v-list-item-title>
                                                            </v-list-item-content>
                                                        </v-list-item>
                                                    </v-list>
                                                </div>
                                                <v-divider/>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-btn :to="{name:'signup'}" large block outlined
                                                       class="green white--text font-weight-bold">
                                                    Signup
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-col>
                                    <v-col cols="6">
                                        <v-card
                                            class="mx-auto"
                                            max-width="344"
                                        >
                                            <v-card-text>
                                                <div class="font-weight-black">Monthly</div>
                                                <p class="text-h4 blue--text font-weight-bold">
                                                    30 Days
                                                </p>
                                                <p class="green--text font-weight-bold text-h2">US$12.00 <span
                                                    class="caption font-weight-bold">(Including VAT)</span>
                                                </p>
                                                <p class="blue-grey--text">For as little as $12, you can get to manage
                                                    rentals and tenants
                                                    seamlessly.</p>
                                                <v-divider/>

                                                <v-list
                                                >
                                                    <v-list-item>
                                                        <v-list-item-content>
                                                            <v-list-item-title class="font-weight-bold">
                                                                <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                Manage clients
                                                            </v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>
                                                    <v-list-item>
                                                        <v-list-item-content>
                                                            <v-list-item-title class="font-weight-bold">
                                                                <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                Manage vacancies
                                                            </v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>
                                                    <v-list-item>
                                                        <v-list-item-content>
                                                            <v-list-item-title class="font-weight-bold">
                                                                <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                Manage client  properties
                                                            </v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>
                                                    <v-list-item>
                                                        <v-list-item-content>
                                                            <v-list-item-title class="font-weight-bold">
                                                                <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                Manage applications
                                                            </v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>
                                                    <v-list-item>
                                                        <v-list-item-content>
                                                            <v-list-item-title class="font-weight-bold">
                                                                <v-icon class="green--text">mdi-check-bold</v-icon>
                                                                Manage tenants
                                                            </v-list-item-title>
                                                        </v-list-item-content>
                                                    </v-list-item>
                                                </v-list>
                                                <v-divider/>
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-btn :to="{name:'signin'}" large block outlined
                                                       class="green white--text font-weight-bold">
                                                    Sign In
                                                </v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>

            <section>
                <v-parallax :src="'./images/living-room.jpg'" height="600">
                </v-parallax>
            </section>

            <section class="amber lighten-5 pa-4">
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline font-weight-bold">Services</div>
                                </v-card-title>
                                <h3 class="caption green--text font-weight-bold">An addictively simple and convinient
                                    application for:</h3>
                                <v-card-text class=" subtitle-1 font-weight-bold">
                                    Clients management <span class=" red--text">*</span> Properties management <span
                                    class=" red--text">*</span>
                                    Tenant Management <span class=" red--text">*</span> Vacany management <span
                                    class=" red--text">*</span> Rental applications management
                                    <v-btn class="green--text  mt-5" outlined large :to="{name:'signup'}">
                                        Try for 1 month free
                                    </v-btn>
                                    <p class="red--text">No credit card required</p>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm4>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline font-weight-bold">Contact Us</div>
                                </v-card-title>
                                <v-card-text class="subtitle-1">
                                    If you have any questions, suggestions, queries, e.t.c you can contact us at <a
                                    class="font-weight-bold text-decoration-none"
                                    href="mailto: enquiries@shortleest.com">enquiries@shortleest.com</a>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>

            <section>
                <v-parallax :src="'./images/skyline.jpg'" height="600">
                </v-parallax>
            </section>
            <v-footer
                dark
                padless
            >
                <v-card
                    flat
                    tile
                    class="blue  white--text text-center"
                >
                    <v-card-text>
                        <!--            <v-btn-->
                        <!--                v-for="icon in icons"-->
                        <!--                :key="icon"-->
                        <!--                class="mx-4 white&#45;&#45;text"-->
                        <!--                icon-->
                        <!--            >-->
                        <!--              <v-icon size="24px">-->
                        <!--                {{ icon }}-->
                        <!--              </v-icon>-->
                        <!--            </v-btn>-->
                    </v-card-text>

                    <v-card-text class="white--text pt-0">
                        Are you tired of going through a heap of files to find information about clients whose property
                        you are
                        managing? Are you tired of having to carry a tone of papers with you inorder to work remotely?
                        Are you tired
                        of having to download sanned copies of tenant applications? . Welcome to ShortLeest! Become more
                        efficient at managing properties, whether the properties are yours or belong to your clients
                    </v-card-text>

                    <v-divider></v-divider>

                    <v-card-text class="white--text">
            <span
                class="white--text caption">&copy;2021 All rights reserved, Shortleest is the property of IBT technologies</span>
                        <div class="text-center ml-4">
                            <router-link class="mr-2 caption white--text" :to="{name: 'privacy-policy'}">Privacy
                                Policy
                            </router-link>
                            <router-link class="caption white--text " :to="{name: 'terms-conditions'}">Terms and
                                conditions
                            </router-link>
                        </div>
                    </v-card-text>
                </v-card>
            </v-footer>

        </v-content>
    </v-app>
</template>

<script>
export default {
    name: "Home",
    data: function () {
        return {
            dialog: false,
        };
    },
    methods: {}
};
</script>

<style scoped>
.finedTitle {
    font-weight: 900;
    text-shadow: 2px 2px #000000;
}

.social-icon {
    font-size: 21px;
    color: white;
}
</style>
