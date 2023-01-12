<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            <button class="btn btn-info btn-sm" @click="openModal()">Agregar Role</button>
        </div>
        <div class="card-body">
            <div class="table-responsive" v-if="load">
                <table class="table table-bordered" id="table-roles" width="100%" cellspacing="0" >
                    <thead>
                        <tr>
                            <th class="color-gray">Nombre</th>
                            <th class="color-gray"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th class="color-gray"><input type="text" class="form-control"></th>
                            <th class="color-gray"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <tr v-for="(role, index) in roles" :key="index">
                            <td>{{role.name}}</td>
                            <td class="text-center">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                        <div class="dropdown-header">Acciones:</div>
                                        <button class="dropdown-item" @click="openModalPermisos(role)"><i class="fa-solid fa-plus"></i> Asignar permisos</button>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" @click="deleteRole(role)"><i class="fas fa-trash" ></i> Eliminar</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <role-modal v-if="load_modal"></role-modal>
        <role-permiso-modal v-if="load_modal_2" :role="selected_role"></role-permiso-modal>
    </div>
</template>
<script>
import RoleModal from './Modals/RoleModal.vue'
import RolePermisoModal from './Modals/RolePermisoModal.vue'
export default {
    components:{
        RoleModal,
        RolePermisoModal
    },
    data(){
        return{
            roles:[],
            load:false,
            load_modal:false,
            load_modal_2:false,
            selected_role:''
        }
    },
    created(){
        this.getRoles()
    },
    methods:{
        getRoles(){
            this.load = false
            axios.get('/Roles/get').then(res=>{
                this.roles = res.data.roles
                this.load = true
            }).catch(error=>{
                console.log(error.response)
                this.alert('Error', 'Error en el servidor', 'error')
            }).finally(() => {
                setTimeout(() => {
                    $(`#table-roles`).DataTable({
                        initComplete: function () {
                            // Apply the search
                            this.api().columns().every( function () {
                                var that = this;

                                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                                    if ( that.search() !== this.value ) {
                                        that
                                            .search( this.value )
                                            .draw();
                                    }
                                } );
                            } );
                        }
                    })
                }, 200)
            })
        },
        selectView(view){
            this.select_view = view
        },
        alert(titulo, text, tipo){
            this.$fire({
                title: titulo,
                text: text,
                type: tipo,
                timer: 3000
            })
        },
        openModal(){
            this.load_modal = true
            setTimeout(()=>{
                $("#modalRole").modal('show')
            },200)
        },
        closeModal(){
            $("#modalRole").modal('hide')
            setTimeout(()=>{
                this.load_modal = false
            },200)
        },
        openModalPermisos(role){
            this.selected_role = role
            this.load_modal_2 = true
            setTimeout(()=>{
                $("#modalRolePermiso").modal('show')
            },200)
        },
        closeModalPermisos(){
            $("#modalRolePermiso").modal('hide')
            setTimeout(()=>{
                this.load_modal_2 = false
            },200)
        },
        deleteRole(role){
             this.$fire({
                title: 'Role',
                text: 'Estas Seguro de eliminar el role seleccionado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#FF0000',
            }).then((result) => {
                if(result.value){
                    axios.get(`/Roles/delete/${role.id}`).then(res => {
                        if(res.data.status){
                            this.$fire({
                                title: 'Role',
                                text: 'Eliminado',
                                type: 'error',
                                timer: 3000
                            })
                            this.getRoles()
                        }
                    })
                }
            });
        }
    }
}
</script>
