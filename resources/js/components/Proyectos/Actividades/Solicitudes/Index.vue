<template>
    <div v-if="load">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-3">
                    <b-alert show variant="success">Completada</b-alert>
                </div>
                <div class="col-12 col-lg-3">
                    <b-alert show variant="warning">Pedido</b-alert>
                </div>
                <div class="col-12 col-lg-3">
                    <b-alert show variant="success">Aprobado</b-alert>
                </div>
                <div class="col-12 col-lg-3">
                    <b-alert show variant="info">Aceptado</b-alert>
                </div>
                <div class="col-12 col-lg-3">
                    <b-alert show variant="warning">Solicitud</b-alert>
                </div>
                <div class="col-12 col-lg-3">
                    <b-alert show variant="danger">Rechazado</b-alert>
                </div>
            </div>
        </div>
        <solicitudes-table :solicitudes="solicitudes"></solicitudes-table>
    </div>
</template>

<script>
import Table from './Table.vue'
export default {
    props:['role'],
    components:{
        'solicitudes-table' : Table
    },
    data(){
        return{
            solicitudes:{},
            load: false
        }
    },
    created(){
        this.getSolicitudes()
    },
    methods: {
        getSolicitudes(){
            this.load = false
            axios.get('/Proyectos/Actividades/Solicitudes/get').then(res=>{
                this.solicitudes = res.data.solicitudes
                this.load = true
            })
        }
    }
}
</script>
