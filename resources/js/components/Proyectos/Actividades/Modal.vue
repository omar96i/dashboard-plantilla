<template>
    <div>
         <!-- Modal Reportes -->
        <div class="modal fade" id="modalReportes" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Reporte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="b-i" class="col-form-label">Producto:</label>
                                    <b-form-select :options="options_producto" v-model="reporte.producto_id" :state="reporteValidacion.producto_id"></b-form-select>
                                    <b-form-invalid-feedback :state="reporteValidacion.producto_id">
                                        Se debe seleccionar una opcion!
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="reporteValidacion.producto_id">
                                        Esta bien!
                                    </b-form-valid-feedback>
                                </div>
                                <div class="col-4">
                                    <label for="b-i" class="col-form-label">Cantidad afectada:</label>
                                    <b-form-input type="number" v-model="reporte.cantidad" :state="reporteValidacion.cantidad" placeholder=""></b-form-input>
                                    <b-form-invalid-feedback :state="reporteValidacion.cantidad">
                                        Se debe seleccionar una opcion!
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="reporteValidacion.cantidad">
                                        Esta bien!
                                    </b-form-valid-feedback>
                                </div>
                                <div class="col-4">
                                    <label for="fecha_inicial">Fecha</label>
                                    <b-form-datepicker id="fecha_inicial" class="mb-2" :state="reporteValidacion.fecha" v-model="reporte.fecha" placeholder="Selecciona una fecha"></b-form-datepicker>
                                    <b-form-invalid-feedback :state="reporteValidacion.fecha">
                                        El campo no puede estar vacio
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="reporteValidacion.fecha">
                                        OK!.
                                    </b-form-valid-feedback>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Descripcion del reporte</label>
                                    <b-form-textarea
                                        id="textarea"
                                        placeholder="..."
                                        v-model="reporte.descripcion"
                                        :state="reporteValidacion.descripcion"
                                        rows="3"
                                        max-rows="6"
                                    ></b-form-textarea>
                                    <b-form-invalid-feedback :state="reporteValidacion.descripcion">
                                        Este espacio no puede quedar vacio
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="reporteValidacion.descripcion">
                                        Esta bien!
                                    </b-form-valid-feedback>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" class="btn btn-success" @click="store()">Agregar</button>
                                <button type="button" class="btn btn-secondary" @click="$parent.closeModal()">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SpinnerView from '../../Spinner.vue'
    export default {
        components: {
			SpinnerView
		},
        props:['actividad_id'],
        data(){
            return{
                reporte:{
                    'producto_id': '',
                    'cantidad': '',
                    'descripcion': '',
                    'fecha': ''
                },
                reporteValidacion:{
                    'producto_id': null,
                    'cantidad': null,
                    'descripcion': null,
                    'fecha' : null
                },
                options_producto: []
            }
        },
        created(){
            this.getProductos()
        },
        methods:{

            store(){
                if(this.reporte.producto_id != '' && this.reporte.cantidad != '' && this.reporte.descripcion != '' && this.reporte.fecha != ''){
                    axios.post(`/Proyectos/Actividades/Reportes/store/${this.actividad_id}`, this.reporte).then(res=>{
                        if(res.data.status){
                            this.alert('Reporte', res.data.msg, 'success')
                            this.$parent.closeModal()
                        }
                    })
                }else{
                    this.validar()
                }

            },

            getProductos(){
                axios.get(`/Proyectos/Actividades/Inventario/get/${this.actividad_id}`).then(res=>{
                    res.data.inventario.forEach(producto => {
                        this.options_producto.push({ value : producto.id, text : producto.productos.productos.nombre})
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
