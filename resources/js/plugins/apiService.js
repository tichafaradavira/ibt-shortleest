import Vue from 'vue'
import axios from "axios";


export default {
    install(Vue, options) {
        Vue.prototype.$axios = axios;
        // Vue.prototype.$axios.defaults.baseURL = "https://www.shortleest.com/api";
        Vue.prototype.$axios.defaults.baseURL = process.env.MIX_URL+"/api";
    }
};
