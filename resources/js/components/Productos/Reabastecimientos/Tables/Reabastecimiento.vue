<template>
    <div>
        <div class="table-responsive p-4" v-if="load">
            <table class="table table-bordered table-productos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="color-gray">Nombre</th>
                        <th class="color-gray">Descripcion</th>
                        <th class="color-gray">Referencia</th>
                        <th class="color-gray">Marca</th>
                        <th class="color-gray">Color</th>
                        <th class="color-gray">Temperatura de calor</th>
                        <th class="color-gray">Voltaje</th>
                        <th class="color-gray">cantidad</th>
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
                        <th class="color-gray"><input type="text" class="form-control"></th>
                        <th class="color-gray"><input type="text" class="form-control" disabled></th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(producto, index) in reabastecimientos" :key="index">
                        <td>{{producto.producto.nombre}}</td>
                        <td>{{producto.producto.descripcion}}</td>
                        <td>{{producto.producto.referencia}}</td>
                        <td>{{producto.producto.marca}}</td>
                        <td>{{producto.producto.color}}</td>
                        <td>{{producto.producto.temperatura_calor}}</td>
                        <td>{{producto.producto.voltaje}}</td>
                        <td>{{producto.cantidad}}</td>
                        <td class="text-center">
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="dropdown-header">Acciones:</div>
                                    <button class="dropdown-item" @click="eliminar(producto.id)"><i class="fas fa-trash" ></i> Delete</button>
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
                reabastecimientos:{},
                load: false
            }
        },
        created(){
            this.getReabastecimientos()
        },
        methods:{
            eliminar(id){
                this.$fire({
                    title: 'Producto',
                    text: 'Estas Seguro de eliminar el Dato seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Productos/Reabastecimientos/delete/${id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Producto',
                                    text: 'Eliminado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getReabastecimientos()
                            }
                        })
                    }
                });
            },
            getReabastecimientos(){
                this.load = false
                axios.get('/Productos/Reabastecimientos/get').then(res=>{
                    this.reabastecimientos = res.data.reabastecimientos
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`.table-productos`).DataTable({
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
