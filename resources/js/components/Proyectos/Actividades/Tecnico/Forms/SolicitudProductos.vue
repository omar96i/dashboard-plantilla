<template>
    <div v-if="!message">
        <form method="post">
            <h5>Solicitar producto</h5>
            <div class="form-group row">
                <div class="col-12 col-lg-6">
                    <label for="b-i" class="col-form-label">Producto:</label>
                    <b-form-select :options="options_producto" v-model="reporte.producto_id" :state="reporteValidacion.producto_id"></b-form-select>
                    <b-form-invalid-feedback :state="reporteValidacion.producto_id">
                        Se debe seleccionar una opcion!
                    </b-form-invalid-feedback>
                    <b-form-valid-feedback :state="reporteValidacion.producto_id">
                        Esta bien!
                    </b-form-valid-feedback>
                </div>
                <div class="col-12 col-lg-6">
                    <label for="b-i" class="col-form-label">Cantidad:</label>
                    <b-form-input type="number" v-model="reporte.cantidad" :state="reporteValidacion.cantidad" placeholder=""></b-form-input>
                    <b-form-invalid-feedback :state="reporteValidacion.cantidad">
                        Se debe seleccionar una opcion!
                    </b-form-invalid-feedback>
                    <b-form-valid-feedback :state="reporteValidacion.cantidad">
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
                <button type="button" class="btn btn-success" @click="store()">Agregar Solicitud</button>
            </div>
        </form>
    </div>
    <div v-else class="mt-4">
        <b-alert show variant="success">Actualmente la actividad se encuentra completada, No se puede solicitar productos</b-alert>
    </div>
</template>

<script>
    export default {
        props:['actividad_id', 'estado'],
        data(){
            return{
                reporte:{
                    'producto_id': '',
                    'cantidad': '',
                    'descripcion': '',
                },
                reporteValidacion:{
                    'producto_id': null,
                    'cantidad': null,
                    'descripcion': null,
                },
                options_producto: [],
                message: (this.estado == 'completado')? true : false
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
                            this.$parent.$parent.$parent.setForm('reset')
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
