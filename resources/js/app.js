
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('covers', require('./components/CoversComponent.vue'));
Vue.component('item-like', require('./components/ItemLike.vue'));
Vue.component('item-favorite', require('./components/ItemFavorite.vue'));
Vue.component('item-wishlist', require('./components/ItemWishlist.vue'));

// import ES6 style
import {VueMasonryPlugin} from 'vue-masonry';

Vue.use(VueMasonryPlugin)

const app = new Vue({
    el: '#app'
});
