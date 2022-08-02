<template>
<div>
    <button class="btn btn-success btn-sm" @click="agregarUsuario">
        <i class="fas fa-user-plus"></i>
        <samp class="pl-2">Crear Usuario</samp>
    </button>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tablaUsuarios" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Sexo</th>
                    <th>Fecha nacimiento</th>
                    <th>Ciudad</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Foto</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Telefono</th>
                    <th>Sexo</th>
                    <th>Fecha nacimiento</th>
                    <th>Ciudad</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(usuario, index) in usuarios" :key="index">
                    <td class="text-center" v-if="usuario.informacion_personal != null"><img v-bind:src="usuario.informacion_personal.foto == 'default.jpg'? 'img/img_usuarios/'+usuario.informacion_personal.foto: url+usuario.informacion_personal.foto" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                    <td class="text-center" v-else><img src="img/img_usuarios/default.jpg" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                    <td v-if="usuario.informacion_personal != null">{{usuario.informacion_personal.documento}}</td>
                    <td v-else></td>
                    <td v-if="usuario.informacion_personal != null">{{usuario.informacion_personal.nombres}}</td>
                    <td v-else></td>
                    <td v-if="usuario.informacion_personal != null">{{usuario.informacion_personal.apellidos}}</td>
                    <td v-else></td>
                    <td v-if="usuario.informacion_personal != null">{{usuario.informacion_personal.telefono}}</td>
                    <td v-else></td>
                    <td v-if="usuario.informacion_personal != null">{{usuario.informacion_personal.sexo}}</td>
                    <td v-else></td>
                    <td v-if="usuario.informacion_personal != null">{{usuario.informacion_personal.fecha_nacimiento}}</td>
                    <td v-else></td>
                    <td v-if="usuario.informacion_personal != null">{{usuario.informacion_personal.ciudad}}</td>
                    <td>{{usuario.email}}</td>
                    <td class="text-center">
                        <button class="btn btn-info btn-circle btn-sm" @click="editUsuario(usuario.id)"><i class="fa-solid fa-user-pen"></i></button>
                        <button class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash" @click="eliminarUsuario(usuario.id)"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="load_modal">
        <user-modal :user="usuario" :tipo="tipo"/>
    </div>

</div>

</template>

<script>
    import url from '../../mixins/cloudinary'
    import UserModal from './Modal.vue'
    export default {
        components: {
			UserModal
		},
        mixins: [url],
        data(){
            return{
                usuarios:{},
                tipo: '',
                usuario: null,
                load_modal: false,
                load: false
            }
        },
        created(){
            this.getAllUser()

        },
        methods:{
            eliminarUsuario(usuario_id){
                this.$fire({
                    title: 'Usuario',
                    text: 'Estas Seguro de eliminar el usuario seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Usuarios/delete/${usuario_id}`).then(res => {
                            if(res.data.delete){
                                this.$fire({
                                    title: 'Usuario',
                                    text: 'Eliminado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getAllUser()
                            }
                        })
                    }
                });
            },
            agregarUsuario(){
                this.load_modal = false
                setTimeout(() => {
                    this.usuario = null
                    this.tipo = "insert"
                    this.openModal()
				}, 200)
            },
            editUsuario(id){
                this.load_modal = false
                this.tipo = "edit"
                axios.get(`Usuarios/get/${id}`).then(res=>{
                    this.usuario = res.data.usuario
                    this.openModal()
                })
            },
            openModal() {
				this.load_modal = true
				setTimeout(() => {
					$('#modalUsuario').modal('show')
				}, 200)
			},
			closeModal() {
				$('#modalUsuario').modal('hide')
				setTimeout(() => {
					this.load_modal = false
				}, 200)
			},
            getAllUser(){
                this.load = false
				axios.get('/Usuarios/getAll').then(response => {
                    this.usuarios = response.data.usuarios
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaUsuarios`).DataTable({
                            dom: 'Bfrtip',
                            buttons: ['excel', 'copy'],
                            process: true
                        })

                    }, 200)
                })
            },
        }
    }
</script>
