<template>
    <div>
        <!-- Modal Abono -->
        <div class="modal fade" id="modalTemplate" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Templates</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModalTemplate()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="col-12">
                                <label for="a-i" class="col-form-label">Selecciona la cotizacion:</label>
                                <input list="cotizaciones" class="form-control">
                                <datalist id="cotizaciones">
                                    <option v-for="(cotizacion, index) in cotizaciones" :key="index" :value="cotizacion.id">{{cotizacion.nombre_facturar}} - {{cotizacion.cliente_proyecto}}</option>
                                </datalist>
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 text-center mb-4" v-if="!load">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$parent.closeModalTemplate()">Cerrar</button>
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
        components: {
			SpinnerView
		},

        data(){
            return{
                ruta: '',
                load: false,
                cotizaciones: {},
                load_two: false,
            }
        },

        created(){
            this.ruta = `/Cotizaciones/templates/store`
            this.getCotizaciones()
        },

        methods:{
            store(){
                this.load = true
                axios.post(this.ruta).then(res=>{

                })
            },

            getCotizaciones(){
                axios.get('/Cotizaciones/getAll').then(res=>{
                    this.cotizaciones = res.data.cotizaciones
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
