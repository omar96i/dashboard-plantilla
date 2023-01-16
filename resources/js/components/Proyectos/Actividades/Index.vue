<template>
<div>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tablaActividades" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th class="color-gray">Proyecto</th>
                    <th class="color-gray">Empleado</th>
                    <th class="color-gray">Descripcion</th>
                    <th class="color-gray">Fecha inicio</th>
                    <th class="color-gray">Fecha Final</th>
                    <th class="color-gray">Estado</th>
                    <th class="color-gray"></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(actividad, index) in actividades" :key="index">
                    <td>{{(actividad.proyecto_id == null) ? 'Sin asignar' : actividad.proyecto.nombre}}</td>
                    <td>{{actividad.empleado.informacion_personal.nombres}}</td>
                    <td>{{actividad.descripcion}}</td>
                    <td>{{(actividad.reagendamientos.length > 0 )? actividad.reagendamientos[0].fecha_inicio : actividad.fecha_inicio}}</td>
                    <td>{{(actividad.reagendamientos.length > 0 )? actividad.reagendamientos[0].fecha_final : actividad.fecha_final}}</td>
                    <td>{{actividad.estado}}</td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <a class="dropdown-item" :href="'/Proyectos/Actividades/show/'+actividad.id" v-if="permisos[3]"><i class="fa-solid fa-eye"></i> Ver</a>
                                <a class="dropdown-item" :href="'/Proyectos/Actividades/form/'+actividad.id" v-if="permisos[1]"> <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                <a class="dropdown-item" href="#" @click="openModal(actividad.id)" v-if="permisos[4]"> <i class="fa-regular fa-calendar-days"></i> Acciones</a>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" @click="eliminarActividad(actividad.id)" v-if="permisos[2]"><i class="fas fa-trash"></i> Eliminar</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="load_modal">
        <actividades-modal :actividad_id="actividad_id"></actividades-modal>
    </div>
</div>
</template>

<script>
    import url from '../../../mixins/cloudinary'
    import ActividadesModal from './Modal.vue'
    export default {
        components:{
            ActividadesModal
        },

        mixins: [url],

        data(){
            return{
                actividades:{},
                load: false,
                actividad_id: '',
                load_modal: false,
                data_permisos:{
                    permisos: ['proyectos.actividades.crear', 'proyectos.actividades.editar', 'proyectos.actividades.eliminar', 'proyectos.actividades.ver', 'proyectos.actividades.acciones']
                },
                permisos:[
                    false,
                    false,
                    false,
                    false,
                    false
                ]
            }
        },

        created(){
            this.getPermisos()
        },

        methods:{
            getPermisos(){
                axios.post('/Usuarios/get/permisos', this.data_permisos).then(res=>{
                    this.permisos = res.data.permisos
                }).catch(error=>{
                    console.log(error.response)
                }).finally(res=>{
                    this.getActividades()
                })
            },
            openModal(id){
                this.actividad_id = id
                this.load_modal = true
                setTimeout(() => {
                    $('#modalReportes').modal('show')
				}, 200)
            },

            closeModal(){
                $('#modalReportes').modal('hide')
                setTimeout(() => {
                    this.load_modal = false
				}, 200)
            },
            getActividades(){
                this.load = false
                axios.get('/Proyectos/Actividades/get').then(res=>{
                    this.actividades = res.data.actividades
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaActividades`).DataTable({
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
            eliminarActividad(id){
                this.$fire({
                    title: 'Actividad',
                    text: 'Estas seguro de eliminar el dato seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/Actividades/delete/${id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Actividad',
                                    text: 'Eliminada',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getActividades()
                            }
                        })
                    }
                });
            }
        }

    }
</script>
