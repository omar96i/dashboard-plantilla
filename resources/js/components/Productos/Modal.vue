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
                            <div class="form-group row">
                                <div class="col" v-if="load_image">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-raised card-carousel" v-if="render_img">
                                                <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                                                    <ol class="carousel-indicators">
                                                        <li data-target="#carousel" v-for="(url, index) in urls" :key="index" :data-slide-to="index" v-bind:class="{ active: index == 0 }"></li>
                                                    </ol>
                                                    <div class="carousel-inner">
                                                        <div class="carousel-item"  v-for="(url, index) in urls" :key="index" v-bind:class="{ active: index == 0 }">
                                                            <img class="d-block w-100" :src="url" style="height: 400px;">
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <button class="btn btn-danger btn-circle btn-sm" @click="deleteIndex(index)">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </button>
                                                                <a class="btn btn-info btn-circle btn-sm" :href="url" target="_blank">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                                        <i class="fa-solid fa-circle-chevron-left" style="color: black;"></i>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                                        <i class="fa-solid fa-circle-chevron-right" style="color: black;"></i>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col" v-else>
                                    <img class="d-block w-100" src="/img/img_productos/default.png" style="height: 400px;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="foto" class="btn btn-success btn-sm btn-block">Selecciona las imagenes</label>
                                    <input type="file" class="form-control" style="display:none" id="foto" name="foto" multiple v-on:change="onChangeFiles">
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
                                    <label class="col-form-label">Temperatura de color:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.temperatura_calor}, 'form-control']" name="b-i"  v-model="producto.temperatura_calor" placeholder="Temperatura de color..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Numero:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.numero}, 'form-control']" v-model="producto.numero" name="b-i" placeholder="Numero..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <!-- <label class="col-form-label">Codigo letras:</label> -->
                                    <label class="col-form-label">Codigo:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.codigo_utopia}, 'form-control']" name="b-i"  v-model="producto.codigo_utopia" placeholder="Codigo letras.." >
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
                                    <label class="col-form-label">Tipo moneda:</label>
                                    <select name="" id="" v-bind:class="[{ 'is-invalid': productoValidacion.tipo}, 'form-control']" @change="setValor()" v-model="producto.tipo">
                                        <option value="dolar">Dolar</option>
                                        <option value="peso_colombiano">Peso Colombiano</option>
                                    </select>
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Precio base:</label>
                                    <input type="number" @change="setValor()" v-bind:class="[{ 'is-invalid': productoValidacion.sub_valor}, 'form-control']" name="b-i" v-model="producto.sub_valor" placeholder="Valor de producto a empresa..." >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Porcentaje de aumento:</label>
                                    <input type="number" @change="setValor()" v-bind:class="[{ 'is-invalid': productoValidacion.porcentaje}, 'form-control']" name="b-i" v-model="producto.porcentaje" placeholder="% de aumento" >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Valor:</label>
                                    <input type="number" disabled readonly v-bind:class="[{ 'is-invalid': productoValidacion.valor}, 'form-control']" name="b-i" v-model="producto.valor" placeholder="" >
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Ubicación:</label>
                                    <select name="" id="" v-bind:class="[{ 'is-invalid': productoValidacion.ubicacion}, 'form-control']" v-model="producto.ubicacion">
                                        <option value="" selected disabled>Seleccionar ubicación...</option>
                                        <option value="Area perfil">Area perfil</option>
                                        <option value="Caja Tapas">Caja Tapas</option>
                                        <option value="Estanteria 1">Estanteria 1</option>
                                        <option value="Estanteria 2">Estanteria 2</option>
                                        <option value="Estanteria 3">Estanteria 3</option>
                                        <option value="Estanteria 4">Estanteria 4</option>
                                        <option value="Estanteria 5">Estanteria 5</option>
                                        <option value="Estanteria 6">Estanteria 6</option>
                                        <option value="Audio">Audio</option>
                                        <option value="Bodega">Bodega</option>
                                    </select>
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Provedor:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.provedor}, 'form-control']" v-model="producto.provedor" placeholder="Provedor...">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Bardcode:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.barcode}, 'form-control']" v-model="producto.barcode" placeholder="Barcode...">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label class="col-form-label">Observación:</label>
                                    <input type="text" v-bind:class="[{ 'is-invalid': productoValidacion.observacion}, 'form-control']" v-model="producto.observacion"  placeholder="Observacion...">
                                    <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12 col-sm-12">
                                    <label class="col-form-label">Categoria  <a href="#" @click="cambiarValorLoadCategoria()"><i class="fa-solid fa-gear"></i></a></label>
                                    <div v-if="!load_categoria">
                                        <v-select multiple v-model="producto.categoria_id" :options="options_categoria" :reduce="(options_categoria) => options_categoria.id"  v-bind:class="[{ 'is-invalid': productoValidacion.categoria}]"/>
                                        <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                    </div>
                                    <div v-else>
                                        <b-input-group>
                                            <b-form-input type="text" v-model="categoria.nombre" v-bind:class="[{ 'is-invalid': categoriaValidacion.nombre}]"></b-form-input>
                                            <b-input-group-append>
                                            <b-button variant="outline-success" @click="storeCategoria()">Agregar</b-button>
                                            <b-button variant="outline-danger" @click="cambiarValorLoadCategoria()">X</b-button>

                                            </b-input-group-append>
                                            <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                        </b-input-group>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center" v-if="!loading">
                                <button type="submit" class="btn btn-success btn-sm" @click="action()">Agregar</button>
                                <button type="button" class="btn btn-secondary btn-sm" @click="closeModal()">Cerrar</button>
                            </div>
                            <div class="text-center" v-else>
                                <spinner-view :loading="loading"></spinner-view>
                                <small>Si el contenido contiene varias imagenes tiende a tardar el guardado del producto</small>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SpinnerView from '../Spinner.vue'
    import url from '../../mixins/cloudinary'

    export default {
        components: {
			SpinnerView
		},
        mixins: [url],
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
                    'porcentaje': '',
                    'valor': '',
                    'sub_valor': '',
                    'numero' : '',
                    'codigo_utopia' : '',
                    'categoria_id' : '',
                    'ubicacion' : '',
                    'provedor' : '',
                    'barcode' : '',
                    'observacion' : ''
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
                    'valor': false,
                    'sub_valor': false,
                    'porcentaje': '',
                    'codigo_utopia' : false,
                    'numero' : false,
                    'categoria_id' : false,
                    'ubicacion' : '',
                    'provedor' : '',
                    'barcode' : '',
                    'observacion' : ''
                },
                image:'',
                ruta: '',
                files: [],
                urls: [],
                loading: false,
                load_categoria: false,
                categoria: {},
                categoriaValidacion: {
                    'nombre' : false
                },
                options_categoria: [],
                load_image: false,
                render_img: true,
                deleteImg:{
                    'img' : ''
                }
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
                    'numero' : this.product.numero,
                    'codigo_utopia' : this.product.codigo_utopia,
                    'categoria_id' : [],
                    'tipo' : (this.product.valores.length > 0) ? this.product.valores[0].tipo : '',
                    'valor' : (this.product.valores.length > 0) ? this.product.valores[0].valor : '',
                    'porcentaje' : (this.product.valores.length > 0) ? this.product.valores[0].porcentaje : '',
                    'sub_valor' : (this.product.valores.length > 0) ? this.product.valores[0].sub_valor : '',
                    'ubicacion' : this.product.ubicacion,
                    'provedor' : this.product.provedor,
                    'barcode' : this.product.barcode,
                    'observacion' : this.product.observacion
                }
                for (let index = 0; index < this.product.categorias.length; index++) {
                    this.producto.categoria_id.push(this.product.categorias[index].categoria_id)
                }
                this.setValor()
                if(this.product.files != null){
                    let aux = JSON.parse(this.product.files)
                    for (let i = 0; i < aux.length; i++) {
                        this.urls[i] = this.url+aux[i];
                    }
                    this.load_image = true
                }

            }
            this.ruta = (this.tipo == "edit") ? `/Productos/update/${this.product.id}` : '/Productos/store'
            this.getCategorias()
        },
        methods:{
            setValor(){
                if(this.producto.porcentaje != '' && this.producto.sub_valor != '' && this.producto.tipo != ''){
                    var porcentaje = ((this.producto.sub_valor * this.producto.porcentaje)/100)
                    this.producto.valor = parseInt(this.producto.sub_valor)+porcentaje
                }
            },

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

            onChangeFiles(e){
                let files = e.target.files
                // Image Preview
                for (let i = 0; i < files.length; i++) {
                    if(this.urls.length>0){
                        this.urls.push(URL.createObjectURL(files[i]))
                    }else{
                        this.urls[i] = URL.createObjectURL(files[i]);
                    }
                }
                //
                //Set variables
                for (let i = 0; i < files.length; i++) {
                    this.files.push(files[i])
                }
                this.load_image = false
                setTimeout(() => {
                    this.load_image = true
                }, 200)
            },

            getCategorias(){
                axios.get('/Productos/Categorias/get').then(res=>{
                    res.data.categorias.forEach(categoria => {
                        this.options_categoria.push({ id : categoria.id, label : categoria.nombre})
                    });
                })
            },

            deleteIndex(index){
                this.render_img = false
                if(this.tipo == 'edit'){
                    if(this.urls[index].includes('https://res.cloudinary.com')){
                        let aux_img = JSON.parse(this.product.files)
                        this.deleteImg.img = aux_img[index]

                        axios.post(`/Productos/delete/img/${this.product.id}`, this.deleteImg).then(res=>{
                            this.alert("Imagen", "Eliminada", "success")
                            this.urls.splice(index,1)
                            setTimeout(()=>{
                                if(this.files.length == 0 && this.urls.length == 0){
                                    this.load_image = false
                                }
                                this.render_img = true
                            }, 200)
                        }).catch(res=>{
                            console.log(res.response)
                            this.alert("Imagen", "Error en el servidor", "error")
                        })
                    }else{
                        let aux = 0;
                        for (let i = 0; i < this.urls.length; i++) {
                            if(!this.urls[i].includes('https://res.cloudinary.com')){
                                if(this.urls[i] == this.urls[index]){
                                    break;
                                }else{
                                    aux++
                                }
                            }
                        }
                        this.urls.splice(index,1)
                        this.files.splice(aux,1)
                        setTimeout(()=>{
                            this.render_img = true
                        },100)
                    }


                }else{
                    this.files.splice(index,1)
                    this.urls.splice(index,1)
                    setTimeout(()=>{
                        if(this.files.length == 0 && this.urls.length == 0){
                            this.load_image = false
                        }
                        this.render_img = true
                    }, 200)
                }
            },

            action(){
                if(
                    this.producto.nombre == '' ||
                    this.producto.descripcion == '' ||
                    this.producto.referencia == '' ||
                    this.producto.cantidad == '' ||
                    this.producto.categoria_id == '' ||
                    this.producto.valor == '' ||
                    this.producto.sub_valor == ''
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
                    data.append("sub_valor", this.producto.sub_valor)
                    data.append("porcentaje", this.producto.porcentaje)
                    data.append("numero", this.producto.numero)
                    data.append("codigo_utopia", this.producto.codigo_utopia)
                    data.append("ubicacion", this.producto.ubicacion)
                    data.append("provedor", this.producto.provedor)
                    data.append("barcode", this.producto.barcode)
                    data.append("observacion", this.producto.observacion)

                     for (let i = 0; i < this.producto.categoria_id.length; i++) {
                        data.append("categorias[]", this.producto.categoria_id[i])
                    }

                    if(this.files.length > 0){
                        for (let i = 0; i < this.files.length; i++) {
                            data.append('files[]', this.files[i], this.files[i].name)
                        }
                    }

                    axios.post(this.ruta, data).then(res=>{
                        this.loading = false
                        this.alert("Producto", (this.tipo == "edit")? "Producto Editado": "Producto Creado", "success")
                        this.closeModal()
                    }).catch(error=>{
                        console.log(error.response)
                        this.loading = false
                        this.alert("Producto", "Error en el servidor", "error")
                    })

                }
            },

            cambiarValorLoadCategoria(){
                this.load_categoria = (this.load_categoria)? false : true
            },

            storeCategoria(){
                if(this.categoria.nombre == ''){
                    this.validarCategoria()
                }else{
                    axios.post('/Productos/Categorias/store', this.categoria).then(res=>{
                        if(res.data.saved){
                           this.alert('Categoria', 'Creada', 'success')
                           this.categoria = {}
                           this.options_categoria.push({ id : res.data.categoria.id, label : res.data.categoria.nombre})
                           this.cambiarValorLoadCategoria()
                        }
                    })
                }
            },

            validarCategoria(){
                if(this.categoria.nombre == ''){
                    this.categoriaValidacion.nombre = true
                }else{
                    this.categoriaValidacion.nombre = false
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
                if(this.producto.sub_valor == ''){
                    this.productoValidacion.sub_valor = true
                }else{
                    this.productoValidacion.sub_valor = false
                }
                if(this.producto.porcentaje == ''){
                    this.productoValidacion.porcentaje = true
                }else{
                    this.productoValidacion.porcentaje = false
                }
                if(this.producto.categoria_id == ''){
                    this.productoValidacion.categoria_id = true
                }else{
                    this.productoValidacion.categoria_id = false
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
