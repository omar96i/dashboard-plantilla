<template>
    <div v-if="!message">
        <form method="post">
            <h5>Solicitar producto</h5>
            <div class="form-group row">
                <div class="col-12 col-lg-6">
                    <label for="b-i" class="col-form-label">Producto:</label>
                    <b-form-select :options="options_producto" v-model="solicitud.producto_id" :state="solicitudValidacion.producto_id"></b-form-select>
                    <b-form-invalid-feedback :state="solicitudValidacion.producto_id">
                        Se debe seleccionar una opcion!
                    </b-form-invalid-feedback>
                    <b-form-valid-feedback :state="solicitudValidacion.producto_id">
                        Esta bien!
                    </b-form-valid-feedback>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="b-i" class="col-form-label">Cantidad:</label>
                    <b-form-input type="number" v-model="solicitud.cantidad" :state="solicitudValidacion.cantidad" placeholder=""></b-form-input>
                    <b-form-invalid-feedback :state="solicitudValidacion.cantidad">
                        Se debe seleccionar una opcion!
                    </b-form-invalid-feedback>
                    <b-form-valid-feedback :state="solicitudValidacion.cantidad">
                        Esta bien!
                    </b-form-valid-feedback>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <label>Descripcion de la solicitud</label>
                    <b-form-textarea
                        id="textarea"
                        placeholder="..."
                        v-model="solicitud.descripcion"
                        :state="solicitudValidacion.descripcion"
                        rows="3"
                        max-rows="6"
                    ></b-form-textarea>
                    <b-form-invalid-feedback :state="solicitudValidacion.descripcion">
                        Este espacio no puede quedar vacio
                    </b-form-invalid-feedback>
                    <b-form-valid-feedback :state="solicitudValidacion.descripcion">
                        Esta bien!
                    </b-form-valid-feedback>
                </div>
            </div>
            <div class="text-center">
                <button type="button" v-if="!loading" class="btn btn-success" @click="store()">Agregar Solicitud</button>
                <spinner-view :loading="loading"></spinner-view>
            </div>
        </form>
    </div>
    <div v-else class="mt-4">
        <b-alert show variant="success">Actualmente la actividad se encuentra completada, No se puede solicitar productos</b-alert>
    </div>
</template>

<script>
    import SpinnerView from '../../../../Spinner.vue'

    export default {
        props:['actividad_id', 'estado'],
        components:{
            SpinnerView
        },
        data(){
            return{
                solicitud:{
                    'producto_id': '',
                    'cantidad': '',
                    'descripcion': '',
                },
                solicitudValidacion:{
                    'producto_id': null,
                    'cantidad': null,
                    'descripcion': null,
                },
                options_producto: [],
                message: (this.estado == 'completado')? true : false,
                loading: false
            }
        },
        created(){
            this.getProductos()
        },
        methods:{
            store(){
                if(this.solicitud.producto_id != '' && this.solicitud.cantidad != '' && this.solicitud.descripcion != ''){
                    this.loading = true
                    axios.post(`/Proyectos/Actividades/Solicitudes/store/${this.actividad_id}`, this.solicitud).then(res=>{
                        if(res.data.status){
                            this.alert('Solicitud', res.data.msg, 'success')
                            this.solicitud = {
                                'producto_id': '',
                                'cantidad': '',
                                'descripcion': '',
                            }
                        }
                        this.loading = false
                    }).catch(function (error) {
                        this.alert('Solicitud', 'Error del servidor contactarse con el programador', 'error')
                        this.loading = false
                    });
                }else{
                    this.validar()
                }
            },

            getProductos(){
                // old ruta `/Proyectos/Actividades/Inventario/get/${this.actividad_id}` //
                axios.get(`/Productos/getAll`).then(res=>{
                    res.data.productos.forEach(producto => {
                        this.options_producto.push({ value : producto.id, text : producto.nombre})
                    });
                })
            },

            validar(){
                this.reporteValidacion.producto_id = (this.reporte.producto_id == '')? false : true
                this.reporteValidacion.cantidad = (this.reporte.cantidad == '')? false : true
                this.reporteValidacion.descripcion = (this.reporte.descripcion == '')? false : true
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
