require('./bootstrap');

global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

window.Vue = require('vue').default;
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import VueSimpleAlert from "vue-simple-alert";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueSimpleAlert , { reverseButtons: true });
Vue.component('v-select', vSelect)

Vue.component('roles-index', require('./components/Roles/Index.vue').default);

const app = new Vue({
    el: '#app',
});
