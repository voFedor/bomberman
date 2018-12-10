
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-chat-scroll'));
import VModal from 'vue-js-modal';


import VuejsDialog from "vuejs-dialog";

// include the default style

// Tell Vue to install the plugin.
Vue.use(VuejsDialog);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('chat-component', require('./components/LobbyComponent.vue'));
Vue.component('chat-component', require('./components/ChatComponent.vue'));
// register modal component

Vue.component('modal', {
    template: '#modal-template'
})


const app = new Vue({
    el: '#app',
    data: {
        showModal: false
    }
});
