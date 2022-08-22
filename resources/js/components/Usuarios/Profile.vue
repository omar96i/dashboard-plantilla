<template>
    <div>
        <div class="container-fluid rounded bg-white mt-5 mb-5">
            <div class="row" v-if="loading">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <div class="container">
                            <input type="file" style="display:none;" id="img" @change="onImageChange" :disabled="loading_img">
                            <label for="img">
                                <img class="image" width="150px" v-bind:src="user.informacion_personal.foto == 'default.jpg'? 'img/img_usuarios/'+user.informacion_personal.foto: url+user.informacion_personal.foto">
                                <div class="middle">
                                    <div class="text">
                                        <b-spinner type="grow" label="Loading..." v-if="loading_img"></b-spinner>
                                        <i class="fa-solid fa-camera" v-else></i>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <span class="font-weight-bold">{{user.informacion_personal.nombres + " " + user.informacion_personal.apellidos}}</span>
                        <span class="text-black-50">{{user.email}}</span>
                        <span class="text-black-50">{{user.roles[0].name}}</span>
                        <span> </span>
                    </div>
                </div>
                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Informacion personal</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <label class="labels">Documento</label>
                                <input type="text" class="form-control" v-model="user.informacion_personal.documento" placeholder="Documento" disabled readonly>
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6"><label class="labels">Nombres</label><input type="text" v-model="user.informacion_personal.nombres" v-bind:class="[{ 'is-invalid': userValidacion.nombres}, 'form-control']" placeholder="Nombres"><div class="invalid-feedback">El campo no debe quedar vacío</div></div>
                            <div class="col-md-6"><label class="labels">Apellidos</label><input type="text" v-model="user.informacion_personal.apellidos" v-bind:class="[{ 'is-invalid': userValidacion.apellidos}, 'form-control']" value="" placeholder="Apellidos"><div class="invalid-feedback">El campo no debe quedar vacío</div></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12"><label class="labels">Telefono</label><input type="text" v-bind:class="[{ 'is-invalid': userValidacion.telefono}, 'form-control']" v-model="user.informacion_personal.telefono" value="" placeholder="Telefono"><div class="invalid-feedback">El campo no debe quedar vacío</div></div>
                            <div class="col-md-12">
                                <label class="col-form-label">Sexo:</label>
                                <select v-model="user.informacion_personal.sexo" v-bind:class="[{ 'is-invalid': userValidacion.sexo}, 'form-control']" >
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                </select>
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label for="example-datepicker">Fecha nacimiento</label>
                                <b-form-datepicker id="example-datepicker" v-model="user.informacion_personal.fecha_nacimiento" v-bind:class="[{ 'is-invalid': userValidacion.fecha_nacimiento}]"></b-form-datepicker>
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
                            </div>
                            <div class="col-md-12"><label class="labels">Ciudad</label><input type="text" v-bind:class="[{ 'is-invalid': userValidacion.ciudad}, 'form-control']" placeholder="Ciudad..." v-model="user.informacion_personal.ciudad"><div class="invalid-feedback">El campo no debe quedar vacío</div></div>
                        </div>
                        <div class="mt-5 text-center">
                            <button v-if="!loading_perfil" class="btn btn-primary profile-button" type="button" @click="updatePerfil">Guardar</button>
                            <div class="text-center" v-else>
                                <spinner-view :loading="loading"></spinner-view>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Cambiar contraseña</h4>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Nueva contraseña</label><input type="password" class="form-control" v-model="password.new"></div>
                            <div class="col-md-12"><label class="labels">Repetir nueva contraseña</label><input type="password" class="form-control" v-model="password.renew"></div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="button" @click="updatePassword">Cambiar contraseña</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import url from '../../mixins/cloudinary'
import SpinnerView from '../Spinner.vue'

export default {
    data(){
        return{
            user:{},
            userValidacion:{
                'nombres' : false,
                'apellidos' : false,
                'telefono' : false,
                'sexo' : false,
                'ciudad' : false,
                'fecha_nacimiento' : false
            },
            loading: false,
            image: '',
            loading_img: false,
            loading_perfil: false,
            password:{
                'new': '',
                'renew' : ''
            }
        }
    },
    components: {
        SpinnerView,
    },
    created(){
        this.getUser()
    },
    mixins: [url],
    methods:{
        getUser(){
            axios.get('/Usuarios/getUser').then(res=>{
                console.log(res.data.user)
                this.user = res.data.user
                this.loading = true
            }).catch(error=>{
                console.log(error.response)
                this.alert('Error', 'Error de servidor', 'error')
            })
        },
        onImageChange(e){
            if(e.target.files[0].length === 0){
                this.alert('Error', 'No se a seleccionado una imagen', 'error')
                return
            }
            this.loading_img = true
            this.image = e.target.files[0]
            this.updateImage()
        },
        updateImage(){
            let data = new FormData();
            data.append("foto", this.image, this.image.name)
            axios.post(`/Usuarios/update/foto/${this.user.informacion_personal.id}`, data).then(res=>{
                $(".image").attr("src",this.url+res.data.img)
                this.user.informacion_personal.foto = res.data.img
                this.loading_img = false
            }).catch(error=>{
                console.log(error.response)
                this.alert('Error', 'Error de servidor', 'error')
            })
        },
        updatePassword(){
            if(!this.validarPassword()){
                axios.post(`/Usuarios/update/password/${this.user.id}`, this.password).then(res=>{
                    if(res.data.status){
                        this.password = {
                            'new' : '',
                            'renew' : ''
                        }
                        this.alert('Actualizado', 'Su contraseña a sido actualizada!', 'success')
                    }
                }).catch(error=>{
                    console.log(error.response)
                    this.alert('Error', 'Error de servidor', 'error')
                })
            }
        },
        updatePerfil(){
            if(!this.validar()){
                this.loading_perfil = true
                axios.post(`/Usuarios/update/informacionPersonal/${this.user.informacion_personal.id}`, this.user.informacion_personal).then(res=>{
                    if(res.data.status){
                        this.user.informacion_personal.nombres = res.data.informacion_personal.nombres
                        this.user.informacion_personal.apellidos = res.data.informacion_personal.apellidos
                        this.user.informacion_personal.telefono = res.data.informacion_personal.telefono
                        this.user.informacion_personal.fecha_nacimiento = res.data.informacion_personal.fecha_nacimiento
                        this.user.informacion_personal.ciudad = res.data.informacion_personal.ciudad
                        this.user.informacion_personal.sexo = res.data.informacion_personal.sexo
                        this.validar()
                        this.alert('Actualizado', 'Los datos personales han sido actualizado!', 'success')
                        this.loading_perfil = false
                    }
                }).catch(error=>{
                    this.loading_perfil = false
                    console.log(error.response)
                    this.alert('Error', 'Error de servidor', 'error')
                })
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
        validar(){
            this.userValidacion.nombres = (this.user.informacion_personal.nombres == '')? true : false
            this.userValidacion.apellidos = (this.user.informacion_personal.apellidos == '')? true : false
            this.userValidacion.sexo = (this.user.informacion_personal.sexo == '')? true : false
            this.userValidacion.ciudad = (this.user.informacion_personal.ciudad == '')? true : false
            this.userValidacion.fecha_nacimiento = (this.user.informacion_personal.fecha_nacimiento == '')? true : false
            this.userValidacion.telefono = (this.user.informacion_personal.telefono == '')? true : false
            if(this.user.informacion_personal.nombres == '' || this.user.informacion_personal.apellidos == '' || this.user.informacion_personal.sexo == '' || this.user.informacion_personal.telefono == '' || this.user.informacion_personal.ciudad == '' || this.user.informacion_personal.fecha_nacimiento == ''){
                return true
            }else{
                return false
            }
        },
        validarPassword(){
            if(this.password.new == '' || this.password.renew == ''){
                return true
            }
            if(this.password.new != this.password.renew){
                return true
            }
            return false
        }
    }
}
</script>
