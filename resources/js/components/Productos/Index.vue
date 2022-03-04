<template>
<div>
    <button class="btn btn-success btn-sm" @click="agregarProducto">
        <i class="fas fa-user-plus"></i>
        <samp class="pl-2">Crear Productos</samp>
    </button>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tablaProductos" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Referencia</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Temperatura de calor</th>
                    <th>Voltaje</th>
                    <th>Catidad</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Referencia</th>
                    <th>Marca</th>
                    <th>Color</th>
                    <th>Temperatura de calor</th>
                    <th>Voltaje</th>
                    <th>Catidad</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(producto, index) in productos" :key="index">
                    <td>{{producto.foto}}</td>
                    <td>{{producto.referencia}}</td>
                    <td>{{producto.nombre}}</td>
                    <td>{{producto.descripcion}}</td>
                    <td>{{(producto.marca == null)? "" : producto.marca}}</td>
                    <td>{{producto.color}}</td>
                    <td>{{(producto.temperatura_calor == null)? "" : producto.temperatura_calor}}</td>
                    <td>{{(producto.voltaje == null)? "" : producto.voltaje}}</td>
                    <td>{{producto.cantidad}}</td>
                    <td>{{producto.valores[0].valor}}</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-circle btn-sm" @click="editProducto(producto.id)"><i class="fa-solid fa-user-pen"></i></button>
                        <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash" @click="eliminarProducto(producto.id)"></i></button>
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
                producto:null
            }
        },
        created(){
            this.getAllProduct()
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
            getAllProduct(){
                this.load = false
				axios.get('/Productos/getAll').then(response => {
                    this.productos = response.data.productos
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaProductos`).DataTable({
                            dom: 'Bfrtip',
                            buttons: ['excel', 'copy'],
                            process: true
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
