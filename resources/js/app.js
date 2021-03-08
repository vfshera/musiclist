
import Vue from 'vue';

import  VueRouter from 'vue-router'
import Swal from 'sweetalert2'

require('./bootstrap');


import VueClipboards from 'vue-clipboards';

Vue.use(VueClipboards);


import titleHelpers from './helpers/titleHelper'

const plugin = {
    install () {
        Vue.seohelpers = titleHelpers
        Vue.prototype.$seohelpers = titleHelpers
    }
}

Vue.use(plugin)

import { routes } from './routes'

import store from "./store";


window.Swal = Swal;
window.Fire = new Vue();
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

// import '../form-assets/js/main'

Vue.use(VueRouter)

const router = new VueRouter({
        routes,
        mode:'history',
    })



function isLoggedIn(){
    return localStorage.getItem('isLoggedIn') && JSON.parse(localStorage.getItem('LoggedInAs')).access == 0;
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {

        if (!isLoggedIn()) {
            next({
                path: '/',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }

    } else {
        next()
    }
})




Vue.component('entry', require('./Main').default);
Vue.component('master', require('./Master').default);

const app = new Vue({
    el: '#app',
    router,
    store,
});
