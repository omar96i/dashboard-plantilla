<template>
<div>
    <div class="card text-center mb-3">
        <div class="card-body">
            <button v-bind:class="[{ 'active': !load}, 'btn', 'btn-primary', 'btn-sm']" @click="tableProduct()">Productos</button>
            <button v-bind:class="[{ 'active': load}, 'btn', 'btn-primary', 'btn-sm']" @click="tableCategorias()">Categorias</button>
        </div>
    </div>
    <table-productos v-if="!load"></table-productos>
    <table-categorias v-else></table-categorias>
</div>
</template>

<script>
    import TableProductos from './TableProductos.vue'
    import TableCategorias from './TableCategorias.vue'

    export default {
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
