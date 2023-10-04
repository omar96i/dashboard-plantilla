<template>
    <div>
        <!-- Modal Sub Cotizacion -->
        <div class="modal fade" id="modalSubCotizacion" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Sub cotización</h5>
                        <button type="button" class="close" @click="$parent.closeModalSubCotizacion()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-12 col-sm-6">
                                <label for="a-i" class="col-form-label">Selecciona el área:</label>
                                <select name="" id="" class="form-control" v-model="sub_cotizacion.area">
                                    <option value="" selected>Selecciona el área</option>
                                    <option value="electrica">Electrica</option>
                                    <option value="iluminacion">Iluminación</option>
                                    <option value="control_iluminacion">Control Iluminacion</option>
                                    <option value="audio">Audio</option>
                                    <option value="integracion">Integración</option>
                                    <option value="seguridad">Seguridad</option>
                                    <option value="mano_obra">Mano de Obra</option>
                                    <option value="servicios">Servicios</option>
                                </select>
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="b-i" class="col-form-label">Descripcion:</label>
                                <input type="text" id="b-i" class="form-control" name="b-i" placeholder="Descripcion..." v-model="sub_cotizacion.descripcion">
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$parent.closeModalSubCotizacion()">Cerrar</button>
                        <button type="button" class="btn btn-success" @click="storeCotizacion()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SpinnerView from '../Spinner.vue'
    export default {
        props:['cotizacion'],
        components: {
			SpinnerView
		},
        data(){
            return{
                sub_cotizacion:{},
                ruta: ''
            }
        },

        created(){
            this.ruta = `/Cotizaciones/store/${this.cotizacion.id}`
        },

        methods:{
            storeCotizacion(){
                axios.post(this.ruta, this.sub_cotizacion).then(res=>{
                    if(res.data.saved){
                        this.alert("Sub Cotizacion", "Agregada", "success")
                        this.sub_cotizacion = {}
                        this.$parent.getSubCotizacion()
                        this.$parent.closeModalSubCotizacion()
                    }
                })
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
