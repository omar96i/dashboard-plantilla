<template>
    <div class="container-fluid" v-if="load">
        <div class="row">
            <div class="col-12 col-lg-8">
                <FullCalendar :options="calendarOptions" />
            </div>
            <div class="col text-center">
                <h5>Actividades</h5>
                <div class="row container">
                    <b-alert class="mr-1" show variant="primary">Asignado</b-alert>
                    <b-alert class="mr-1" show variant="success">Completado</b-alert>
                    <b-alert class="mr-1" show variant="danger">Incompleta</b-alert>
                </div>

                <a href="#" v-for="(actividad, index) in actividades" :key="index" @click="setDatos(actividad.id)">
                    <b-alert show :variant="getColorAlert(actividad.estado)">
                    <p >{{actividad.descripcion}}</p>
                    <p class="small">{{actividad.fecha_inicio+" - "+actividad.fecha_final}}</p>
                    </b-alert>
                </a>

            </div>
        </div>
        <div v-if="load_modal">
            <modal-actividad :id="actividad_id"></modal-actividad>
        </div>
    </div>

</template>

<script>
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import ModalActividad from './Modal.vue'

export default {
    components: {
        FullCalendar,
        ModalActividad
    },
    data() {
        return {
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                eventClick: this.handleEventClick,
                editable: true,
                selectable: true,
                selectMirror: true,
                locale: 'es',
                events: []
            },
            actividades: [],
            load: false,
            actividad_id: '',
            load_modal: false
        }
    },
    created(){
        this.getActividades()
    },
    methods: {
        handleEventClick: function(arg) {
            this.actividad_id = arg.event._def.publicId
            this.load_modal = false
            setTimeout(() => {
                this.openModal()
            }, 200)

        },
        setDatos(id){
            this.actividad_id = id
            this.load_modal = false
            setTimeout(() => {
                this.openModal()
            }, 200)
        },
        openModal(){
            this.load_modal = true
            setTimeout(() => {
                $('#modalActividad').modal('show')
            }, 200)
        },
        closeModal(){
            $('#modalActividad').modal('hide')
            setTimeout(() => {
                this.actividad_id = ''
                this.load_modal = false
            }, 200)
        },
        getColor(estado){
            if(estado == 'pendiente'){
                return "#cce5ff"
            }
            if(estado == 'completado'){
                return "#d4edda"
            }
            if(estado == 'cancelado'){
                return "#f8d7da"
            }
        },
        getColorText(estado){
            if(estado == 'pendiente'){
                return "#004085"
            }
            if(estado == 'completado'){
                return "#155724"
            }
            if(estado == 'cancelado'){
                return "#721c24"
            }
        },
        getColorBorder(estado){
            if(estado == 'pendiente'){
                return "#b8daff"
            }
            if(estado == 'completado'){
                return "#c3e6cb"
            }
            if(estado == 'cancelado'){
                return "#f5c6cb"
            }
        },
        getColorAlert(estado){
            if(estado == 'pendiente'){
                return "primary"
            }
            if(estado == 'completado'){
                return "success"
            }
            if(estado == 'cancelado'){
                return "danger"
            }
        },
        getActividades(){
            axios.get('/Proyectos/Actividades/getActividadesUsuario').then(res=>{
                this.actividades = res.data.actividades
                res.data.actividades.forEach(actividad => {
                    this.calendarOptions.events.push({ title: 'Actividad', start: actividad.fecha_inicio, end: actividad.fecha_final , id: actividad.id, backgroundColor: this.getColor(actividad.estado), textColor: this.getColorText(actividad.estado), borderColor: this.getColorBorder(actividad.estado) })
                });
                this.load = true
            })
        }

    }
}
</script>
