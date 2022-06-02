<template>
<div>
    <div class="col-12 text-center" v-if="role == 'admin' || role == 'sub.admin'">
        <button v-bind:class="[{ 'active': !load}, 'btn', 'btn-primary']" @click="tableProduct()">Productos</button>
        <button v-bind:class="[{ 'active': load}, 'btn', 'btn-primary']" @click="tableCategorias()">Categorias</button>
    </div>


    <table-productos :role="role" v-if="!load"></table-productos>
    <table-categorias v-else></table-categorias>
</div>
</template>

<script>
    import TableProductos from './TableProductos.vue'
    import TableCategorias from './TableCategorias.vue'

    export default {
        props:['role'],
        components: {
			TableProductos,
            TableCategorias
		},
        data(){
            return{
                load: false
            }
        },
        methods:{
            tableProduct(){
                this.load = false
            },
            tableCategorias(){
                this.load = true
            }
        }
    }
</script>
