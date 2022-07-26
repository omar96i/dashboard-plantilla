<template>
<div>
    <div class="col-12">
        <div class="row">
            <button class="btn btn-success btn-sm mb-3" @click="setDatos()">
                <i class="fas fa-user-plus"></i>
                <samp class="pl-2">Crear Interventoria</samp>
            </button>
        </div>
    </div>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tablaInterventoria" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th class="color-gray">Proyecto</th>
                    <th class="color-gray">Empleado asignado</th>
                    <th class="color-gray">Fecha inicio</th>
                    <th class="color-gray">Hora inicio</th>
                    <th class="color-gray">Fecha final</th>
                    <th class="color-gray">Hora final</th>
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
                <tr v-for="(interventoria, index) in interventorias" :key="index">
                    <td>{{interventoria.proyecto.nombre}}</td>
                    <td>{{interventoria.usuario.informacion_personal.nombres + " " + interventoria.usuario.informacion_personal.apellidos}}</td>
                    <td>{{interventoria.fecha_inicio}}</td>
                    <td>{{interventoria.hora_inicio}}</td>
                    <td>{{interventoria.fecha_final}}</td>
                    <td>{{interventoria.hora_final}}</td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <button class="dropdown-item" @click="setDatos(interventoria.id, 'update')"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                <button class="dropdown-item" @click="setDatos(interventoria.id, 'complete')"><i class="fa-solid fa-file-circle-check"></i> Completar</button>
                                <a class="dropdown-item" :href="'/Proyectos/Interventorias/show/'+interventoria.id" target=”_blank”><i class="fa-solid fa-eye"></i> Ver</a>
                                <a class="dropdown-item" :href="'/Proyectos/Interventorias/pdf/'+interventoria.id"><i class="fa-solid fa-file-pdf"></i> Generar PDF</a>

                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item"><i class="fas fa-trash" ></i> Eliminar</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="load_modal">
        <interventoria-modal :type="type" :id="interventoria_id"></interventoria-modal>
    </div>
</div>
</template>

<script>
    import InterventoriaModal from './Modal.vue'

    export default {
        components:{
            InterventoriaModal
        },
        data(){
            return{
                interventorias:{},
                load_modal: false,
                interventoria_id: '',
                type: 'insert',
                load: false,
            }
        },
        created(){
            this.getInterventorias()
        },
        methods:{
            getInterventorias(){
                this.load = false
                axios.get('/Proyectos/Interventorias/get').then(res=>{
                    this.interventorias = res.data.interventorias
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaInterventoria`).DataTable({
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
            setDatos(id = false, status = false){
                if(status == 'update'){
                    this.interventoria_id = id
                    this.type = 'update'
                }else if(status == 'complete'){
                    this.interventoria_id = id
                    this.type = 'complete'
                }else{
                    this.type = 'insert'
                    this.interventoria_id = ''
                }
                this.openModal()
            },
            openModal(){
                this.load_modal = true
                setTimeout(() => {
                    $('#modalInterventoria').modal('show')
				}, 200)
            },

            closeModal(){
                $('#modalInterventoria').modal('hide')
                setTimeout(() => {
                    this.load_modal = false
				}, 200)
            },
        }
    }
</script>
