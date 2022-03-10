<template>
    <div>
        <!-- Modal Sub Cotizacion -->
        <div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModalProduct()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" v-if="load">
                            <div class="form-group row" >
                                <div class="col-12 col-sm-6">
                                    <label for="a-i" class="col-form-label">Selecciona el producto:</label>
                                    <select name="" id="" class="form-control" v-model="producto.producto_id">
                                        <option value="" selected>Selecciona el producto</option>
                                        <option v-for="(producto, index) in productos" :key="index" :value="producto.id">{{producto.nombre}} - {{producto.cantidad}}</option>
                                    </select>
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="" class="col-form-label">Cantidad:</label>
                                    <input type="text" id="" class="form-control" name="" placeholder="Cantidad..." v-model="producto.cantidad">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="" class="col-form-label">Ubicacion:</label>
                                    <input type="text" id="" class="form-control" name="" placeholder="Ubicacion..." v-model="producto.ubicacion">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$parent.closeModalProduct()">Cerrar</button>
                        <button type="button" class="btn btn-success" @click="store()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SpinnerView from '../Spinner.vue'
    export default {
        props:['sub_cotizacion'],
        components: {
			SpinnerView
		},

        data(){
            return{
                productos:{},
                ruta_productos: '',
                ruta: '',
                producto: {},
                load: false
            }
        },

        created(){
            this.ruta = `/Cotizaciones/store/product/${this.sub_cotizacion.id}`
            this.ruta_productos = '/Productos/getAll'
            this.getProducts()
        },

        methods:{
            getProducts(){
                axios.get(this.ruta_productos).then(res=>{
                    this.productos = res.data.productos
                    this.load = true
                })
            },
            store(){
                axios.post(this.ruta, this.producto).then(res=>{
                    if(res.data.saved){
                        this.alert("Producto", "Agregado", "success")
                        this.producto = {}
                        this.$parent.changeValues()
                    }else{
                        this.alert("Producto", res.data.msg, "warning")
                        this.producto = {}
                    }
                })
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
