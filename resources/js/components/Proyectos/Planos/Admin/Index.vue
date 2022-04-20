<template>
<div>
    <div class="table-responsive" v-if="load">
        <table class="table table-bordered" id="tablaPlanos" width="100%" cellspacing="0" >
            <thead>
                <tr>
                    <th class="color-gray">Proyecto</th>
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
                    <th class="color-gray"></th>
                </tr>
            </tfoot>
            <tbody>
                <tr v-for="(plano, index) in planos" :key="index">
                    <td><a :href="'/Proyectos/show/'+plano.proyecto.id" style="color: #1E42F7; text-decoration: none;" target="_blank">{{plano.proyecto.nombre}}</a></td>
                    <td>{{plano.descripcion}}</td>
                    <td>{{new Date(plano.created_at).toLocaleDateString('en-US', { day: '2-digit', month: '2-digit', year: 'numeric', })}}</td>
                    <td> <b-alert show :variant="color(plano.estado)" class="text-capitalize">{{plano.estado}}</b-alert></td>
                    <td class="text-center">
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <a class="dropdown-item" :href="url+plano.file" target="_blank"><i class="fa-solid fa-eye"></i> Ver Documento</a>
                                <div class="dropdown-divider"></div>
                                <button class="dropdown-item" href="#" @click="aprobarPlano(plano.id)"><i class="fa-solid fa-circle-check"></i> Aprobar</button>
                                <button class="dropdown-item" href="#" @click="rechazarPlano(plano.id)"><i class="fa-solid fa-circle-xmark"></i> Rechazar</button>
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
    import url from '../../../../mixins/cloudinary'
    export default {



        mixins: [url],

        data(){
            return{
                load_modal: false,
                planos: {},
                load: false,
                setColor : ''
            }
        },

        created(){
            this.getPlanos()
        },

        methods:{

            color(estado){
                this.setColor = ''
                if(estado == 'pendiente'){
                    this.setColor = 'warning'
                }else if(estado == 'aprobado'){
                    this.setColor = 'success'
                }else if(estado == 'rechazado'){
                    this.setColor = 'danger'
                }

                return this.setColor
            },

            getPlanos(){
                this.load = false
                axios.get('/Proyectos/PlanosAdmin/get').then(res=>{
                    this.planos = res.data.planos
                    this.load = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaPlanos`).DataTable({
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

            aprobarPlano(plano_id){
                this.$fire({
                    title: 'Plano',
                    text: 'Estas seguro de aprobar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aprobar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#2EE129',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/PlanosAdmin/aprobar/${plano_id}`).then(res => {
                            if(res.data.status){
                                this.$fire({
                                    title: 'Plano',
                                    text: 'Aprobado',
                                    type: 'success',
                                    timer: 3000
                                })
                                this.getPlanos()
                            }
                        })
                    }
                });
            },

            rechazarPlano(plano_id){
                this.$fire({
                    title: 'Plano',
                    text: 'Estas seguro de rechazar?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Rechazar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/PlanosAdmin/rechazar/${plano_id}`).then(res => {
                            if(res.data.status){
                                this.$fire({
                                    title: 'Plano',
                                    text: 'rechazado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getPlanos()
                            }
                        })
                    }
                });
            },

        }

    }
</script>
