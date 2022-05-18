<template>
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
                    <th class="color-gray"><input type="text" class="form-control" disabled></th>
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
                <tr v-for="(producto, index) in inventario" :key="index">
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
</template>

<script>
    export default {
        props: ['inventario'],
        created(){
            this.loadTable()
        },
        methods:{
            loadTable(){
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
            }
        }
    }
</script>
