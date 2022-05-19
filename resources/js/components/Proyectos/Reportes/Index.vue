<template>
<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4">
                <b-alert show variant="success">Arreglado</b-alert>
            </div>
            <div class="col-12 col-lg-4">
                <b-alert show variant="warning">Pendiente</b-alert>
            </div>
            <div class="col-12 col-lg-4">
                <b-alert show variant="danger">Baja</b-alert>
            </div>
        </div>
    </div>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tableReportes" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th class="color-gray">Usuario</th>
                    <th class="color-gray">Producto</th>
                    <th class="color-gray">Descripcion</th>
                    <th class="color-gray">Fecha</th>
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
                    <th class="color-gray"></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(reporte, index) in reportes" :key="index">
                    <td>{{reporte.usuario.informacion_personal.nombres+" "+reporte.usuario.informacion_personal.apellidos}}</td>
                    <td>{{reporte.producto.productos.productos.nombre}}</td>
                    <td>{{reporte.descripcion}}</td>
                    <td>{{reporte.fecha}}</td>
                    <td><b-alert :variant="getColor(reporte.estado)" show>{{reporte.estado}}</b-alert></td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <button class="dropdown-item" @click="accion(reporte.id)"> <i class="fa-solid fa-pen-to-square"></i> Accion</button>
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
    export default {
        data(){
            return{
                reportes:{},
                load: false,
            }
        },
        created(){
            this.getReportes()
        },
        methods:{

            accion(id){
                this.$fire({
                    title: 'Reporte',
                    text: 'Selecciona una opcion dependiendo el estado del producto',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Arreglado',
                    cancelButtonText: 'Dar de baja',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/Actividades/Reportes/confirm/${id}`).then(res=>{
                            if(res.data.updated){
                                this.alert('Reporte', 'Haz arreglado el producto', 'success')
                                this.getReportes()
                            }
                        })
                    }else{
                        this.$fire({
                            title: 'Reporte',
                            text: 'Estas seguro de dar de baja al producto?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Dar de baja',
                            cancelButtonText: 'Cancelar',
                            confirmButtonColor: '#FF0000',
                        }).then((result) => {
                            if(result.value){
                                axios.get(`/Proyectos/Actividades/Reportes/cancel/${id}`).then(res=>{
                                    if(res.data.updated){
                                        this.alert('Reporte', 'Haz dado de baja al producto', 'success')
                                        this.getReportes()
                                    }
                                })
                            }
                        });
                    }
                });
            },

            getReportes(){
                this.load = false
                axios.get('/Proyectos/Actividades/Reportes/get').then(res=>{
                    this.reportes = res.data.reportes
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tableReportes`).DataTable({
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
                    return "warning"
                }
                if(estado == 'arreglado'){
                    return "success"
                }
                if(estado == 'baja'){
                    return "danger"
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
