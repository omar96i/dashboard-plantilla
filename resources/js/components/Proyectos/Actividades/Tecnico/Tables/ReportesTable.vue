<template>
    <div class="table-responsive p-4">
        <table class="table table-bordered table-reportes" width="100%" cellspacing="0">
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
                <tr v-for="(reporte, index) in reportes" :key="index">
                    <td class="text-center"><img :src="(reporte.producto.productos.productos.foto == 'default.png')? '/img/img_productos/default.png' : `https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/${reporte.producto.productos.productos.foto}`" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                    <td>{{reporte.producto.productos.productos.nombre}}</td>
                    <td>{{reporte.cantidad}}</td>
                    <td>{{reporte.descripcion}}</td>
                    <td>{{reporte.fecha}}</td>
                    <td><b-alert show :variant="getColor(reporte.estado)">{{reporte.estado}}</b-alert></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['reportes'],
        created(){
            this.loadTable()
        },
        methods:{
            getColor(estado){
                if(estado == 'pendiente'){
                    return 'warning'
                }
            },
            loadTable(){
                setTimeout(() => {
                    $(`.table-reportes`).DataTable({
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
