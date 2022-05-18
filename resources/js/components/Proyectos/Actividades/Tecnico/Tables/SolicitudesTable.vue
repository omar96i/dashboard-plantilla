<template>
    <div class="table-responsive p-4">
        <table class="table table-bordered table-solicitudes" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Estado</th>
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
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(solicitud, index) in solicitudes" :key="index">
                    <td class="text-center"><img :src="(solicitud.producto.foto == 'default.png')? '/img/img_productos/default.png' : `https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/${solicitud.producto.foto}`" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                    <td>{{solicitud.producto.nombre}}</td>
                    <td>{{solicitud.cantidad}}</td>
                    <td>{{solicitud.descripcion}}</td>
                    <td>{{solicitud.created_at}}</td>
                    <td><b-alert show :variant="getColor(solicitud.estado)">{{solicitud.estado}}</b-alert></td>
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
                    return 'warning'
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
            }
        }
    }
</script>
