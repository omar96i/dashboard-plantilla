<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Permisos</h6>
            <button class="btn btn-info btn-sm" @click="openModal()" v-if="permisos[0]">Agregar Permiso</button>
        </div>
        <div class="card-body">
            <div class="table-responsive" v-if="load">
                <table class="table table-bordered" id="table-permisos" width="100%" cellspacing="0" >
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
                        <tr v-for="(permiso, index) in permisos" :key="index">
                            <td>{{permiso.name}}</td>
                            <td class="text-center">
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                        <div class="dropdown-header">Acciones:</div>
                                        <div class="dropdown-divider"></div>
                                        <button class="dropdown-item" @click="deletePermiso(permiso)" v-if="permisos[1]"><i class="fas fa-trash" ></i> Eliminar</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <permiso-modal v-if="load_modal"></permiso-modal>
    </div>
</template>
<script>
import PermisoModal from './Modals/PermisoModal.vue'
export default {
    components:{
        PermisoModal
    },
    data(){
        return{
            permisos:[],
            load:false,
            load_modal:false,
            data_permisos:{
                permisos: ['roles.permisos.crear', 'roles.permisos.eliminar', 'roles.permisos.asignar']
            },
            permisos:[
                false,
                false,
                false,
            ]
        }
    },
    created(){
        this.getPermisosActive()
    },
    methods:{
        getPermisosActive(){
            axios.post('./Usuarios/get/permisos', this.data_permisos).then(res=>{
                this.permisos = res.data.permisos
            }).catch(error=>{
                console.log(error.response)
            }).finally(res=>{
                this.getPermisos()
            })
        },
        getPermisos(){
            this.load = false
            axios.get('/Roles/Permisos/get').then(res=>{
                this.permisos = res.data.permisos
                this.load = true
            }).catch(error=>{
                console.log(error.response)
                this.alert('Error', 'Error en el servidor', 'error')
            }).finally(() => {
                setTimeout(() => {
                    $(`#table-permisos`).DataTable({
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
                $("#modalPermisos").modal('show')
            },200)
        },
        closeModal(){
            $("#modalPermisos").modal('hide')
            setTimeout(()=>{
                this.load_modal = false
            },200)
        },
        deletePermiso(permiso){
             this.$fire({
                title: 'Permiso',
                text: 'Estas Seguro de eliminar el permiso seleccionado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#FF0000',
            }).then((result) => {
                if(result.value){
                    axios.get(`/Roles/Permisos/delete/${permiso.id}`).then(res => {
                        if(res.data.status){
                            this.$fire({
                                title: 'Permiso',
                                text: 'Eliminado',
                                type: 'error',
                                timer: 3000
                            })
                            this.getPermisos()
                        }
                    })
                }
            });
        }
    }
}
</script>
