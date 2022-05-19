<template>
    <div v-if="load">
        <reagendamientos-table :reagendamientos="reagendamientos"></reagendamientos-table>
    </div>
</template>
<script>
import Table from './Table.vue'
export default {
    components:{
        'reagendamientos-table' : Table
    },
    data(){
        return{
            reagendamientos:{},
            load: false
        }
    },
    created(){
        this.getReagendamientos()
    },
    methods:{
        getReagendamientos(){
            axios.get('/Proyectos/Actividades/Reagendamientos/get').then(res=>{
                this.reagendamientos = res.data.reagendamientos
                this.load = true
            })
        }
    }
}
</script>
