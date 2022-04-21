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
                    <td>{{actividad.proyecto.nombre}}</td>
                    <td>{{actividad.empleado.informacion_personal.nombres}}</td>
                    <td>{{actividad.descripcion}}</td>
                    <td>{{actividad.fecha_inicio}}</td>
                    <td>{{actividad.fecha_final}}</td>
                    <td>{{actividad.estado}}</td>

                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <a class="dropdown-item" href="#"><i class="fa-solid fa-eye"></i> Ver</a>
                                <a class="dropdown-item" :href="'/Proyectos/Actividades/form/'+actividad.id"> <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" href="#"><i class="fas fa-trash" ></i> Eliminar</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
    import url from '../../../mixins/cloudinary'
    export default {

        mixins: [url],

        data(){
            return{
                actividades:{},
                load: false
            }
        },

        created(){
            this.getActividades()
        },

        methods:{
            getActividades(){
                axios.get('/Proyectos/Actividades/get').then(res=>{
                    console.log(res.data.actividades)
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
            }
        }

    }
</script>
