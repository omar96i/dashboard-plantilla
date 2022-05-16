<template>
    <div>
         <!-- Modal Reportes -->
        <div class="modal fade" id="modalActividad" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content" v-if="load">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Actividad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center col-12">
                            <h4>Datos de la actividad</h4>
                        </div>
                        <div class="row p-4">
                            <div class="col-12 col-lg-6" style="border-left: 0.01cm solid;">
                                <h5 class="font-size-tittle color-gray">Fecha Inicial</h5>
                                <p class="text-muted mt-1">{{actividad.fecha_inicio}}</p>
                            </div>
                            <div class="col-12 col-lg-6" style="border-left: 0.01cm solid;">
                                <h5 class="font-size-tittle color-gray">Fecha Final</h5>
                                <p class="text-muted mt-1">{{actividad.fecha_final}}</p>
                            </div>
                            <div class="col-12 col-lg-6" style="border-left: 0.01cm solid;">
                                <h5 class="font-size-tittle color-gray">Proyecto</h5>
                                <p class="text-muted mt-1">{{actividad.proyecto.nombre}}</p>

                            </div>
                            <div class="col-12 col-lg-6" style="border-left: 0.01cm solid;">
                                <h5 class="font-size-tittle color-gray">Estado</h5>
                                <b-alert class="text-muted mt-1" show :variant="getColorAlert(actividad.estado)">{{actividad.estado}}</b-alert>
                            </div>
                            <div class="col-12" style="border-left: 0.01cm solid;">
                                <h5 class="font-size-tittle color-gray">Descripcion</h5>
                                <p class="text-muted mt-1">{{actividad.descripcion}}</p>
                            </div>
                        </div>
                        <b-tabs content-class="mt-3">
                            <b-tab title="Files" active>
                                <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
                                    <div class="col" v-for="(file, index) in actividad.files" :key="index">
                                        <div class="card">
                                            <video class="card-img-top" height="300px" controls style="height:300px;" v-if="file.tipo == 'video/mp4'">
                                                <source :src="`https://res.cloudinary.com/dcj3tck83/video/upload/v1650564336/${file.file}`" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                            <img v-else :src="`https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/${file.file}`" alt="Image 1" style="height:300px;">
                                        </div>
                                    </div>
                                </div>
                            </b-tab>
                            <b-tab title="Inventario">
                                <div class="table-responsive p-4">
                                    <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Foto</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Referencia</th>
                                                <th>Marca</th>
                                                <th>Color</th>
                                                <th>Temperatura</th>
                                                <th>Voltaje</th>
                                                <th>Cantidad asignada</th>
                                                <th>Ubicacion</th>
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
                                                <th class="color-gray"><input type="text" class="form-control"></th>
                                                <th class="color-gray"><input type="text" class="form-control"></th>
                                                <th class="color-gray"><input type="text" class="form-control"></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <tr v-for="(producto, index) in actividad.inventario" :key="index">
                                                <td><img :src="(producto.productos.productos.foto == 'default.png')? '/img/img_productos/default.png' : `https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/${producto.productos.productos.foto}`" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                                                <td>{{producto.productos.productos.nombre}}</td>
                                                <td>{{producto.productos.productos.descripcion}}</td>
                                                <td>{{producto.productos.productos.referencia}}</td>
                                                <td>{{producto.productos.productos.marca}}</td>
                                                <td>{{producto.productos.productos.color}}</td>
                                                <td>{{producto.productos.productos.temperatura_calor}}</td>
                                                <td>{{producto.productos.productos.voltaje}}</td>
                                                <td>{{producto.cantidad}}</td>
                                                <td>{{producto.productos.ubicacion}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </b-tab>
                            <b-tab title="Acciones">
                                <div class="row container text-center">
                                    <div class="col-12 col-sm-4 my-2 mt-sm-0">
                                        <b-button variant="success" @click="setForm('reportes')">Enviar Reporte</b-button>
                                    </div>
                                    <div class="col-12 col-sm-4 my-2 mt-sm-0">
                                        <b-button variant="success" @click="setForm('solicitud_productos')">Solicitar Producto</b-button>
                                    </div>
                                    <div class="col-12 col-sm-4 my-2 mt-sm-0">
                                        <b-button variant="success" @click="setForm('finalizar')">Finalizar actividad</b-button>
                                    </div>
                                </div>
                                <div>
                                    <form-reportes :actividad_id="id" :estado="actividad.estado" v-if="load_form_reportes"></form-reportes>
                                    <form-solicitud-productos :actividad_id="id" :estado="actividad.estado" v-if="load_form_solicitud_productos"></form-solicitud-productos>
                                    <form-finalizar :actividad_id="id" :estado="actividad.estado" v-if="load_form_finalizar"></form-finalizar>

                                </div>
                            </b-tab>
                        </b-tabs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import FormSolicitudProductos from './Forms/SolicitudProductos.vue'
    import FormReportes from './Forms/Reportes.vue'
    import FormFinalizar from './Forms/Finalizar.vue'

    export default {
        props: ['id'],
        components: {
            FormReportes,
            FormSolicitudProductos,
            FormFinalizar
        },
        data(){
            return{
                actividad:{},
                table:[],
                load: false,
                load_form_reportes: false,
                load_form_solicitud_productos: false,
                load_form_finalizar: false,

            }
        },
        created(){
            this.getActividad()
        },
        methods:{
            getActividad(){
                this.load = false
                axios.get(`/Proyectos/Actividades/get/${this.id}`).then(res=>{
                    this.actividad = res.data.actividad
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`.tables-productos`).DataTable({
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
            getColorAlert(estado){
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
            setForm(tipo){
                this.load_form_reportes = (tipo == 'reportes')? true : false
                this.load_form_solicitud_productos = (tipo == 'solicitud_productos')? true : false
                this.load_form_finalizar = (tipo == 'finalizar')? true : false
            }
        }
    }
</script>
