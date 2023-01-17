<template>
    <div>
         <!-- Modal productos -->
        <div class="modal fade" id="modalReabastecimiento" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Reabastecimiento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModalSecond()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 text-center my-2">
                            <h5>Agregar Producto</h5>
                        </div>
                        <div class="row mt-3" v-if="load">
                            <div class="col-12 col-lg-5">
                                <b-form-select v-model="producto.producto_id" :options="options_select"></b-form-select>
                                <b-form-invalid-feedback>
                                    Debe seleccionar un producto
                                </b-form-invalid-feedback>
                                <b-form-valid-feedback>
                                    Esta bien!
                                </b-form-valid-feedback>
                            </div>
                            <div class="col-12 col-lg-5">
                                <b-form-input type="number" v-model="producto.cantidad" placeholder="Cantidad..."></b-form-input>
                                <b-form-invalid-feedback>
                                    Se debe seleccionar una opcion!
                                </b-form-invalid-feedback>
                                <b-form-valid-feedback>
                                    Esta bien!
                                </b-form-valid-feedback>
                            </div>
                            <div class="col-12 col-lg-2">
                                <button class="btn btn-success btn-block" @click="agregarProducto()">Agregar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SpinnerView from '../Spinner.vue'
    export default {
        props: ['productos_props'],
        components: {
			SpinnerView
		},
        data(){
            return{
                producto: {
                    'producto_id' : '',
                    'cantidad' : ''
                },
                load: false,
                options_select: [],
            }
        },
        created(){
            this.productos_props.forEach(producto => {
                this.options_select.push({ value : producto.id, text : producto.nombre})
            });
            this.load = true
        },
        methods:{
            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
            },
            agregarProducto(){
                axios.post(`/Productos/Reabastecimientos/store`, this.producto).then(res=>{
                    if(res.data.status){
                        this.alert('Abastecimiento', 'Realizado', 'success')
                        this.producto = {
                            'producto_id' : '',
                            'cantidad' : ''
                        }
                        this.$parent.getPermisos()
                    }
                })
            }
        }
    }
</script>
