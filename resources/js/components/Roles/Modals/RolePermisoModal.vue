<template>
    <div>
         <!-- Modal productos -->
        <div class="modal fade" id="modalRolePermiso" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">{{role.name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModalPermisos()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                         <div class="col-12">
                            <label class="col-form-label">Permisos:</label>
                            <v-select multiple v-model="data.permisos" :options="permisos"/>
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
        props:['role'],
        components:{
            Spinner
        },
        data(){
            return{
                data:{
                    permisos : []
                },
                loading: false,
                loading_post: false,
                permisos : []
            }
        },
        created(){
            this.getPermisos()
        },
        methods:{
            getPermisos(){
                axios.get(`/Roles/get/permisos/${this.role.id}`).then(res=>{
                    this.data.permisos = res.data.active
                    res.data.permisos.forEach(permiso => {
                        this.permisos.push(permiso.name)
                    })
                }).catch(error=>{
                    console.log(error.response)
                    this.alert('Error', 'Error en el servidor', 'error')
                })
            },
            action(){
                this.loading_post = true
                axios.post(`./Roles/store/permisos/${this.role.id}`, this.data).then(res=>{
                    if(res.data.status){
                        this.alert('Role', 'Permisos asignados', 'success')
                        this.$parent.closeModalPermisos()
                        this.loading_post = false
                    }
                }).catch(error=>{
                    console.log(error.response)
                    this.loading_post = false
                    this.alert('Error', 'Error en el servidor', 'error')
                })
            },
            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
            },
        }
    }
</script>
