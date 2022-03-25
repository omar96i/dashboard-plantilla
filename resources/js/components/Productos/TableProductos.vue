<template>
    <div>
        <div class="col-12">
            <div class="row">
                <button class="btn btn-success btn-sm mb-3" @click="agregarProducto">
                    <i class="fas fa-user-plus"></i>
                    <samp class="pl-2">Crear Productos</samp>
                </button>
            </div>
        </div>

        <div class="table-responsive mt-2" v-if="load">
            <table class="table table-bordered" id="tablaProductos" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <th class="color-gray">Foto</th>
                        <th class="color-gray">Nombre</th>
                        <th class="color-gray">Descripcion</th>
                        <th class="color-gray">Referencia</th>
                        <th class="color-gray">Marca</th>
                        <th class="color-gray">Categoria</th>
                        <th class="color-gray">Color</th>
                        <th class="color-gray">Temperatura de calor</th>
                        <th class="color-gray">Voltaje</th>
                        <th class="color-gray">Catidad</th>
                        <th class="color-gray">Tipo moneda</th>
                        <th class="color-gray">Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><input type="text" class="form-control" disabled></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(producto, index) in productos" :key="index">
                        <td>{{producto.foto}}</td>
                        <td>{{producto.referencia}}</td>
                        <td>{{producto.nombre}}</td>
                        <td>{{producto.descripcion}}</td>
                        <td>{{(producto.marca == null)? "" : producto.marca}}</td>
                        <td>{{(producto.categoria_id == null)? "" : producto.categoria.nombre}}</td>
                        <td>{{producto.color}}</td>
                        <td>{{(producto.temperatura_calor == null)? "" : producto.temperatura_calor}}</td>
                        <td>{{(producto.voltaje == null)? "" : producto.voltaje}}</td>
                        <td>{{producto.cantidad}}</td>
                        <td>{{(producto.valores[0].tipo == 'peso_colombiano')? "Peso colombiano" : "Dolar"}}</td>
                        <td>{{(producto.valores[0].tipo == 'dolar')? new Intl.NumberFormat('en-US').format((producto.valores[0].valor * dolar.valor)) : new Intl.NumberFormat('en-US').format(producto.valores[0].valor)}}</td>
                        <td class="text-center">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="dropdown-header">Acciones:</div>
                                    <button class="dropdown-item" @click="editProducto(producto.id)"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" @click="eliminarProducto(producto.id)"><i class="fas fa-trash" ></i> Eliminar</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="load_modal">
            <product-modal :product="producto" :tipo="tipo"></product-modal>
        </div>
    </div>
</template>

<script>
    import ProductModal from './Modal.vue'
    export default {
        components: {
			ProductModal
		},
        data(){
            return{
                productos:{},
                load: false,
                load_modal: false,
                producto:null,
                dolar: {}
            }
        },
        created(){
            this.getDolar()
        },
        methods:{
            agregarProducto(){
                this.load_modal = false
                setTimeout(() => {
                    this.producto = null
                    this.tipo = "insert"
                    this.openModal()
				}, 200)
            },
            editProducto(id){
                this.load_modal = false
                this.tipo = "edit"
                axios.get(`Productos/get/${id}`).then(res=>{
                    console.log(res.data)
                    this.producto = res.data.producto
                    this.openModal()
                })
            },
            getDolar(){
                axios.get('TRM/get').then(res=>{
                    this.dolar = res.data.trm
                }).finally(() => {
                    this.getAllProduct()
                })
            },
            getAllProduct(){
                this.load = false
				axios.get('/Productos/getAll').then(response => {
                    this.productos = response.data.productos
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaProductos`).DataTable({
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
            eliminarProducto(producto_id){
                this.$fire({
                    title: 'Producto',
                    text: 'Estas Seguro de eliminar el producto seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Productos/delete/${producto_id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Producto',
                                    text: 'Eliminado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getAllProduct()
                            }
                        })
                    }
                });
            },
            openModal() {
				this.load_modal = true
				setTimeout(() => {
					$('#modalProductos').modal('show')
				}, 200)
			},
			closeModal() {
				$('#modalProductos').modal('hide')
				setTimeout(() => {
					this.load_modal = false
				}, 200)
			},
        }

    }
</script>

