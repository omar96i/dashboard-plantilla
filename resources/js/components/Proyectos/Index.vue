<template>
<div>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tableProyectos" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th class="color-gray">Nombre</th>
                    <th class="color-gray">Fecha inicial</th>
                    <th class="color-gray">Fecha final</th>
                    <th class="color-gray"></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"><input type="text" class="form-control"></th>
                    <th class="color-gray"></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(proyecto, index) in proyectos" :key="index">
                    <td>{{proyecto.nombre}}</td>
                    <td>{{proyecto.fecha_inicial}}</td>
                    <td>{{proyecto.fecha_final}}</td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <a class="dropdown-item" :href="'/Proyectos/show/'+proyecto.id" v-if="permisos[3]"><i class="fa-solid fa-eye"></i> Ver</a>
                                <a class="dropdown-item" :href="'/Proyectos/form/'+proyecto.id" v-if="permisos[1]"> <i class="fa-solid fa-pen-to-square"></i> Editar</a>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" href="#" v-if="permisos[2]"><i class="fas fa-trash" ></i> Eliminar</button>
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
                proyectos:{},
                load: false,
                data_permisos:{
                    permisos: ['proyectos.crear', 'proyectos.editar', 'proyectos.eliminar', 'proyectos.ver']
                },
                permisos:[
                    false,
                    false,
                    false,
                    false
                ]
            }
        },
        created(){
            this.getPermisos()
        },
        methods:{
            getPermisos(){
                axios.post('./Usuarios/get/permisos', this.data_permisos).then(res=>{
                    this.permisos = res.data.permisos
                }).catch(error=>{
                    console.log(error.response)
                }).finally(res=>{
                    this.getProyectos()
                })
            },
            getProyectos(){
                axios.get('/Proyectos/get').then(res=>{
                    this.proyectos = res.data.proyectos
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tableProyectos`).DataTable({
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
        }
    }
</script>
