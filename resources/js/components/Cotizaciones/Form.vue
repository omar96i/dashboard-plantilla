<template>
<div>
    <form @submit.prevent="storeCotizacion()">
        <div class="form-group row" >
            <div class="col-12 col-sm-4">
                <label class="col-form-label">Nombre a Facturar:</label>
                <input type="text" class="form-control" v-model="cotizacion.nombre_facturar" placeholder="Nombre cliente...">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
            <div class="col-12 col-sm-4">
                <label for="" class="col-form-label">Cliente del proyecto:</label>
                <input type="text" id="" class="form-control" v-model="cotizacion.cliente_proyecto" placeholder="Cliente del proyecto...">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
            <div class="col-12 col-sm-4">
                <label for="c-i" class="col-form-label">Nit ó Cédula:</label>
                <input type="text" name="c-i" id="c-i" class="form-control" v-model="cotizacion.documento" placeholder="Nit o Cedula...">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-12 col-sm-4">
                <label for="" class="col-form-label">Direccion:</label>
                <input type="text" id="" class="form-control" name="" v-model="cotizacion.direccion" placeholder="Nombre cliente...">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
            <div class="col-12 col-sm-4">
                <label for="" class="col-form-label">Telefono:</label>
                <input type="text" id="" class="form-control" name="" v-model="cotizacion.telefono" placeholder="Telefono...">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
            <div class="col-12 col-sm-4">
                <label for="" class="col-form-label">Email:</label>
                <input type="text" name="" id="" class="form-control" v-model="cotizacion.email" placeholder="Email...">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
        </div>
        <div class="col-12 text-center">
            <button class="btn btn-success btn-sm" type="submit">Guardar</button>
        </div>
    </form>


    <div v-if="load_second_form">
        <hr>
        <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Area</h6>
            <button href="#" class="btn btn-success btn-sm btn-icon-split" @click="openModalSubCotizacion()">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <span class="text">Agregar area</span>
            </button>
        </div>

        <div class="col-12 mb-5">
            <div class="form-group row">
                <div class="col-12 col-sm-6">
                    <label for="a-i" class="col-form-label text-muted">Selecciona el area:</label>
                    <select class="form-control" @change="changeValues()" v-model="sub_cotizacion.id">
                        <option value="" selected>Sin seleccionar...</option>
                        <option v-for="(sub_cotizacion, index) in sub_cotizaciones" :key="index" :value="sub_cotizacion.id">{{sub_cotizacion.area}}</option>
                    </select>
                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                </div>
                <div class="col-12 col-sm-6">
                    <label for="e-i" class="col-form-label">Descripcion:</label>
                    <input type="text" id="e-i" class="form-control" name="e-i" placeholder="Descripcion..." v-model="sub_cotizacion.descripcion">
                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                </div>
                <div class="col-12 col-sm-12">
                    <label class="col-form-label">Observacion:</label>
                    <textarea class="form-control" placeholder="Observacion..." v-model="sub_cotizacion.observacion"></textarea>
                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                </div>
                <div class="col-12 text-center mt-4">
                    <button class="btn btn-success btn-sm" @click="updateSubCotizacion()">Guardar</button>
                    <button class="btn btn-danger btn-sm" v-if="sub_cotizacion.id != ''" @click="eliminarSubCotizacion">Eliminar</button>

                </div>
            </div>
        </div>
    </div>

    <div v-if="load_three_form">
        <hr>
        <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Productos</h6>
            <button href="#" class="btn btn-success btn-sm btn-icon-split" @click="openModalProduct()">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-plus"></i>
                </span>
                <span class="text">Producto</span>
            </button>
        </div>

        <div class="table-responsive" v-if="load_products">
            <table class="table table-bordered" id="tableProductos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Referencia</th>
                        <th>Descripcion</th>
                        <th>Referencia</th>
                        <th>Marca</th>
                        <th>Ubicacion</th>
                        <th>Cant</th>
                        <th>Valor unidad</th>
                        <th>Valor Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Foto</th>
                        <td>Nombre</td>
                        <th>Descripcion</th>
                        <th>Referencia</th>
                        <th>Marca</th>
                        <th>Ubicacion</th>
                        <th>Cant</th>
                        <th>Valor unidad</th>
                        <th>Valor Total</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>

                    <tr v-for="(producto, index) in productos" :key="index">
                        <td>{{producto.productos.foto}}</td>
                        <td>{{producto.productos.nombre}}</td>
                        <td>{{producto.productos.descripcion}}</td>
                        <td>{{producto.productos.referencia}}</td>
                        <td>{{producto.productos.marca}}</td>
                        <td><input type="text" class="form-control" v-bind:data-producto_id="producto.id" :value="producto.ubicacion" v-on:change="updateProduct"></td>
                        <td><input type="text" class="form-control" v-bind:data-producto_id="producto.id" :value="producto.cantidad" v-on:change="updateProductCantidad"></td>
                        <td>{{producto.productos.valores[0].valor}}</td>
                        <td>{{(producto.productos.valores[0].valor*producto.cantidad)}}</td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash" @click="eliminarProducto(producto.id)"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div v-if="load_first_modal">
        <cotizacion-modal :cotizacion="cotizacion"></cotizacion-modal>
    </div>

    <div v-if="load_second_modal">
        <productos-modal :sub_cotizacion="sub_cotizacion"></productos-modal>
    </div>

</div>
</template>

<script>
    import SpinnerView from '../Spinner.vue'
    import CotizacionModal from './Modal.vue'
    import ProductosModal from './ModalProduct.vue'
    export default {
        props:['cotizacion_props'],
        components: {
			SpinnerView,
            CotizacionModal,
            ProductosModal
		},
        data(){
            return{
                load_second_form: false,
                load_first_modal: false,
                load_three_form: false,
                load_second_modal: false,
                cotizacion:{},
                ruta: '',
                sub_cotizaciones: {},
                sub_cotizacion: {
                    'id' : ''
                },
                productos: {},
                load_products: false,
                tipo: 'insert',
                producto_update:{
                    'id' : '',
                    'ubicacion' : '',
                    'cantidad' : ''
                }
            }
        },
        created(){
            if(this.cotizacion_props != undefined){
                this.cotizacion = this.cotizacion_props
                this.getSubCotizacion()
                this.tipo = 'edit'
            }
            this.ruta = (this.tipo == "insert")? '/Cotizaciones/store' : `/Cotizaciones/update/${this.cotizacion.id}`
        },
        methods:{
            abrirModal(){
                $("#modalCotizacion").modal('show')
            },
            storeCotizacion(){
                axios.post(this.ruta, this.cotizacion).then(res=>{
                    if(res.data.saved){
                        this.cotizacion = res.data.cotizacion
                        this.load_second_form = true
                        this.load_first_modal = true
                        this.getCotizacion()
                        this.alert('Cotizacion', 'Creada', 'success')
                    }
                    if(res.data.updated){
                        this.cotizacion = res.data.cotizacion
                        this.alert('Cotizacion', 'Actualizada', 'success')
                    }
                })
            },
            updateProduct: function (event) {
                this.producto_update.ubicacion = event.target.value
                this.producto_update.id = event.target.attributes[1].value
                axios.post(`/Cotizaciones/update/producto/${this.producto_update.id}`, this.producto_update).then(res => {
                    if(res.data.updated){
                        this.alert('Producto', res.data.msg, 'success')
                        this.changeValues()
                    }
                    this.producto_update = {
                        'id' : '',
                        'ubicacion' : '',
                        'cantidad' : ''
                    }
                })
            },
            updateProductCantidad: function (event) {
                this.producto_update.cantidad = event.target.value
                this.producto_update.id = event.target.attributes[1].value
                axios.post(`/Cotizaciones/update/producto/${this.producto_update.id}`, this.producto_update).then(res => {
                    if(res.data.updated){
                        this.alert('Producto', res.data.msg, 'success')
                        this.changeValues()
                    }else{
                        this.alert('Producto', res.data.msg, 'warning')
                        this.changeValues()
                    }
                    this.producto_update = {
                        'id' : '',
                        'ubicacion' : '',
                        'cantidad' : ''
                    }
                })
            },
            eliminarSubCotizacion(){
                this.$fire({
                    title: 'Sub Cotizacion',
                    text: 'Estas Seguro de eliminar el dato seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Cotizaciones/delete/subCotizacion/${this.sub_cotizacion.id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'SubCotizacion',
                                    text: 'Eliminada',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.sub_cotizacion = {
                                    'id' : ''
                                }
                                this.load_products = false
                                this.getSubCotizacion()
                            }
                        })
                    }
                });
            },

            eliminarProducto(id_producto){
                this.$fire({
                    title: 'Producto',
                    text: 'Estas Seguro de eliminar el dato seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Cotizaciones/delete/producto/${id_producto}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Producto',
                                    text: 'Eliminado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.changeValues()
                            }
                        })
                    }
                });
            },
            getCotizacion(){
                axios.get('/Cotizaciones/get').then(res=>{
                    this.new_cotizacion = res.data.cotizacion
                    this.cotizacion = res.data.cotizacion
                    if(this.new_cotizacion != ''){
                        this.load_second_form = true
                        this.load_first_modal = true
                        this.getSubCotizacion()
                    }
                })
            },

            updateSubCotizacion(){
                axios.post(`/Cotizaciones/update/subCotizacion/${this.sub_cotizacion.id}`, this.sub_cotizacion).then(res=>{
                    if(res.data.updated){
                        this.sub_cotizacion = res.data.sub_cotizacion
                        this.alert('Sub cotizacion', 'Actualizada', 'success')
                    }
                })
            },
            getSubCotizacion(){
                axios.get(`/Cotizaciones/get/${this.cotizacion.id}`).then(res=>{
                    this.sub_cotizaciones = res.data.sub_cotizacion
                    this.load_second_form = true
                })
            },
            changeValues(){
                this.load_products = false
                if(this.sub_cotizacion.id != ''){
                    axios.get(`/Cotizaciones/get/subCotizacion/${this.sub_cotizacion.id}`).then(res=>{
                        console.log(res.data)
                        this.productos = res.data.productos_sub_cotizacion
                        this.sub_cotizacion = res.data.sub_cotizacion
                        this.load_three_form = true
                        this.load_products = true
                    }).finally(() => {
                        setTimeout(() => {
                            $(`#tableProductos`).DataTable({
                                dom: 'Bfrtip',
                                buttons: ['excel', 'copy'],
                                process: true
                            })

                        }, 200)
                    })
                }else{
                    this.sub_cotizacion = {
                        'id' : ''
                    }
                    this.load_second_modal = false
                    this.load_products = false
                }
            },
            openModalProduct(){
                this.load_second_modal = true
				setTimeout(() => {
					$("#modalProductos").modal('show')
				}, 200)
            },

            closeModalProduct(){
                $("#modalProductos").modal('hide')
                setTimeout(() => {
                    this.load_second_modal = false
				}, 200)
            },

            openModalSubCotizacion(){
                this.load_first_modal = true
				setTimeout(() => {
					$("#modalSubCotizacion").modal('show')
				}, 200)
            },

            closeModalSubCotizacion(){
                $("#modalSubCotizacion").modal('hide')
                setTimeout(() => {
                    this.load_first_modal = false
				}, 1000)
            },
            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
            }
        }
    }
</script>
