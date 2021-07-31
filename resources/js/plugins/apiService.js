import Vue from 'vue'
import axios from "axios";


export default {
    install(Vue, options) {
        Vue.prototype.$axios = axios;
        // Vue.prototype.$axios.defaults.baseURL = "https://www.shortleest.com/api";
        Vue.prototype.$axios.defaults.baseURL = "http://127.0.0.1:80/api";
    }
};
