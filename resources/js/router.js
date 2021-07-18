import Vue from 'vue';
import Signup from './components/modules/auth/Signup'
import Signin from './components/modules/auth/Signin'
import Auth from './components/layouts/Auth'
import ResetEmail from './components/modules/auth/ResetEmail'
import TermsConditions from "./components/pages/TermsConditions";
import Account from "./components/layouts/Account";
import Application from "./components/modules/applications/Forms/Application";
import Applications from "./components/modules/applications/Applications";
import ViewApplication from "./components/modules/applications/ViewApplication";
import Clients from "./components/modules/clients/Clients";
import ViewClient from "./components/modules/clients/ViewClient";
import ClientForm from "./components/modules/clients/ClientForm";
import Properties from "./components/modules/properties/Properties";
import PropertyForm from "./components/modules/properties/PropertyForm";
import ViewProperty from "./components/modules/properties/ViewProperty";
import Vacancies from "./components/modules/vacancies/Vacancies";
import VacancyForm from "./components/modules/vacancies/VacancyForm";
import ViewVacancy from "./components/modules/vacancies/ViewVacancy";
import VerifyEmail from "./components/modules/auth/VerifyEmail";
import Reset from "./components/modules/auth/Reset";
import ViewProfile from "./components/modules/auth/ViewProfile";
import ProfileForm from "./components/modules/auth/ProfileForm";
import Success from "./components/modules/applications/Forms/Success";
import PrivacyPolicy from "./components/pages/PrivacyPolicy";
import Help from "./components/modules/manual/Help";
import Home from "./components/pages/Home";
import VueRouter from 'vue-router';
Vue.use(VueRouter)

const routes = [
    {
        path: '',
        component: Home,
        name: 'home'
    },
    {
        path: '/auth',
        component: Auth,
        name: 'auth',
        redirect: {
            name: 'signin'
        },
        children: [
            {
                path: 'signin',
                component: Signin,
                name: 'signin',
            },
            {
                path: 'signup',
                component: Signup,
                name: 'signup',
            }
            ,
            {
                path: '/resetemail',
                component: ResetEmail,
                name: 'resetemail'
            },
            {
                path: '/reset/:email',
                component: Reset,
                name: 'reset-password'
            },
            {
                path: '/terms-conditions',
                component: TermsConditions,
                name: 'terms-conditions'
            },
            {
                path: '/privacy-policy',
                component: PrivacyPolicy,
                name: 'privacy-policy'
            },
            {
                path: '/verifyemail/:email',
                component: VerifyEmail,
                name: 'verifyemail'
            },

        ]
    },
    {
        path: '/apply/:id/:token',
        component: Application,
        name: 'apply'
    },
    {
        path: '/apply/submitted',
        component: Success,
        name: 'apply-submitted'
    },
    {
        path: '/account',
        component: Account,
        name: 'account',
        children: [
            {
                path: 'applications',
                component: Applications,
                name: 'applications',
            },
            {
                path: 'application/:id',
                component: ViewApplication,
                name: 'view-application',
            },

            {
                path: 'clients/form/:id?',
                component: ClientForm,
                name: 'client-form',
            },
            {
                path: 'clients/:id',
                component: ViewClient,
                name: 'view-client',
            },
            {
                path: 'clients',
                component: Clients,
                name: 'clients',
            },

            {
                path: 'properties',
                component: Properties,
                name: 'properties',
            },
            {
                path: 'properties/form/:client?/:id?',
                component: PropertyForm,
                name: 'property-form',
            },
            {
                path: 'properties/:id',
                component: ViewProperty,
                name: 'view-property',
            },
            {
                path: 'vacancies/form/:property?/:id?',
                component: VacancyForm,
                name: 'vacancy-form',
            },

            {
                path: 'vacancies/:id',
                component: ViewVacancy,
                name: 'view-vacancy',
            },
            {
                path: 'vacancies',
                component: Vacancies,
                name: 'vacancies',
            },
            {
                path: 'profile',
                component: ViewProfile,
                name: 'profile',
            },
            {
                path: 'profile-form',
                component: ProfileForm,
                name: 'profile-form',
            },
            {
                path: 'help',
                component: Help,
                name: 'help',
            },
        ],
        beforeEnter(to, from, next) {
            let token = localStorage.getItem("token");
            if (token) {
                next()
            } else {
                next('/signin')
            }
        }
    },
    { path: '*', redirect: '/' }

]

export default new VueRouter(
    {
        mode: 'history',
        routes: routes
    })
