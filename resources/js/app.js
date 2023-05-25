require('./bootstrap');

global.jQuery = require('jquery');
var $ = global.jQuery;
window.$ = $;

window.Vue = require('vue').default;
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import VueSimpleAlert from "vue-simple-alert";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import VueSignaturePad from 'vue-signature-pad';
Vue.use(VueSignaturePad);

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.use(VueSimpleAlert , { reverseButtons: true });
Vue.component('v-select', vSelect)
// Compoenents
Vue.component('proyecto-actividad-pruebas-table', require('./components/Proyectos/Actividades/Tecnico/Tables/PruebasTable.vue').default);
Vue.component('prueba-index', require('./components/Prueba.vue').default);
Vue.component('usuarios-index', require('./components/Usuarios/Index.vue').default);
Vue.component('usuarios-profile', require('./components/Usuarios/Profile.vue').default);
Vue.component('productos-index', require('./components/Productos/Index.vue').default);
Vue.component('productos-modal-import', require('./components/Productos/ModalImport.vue').default);
Vue.component('productos-reabastecimientos-index', require('./components/Productos/Reabastecimientos/Index.vue').default);
Vue.component('cotizaciones-index', require('./components/Cotizaciones/Index.vue').default);
Vue.component('cotizaciones-show', require('./components/Cotizaciones/Show.vue').default);
Vue.component('cotizaciones-form', require('./components/Cotizaciones/Form.vue').default);
Vue.component('configuraciones-index', require('./components/Configuraciones/Index.vue').default);
Vue.component('home-index', require('./components/Home.vue').default);
Vue.component('proyectos-index', require('./components/Proyectos/Index.vue').default);
Vue.component('proyectos-form', require('./components/Proyectos/Form.vue').default);
Vue.component('proyectos-planos', require('./components/Proyectos/Planos/Index.vue').default);
Vue.component('proyectos-planos-admin', require('./components/Proyectos/Planos/Admin/Index.vue').default);
Vue.component('proyectos-actividades', require('./components/Proyectos/Actividades/Index.vue').default);
Vue.component('proyectos-tecnico-actividades', require('./components/Proyectos/Actividades/Tecnico/Index.vue').default);
Vue.component('proyectos-tecnico-actividades-calendario', require('./components/Proyectos/Actividades/Tecnico/Calendario.vue').default);
Vue.component('proyectos-actividades-form', require('./components/Proyectos/Actividades/Form.vue').default);
Vue.component('proyectos-reportes', require('./components/Proyectos/Reportes/Index.vue').default);
Vue.component('proyectos-actividades-asistencia', require('./components/Proyectos/Actividades/Asistencias/Index.vue').default);
Vue.component('proyectos-actividades-solicitud', require('./components/Proyectos/Actividades/Solicitudes/Index.vue').default);
Vue.component('proyectos-actividades-reagendamientos', require('./components/Proyectos/Actividades/Reagendamientos/Index.vue').default);
Vue.component('proyectos-interventoria', require('./components/Proyectos/Interventorias/Index.vue').default);

const app = new Vue({
    el: '#app',
});
