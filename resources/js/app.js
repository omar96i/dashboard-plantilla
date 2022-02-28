require('./bootstrap');

global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

window.Vue = require('vue').default;
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import VueSimpleAlert from "vue-simple-alert";


Vue.use(VueSimpleAlert , { reverseButtons: true });
Vue.component('v-select', vSelect)
// Compoenents
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('usuarios-index', require('./components/Usuarios/Index.vue').default);


const app = new Vue({
    el: '#app',
});
