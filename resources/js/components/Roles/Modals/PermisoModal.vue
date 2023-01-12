<template>
    <div>
         <!-- Modal productos -->
        <div class="modal fade" id="modalPermisos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Permisos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="col-12">
                            <label class="col-form-label">Nombre:</label>
                            <input type="text" v-bind:class="[{ 'is-invalid': permisoValidacion.name}, 'form-control']" v-model="data.name" placeholder="Nombre del permiso" >
                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <button class="btn btn-info btn-sm" @click="action()" v-if="!loading_post">Agregar</button>
                            <spinner v-else></spinner>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Spinner from '../../Spinner.vue'
    export default {
        components:{
            Spinner
        },
        data(){
            return{
                data:{
                    'name' : ''
                },
                permisoValidacion:{
                    'name' : false
                },
                loading: false,
                loading_post: false
            }
        },
        methods:{
            action(){
                if(!this.validar()){
                    this.loading_post = true
                    axios.post('./Roles/Permisos/store', this.data).then(res=>{
                        if(res.data.status){
                            this.alert('Permiso', 'El registro a sido creado', 'success')
                            this.$parent.closeModal()
                            this.$parent.getPermisos()
                        }
                        this.loading_post = false

                    }).catch(error=>{
                        console.log(error.response)
                        this.loading_post = false
                        this.alert('Error', 'Error en el servidor', 'error')
                    })
                }
            },
            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
            },
            validar(){
                this.permisoValidacion.name = (this.data.name == '') ? true : false
                return this.permisoValidacion.name
            }
        }
    }
</script>
