<template>
    <div class="table-responsive p-4">
        <table class="table table-bordered table-solicitudes" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
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
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control" disabled></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(solicitud, index) in solicitudes" :key="index">
                    <td>{{solicitud.actividades.descripcion}}</td>
                    <td>{{solicitud.producto.nombre}}</td>
                    <td>{{solicitud.cantidad}}</td>
                    <td>{{solicitud.descripcion}}</td>
                    <td><b-alert show :variant="getColor(solicitud.estado)">{{solicitud.estado}}</b-alert></td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <button class="dropdown-item" href="#" @click="aprobar(solicitud.id)"><i class="fa-solid fa-circle-check"></i> Aprobar</button>
                                <button class="dropdown-item" href="#" @click="rechazar(solicitud.id)"><i class="fa-solid fa-circle-xmark"></i> Rechazar</button>
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
        props: ['solicitudes'],
        created(){
            this.loadTable()
        },
        methods:{
            getColor(estado){
                if(estado == 'pedido'){
                    return 'primary'
                }
                if(estado == 'aprobado'){
                    return 'success'
                }
                if(estado == 'aceptado'){
                    return 'info'
                }
                if(estado == 'rechazado'){
                    return 'danger'
                }
            },
            loadTable(){
                setTimeout(() => {
                    $(`.table-solicitudes`).DataTable({
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
            },

            aprobar(id){
                this.$fire({
                    title: 'Solicitud',
                    text: 'Estas seguro de aceptar la solicitud?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aprobar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#2EE129',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/Actividades/Solicitudes/update/${id}/aceptado`).then(res => {
                            if(res.data.status){
                                this.alert('Solicitud', res.data.msg, 'success')
                                this.$parent.getSolicitudes()
                            }
                        })
                    }
                });
            },

            rechazar(id){
                this.$fire({
                    title: 'Solicitud',
                    text: 'Estas seguro de cancelar la solicitud?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Rechazar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/Actividades/Solicitudes/update/${id}/rechazado`).then(res => {
                            if(res.data.status){
                                this.alert('Solicitud', res.data.msg, 'error')
                                this.$parent.getSolicitudes()
                            }
                        })
                    }
                });
            },

            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
            },
        }
    }
</script>
