<template>
<div>
    <div class="py-3 my-2">
        <b-button size="sm" variant="success" @click="showBottom = !showBottom">
            Mostrar resumen
        </b-button>
        <button href="#" class="btn btn-success btn-sm" @click="openModalTemplate()" v-if="tipo == 'insert'">
            <span class="icon text-white-50">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span class="text">Cargar template</span>
        </button>
    </div>

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
        <div class="col-12 text-center" v-if="!spinner_one">
            <button class="btn btn-success btn-sm" type="submit">Guardar</button>
        </div>
        <div class="col-12 text-center" v-else>
            <spinner-view :loading="spinner_one"></spinner-view>
        </div>
    </form>

    <b-tabs content-class="mt-3">
        <b-tab title="Areas" active>
            <div v-if="load_second_form">
                <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 text-primary">Area</h6>
                    <button href="#" class="btn btn-success btn-sm" @click="openModalSubCotizacion()">
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
                        <div class="col-12 text-center mt-4" v-if="!spinner_two">
                            <button class="btn btn-success btn-sm" @click="updateSubCotizacion()">Guardar</button>
                            <button class="btn btn-danger btn-sm" v-if="sub_cotizacion.id != ''" @click="eliminarSubCotizacion">Eliminar</button>
                        </div>
                        <div class="col-12 text-center mt-4" v-else>
                            <spinner-view :loading="spinner_two"></spinner-view>
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="load_three_form">
                <hr>
                <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 text-primary">Productos</h6>
                    <button href="#" class="btn btn-success btn-sm" @click="openModalProduct()">
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
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Referencia</th>
                                <th>Marca</th>
                                <th>Ubicacion</th>
                                <th>Cant</th>
                                <th>Valor unidad</th>
                                <th>Valor Total</th>
                                <th>Valor unidad</th>
                                <th>Valor Total</th>
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
                                <th>Ubicacion</th>
                                <th>Cant</th>
                                <th>Valor unidad</th>
                                <th>Valor Total</th>
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
                                <td><small>USD</small> <strong>{{(producto.productos.valores[0].tipo == 'dolar')? new Intl.NumberFormat('en-US').format(producto.productos.valores[0].valor): '-'}}</strong></td>
                                <td><small>USD</small> <strong>{{(producto.productos.valores[0].tipo == 'dolar')? new Intl.NumberFormat('en-US').format((producto.productos.valores[0].valor * producto.cantidad)) : '-'}}</strong></td>
                                <td>{{(producto.productos.valores[0].tipo == 'dolar')? new Intl.NumberFormat('en-US').format(Math.round((producto.productos.valores[0].valor * dolar.valor))) : new Intl.NumberFormat('en-US').format(Math.round(producto.productos.valores[0].valor))}}</td>
                                <td>{{(producto.productos.valores[0].tipo == 'dolar')? new Intl.NumberFormat('en-US').format(Math.round(((producto.productos.valores[0].valor * dolar.valor) * producto.cantidad))) : new Intl.NumberFormat('en-US').format(Math.round((producto.productos.valores[0].valor * producto.cantidad)))}}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash" @click="eliminarProducto(producto.id)"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </b-tab>
        <b-tab title="Abonos">
            <div v-if="load_second_form">
                <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 text-primary">Abonos</h6>
                    <button href="#" class="btn btn-success btn-sm" @click="openModalAbonos()">
                        <span class="icon text-white-50">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                        <span class="text">Forma de pago</span>
                    </button>
                </div>

                <div class="table-responsive" v-if="load_table_abonos">
                    <table class="table table-bordered" id="tableAbonos" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Abono #</th>
                                <th>Fecha</th>
                                <th>Valor del abono</th>
                                <th>Observacion</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Abono #</th>
                                <th>Fecha</th>
                                <th>Valor del abono</th>
                                <th>Observacion</th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr v-for="(abono, index) in abonos" :key="index">
                                <td>{{abono.nombre}}</td>
                                <td>{{abono.fecha}}</td>
                                <td>{{abono.valor}}</td>
                                <td>{{abono.observacion}}</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-circle btn-sm" @click="eliminarAbono(abono.id)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </b-tab>
        <b-tab title="Planos">
            <div class="col-12 mt-3">
                <form action="post" enctype="multipart/form-data" @submit.prevent="storeImage">
                    <div class="col-12 text-center my-2">
                        <h5>Subir archivos</h5>
                    </div>
                    <div class="row mt-3">
                        <div class="col-10 text-center">
                            <input type="file" class="form-control" accept=" video/*, image/*"  id="foto" name="foto" v-on:change="onImageChange">
                        </div>
                        <div class="text-center col-2">
                            <b-button block variant="success" type="submit" v-bind:disabled="loading_btn"><b-spinner small type="grow" v-if="loading_btn"></b-spinner> Agregar</b-button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4 mt-4" v-if="loading_files">
                <div class="col" v-for="(file, index) in files.files" :key="index">
                    <div class="card">
                        <div style="z-index: 1; position: absolute;">
                            <button class="btn btn-danger btn-circle" @click="deleteFile(file.id)">
                                <i class="fas fa-trash"></i>
                            </button>
                            <a target="_blank" :href="'https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/'+file.file" class="btn btn-info btn-circle">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                        <b-img-lazy :src="'https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/'+file.file" alt="Image 1" style="height:300px;"></b-img-lazy>
                    </div>
                </div>
            </div>
        </b-tab>
    </b-tabs>

    <div v-if="load_first_modal">
        <cotizacion-modal :cotizacion="cotizacion"></cotizacion-modal>
    </div>

    <div v-if="load_second_modal">
        <productos-modal :sub_cotizacion="sub_cotizacion"></productos-modal>
    </div>

    <div v-if="load_three_modal">
        <abonos-modal :cotizacion="cotizacion"></abonos-modal>
    </div>

    <div v-if="load_four_modal">
        <templates-modal></templates-modal>
    </div>

    <b-alert
      v-model="showBottom"
      class="position-fixed fixed-bottom m-0 rounded-0 bg-dark"
      style="z-index: 2000;"
      dismissible
    >
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h5 style="color: white;">Resumen General</h5>
                    <strong style="font-size: 0.8em; color: white;">Total: <small>{{new Intl.NumberFormat('en-US').format(Math.round(cotizacion_valor_general.total))}}</small></strong>
                </div>

                <div class="col-12 col-sm-6 border-left">
                    <h5 style="color: white;">Resumen de area</h5>
                    <strong style="font-size: 0.8em; color: white;">Sub total: <small>{{(load_products == false)? "Sin seleccionar" : new Intl.NumberFormat('en-US').format(Math.round(sub_cotizacion_valor.sub_total))}}</small></strong><br>
                    <strong style="font-size: 0.8em; color: white;">Iva: <small>{{(load_products == false)? "Sin seleccionar" : new Intl.NumberFormat('en-US').format(Math.round(sub_cotizacion_valor.iva))}}</small></strong><br>
                    <strong style="font-size: 0.8em; color: white;">Total: <small>{{(load_products == false)? "Sin seleccionar" : new Intl.NumberFormat('en-US').format(Math.round(sub_cotizacion_valor.total))}}</small></strong>
                </div>
            </div>
        </div>
    </b-alert>

</div>
</template>

<script>
    import SpinnerView from '../Spinner.vue'
    import CotizacionModal from './Modal.vue'
    import ProductosModal from './ModalProduct.vue'
    import AbonosModal from './ModalAbonos.vue'
    import TemplatesModal from './ModalTemplates.vue'
    export default {
        props:['cotizacion_props'],
        components: {
			SpinnerView,
            CotizacionModal,
            ProductosModal,
            AbonosModal,
            TemplatesModal
		},
        data(){
            return{
                load_second_form: false,
                load_first_modal: false,
                load_three_form: false,
                load_second_modal: false,
                load_three_modal: false,
                load_four_modal: false,
                cotizacion:{},
                cotizacion_valor_general: {
                    'sub_valor' : 0,
                    'iva' : 0,
                    'total' : 0
                },
                ruta: '',
                sub_cotizaciones: {},
                sub_cotizacion: {
                    'id' : ''
                },
                sub_cotizacion_valor:{
                    'sub_total' : 0,
                    'iva' : 0,
                    'total' : 0
                },
                productos: {},
                load_products: false,
                tipo: 'insert',
                producto_update:{
                    'id' : '',
                    'ubicacion' : '',
                    'cantidad' : ''
                },
                load_table_abonos: false,
                spinner_one: false,
                spinner_two: false,
                abonos:{},
                showBottom: false,
                showTop: false,
                dolar: {},
                show: true,
                loading_btn: false,
                image: '',
                files: {},
                loading_files: false
            }
        },
        created(){
            if(this.cotizacion_props != undefined){
                this.cotizacion = this.cotizacion_props
                this.getSubCotizacion()
                this.getAbonos()
                this.getDolar()
                this.getFiles()
                this.tipo = 'edit'
            }
            this.ruta = (this.tipo == "insert")? '/Cotizaciones/store' : `/Cotizaciones/update/${this.cotizacion.id}`
        },
        methods:{
            getDolar(){
                axios.get(`/Cotizaciones/Dolar/get/${this.cotizacion.dolar_id}`).then(res=>{
                    this.dolar = res.data.dolar
                    this.getValorGeneral()
                })
            },
            abrirModal(){
                $("#modalCotizacion").modal('show')
            },
            updateAreaValores(){
                this.sub_cotizacion_valor = {
                    'sub_total' : 0,
                    'iva' : 0,
                    'total' : 0
                }

                if(this.productos.length > 0){
                    this.productos.forEach(producto => {
                        this.sub_cotizacion_valor.sub_total += (producto.productos.valores[0].tipo == 'dolar')? ((producto.productos.valores[0].valor * this.dolar.valor) * producto.cantidad) : (producto.productos.valores[0].valor * producto.cantidad)
                    });
                    this.sub_cotizacion_valor.iva = (this.sub_cotizacion_valor.sub_total/100)*19
                    this.sub_cotizacion_valor.total = this.sub_cotizacion_valor.iva + this.sub_cotizacion_valor.sub_total
                }
            },
            onImageChange(e){
                this.image = e.target.files[0]

                let reader  = new FileReader()

                reader.addEventListener("load", function () {
                    this.imagePreview = reader.result
                }.bind(this), false);

                if( this.image ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.image.name ) ) {
                        reader.readAsDataURL( this.image )
                    }
                }
            },
            storeImage(){
                if(this.image != ''){
                    this.loading_btn = true
                    let data = new FormData();
                    data.append("file", this.image)
                    data.append("cotizacion_id", this.cotizacion.id)

                    axios.post(`/Cotizaciones/Files/store/${this.cotizacion.id}`, data).then(res=>{
                        if(res.data.status){
                            this.getFiles()
                            this.alert('Archivo', 'Subido', 'success')

                        }
                        this.loading_btn = false
                        this.image = ''
                    }).catch(function (error) {
                        console.log(error.response)
                        this.loading = false
                    });
                }else{
                    this.alert('Archivo', 'Sin seleccionar', 'error')
                }
            },

            deleteFile(id){
                this.$fire({
                    title: 'Archivo',
                    text: 'Estas seguro de eliminar el archivo seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Cotizaciones/Files/delete/${id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Archivo',
                                    text: 'Eliminado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getFiles()
                            }
                        })
                    }
                });
            },

            getFiles(){
                this.loading_files = false
                axios.get(`/Cotizaciones/Files/get/${this.cotizacion.id}`).then(res=>{
                    this.files = res.data.files
                    this.loading_files = true
                })
            },

            getValorGeneral(){
                this.cotizacion_valor_general= {
                    'sub_valor' : 0,
                    'iva' : 0,
                    'total' : 0
                }
                axios.get(`/Cotizaciones/getValorGeneral/${this.cotizacion.id}`).then(res=>{
                    if(res.data.cotizaciones.sub_cotizaciones.length > 0){
                        res.data.cotizaciones.sub_cotizaciones.forEach(sub_cotizacion => {
                            this.cotizacion_valor_general.sub_valor = 0
                            this.cotizacion_valor_general.iva = 0
                            sub_cotizacion.productos.forEach(producto => {
                                this.cotizacion_valor_general.sub_valor += (producto.productos.valores[0].tipo == 'dolar')? (producto.productos.valores[0].valor * this.dolar.valor) * producto.cantidad : producto.productos.valores[0].valor * producto.cantidad
                            });
                            this.cotizacion_valor_general.iva = ((this.cotizacion_valor_general.sub_valor/100) * 19)
                            this.cotizacion_valor_general.total += this.cotizacion_valor_general.iva + this.cotizacion_valor_general.sub_valor
                        });
                    }
                })
            },
            storeCotizacion(){
                this.spinner_one = true
                axios.post(this.ruta, this.cotizacion).then(res=>{
                    if(res.data.saved){
                        this.cotizacion = res.data.cotizacion
                        this.tipo = 'edit'
                        this.ruta = `/Cotizaciones/update/${this.cotizacion.id}`
                        this.load_second_form = true
                        this.load_first_modal = true
                        this.alert('Cotizacion', 'Creada', 'success')
                        this.getAbonos()
                        this.getDolar()
                    }else{
                        this.alert('Cotizacion', res.data.msg, 'error')
                    }
                    if(res.data.updated){
                        this.cotizacion = res.data.cotizacion
                        this.alert('Cotizacion', 'Actualizada', 'success')
                    }
                    this.spinner_one = false
                })
            },
            setDatos(template){
                this.cotizacion = template
                this.load_second_form = true
                this.load_first_modal = true
                this.tipo = 'edit'
                this.ruta = `/Cotizaciones/update/${this.cotizacion.id}`
                this.getAbonos()
                this.getDolar()
                this.getSubCotizacion()
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
                    this.getValorGeneral()
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
                                this.getValorGeneral()
                            }
                        })
                    }
                });
            },

            eliminarAbono(id_abono){
                this.$fire({
                    title: 'Abono',
                    text: 'Estas Seguro de eliminar el dato seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Cotizaciones/Abono/delete/${id_abono}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Abono',
                                    text: 'Eliminado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getAbonos()
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
                                this.getValorGeneral()
                            }
                        })
                    }
                });
            },

            updateSubCotizacion(){
                this.spinner_two = true
                axios.post(`/Cotizaciones/update/subCotizacion/${this.sub_cotizacion.id}`, this.sub_cotizacion).then(res=>{
                    if(res.data.updated){
                        this.sub_cotizacion = res.data.sub_cotizacion
                        this.alert('Sub cotizacion', 'Actualizada', 'success')
                        this.spinner_two = false
                    }
                })
            },
            getAbonos(){
                this.load_table_abonos = false
                axios.get(`/Cotizaciones/Abonos/get/${this.cotizacion.id}`).then(res=>{
                    this.abonos = res.data.abonos
                    this.load_table_abonos = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tableAbonos`).DataTable({
                            dom: 'Bfrtip',
                            buttons: ['excel', 'copy'],
                            process: true
                        })

                    }, 200)
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
                this.load_three_form = false
                if(this.sub_cotizacion.id != ''){
                    axios.get(`/Cotizaciones/get/subCotizacion/${this.sub_cotizacion.id}`).then(res=>{
                        this.productos = res.data.productos_sub_cotizacion
                        this.sub_cotizacion = res.data.sub_cotizacion
                        this.load_three_form = true
                        this.load_products = true
                        this.updateAreaValores()
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

            openModalAbonos(){
                this.load_three_modal = true
				setTimeout(() => {
					$("#modalAbonos").modal('show')
				}, 200)
            },

            closeModalAbonos(){
                $("#modalAbonos").modal('hide')
                setTimeout(() => {
                    this.load_three_modal = false
				}, 200)
            },

            openModalTemplate(){
                this.load_four_modal = true
				setTimeout(() => {
					$("#modalTemplate").modal('show')
				}, 200)
            },

            closeModalTemplate(){
                $("#modalTemplate").modal('hide')
                setTimeout(() => {
                    this.load_four_modal = false
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
