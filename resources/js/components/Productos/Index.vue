<template>
<div>
    <div class="col-12 text-center" v-if="role == 'admin' || role == 'sub.admin'">
        <button v-bind:class="[{ 'active': !load}, 'btn', 'btn-primary']" @click="tableProduct()">Productos</button>
        <button class="btn btn-primary" @click="openModal()">Importar Productos</button>
        <button v-bind:class="[{ 'active': load}, 'btn', 'btn-primary']" @click="tableCategorias()">Categorias</button>
    </div>

    <productos-modal-import v-if="load_modal"></productos-modal-import>
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
                load: false,
                load_modal: false,
            }
        },
        methods:{
            tableProduct(){
                this.load = false
            },
            tableCategorias(){
                this.load = true
            },
            openModal(){
                this.load_modal = true
                setTimeout(()=>{
                    $("#modalImport").modal('show')
                },200)
            },
            closeModal(){
                $("#modalImport").modal('hide')
                setTimeout(()=>{
                    this.load_modal = false
                },200)
            }
        }
    }
</script>
