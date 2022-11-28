<template>
<div>
    <div class="row mb-3" v-if="role == 'admin' || role == 'sub.admin'">
        <div class="col-12 col-sm-4 mt-2">
            <button v-bind:class="[{ 'active': !load}, 'btn', 'btn-primary', 'btn-block']" @click="tableProduct()">Productos</button>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <button class="btn btn-primary btn-block" @click="openModal()">Importar Productos</button>
        </div>
        <div class="col-12 col-sm-4 mt-2">
            <button v-bind:class="[{ 'active': load}, 'btn', 'btn-primary', 'btn-block']" @click="tableCategorias()">Categorias</button>
        </div>
    </div>
    <hr>

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
