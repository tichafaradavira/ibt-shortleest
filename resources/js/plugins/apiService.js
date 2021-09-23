import Vue from 'vue'
import axios from "axios";
import VueRouter from "../router"



export default {
    install(Vue, options) {
        axios.interceptors.response.use(function (response) {
            // Any status code that lie within the range of 2xx cause this function to trigger
            // Do something with response data
            return response;
        }, function (error) {
            // Any status codes that falls outside the range of 2xx cause this function to trigger
            // Do something with response error
            // return Promise.reject(error);
            if(error.response.data == 403){
                VueRouter.push({name:'billing-form', query: { trialExpired: true }})
            }
            else if(error.response.data == 405)
            {
                VueRouter.push({name:'incomplete-billing'})
            }
            else{
                return Promise.reject(error)
            }
        });
        Vue.prototype.$axios = axios;
        Vue.prototype.$axios.defaults.baseURL = process.env.MIX_URL+"/api";
    }
};
