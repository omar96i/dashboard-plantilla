<template>
    <div v-if="load">
        <asistencia-table :asistencias="asistencias"></asistencia-table>
    </div>
</template>
<script>
import Table from './Table.vue'
export default {
    components:{
        'asistencia-table' : Table
    },
    data(){
        return{
            asistencias:{},
            load: false
        }
    },
    created(){
        this.getAsistencias()
    },
    methods:{
        getAsistencias(){
            axios.get('/Proyectos/Actividades/Asistencias/get').then(res=>{
                this.asistencias = res.data.asistencias
                this.load = true
            })
        }
    }
}
</script>
