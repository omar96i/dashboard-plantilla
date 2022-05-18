<template>
    <div class="table-responsive p-4">
        <table class="table table-bordered table-asistencia" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tecnico</th>
                    <th>Actividad</th>
                    <th>Proyecto</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>latitude</th>
                    <th>longitude</th>
                    <th></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control" disabled></th>
                    <th class="color-gray"><input type="text" class="form-control" disabled></th>
                    <th class="color-gray"><input type="text" class="form-control" disabled></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(asistencia, index) in asistencias" :key="index">
                    <td>{{asistencia.tecnico.informacion_personal.nombres + ' ' + asistencia.tecnico.informacion_personal.apellidos}}</td>
                    <td>{{asistencia.actividad.descripcion}}</td>
                    <td>{{asistencia.actividad.proyecto.nombre}}</td>
                    <td>{{asistencia.fecha}}</td>
                    <td>{{asistencia.time}}</td>
                    <td>{{asistencia.latitude}}</td>
                    <td>{{asistencia.longitude}}</td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <a :href="asistencia.url" class="dropdown-item" target="_blank"><i class="fa-solid fa-location-pin"></i> Ubicación</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['asistencias'],
        created(){
            this.loadTable()
        },
        methods:{
            loadTable(){
                setTimeout(() => {
                    $(`.table-asistencia`).DataTable({
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
            }
        }
    }
</script>
