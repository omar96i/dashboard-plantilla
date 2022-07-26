<template>
    <div>
         <!-- Modal Reportes -->
        <div class="modal fade" id="modalInterventoria" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" v-if="load">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Interventoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b-tabs content-class="mt-3">
                            <b-tab title="Datos de interventoria" active>
                                <div class="form-group row">
                                    <div class="col-12 col-lg-6 alert alert-success">
                                        <div class="col-12 col-lg-6">
                                            <label for="fecha_inicio">Fecha de inicio</label>
                                            <b-form-datepicker id="fecha_inicio" class="mb-2" v-model="interventoria.fecha_inicio" :disabled="interventoriaInputsDisabled.fecha_inicio"></b-form-datepicker>
                                            <b-form-invalid-feedback :state="interventoriaValidar.fecha_inicio">
                                                Selecciona una fecha
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.fecha_inicio">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="hora_inicio">Hora de inicio</label><br>
                                            <b-time id="hora_inicio" locale="en" v-model="interventoria.hora_inicio" :disabled="interventoriaInputsDisabled.hora_inicio"></b-time>
                                            <b-form-invalid-feedback :state="interventoriaValidar.hora_inicio">
                                                Selecciona una hora
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.hora_inicio">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 alert alert-danger">
                                        <div class="col-12 col-lg-6">
                                            <label for="fecha_final">Fecha de final</label>
                                            <b-form-datepicker id="fecha_final" class="mb-2" v-model="interventoria.fecha_final" :disabled="interventoriaInputsDisabled.fecha_final"></b-form-datepicker>
                                            <b-form-invalid-feedback :state="interventoriaValidar.fecha_final">
                                                Selecciona una fecha
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.fecha_final">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="hora_final">Hora de final</label><br>
                                            <b-time id="hora_final" locale="en" v-model="interventoria.hora_final" :disabled="interventoriaInputsDisabled.hora_final"></b-time>
                                            <b-form-invalid-feedback :state="interventoriaValidar.hora_final">
                                                Selecciona una hora
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.hora_final">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 col-lg-6">
                                        <label for="seleccionar_persona">Quien realiza interventoria?</label>
                                        <v-select id="seleccionar_persona" :options="usuarios" v-model="interventoria.usuario_id" :reduce="usuarios => usuarios.value" :disabled="interventoriaInputsDisabled.usuario_id"></v-select>
                                        <b-form-invalid-feedback :state="interventoriaValidar.usuario_id">
                                            Selecciona un usuario
                                        </b-form-invalid-feedback>
                                        <b-form-valid-feedback :state="interventoriaValidar.usuario_id">
                                            OK!.
                                        </b-form-valid-feedback>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <label for="seleccionar_proyecto">Proyecto?</label>
                                        <v-select id="seleccionar_proyecto" :options="proyectos" v-model="interventoria.proyecto_id" :reduce="proyectos => proyectos.value" :disabled="interventoriaInputsDisabled.proyecto_id"></v-select>
                                        <b-form-invalid-feedback :state="interventoriaValidar.proyecto_id">
                                            Selecciona un proyecto
                                        </b-form-invalid-feedback>
                                        <b-form-valid-feedback :state="interventoriaValidar.proyecto_id">
                                            OK!.
                                        </b-form-valid-feedback>
                                    </div>
                                </div>
                                <div v-if="load_second_form">
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="seleccion">Proceso al que pertenece el requerimiento</label>
                                            <b-form-group id="seleccion" v-slot="{ ariaDescribedby }">
                                                <b-form-radio-group
                                                    id="radio-group-1"
                                                    v-model="interventoria.checkout_1"
                                                    :options="options"
                                                    :aria-describedby="ariaDescribedby"
                                                    name="radio-options"
                                                ></b-form-radio-group>
                                            </b-form-group>
                                            <b-form-invalid-feedback :state="interventoriaValidar.checkout_1">
                                                Selecciona un usuario
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.checkout_1">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="descripcion">Revision de obra</label>
                                            <b-form-textarea
                                                id="textarea"
                                                v-model="interventoria.descripcion_1"
                                                placeholder="Descripcion..."
                                                rows="5"
                                                max-rows="10"
                                            ></b-form-textarea>
                                            <b-form-invalid-feedback :state="interventoriaValidar.descripcion_1">
                                                Selecciona un usuario
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.descripcion_1">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-lg-5 mt-2 mt-lg-0">
                                            <label for="seleccion2">Se informo a la persona encargada de obra?  </label>
                                            <b-form-group id="seleccion2" v-slot="{ ariaDescribedby }">
                                                <b-form-radio-group
                                                    id="radio-group-2"
                                                    v-model="interventoria.checkout_2"
                                                    :options="options2"
                                                    :aria-describedby="ariaDescribedby"
                                                    name="radio-options-2"
                                                ></b-form-radio-group>
                                            </b-form-group>
                                            <b-form-invalid-feedback :state="interventoriaValidar.checkout_2">
                                                Selecciona un usuario
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.checkout_2">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12">
                                            <label for="descripcion">OBSERVACION CLIENTE / ENCARGADO</label>
                                            <b-form-textarea
                                                id="textarea"
                                                v-model="interventoria.descripcion_2"
                                                placeholder="Descripcion..."
                                                rows="5"
                                                max-rows="10"
                                            ></b-form-textarea>
                                            <b-form-invalid-feedback :state="interventoriaValidar.descripcion_2">
                                                Selecciona un usuario
                                            </b-form-invalid-feedback>
                                            <b-form-valid-feedback :state="interventoriaValidar.descripcion_2">
                                                OK!.
                                            </b-form-valid-feedback>
                                        </div>
                                    </div>
                                </div>
                                <!-- <label for="signature">Ingresa la firma</label>
                                <vueSignature ref="signature" :sigOption="option" :disabled="disabled" :h="'100px'" class="border"></vueSignature>
                                <button @click="save">Save</button>
                                <button @click="clear">Clear</button>
                                <button @click="handleDisabled">disabled</button> -->
                                <div class="text-center col-12">
                                    <b-button variant="success btn-sm" @click="action()">{{(type == 'insert')? 'Crear': 'Actualizar'}}</b-button>
                                </div>
                            </b-tab>
                            <b-tab title="Firma de cliente" @click="setEstado('cliente')">
                                <div class="container-fluid" v-if="load_firma_form_1">
                                    <firma-form :interventoria="interventoria" :type="'cliente'"></firma-form>
                                </div>
                            </b-tab>
                            <b-tab title="Firma operario" @click="setEstado('operario')">
                                <div class="container-fluid" v-if="load_firma_form_2">
                                    <firma-form :interventoria="interventoria" :type="'operario'"></firma-form>
                                </div>
                            </b-tab>
                        </b-tabs>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FirmaForm from './FirmaForm'
    export default {
        props:['type', 'id'],
        components: {
            FirmaForm
        },
        data(){
            return{
                load_firma_form_1: false,
                load_firma_form_2: false,
                interventoria:{
                    'proyecto_id': '',
                    'usuario_id': '',
                    'fecha_inicio': '',
                    'hora_inicio' : '',
                    'fecha_final' : '',
                    'hora_final': '',
                    'checkout_1': '',
                    'descripcion_1' : '',
                    'checkout_2' : '',
                    'descripcion_2' : '',
                    'files' : '',
                },
                interventoriaValidar:{
                    'proyecto_id': null,
                    'usuario_id': null,
                    'fecha_inicio': null,
                    'hora_inicio' : null,
                    'fecha_final' : null,
                    'hora_final': null,
                    'checkout_1': null,
                    'descripcion_1' : null,
                    'checkout_2' : null,
                    'descripcion_2' : null,
                    'files' : null,
                },
                interventoriaInputsDisabled:{
                    'proyecto_id': false,
                    'usuario_id': false,
                    'fecha_inicio': false,
                    'hora_inicio' : false,
                    'fecha_final' : false,
                    'hora_final': false,
                },
                usuarios:[],
                proyectos:[],
                load: true,
                loading: true,
                disabled:false,
                selected: 'first',
                option:{
                    penColor:"rgb(0, 0, 0)",
                    backgroundColor:"rgb(255,255,255)"
                },
                options: [
                    { text: 'Dirección Comercial', value: 'Dirección Comercial' },
                    { text: 'Dirección Ingenieria', value: 'Dirección Ingenieria' },
                    { text: 'Dirección Administrativa', value: 'Dirección Administrativa' }
                ],
                options2: [
                    { text: 'Si', value: 'Si' },
                    { text: 'No', value: 'No' },
                ],
                ruta: '',
                load_second_form: false
            }
        },
        created() {
            if(this.type == 'update' || this.type == 'complete'){
                this.getInterventoria()
                if(this.type == 'complete'){
                    this.load_second_form = true,
                    this.interventoriaInputsDisabled.proyecto_id = true
                    this.interventoriaInputsDisabled.usuario_id = true
                    this.interventoriaInputsDisabled.fecha_inicio = true
                    this.interventoriaInputsDisabled.hora_inicio  = true
                    this.interventoriaInputsDisabled.fecha_final  = true
                    this.interventoriaInputsDisabled.hora_final = true
                }
            }
            this.getUsuarios()
            this.getProyectos()
        },
        methods:{
            setEstado(tipo){
                if(tipo == 'cliente'){
                    this.load_firma_form_1 = true
                    this.load_firma_form_2 = false
                }else if(tipo == 'operario'){
                    this.load_firma_form_1 = false
                    this.load_firma_form_2 = true
                }
            },
            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
            },

            getInterventoria(){
                axios.get(`/Proyectos/Interventorias/get/${this.id}`).then(res=>{
                    this.interventoria = res.data.interventoria
                })
            },

            action(){
                if(this.type == 'update' || this.type == 'complete'){
                    this.ruta = `/Proyectos/Interventorias/update/${this.interventoria.id}`
                }else{
                    this.ruta = '/Proyectos/Interventorias/store'
                }
                if(
                    this.interventoria.proyecto_id == '' ||
                    this.interventoria.usuario_id == '' ||
                    this.interventoria.fecha_inicio == '' ||
                    this.interventoria.hora_inicio == '' ||
                    this.interventoria.fecha_final == '' ||
                    this.interventoria.hora_final == ''
                ){
                    this.validar()
                }else{
                    axios.post(this.ruta, this.interventoria).then(res=>{
                        if(res.data.status){
                            this.alert('Interventoria', res.data.msg, 'success')
                            this.$parent.getInterventorias()
                            if(this.type == 'insert'){
                                this.interventoria = {
                                    'proyecto_id': '',
                                    'usuario_id': '',
                                    'fecha_inicio': '',
                                    'hora_inicio' : '',
                                    'fecha_final' : '',
                                    'hora_final': '',
                                    'checkout_1': '',
                                    'descripcion_1' : '',
                                    'checkout_2' : '',
                                    'descripcion_2' : '',
                                    'files' : '',
                                }
                            }
                        }

                    }).catch(function (error) {
                        console.log(error.response)
                    });
                }
            },
            getUsuarios(){
                axios.get('/Usuarios/getAll').then(res=>{
                    res.data.usuarios.forEach(usuario => {
                        this.usuarios.push({ value : usuario.id, label : usuario.informacion_personal.nombres + " " + usuario.informacion_personal.apellidos})
                    });
                })
            },
            getProyectos(){
                axios.get('/Proyectos/get').then(res=>{
                    res.data.proyectos.forEach(proyecto => {
                        this.proyectos.push({ value : proyecto.id, label : proyecto.nombre})
                    });
                })
            },
            save(){
                var _this = this;
                var png = _this.$refs.signature.save()
                console.log(png);
            },
            clear(){
                var _this = this;
                _this.$refs.signature.clear();
            },
            fromDataURL(url){
                var _this = this;
                _this.$refs.signature.fromDataURL("data:image/png;base64,iVBORw0K...");
            },
            handleDisabled(){
                var _this = this;
                _this.disabled  = !_this.disabled
            },
            validar(){
                this.interventoriaValidar.proyecto_id = (this.interventoria.proyecto_id == '' )? false : true
                this.interventoriaValidar.usuario_id = (this.interventoria.usuario_id == '' )? false : true
                this.interventoriaValidar.fecha_inicio = (this.interventoria.fecha_inicio == '' )? false : true
                this.interventoriaValidar.hora_inicio = (this.interventoria.hora_inicio == '' )? false : true
                this.interventoriaValidar.fecha_final = (this.interventoria.fecha_final == '' )? false : true
                this.interventoriaValidar.hora_final = (this.interventoria.hora_final == '' )? false : true
            }
        }
    }
</script>
