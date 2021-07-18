import {ValidationProvider, extend, ValidationObserver} from "vee-validate";
import Vue from 'vue'
import * as VeeValidate from 'vee-validate';
import {required, required_if ,email,confirmed,numeric,double} from 'vee-validate/dist/rules';

export default {
    install(Vue, options) {

        Vue.use(VeeValidate, {
            classes: true,
            classNames: {
                valid: 'text--success',
                invalid: 'text--danger'
            }
        });

        Vue.component('ValidationProvider', ValidationProvider);
        Vue.component('ValidationObserver', ValidationObserver);

        extend('required', {
            ...required,
            message: 'The  {_field_} field is required'
        });

        extend('required_section', {
            ...required,
            message: '{_field_} section cannot be empty'
        });

        extend('double', {
            ...double,
            message: '{_field_} needs to be valid decimal'
        });

        extend('required_if', {
            ...required_if,
            message: 'The  {_field_} field is required'
        });

        extend('numeric', {
            ...numeric,
            message: 'The  {_field_} field should be a number'
        });

        extend('email', {
            ...email,
            message: 'This  {_field_} should be a valid email. '
        });

        extend('confirmed', {
            ...confirmed,
            message: 'Password confirmation does not match '
        });

        extend('date', value => {

            if (value.match(/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/)) {
                return true;
            }
            return 'The date must be in the format dd-mm-yyyy e.g 13-03-2021';
        });

        extend('number', value => {

            if (String(value).match(/^\d+(\.\d+)?$/)) {
                return true;
            }
            return 'Invalid number';
        });
    }
};
