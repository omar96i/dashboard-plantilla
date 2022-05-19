<template>
    <div>
         <!-- Modal Reportes -->
        <div class="modal fade" id="modalReportes" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Reagendamiento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group row">
                                <div class="col-12 col-lg-6">
                                    <label for="fecha_inicial">Fecha inicio</label>
                                    <b-form-datepicker id="fecha_inicial" class="mb-2" :state="reagendamientoValidacion.fecha_inicio" v-model="reagendamiento.fecha_inicio" placeholder="Selecciona una fecha"></b-form-datepicker>
                                    <b-form-invalid-feedback :state="reagendamientoValidacion.fecha_inicio">
                                        El campo no puede estar vacio
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="reagendamientoValidacion.fecha_inicio">
                                        OK!.
                                    </b-form-valid-feedback>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <label for="fecha_inicial">Fecha final</label>
                                    <b-form-datepicker id="fecha_inicial" class="mb-2" :state="reagendamientoValidacion.fecha_final" v-model="reagendamiento.fecha_final" placeholder="Selecciona una fecha"></b-form-datepicker>
                                    <b-form-invalid-feedback :state="reagendamientoValidacion.fecha_final">
                                        El campo no puede estar vacio
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="reagendamientoValidacion.fecha_final">
                                        OK!.
                                    </b-form-valid-feedback>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label>Descripcion</label>
                                    <b-form-textarea
                                        id="textarea"
                                        placeholder="..."
                                        v-model="reagendamiento.descripcion"
                                        :state="reagendamientoValidacion.descripcion"
                                        rows="3"
                                        max-rows="6"
                                    ></b-form-textarea>
                                    <b-form-invalid-feedback :state="reagendamientoValidacion.descripcion">
                                        Este espacio no puede quedar vacio
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="reagendamientoValidacion.descripcion">
                                        Esta bien!
                                    </b-form-valid-feedback>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="button" v-if="!loading" class="btn btn-success" @click="store()">Agregar</button>
                                <button type="button" v-if="!loading" class="btn btn-secondary" @click="$parent.closeModal()">Cerrar</button>
                                <spinner-view :loading="loading"></spinner-view>
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
                reagendamiento:{
                    'descripcion': '',
                    'fecha_inicio': '',
                    'fecha_final': '',
                },
                reagendamientoValidacion:{
                    'descripcion': null,
                    'fecha_inicio' : null,
                    'fecha_final': null,
                },
                loading: false
            }
        },
        methods:{

            store(){
                if(this.reagendamiento.descripcion != '' && this.reagendamiento.fecha_inicio != '' && this.reagendamiento.fecha_final){
                    this.loading = true
                    axios.post(`/Proyectos/Actividades/Reagendamientos/store/${this.actividad_id}`, this.reagendamiento).then(res=>{
                        if(res.data.status){
                            this.alert('Reagendamiento', res.data.msg, 'success')
                            this.$parent.closeModal()
                        }
                        this.loading = false
                    })
                }else{
                    this.validar()
                }

            },

            validar(){
                this.reagendamientoValidacion.descripcion = (this.reagendamiento.descripcion == '')? false : true
                this.reagendamientoValidacion.fecha_inicio = (this.reagendamiento.fecha_inicio == '')? false : true
                this.reagendamientoValidacion.fecha_final = (this.reagendamiento.fecha_final == '')? false : true
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
