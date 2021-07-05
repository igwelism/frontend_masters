/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusSquare, faMinusSquare, faTrash } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faPlusSquare, faMinusSquare, faTrash)

Vue.component('font-awesome-icon', FontAwesomeIcon)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('food-component', require('./components/FoodComponent.vue').default);
Vue.component('laundry-component', require('./components/LaundryComponent.vue').default);
Vue.component('cleaning-component', require('./components/CleaningComponent').default);
Vue.component('cart-component', require('./components/CartComponent').default);
Vue.component('profile-component', require('./components/ProfileComponent').default);
Vue.component('address-component', require('./components/AddressComponent').default);
Vue.component('subscription-component', require('./components/SubscriptionComponent').default);
Vue.component('admin-subscription-component', require('./components/AdminSubscriptionComponent').default);
Vue.component('customer-component', require('./components/CustomerComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
