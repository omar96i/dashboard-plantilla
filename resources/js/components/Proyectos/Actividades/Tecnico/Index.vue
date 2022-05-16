<template>
    <div class="container-fluid" v-if="load">
        <div class="row">
            <div class="col-12 col-lg-8">
                <FullCalendar :options="calendarOptions" />
            </div>
            <div class="col">
                <h5>Actividades</h5>
                <a href="" v-for="(actividad, index) in actividades" :key="index">
                    <b-alert show >
                    <p >{{actividad.descripcion}}</p>
                    <p class="small">{{actividad.fecha_inicio+" - "+actividad.fecha_final}}</p>
                    </b-alert>
                </a>

            </div>
        </div>

    </div>

</template>

<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    components: {
        FullCalendar // make the <FullCalendar> tag available
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
        }
    },
    created(){
        this.getActividades()
    },
    methods: {
        handleEventClick: function(arg) {
            console.log(arg.event)
        },
        getRamdomColor(){
            return "#"+Math.floor(Math.random()*16777215).toString(16);
        },
        getActividades(){
            axios.get('/Proyectos/Actividades/getActividadesUsuario').then(res=>{
                this.actividades = res.data.actividades
                res.data.actividades.forEach(actividad => {
                    this.calendarOptions.events.push({ title: 'Actividad', start: actividad.fecha_inicio, end: actividad.fecha_final , id: actividad.id, backgroundColor: this.getRamdomColor() })
                });
                this.load = true
            })
        }

    }
}
</script>
