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

Vue.component('usuarios-index', require('./components/Usuarios/Index.vue').default);
Vue.component('productos-index', require('./components/Productos/Index.vue').default);
Vue.component('cotizaciones-index', require('./components/Cotizaciones/Index.vue').default);
Vue.component('cotizaciones-show', require('./components/Cotizaciones/Show.vue').default);
Vue.component('cotizaciones-form', require('./components/Cotizaciones/Form.vue').default);


const app = new Vue({
    el: '#app',
});
