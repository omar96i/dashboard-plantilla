<template>
    <div v-if="load">
        <solicitudes-table :solicitudes="solicitudes"></solicitudes-table>
    </div>
</template>

<script>
import Table from './Table.vue'
export default {
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
                console.log(res.data)
                this.solicitudes = res.data.solicitudes
                this.load = true
            })
        }
    }
}
</script>
