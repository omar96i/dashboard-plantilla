<template>
    <div>
        <!-- Modal Abono -->
        <div class="modal fade" id="modalAbonos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Abono</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModalAbonos()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group row" >
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Abono # <span style="color:red;">*</span></label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': validacionAbono.nombre}, 'form-control']" placeholder="Nombre del abono..." v-model="abono.nombre">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Fecha</label>
                                    <input type="date" v-bind:class="['form-control']" placeholder="Fecha..." v-model="abono.fecha">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row" >
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Valor del abono <span style="color:red;">*</span></label>
                                    <input type="number" v-bind:class="[{ 'is-invalid': validacionAbono.valor}, 'form-control']" placeholder="Valor..." v-model="abono.valor">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Observacion <span style="color:red;">*</span></label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': validacionAbono.observacion}, 'form-control']" placeholder="Observacion..." v-model="abono.observacion">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 text-center mb-4" v-if="!load">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$parent.closeModalAbonos()">Cerrar</button>
                        <button type="button" class="btn btn-success" @click="store()">Agregar</button>
                    </div>
                    <div class="col-12 text-center mb-4" v-else>
                        <spinner-view :loading="load"></spinner-view>
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
                abono:{
                    'nombre' : '',
                    'valor' : '',
                    'fecha' : '',
                    'observacion' : '',
                },
                validacionAbono:{
                    'nombre' : false,
                    'valor' : false,
                    'observacion' : false,
                },
                ruta: '',
                load: false
            }
        },

        created(){
            this.ruta = `/Cotizaciones/Abonos/store/${this.cotizacion.id}`
        },

        methods:{
            store(){
                if(!this.validacion()){
                    this.load = true
                    axios.post(this.ruta, this.abono).then(res=>{
                        if(res.data.saved){
                            this.alert("Abono", "Agregado", "success")
                            this.$parent.closeModalAbonos()
                            this.$parent.getAbonos()
                        }
                        this.load = false
                    })
                }
            },

            validacion(){
                if(
                    this.abono.nombre == '' ||
                    this.abono.valor == '' ||
                    this.abono.observacion == ''
                ){
                    this.validacionAbono.nombre = (this.abono.nombre == '')? true : false
                    this.validacionAbono.valor = (this.abono.valor == '')? true : false
                    this.validacionAbono.observacion = (this.abono.observacion == '')? true : false
                    return true
                }
                this.validacionAbono.nombre = (this.abono.nombre == '')? true : false
                this.validacionAbono.valor = (this.abono.valor == '')? true : false
                this.validacionAbono.observacion = (this.abono.observacion == '')? true : false
                return false
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
