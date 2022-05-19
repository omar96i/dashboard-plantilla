<template>
    <div class="table-responsive p-4">
        <table class="table table-bordered table-reagendamientos" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Actividad</th>
                    <th>Descripcion</th>
                    <th>Fecha inicial</th>
                    <th>Fecha final</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(reagendamiento, index) in reagendamientos" :key="index">
                    <td>{{reagendamiento.actividad.descripcion}}</td>
                    <td>{{reagendamiento.descripcion}}</td>
                    <td>{{reagendamiento.fecha_inicio}}</td>
                    <td>{{reagendamiento.fecha_final}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['reagendamientos'],
        created(){
            this.loadTable()
        },
        methods:{
            loadTable(){
                setTimeout(() => {
                    $(`.table-reagendamientos`).DataTable({
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
