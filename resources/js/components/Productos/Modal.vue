<template>
    <div>
         <!-- Modal productos -->
        <div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" @submit.prevent="action()" enctype="multipart/form-data">
                            <div class="form-group row text-center">
                                <div class="col-12">
                                    <img v-bind:src="imagePreview" alt="" style="width: 20em; border-radius: 12px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="foto" class="btn btn-success btn-sm btn-block">Selecciona una imagen</label>
                                    <input type="file" class="form-control" style="display:none" id="foto" name="foto" v-on:change="onImageChange">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Nombre</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.nombre}, 'form-control']" v-model="producto.nombre" placeholder="nombre..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="b-i" class="col-form-label">Descripcion:</label>
                                    <input type="text" id="b-i" v-bind:class="[{ 'is-invalid': productoValidacion.descripcion}, 'form-control']" v-model="producto.descripcion" name="b-i" placeholder="Descripcion..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Referencia</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.referencia}, 'form-control']" v-model="producto.referencia" name="b-i" placeholder="Referencia..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Marca:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.marca}, 'form-control']" v-model="producto.marca" name="b-i" placeholder="Marca..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Color:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.color}, 'form-control']" v-model="producto.color" name="b-i" placeholder="Color..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Temperatura de calor:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.temperatura_calor}, 'form-control']" name="b-i"  v-model="producto.temperatura_calor" placeholder="Temperatura de calor..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Voltaje:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.voltaje}, 'form-control']" v-model="producto.voltaje" name="b-i" placeholder="Voltaje...">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Cantidad:</label>
                                    <input type="number" v-bind:class="[{ 'is-invalid': productoValidacion.cantidad}, 'form-control']" name="b-i" v-model="producto.cantidad" placeholder="Cantidad..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Valor:</label>
                                    <input type="number" v-bind:class="[{ 'is-invalid': productoValidacion.valor}, 'form-control']" name="b-i" v-model="producto.valor" placeholder="Valor..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Tipo moneda:</label>
                                    <select name="" id="" v-bind:class="[{ 'is-invalid': productoValidacion.tipo}, 'form-control']" v-model="producto.tipo">
                                        <option value="dolar">Dolar</option>
                                        <option value="peso_colombiano">Peso Colombiano</option>
                                    </select>
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="text-center" v-if="!loading">
                                <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                                <button type="button" class="btn btn-secondary btn-sm">Cerrar</button>
                            </div>
                            <div class="text-center" v-else>
                                <spinner-view :loading="loading"></spinner-view>
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
        props:['product', 'tipo'],
        data(){
            return{
                imagePreview:'/img/img_productos/default.png',
                producto:{
                    'nombre' : '',
                    'descripcion' : '',
                    'referencia' : '',
                    'marca' : '',
                    'color' : '',
                    'temperatura_calor' : '',
                    'voltaje' : '',
                    'cantidad' : '',
                    'tipo' : '',
                    'valor': ''
                },
                productoValidacion:{
                    'nombre' : false,
                    'descripcion' : false,
                    'referencia' : false,
                    'marca' : false,
                    'color' : false,
                    'voltaje' : false,
                    'temperatura_calor' : false,
                    'cantidad' : false,
                    'tipo' : false,
                    'valor': false
                },
                image:'',
                ruta: '',
                loading: false,
            }
        },
        created(){
            if(this.tipo == "edit"){
                this.producto = {
                    'nombre' : this.product.nombre,
                    'descripcion' : this.product.descripcion,
                    'referencia' : this.product.referencia,
                    'marca' : this.product.marca,
                    'color' : this.product.color,
                    'voltaje' : this.product.voltaje,
                    'temperatura_calor' : this.product.temperatura_calor,
                    'cantidad' : this.product.cantidad,
                    'tipo' : this.product.valores[0].tipo,
                    'valor' : this.product.valores[0].valor,
                }
                this.imagePreview = `/img/img_productos/${this.product.foto}`
            }
            this.ruta = (this.tipo == "edit") ? `/Productos/update/${this.product.id}` : '/Productos/store'
        },
        methods:{
            onImageChange(e){
                this.image = e.target.files[0]

                let reader  = new FileReader()

                reader.addEventListener("load", function () {
                    this.imagePreview = reader.result
                }.bind(this), false);

                if( this.image ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.image.name ) ) {
                        reader.readAsDataURL( this.image )
                    }
                }
            },
            action(){
                if(
                    this.producto.nombre == '' ||
                    this.producto.descripcion == '' ||
                    this.producto.referencia == '' ||
                    this.producto.color == '' ||
                    this.producto.cantidad == '' ||
                    this.producto.valor == ''
                )
                {
                    this.Validar()
                }else
                {
                    this.loading = true;
                    let data = new FormData();
                    data.append("nombre", this.producto.nombre)
                    data.append("descripcion", this.producto.descripcion)
                    data.append("referencia", this.producto.referencia)
                    data.append("marca", this.producto.marca)
                    data.append("color", this.producto.color)
                    data.append("voltaje", this.producto.voltaje)
                    data.append("tipo", this.producto.tipo)
                    data.append("temperatura_calor", this.producto.temperatura_calor)
                    data.append("cantidad", this.producto.cantidad)
                    data.append("valor", this.producto.valor)
                    if(this.image != ''){
                        data.append("foto", this.image, this.image.name)
                    }

                    axios.post(this.ruta, data).then(res=>{
                        if(res.data.saved){

                        }
                        this.loading = false
                        this.alert("Producto", (this.tipo == "edit")? "Producto Editado": "Producto Creado", "success")
                        this.closeModal()
                    })

                }
            },

            closeModal(){
                this.$parent.getAllProduct()
                this.$parent.closeModal()
            },
            Validar(){
                if(this.producto.nombre == ''){
                    this.productoValidacion.nombre = true
                }else{
                    this.productoValidacion.nombre = false
                }
                if(this.producto.descripcion == ''){
                    this.productoValidacion.descripcion = true
                }else{
                    this.productoValidacion.descripcion = false
                }
                if(this.producto.referencia == ''){
                    this.productoValidacion.referencia = true
                }else{
                    this.productoValidacion.referencia = false
                }
                if(this.producto.color == ''){
                    this.productoValidacion.color = true
                }else{
                    this.productoValidacion.color = false
                }
                if(this.producto.cantidad == ''){
                    this.productoValidacion.cantidad = true
                }else{
                    this.productoValidacion.cantidad = false
                }
                if(this.producto.valor == ''){
                    this.productoValidacion.valor = true
                }else{
                    this.productoValidacion.valor = false
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
