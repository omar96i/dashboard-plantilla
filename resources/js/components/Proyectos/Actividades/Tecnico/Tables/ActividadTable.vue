<template>
    <div>
        <div class="table-responsive p-4">
            <table class="table table-bordered table-asistencia" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Descripcion</th>
                        <th>Fecha inicio</th>
                        <th>Fecha final</th>
                        <th>Estado</th>
                        <th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th class="color-gray"><input type="text" class="form-control"></th>
                        <th class="color-gray"><input type="text" class="form-control"></th>
                        <th class="color-gray"><input type="text" class="form-control"></th>
                        <th class="color-gray"><input type="text" class="form-control"></th>
                        <th class="color-gray"><input type="text" class="form-control" disabled></th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(actividad, index) in actividades" :key="index">
                        <td>{{actividad.descripcion}}</td>
                        <td>{{actividad.fecha_inicio}}</td>
                        <td>{{actividad.fecha_final}}</td>
                        <td><b-alert show :variant="getColor(actividad.estado)">{{actividad.estado}}</b-alert></td>
                        <td class="text-center">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="dropdown-header">Acciones:</div>
                                    <button class="dropdown-item" @click="setDatos(actividad.id)"><i class="fa-solid fa-eye"></i> Ver</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div v-if="load_modal">
            <modal-actividad :id="actividad_id"></modal-actividad>
        </div>
    </div>

</template>

<script>
    import ModalActividad from '../Modal.vue'
    export default {
        components:{
            ModalActividad
        },
        data(){
            return{
                actividades: {},
                actividad_id: '',
                load_modal: false
            }
        },
        created(){
            this.loadTable()
        },
        methods:{
            loadTable(){
                axios.get('/Proyectos/Actividades/getActividadesUsuario').then(res=>{
                    this.actividades = res.data.actividades
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
            getColor(estado){
                if(estado == 'pendiente'){
                    return 'primary'
                }
                if(estado == 'completado'){
                    return 'success'
                }
                if(estado == 'incompleto'){
                    return 'danger'
                }
            },
            setDatos(id){
                this.actividad_id = id
                this.load_modal = false
                setTimeout(() => {
                    this.openModal()
                }, 200)
            },
            openModal(){
                this.load_modal = true
                setTimeout(() => {
                    $('#modalActividad').modal('show')
                }, 200)
            },
            closeModal(){
                $('#modalActividad').modal('hide')
                setTimeout(() => {
                    this.actividad_id = ''
                    this.load_modal = false
                }, 200)
            },
        }
    }
</script>
