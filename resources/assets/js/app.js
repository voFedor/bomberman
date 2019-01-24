
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-chat-scroll'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('chat-component', require('./components/LobbyComponent.vue'));
Vue.component('chat-component', require('./components/ChatComponent.vue'));
// register modal component
import ChatComponent from './components/ChatComponent.vue'

Vue.component('NotifyComponent', require('./components/NotifyComponent.vue'));
import NotifyComponent from './components/NotifyComponent.vue'

Vue.component('lobbycomponent', require('./components/LobbyComponent.vue'));
import lobbycomponent from './components/LobbyComponent.vue'


const app = new Vue({
    el: '#app',
    components: {
        ChatComponent
    }
});


const app2 = new Vue({
     el: '#app2',
     components: {
         lobbycomponent
     }
 });
