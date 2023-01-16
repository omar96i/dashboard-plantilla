<template>
    <div>
        <div class="col-12">
            <div class="row">
                <button class="btn btn-success btn-sm mb-3" @click="openModal()" v-if="permisos[0]">
                    <i class="fas fa-user-plus"></i>
                    <samp class="pl-2">Crear Categoria</samp>
                </button>
            </div>
        </div>

        <div class="table-responsive mt-2" v-if="load">
            <table class="table table-bordered" id="tablaCategorias" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <th class="color-gray">Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><input type="text" class="form-control"></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(categoria, index) in categorias" :key="index">
                        <td>{{categoria.nombre}}</td>
                        <td class="text-center">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="dropdown-header">Acciones:</div>
                                    <button class="dropdown-item" @click="editCategoria(categoria.id)" v-if="permisos[1]"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" @click="eliminarCategoria(categoria.id)" v-if="permisos[2]"><i class="fas fa-trash" ></i> Eliminar</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="load_modal">
            <modal-categorias :category="category" :tipo="tipo"></modal-categorias>
        </div>
    </div>
</template>

<script>
    import ModalCategorias from './ModalCategorias.vue'
    export default {
        components: {
			ModalCategorias
		},
        data(){
            return{
                categorias:{},
                load: false,
                load_modal : false,
                category: {},
                tipo: 'insert',
                data_permisos:{
                    permisos: ['productos.categorias.crear', 'productos.categorias.editar', 'productos.categorias.eliminar', 'productos.reabastecimientos']
                },
                permisos:[
                    false,
                    false,
                    false,
                    false
                ]
            }
        },
        created(){
            this.getPermisos()
        },
        methods:{
            getPermisos(){
                axios.post('./Usuarios/get/permisos', this.data_permisos).then(res=>{
                    this.permisos = res.data.permisos
                }).catch(error=>{
                    console.log(error.response)
                }).finally(res=>{
                    this.get()
                })
            },
            get(){
                this.load = false
                axios.get('/Productos/Categorias/get').then(res=>{
                    this.categorias = res.data.categorias
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaCategorias`).DataTable({
                            initComplete: function () {
                                // Apply the search
                                this.api().columns().every( function () {
                                    var that = this;

                                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                        if ( that.search() !== this.value ) {
                                            that
                                                .search( this.value )
                                                .draw();
                                        }
                                    } );
                                } );
                            }
                        })
                    }, 200)
                })
            },

            editCategoria(id){
                axios.get(`/Productos/Categorias/get/${id}`).then(res=>{
                    this.category = res.data.categoria
                    this.tipo = 'edit'
                    this.openModal()
                })
            },

            openModal() {
				this.load_modal = true
				setTimeout(() => {
					$('#modalCategoria').modal('show')
				}, 200)
			},

			closeModal() {
				$('#modalCategoria').modal('hide')
				setTimeout(() => {
					this.load_modal = false
				}, 200)
			},

            eliminarCategoria(id){
                this.$fire({
                    title: 'Categoria',
                    text: 'Estas Seguro de eliminar la categoria seleccionada?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Productos/Categorias/delete/${id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Categoria',
                                    text: 'Eliminada',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.get()
                            }
                        })
                    }
                });
            }
        }
    }
</script>

