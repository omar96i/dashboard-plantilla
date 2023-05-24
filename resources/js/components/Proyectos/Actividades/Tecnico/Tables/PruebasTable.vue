<template>
    <div class="table-responsive p-4">
        <table class="table table-bordered table-pruebas" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Files</th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <!-- <th class="color-gray"><input type="text" class="form-control" disabled></th> -->
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(prueba, index) in pruebas" :key="index">
                    <td>{{prueba.descripcion}}</td>
                    <td>{{prueba.fecha}}</td>
                    <td>
                        <span v-for="(file, index) in prueba.files" :key="index"><a target="_blank" :href="`https://res.cloudinary.com/dcj3tck83/image/upload/v1649869726/${file}`">{{file}}</a> - </span>
                    </td>
                    <!-- <td></td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['pruebas'],
        created(){
            this.loadTable()
        },
        methods:{
            loadTable(){

                this.pruebas.forEach(prueba => {
                    prueba.files = JSON.parse(prueba.files)
                });
                setTimeout(() => {
                    $(`.table-pruebas`).DataTable({
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
                }, 500)
            }
        }
    }
</script>
