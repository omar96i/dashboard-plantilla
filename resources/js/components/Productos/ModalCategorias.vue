<template>
    <div>
         <!-- Modal productos -->
        <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group row">
                                <div class="col-12">
                                    <b-input-group>
                                        <b-form-input type="text" v-model="categoria.nombre" v-bind:class="[{ 'is-invalid': categoriaValidacion.nombre}]"></b-form-input>
                                        <b-input-group-append>
                                        <b-button variant="outline-success" @click="storeCategoria()" v-bind:disabled="loading"><b-spinner small type="grow" v-if="loading"></b-spinner> {{(tipo == 'insert')? 'Crear' : 'Actualizar'}}</b-button>
                                        </b-input-group-append>
                                        <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                    </b-input-group>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SpinnerView from '../Spinner.vue'
    export default {
        components: {
			SpinnerView
		},
        props:['category', 'tipo'],
        data(){
            return{
                categoria: {},
                categoriaValidacion: {
                    'nombre' : false
                },
                loading: false
            }
        },
        created(){
            if(this.tipo == "edit"){
                this.categoria = {
                    'nombre' : this.category.nombre,
                }
            }
            this.ruta = (this.tipo == "edit") ? `/Productos/Categorias/update/${this.category.id}` : '/Productos/Categorias/store'
        },
        methods:{

            storeCategoria(){
                if(this.categoria.nombre == ''){
                    this.validarCategoria()
                }else{
                    this.loading = true
                    axios.post(this.ruta, this.categoria).then(res=>{
                        if(res.data.saved){
                           this.alert('Categoria', (this.tipo == 'edit')? 'Actualizada' : 'Creada', 'success')
                           this.categoria = {}
                           this.loading = false
                           this.$parent.get()
                           this.$parent.closeModal()
                        }
                    })
                }
            },

            validarCategoria(){
                if(this.categoria.nombre == ''){
                    this.categoria.nombre = true
                }else{
                    this.categoria.nombre = false
                }
            },

            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
            }
        }
    }
</script>
