
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('@js/bootstrap');
import Echo from 'laravel-echo'

window.Vue = require('vue');
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
    namespace: null
});

window.AdminOrdersShow = new Vue({
    el: '#admin-orders-show',
    mounted() {
      console.log('parent mounted');
    },
    components: {
      'admin-orders-show': require('./show.vue')
    },
});
