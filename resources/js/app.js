/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Router from 'vue-router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use(Router)
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

const routes = [
    { path: '/', name: 'product_list', component: require('./components/Product/ListComponent.vue').default },
    { path: '/product/add', name: 'product_add', component: require('./components/Product/FormComponent.vue').default },
    { path: '/product/edit/:id', name: 'product_edit', component: require('./components/Product/FormComponent.vue').default, props: true },
    { path: '/category', name: 'category_list', component: require('./components/Category/ListComponent.vue').default },
    { path: '/category/add', name: 'product_add', component: require('./components/category/FormComponent.vue').default },
    { path: '/category/edit/:id', name: 'product_edit', component: require('./components/category/FormComponent.vue').default, props: true },
]
    
const router = new Router({
    mode: 'history',
    routes
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});
