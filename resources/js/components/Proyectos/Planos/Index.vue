<template>
<div>
    <div class="col-12">
        <div class="row">
            <button class="btn btn-success btn-sm mb-3" @click="openModal()">
                <i class="fas fa-user-plus"></i>
                <samp class="pl-2">Crear Plano</samp>
            </button>
        </div>
    </div>
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
                    <td>{{plano.proyecto.nombre}}</td>
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
                                <button v-if="plano.estado == 'pendiente'" class="dropdown-item" href="#" @click="eliminarPlano(plano.id)"><i class="fas fa-trash" ></i> Eliminar</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div v-if="load_modal">
        <planos-modal :proyectos="proyectos"></planos-modal>
    </div>
</div>
</template>

<script>
    import url from '../../../mixins/cloudinary'
    import PlanosModal from './Modal.vue'
    export default {

        components: {
			PlanosModal
		},

        mixins: [url],

        data(){
            return{
                proyectos: {},
                load_modal: false,
                planos: {},
                load: false,
                setColor: ''
            }
        },

        created(){
            this.getProyectos()
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
                axios.get('/Proyectos/Planos/get').then(res=>{
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

            getProyectos(){
                axios.get('/Proyectos/get').then(res=>{
                    this.proyectos = res.data.proyectos
                })
            },

            openModal() {
				this.load_modal = true
				setTimeout(() => {
					$('#modalPlanos').modal('show')
				}, 200)
			},

			closeModal() {
				$('#modalPlanos').modal('hide')
				setTimeout(() => {
					this.load_modal = false
				}, 200)
			},

            eliminarPlano(plano_id){
                this.$fire({
                    title: 'Plano',
                    text: 'Estas seguro de eliminar el plano seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/Planos/delete/${plano_id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Plano',
                                    text: 'Eliminado',
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
