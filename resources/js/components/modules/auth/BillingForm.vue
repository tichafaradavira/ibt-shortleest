<template>
    <v-container class="pa-4 ma-0">
        <v-row>
            <v-col class="text-left">
                <h2 class="display-1 font-weight-bold">Billing information</h2>
                <h3 class="subtitle-1 font-weight-bold">Your billing information</h3>
            </v-col>
        </v-row>
        <v-row>
            <v-col class="d-flex  justify-center" cols="12" >
                <div>
                <p v-if="trialExpired" class="red--text font-weight-bold">Your trial period has expired. Please add a payment method for your account.</p>
                <v-card class="pa-4 text-left" min-width="800" max-width="800">
                    <v-progress-linear
                        v-if="loading"
                        indeterminate
                        :color="loadingColor"
                    ></v-progress-linear>
                    <v-card-title><v-icon font-size="20" class="blue--text ma-2">mdi-credit-card-plus-outline</v-icon>Add payment method</v-card-title>
                    <v-divider/>
                    <v-card-text class="pa-4">
                        <p v-if="addPaymentStatusError" class="red--text font-weight-bold ma-2">{{addPaymentStatusError}}</p>
                        <label class="black--text" for="card-element">Card holder's name</label>
                        <v-text-field
                            dense
                            class="text-input"
                            outlined
                            placeholder="Card Holder Name"
                            v-model="name"
                            hint="This is the  card holders's name."
                        ></v-text-field>
                        <label class="black--text" for="card-element">Credit/Debit card number</label>
                        <div id="card-element" class="form-control" style='height: 2.4em; padding-top: .7em;'>
                            <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <v-checkbox
                            class="ma-2 black--text font-weight-bold"
                            v-model="defaultCard"
                            label="Make default payment method"
                            color="primary"
                        ></v-checkbox>
                        <v-btn class="primary mr-2 " @click="submitPaymentMethod"><v-icon class="mr-1">mdi-credit-card-plus</v-icon>Save payment method</v-btn>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-actions>
                        <h3>Accepted cards</h3>
                        <span class="caption font-weight-bold">American Express,</span>
                        <span class="caption font-weight-bold">China UnionPay (CUP),</span>
                        <span class="caption font-weight-bold">Discover & Diners,</span>
                        <span class="caption font-weight-bold">Japan Credit Bureau (JCB),</span>
                        <span class="caption font-weight-bold ">Mastercard,</span>
                        <span class="caption font-weight-bold">Visa</span>
                    </v-card-actions>
                </v-card>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>
<script>

import loading from "../general/loading";
import _pick from 'lodash/pick'
import CountrySelect from "../general/CountrySelect";
import CurrencySelect from "../general/CurrencySelect";
import {CURRENCIES, COUNTRIES} from "./constants";

export default {
    data() {
        return {
            stripeAPIToken: 'pk_test_51JKEsrIYDkw8EwvfNTmBGdxSgWbsS9XrlO5qwWrKzKZlPW9IB7kCbBCoEaqYRgUXlAIhxbP2tY9n6ZmsE86TYeI400dHQrgU7T',
            stripe: '',
            elements: '',
            card: '',
            intentToken: '',
            name: 'Test Name',
            defaultCard: true,
            trialExpired: false,
            addPaymentStatus: 0,
            addPaymentStatusError: '',
            paymentMethods: [],
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
        submitPaymentMethod(){
            this.loading = true;
            this.addPaymentStatus = 1;

            this.stripe.confirmCardSetup(
                this.intentToken.client_secret, {
                    payment_method: {
                        card: this.card,
                        billing_details: {
                            name: this.name
                        }
                    }
                }
            ).then(function(result) {
                if (result.error) {
                    this.addPaymentStatus = 3;
                    this.addPaymentStatusError = result.error.message;
                    this.loading = false;

                } else {
                    this.savePaymentMethod( result.setupIntent.payment_method );
                    this.addPaymentStatus = 2;
                    this.card.clear();
                    this.name = '';
                }
            }.bind(this));
        },
        includeStripe( URL, callback ){
            let documentTag = document, tag = 'script',
                object = documentTag.createElement(tag),
                scriptTag = documentTag.getElementsByTagName(tag)[0];
            object.src = '//' + URL;
            if (callback) { object.addEventListener('load', function (e) { callback(null, e); }, false); }
            scriptTag.parentNode.insertBefore(object, scriptTag);
        },
        configureStripe(){
            this.stripe = Stripe( this.stripeAPIToken );
            var style = {
                base: {
                    fontWeight: 'bold',
                    border: '2px solid red'
                },
            };
            this.elements = this.stripe.elements();
            this.card = this.elements.create('card',{
                hidePostalCode: true,
                style: style
            });

            this.card.mount('#card-element');
        },
        cancel() {
            this.$router.push({
                    name: 'profile'
                }
            );
        },
        loadIntent(){
            let token = localStorage.getItem("token");

            this.$axios.get(`/users/setup-intent`, {
                headers: {Authorization: `Bearer ${token}`}
            }).then( function( response ){
                    this.intentToken = response.data;
                    this.loading = false;
                }.bind(this));
        },
        savePaymentMethod(method) {
            // this.loading = true;
            let token = localStorage.getItem("token");
            this.$axios.post('/users/payments'
                , {
                    payment_method: method,
                    default: this.defaultCard
                },
                {headers: {Authorization: `Bearer ${token}`}}
                ).then(function () {
                this.loading = false;
                this.$router.push({name:'billing'})
            }.bind(this));
        },
        loadPaymentMethods(){
            let token = localStorage.getItem("token");

            this.$axios.get('/users/payment-methods',
                {headers: {Authorization: `Bearer ${token}`}}
            )
                .then( function( response ){
                    this.paymentMethods = response.data;
                }.bind(this));
        },
    },
    mounted() {
        if(this.$route.query.trialExpired){
            this.trialExpired = true;
        }

        this.includeStripe('js.stripe.com/v3', function(){
            this.configureStripe();
        }.bind(this) );

        this.loadIntent();
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

#card-element {
    border: 1px solid #607D8B;
    border-radius: 4px;
    height: 80px;
    background: #cbf5f8;
    margin-bottom: 20px;
    padding-top: 10px;
}
</style>

