<template>
    <div>
        <div class="row mb-4">
            <div class="col-12 col-sm-6 mt-2" v-if="permisos[0]">
                <button class="btn btn-success btn-sm btn-block" @click="agregarProducto" v-if="role == 'admin' || role == 'sub.admin'">
                    <i class="fa-solid fa-box"></i>
                    <samp class="pl-2">Crear Productos</samp>
                </button>
            </div>
            <div class="col-12 col-sm-6 mt-2" v-if="permisos[3]">
                <button class="btn btn-success btn-sm btn-block" @click="reabastecerProductos">
                    <i class="fa-solid fa-box"></i>
                    <samp class="pl-2">Reabastecer productos</samp>
                </button>
            </div>
        </div>

        <hr>

        <div class="table-responsive mt-2" v-if="load">
            <table class="table table-bordered" id="tablaProductos" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <th class="color-gray">Foto</th>
                        <th class="color-gray">Referencia</th>
                        <th class="color-gray">Nombre</th>
                        <th class="color-gray">Descripcion</th>
                        <th class="color-gray">Marca</th>
                        <th class="color-gray">Categorias</th>
                        <th class="color-gray">Color</th>
                        <th class="color-gray">Temperatura de calor</th>
                        <th class="color-gray">Voltaje</th>
                        <th class="color-gray">Cantidad</th>
                        <th class="color-gray">Tipo moneda</th>
                        <th class="color-gray">Porcentaje</th>
                        <th class="color-gray">Valor</th>
                        <th class="color-gray">Valor base</th>
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
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th><input type="text" class="form-control"></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(producto, index) in productos" :key="index">
                        <td><img v-bind:src="producto.files == null? 'img/img_productos/default.png': getUrl(producto.files)" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                        <td>{{producto.referencia}}</td>
                        <td>{{producto.nombre}}</td>
                        <td>{{producto.descripcion}}</td>
                        <td>{{(producto.marca == null || producto.marca == "null")? "sin definir" : producto.marca}}</td>
                        <td><span v-for="(categoria, index) in producto.categorias" :key="index">{{categoria.categoria.nombre}} -</span></td>
                        <td>{{(producto.color == null || producto.marca == "null")? "sin definir" : producto.color}}</td>
                        <td>{{(producto.temperatura_calor == null || producto.temperatura_calor == "null")? "sin definir" : producto.temperatura_calor}}</td>
                        <td>{{(producto.voltaje == null || producto.voltaje == "null")? "sin definir" : producto.voltaje}}</td>
                        <td><b-alert :variant="getColor(producto.cantidad)" show>{{producto.cantidad}}</b-alert></td>
                        <td>{{(producto.valores.length > 0 ) ? (producto.valores[0].tipo == 'peso_colombiano')? "Peso colombiano" : "Dolar" : ""}}</td>
                        <td>{{(producto.valores.length > 0) ? producto.valores[0].porcentaje : ""}}%</td>
                        <td><strong><small>USD</small> {{(producto.valores.length > 0) ? (producto.valores[0].tipo == 'dolar')? producto.valores[0].valor: '-' : "-"}}</strong></td>
                        <td>{{(producto.valores.length > 0) ? (producto.valores[0].tipo == 'dolar')? new Intl.NumberFormat('en-US').format((producto.valores[0].sub_valor * dolar.valor)) : new Intl.NumberFormat('en-US').format(producto.valores[0].sub_valor) : ''}}</td>
                        <td>{{(producto.valores.length > 0) ? (producto.valores[0].tipo == 'dolar')? new Intl.NumberFormat('en-US').format((producto.valores[0].valor * dolar.valor)) : new Intl.NumberFormat('en-US').format(producto.valores[0].valor) : ''}}</td>
                        <td class="text-center">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="dropdown-header">Acciones:</div>
                                    <button class="dropdown-item" @click="editProducto(producto.id)" v-if="permisos[1]"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                    <div class="dropdown-divider"></div>
                                    <button class="dropdown-item" @click="eliminarProducto(producto.id)" v-if="permisos[2]"><i class="fas fa-trash" ></i> Eliminar</button>
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
        <div v-if="second_load_modal">
            <modal-reabastecer :productos_props="productos"></modal-reabastecer>
        </div>
    </div>
</template>

<script>
    import ProductModal from './Modal.vue'
    import ModalReabastecer from './ModalReabastecer'
    import url from '../../mixins/cloudinary'

    export default {
        props:['role'],
        components: {
			ProductModal,
            ModalReabastecer
		},
        mixins: [url],
        data(){
            return{
                productos:{},
                load: false,
                load_modal: false,
                producto:null,
                dolar: {},
                second_load_modal: false,
                data_permisos:{
                    permisos: ['productos.crear', 'productos.editar', 'productos.eliminar', 'productos.reabastecimientos']
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
                    this.getDolar()
                })
            },
            getColor(cantidad){
                if(cantidad < 30 && cantidad > 10){
                    return 'warning'
                }else if(cantidad <= 10){
                    return 'danger'
                }else{
                    return 'success'
                }
            },
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
            getUrl(json){
                let url = JSON.parse(json)
                return this.url+url[0]
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
            reabastecerProductos(){
                this.openModalSecond()
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

            openModalSecond() {
				this.second_load_modal = true
				setTimeout(() => {
					$('#modalReabastecimiento').modal('show')
				}, 200)
			},
			closeModalSecond() {
				$('#modalReabastecimiento').modal('hide')
				setTimeout(() => {
					this.second_load_modal = false
				}, 200)
			},
        }

    }
</script>

