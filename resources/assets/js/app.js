
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

Vue.component('chat-component', require('./components/ChatComponent.vue'));
Vue.component('calendar-component', require('./components/CalendarComponent.vue'));

import moment from 'moment'
import vueEventCalendar from 'vue-event-calendar'
Vue.use(vueEventCalendar, {
    locale: 'en',
    color: '#2C3E50'
});

Vue.prototype.moment = moment;

const app = new Vue({
    el: '#app'
});
