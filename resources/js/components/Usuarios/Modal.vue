<template>
    <div>
         <!-- Modal Usuarios -->
        <div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Usuarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" @submit.prevent="action" enctype="multipart/form-data">
                            <div class="form-group row text-center">
                                <div class="col-12 col-md-4">
                                    <div class="col-12">
                                        <img v-bind:src="imagePreview" alt="" style="width: 20em; border-radius: 12px;">
                                    </div>
                                    <div class="col-12">
                                        <label for="foto" class="btn btn-success btn-sm btn-block">Selecciona una imagen</label>
                                        <input type="file" class="form-control" style="display:none" id="foto" name="foto" v-on:change="onImageChange">
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Email</label>
                                            <input type="email" v-bind:class="[{ 'is-invalid': usuarioValidacion.email}, 'form-control']" v-model="usuario.email" placeholder="Email..." >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label for="b-i" class="col-form-label">Password:</label>
                                            <input type="password" id="b-i" v-bind:class="[{ 'is-invalid': usuarioValidacion.password}, 'form-control']" v-model="usuario.password" name="b-i" placeholder="Password..." >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Documento</label>
                                            <input type="text" v-bind:class="[{ 'is-invalid': usuarioValidacion.documento}, 'form-control']" v-model="usuario.documento" name="b-i" placeholder="Documento..." >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Nombres:</label>
                                            <input type="text" v-bind:class="[{ 'is-invalid': usuarioValidacion.nombres}, 'form-control']" v-model="usuario.nombres" name="b-i" placeholder="Nombres..." >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Apellidos:</label>
                                            <input type="text" v-bind:class="[{ 'is-invalid': usuarioValidacion.apellidos}, 'form-control']" v-model="usuario.apellidos" name="b-i" placeholder="Apellidos..." >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Telefono:</label>
                                            <input type="text" v-bind:class="[{ 'is-invalid': usuarioValidacion.telefono}, 'form-control']" name="b-i"  v-model="usuario.telefono" placeholder="Telefono..." >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Fecha Nacimiento:</label>
                                            <input type="date" v-bind:class="[{ 'is-invalid': usuarioValidacion.fecha_nacimiento}, 'form-control']" v-model="usuario.fecha_nacimiento" name="b-i" >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Ciudad:</label>
                                            <input type="text" v-bind:class="[{ 'is-invalid': usuarioValidacion.ciudad}, 'form-control']" name="b-i" v-model="usuario.ciudad" placeholder="Cuidad..." >
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Sexo:</label>
                                            <select name="" v-model="usuario.sexo" v-bind:class="[{ 'is-invalid': usuarioValidacion.sexo}, 'form-control']" >
                                                <option value="hombre">Hombre</option>
                                                <option value="mujer">Mujer</option>
                                            </select>
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <label class="col-form-label">Rol:</label>
                                            <select name="" v-model="usuario.role" v-bind:class="[{ 'is-invalid': usuarioValidacion.role}, 'form-control']" >
                                                <option value="admin">admin</option>
                                                <option value="lider.electrico">lider.electrico</option>
                                                <option value="lider.ingenieria">lider.ingenieria</option>
                                                <option value="sub.admin">sub.admin</option>
                                                <option value="comercial">comercial</option>
                                                <option value="administracion.compras">administracion.compras</option>
                                                <option value="tecnico">tecnico</option>
                                                <option value="diseñador">diseñador</option>
                                            </select>
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center" v-if="!loading">
                                <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="closeModal">Cerrar</button>
                            </div>
                            <div class="text-center" v-else>
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
    import url from '../../mixins/cloudinary'
    import SpinnerView from '../Spinner.vue'
    export default {
        props:['user', 'tipo'],
        components: {
			SpinnerView,
		},
        mixins: [url],
        data(){
            return{
                imagePreview:'/img/img_usuarios/default.jpg',
                usuario:{
                    'email' : '',
                    'password' : '',
                    'documento' : '',
                    'nombres' : '',
                    'apellidos' : '',
                    'telefono' : '',
                    'sexo' : '',
                    'fecha_nacimiento' : '',
                    'ciudad' : '',
                    'role': ''
                },
                usuarioValidacion:{
                    'email' : false,
                    'password' : false,
                    'documento' : false,
                    'nombres' : false,
                    'apellidos' : false,
                    'sexo' : false,
                    'telefono' : false,
                    'fecha_nacimiento' : false,
                    'ciudad' : false,
                    'role': false
                },
                image:'',
                ruta: '',
                loading: false,
            }
        },
        created(){
            if(this.tipo == "edit"){
                this.usuario = {
                    'email' : this.user.email,
                    'password' : '',
                    'documento' : this.user.informacion_personal.documento,
                    'nombres' : this.user.informacion_personal.nombres,
                    'apellidos' : this.user.informacion_personal.apellidos,
                    'direccion' : this.user.informacion_personal.direccion,
                    'telefono' : this.user.informacion_personal.telefono,
                    'sexo' : this.user.informacion_personal.sexo,
                    'fecha_nacimiento' : this.user.informacion_personal.fecha_nacimiento,
                    'ciudad' : this.user.informacion_personal.ciudad,
                    'role': this.user.role_user[0]
                }
                this.imagePreview = (this.user.informacion_personal.foto == "default.jpg")? '/img/img_usuarios/default.jpg' : this.url+this.user.informacion_personal.foto
            }

            this.ruta = (this.tipo == "edit") ? `/Usuarios/update/${this.user.id}` : '/Usuarios/store'

        },
        methods:{
            action(){
                if(
                    this.usuario.email == '' ||
                    this.usuario.documento == '' ||
                    this.usuario.nombres == '' ||
                    this.usuario.apellidos == '' ||
                    this.usuario.direccion == '' ||
                    this.usuario.telefono == '' ||
                    this.usuario.sexo == '' ||
                    this.usuario.fecha_nacimiento == '' ||
                    this.usuario.ciudad == '' ||
                    this.usuario.role == ''
                )
                {
                    this.Validar()
                }else
                {
                    this.loading = true
                    let data = new FormData();
                    data.append("email", this.usuario.email)
                    if(this.tipo == "edit"){
                        if(this.usuario.password != ''){
                            data.append("password", this.usuario.password)
                        }
                    }else{
                        data.append("password", this.usuario.password)
                    }
                    data.append("documento", this.usuario.documento)
                    data.append("nombres", this.usuario.nombres)
                    data.append("apellidos", this.usuario.apellidos)
                    data.append("direccion", this.usuario.direccion)
                    data.append("telefono", this.usuario.telefono)
                    data.append("sexo", this.usuario.sexo)
                    data.append("fecha_nacimiento", this.usuario.fecha_nacimiento)
                    data.append("ciudad", this.usuario.ciudad)
                    data.append("role", this.usuario.role)
                    if(this.image != ''){
                        data.append("foto", this.image, this.image.name)
                    }

                    axios.post(this.ruta, data).then(res=>{
                        if(res.data.saved){
                            this.usuario = {
                                'email' : '',
                                'password' : '',
                                'documento' : '',
                                'nombres' : '',
                                'apellidos' : '',
                                'direccion' : '',
                                'telefono' : '',
                                'sexo' : '',
                                'fecha_nacimiento' : '',
                                'ciudad' : '',
                                'role': ''
                            }
                        }
                        this.loading = false
                        this.alert("Usuario", (this.tipo == "edit")? "Usuario Editado": "Usuario Creado", "success")
                        this.closeModal()
                    }).catch(function (error) {
                        console.log(error.response)
                        this.alert('Asistencia', 'Error en el servidor contactese con el programador', 'error')
                        this.loading = false
                    });
                }
            },

            closeModal(){
                this.$parent.getAllUser()
                this.$parent.closeModal()
            },

            Validar(){
                if(this.usuario.email == ''){
                    this.usuarioValidacion.email = true
                }else{
                    this.usuarioValidacion.email = false
                }
                if(this.usuario.documento == ''){
                    this.usuarioValidacion.documento = true
                }else{
                    this.usuarioValidacion.documento = false
                }
                if(this.usuario.nombres == ''){
                    this.usuarioValidacion.nombres = true
                }else{
                    this.usuarioValidacion.nombres = false
                }
                if(this.usuario.apellidos == ''){
                    this.usuarioValidacion.apellidos = true
                }else{
                    this.usuarioValidacion.apellidos = false
                }
                if(this.usuario.telefono == ''){
                    this.usuarioValidacion.telefono = true
                }else{
                    this.usuarioValidacion.telefono = false
                }
                if(this.usuario.fecha_nacimiento == ''){
                    this.usuarioValidacion.fecha_nacimiento = true
                }else{
                    this.usuarioValidacion.fecha_nacimiento = false
                }
                if(this.usuario.ciudad == ''){
                    this.usuarioValidacion.ciudad = true
                }else{
                    this.usuarioValidacion.ciudad = false
                }
                if(this.usuario.role == ''){
                    this.usuarioValidacion.role = true
                }else{
                    this.usuarioValidacion.role = false
                }
                if(this.usuario.sexo == ''){
                    this.usuarioValidacion.sexo = true
                }else{
                    this.usuarioValidacion.sexo = false
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
