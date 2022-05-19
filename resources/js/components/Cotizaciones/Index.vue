<template>
<div>
    <a class="btn btn-success btn-sm" href="/Cotizaciones/form">
        <i class="fa-solid fa-plus"></i>
        <samp class="pl-2">Cotizacion</samp>
    </a>
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-12 col-lg-4">
                <b-alert show variant="success">Finalizado</b-alert>
            </div>
            <div class="col-12 col-lg-4">
                <b-alert show variant="info">Activo</b-alert>
            </div>
            <div class="col-12 col-lg-4">
                <b-alert show variant="warning">Progreso</b-alert>
            </div>

        </div>
    </div>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tablaCotizaciones" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th>Nombre a Facturar</th>
                    <th>Cliente del proyecto</th>
                    <th>Documento</th>
                    <th>Direccion</th>
                    <th>Fecha</th>
                    <th>Email</th>
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
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(cotizacion, index) in cotizaciones" :key="index">
                    <td>{{cotizacion.nombre_facturar}}</td>
                    <td>{{cotizacion.cliente_proyecto}}</td>
                    <td>{{cotizacion.documento}}</td>
                    <td>{{cotizacion.direccion}}</td>
                    <td>{{cotizacion.fecha}}</td>
                    <td>{{cotizacion.email}}</td>
                    <td><b-alert :variant="getColor(cotizacion.estado)" show>{{cotizacion.estado}}</b-alert></td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <a class="dropdown-item" :href="'/Cotizaciones/show/'+cotizacion.id"><i class="fa-solid fa-eye"></i> Ver</a>
                                <a class="dropdown-item" :href="'/Cotizaciones/edit/'+cotizacion.id"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" href="#" @click="eliminarCotizacion(cotizacion.id)"><i class="fas fa-trash" ></i> Eliminar</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <cotizaciones-form></cotizaciones-form>
    </div>
</div>
</template>

<script>
    import CotizacionesForm from './Modal.vue'
    export default {
        components: {
			CotizacionesForm
		},
        data(){
            return{
                cotizaciones:{},
                load: false
            }
        },
        created(){
            this.getCotizaciones()
        },
        methods:{
            abrirModal(){
                $("#modalCotizacion").modal('show')
            },
            getCotizaciones(){
                axios.get('/Cotizaciones/getAll').then(res=>{
                    this.cotizaciones = res.data.cotizaciones
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaCotizaciones`).DataTable({
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
            eliminarCotizacion(id){
                this.$fire({
                    title: 'Cotizacion',
                    text: 'Estas Seguro de eliminar el dato seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Cotizaciones/delete/${id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Cotizacion',
                                    text: 'Eliminada',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.load = false
                                this.getCotizaciones()
                            }
                        })
                    }
                });
            },
            getColor(estado){
                if(estado == 'progreso'){
                    return "warning"
                }
                if(estado == 'activo'){
                    return "info"
                }
                if(estado == 'finalizado'){
                    return "success"
                }
            },
        }
    }
</script>
