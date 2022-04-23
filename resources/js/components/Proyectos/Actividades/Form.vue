<template>
    <div>
        <div class="col-12">
            <div class="row">
                <b-row class="col-6">
                    <b-col sm="12">
                        <label>Proyecto</label>
                        <b-form-select :state="actividadValidador.proyecto_id" v-model="actividad.proyecto_id" :options="proyectos"></b-form-select>
                        <b-form-invalid-feedback :state="actividadValidador.proyecto_id">
                            Debe seleccionar un proyecto
                        </b-form-invalid-feedback>
                        <b-form-valid-feedback :state="actividadValidador.proyecto_id">
                            Esta bien!
                        </b-form-valid-feedback>
                    </b-col>
                </b-row>
                <b-row class="col-6">
                    <b-col sm="12">
                        <label>Usuarios</label>
                        <b-form-select :state="actividadValidador.empleado_id" v-model="actividad.empleado_id" :options="usuarios"></b-form-select>
                        <b-form-invalid-feedback :state="actividadValidador.empleado_id">
                            Debe seleccionar un usuario
                        </b-form-invalid-feedback>
                        <b-form-valid-feedback :state="actividadValidador.empleado_id">
                            Esta bien!
                        </b-form-valid-feedback>
                    </b-col>
                </b-row>
            </div>
            <div class="row mt-2">
                <b-row class="col-6">
                    <b-col sm="12">
                        <label for="fecha_inicial">Fecha Inicial</label>
                        <b-form-datepicker id="fecha_inicial" :state="actividadValidador.fecha_inicio" v-model="actividad.fecha_inicio"></b-form-datepicker>
                        <b-form-invalid-feedback :state="actividadValidador.fecha_inicio">
                            Selecciona una fecha!
                        </b-form-invalid-feedback>
                        <b-form-valid-feedback :state="actividadValidador.fecha_inicio">
                            Esta bien!
                        </b-form-valid-feedback>
                    </b-col>
                </b-row>
                <b-row class="col-6">
                    <b-col sm="12">
                        <label for="fecha_final">Fecha Final</label>
                        <b-form-datepicker id="fecha_final" :state="actividadValidador.fecha_final" v-model="actividad.fecha_final"></b-form-datepicker>
                        <b-form-invalid-feedback :state="actividadValidador.fecha_final">
                            Selecciona una fecha!
                        </b-form-invalid-feedback>
                        <b-form-valid-feedback :state="actividadValidador.fecha_final">
                            Esta bien!
                        </b-form-valid-feedback>
                    </b-col>
                </b-row>
            </div>
            <div class="row mt-2">
                <b-row class="col-6">
                    <b-col sm="12">
                        <label>Descripcion de la actividad</label>
                        <b-form-textarea
                            id="textarea"
                            placeholder="Descripcion de la actividad a hacer..."
                            v-model="actividad.descripcion"
                            :state="actividadValidador.descripcion"
                            rows="3"
                            max-rows="6"
                        ></b-form-textarea>
                        <b-form-invalid-feedback :state="actividadValidador.descripcion">
                            Este espacio no puede quedar vacio
                        </b-form-invalid-feedback>
                        <b-form-valid-feedback :state="actividadValidador.descripcion">
                            Esta bien!
                        </b-form-valid-feedback>
                    </b-col>
                </b-row>
            </div>
            <div class="text-center mt-3">
                <b-button variant="success" @click="store()">{{tipo == 'insert'? 'Agregar' : 'Actualizar'}}</b-button>
            </div>
        </div>
        <hr>
        <div v-if="load_form_file">
            <b-tabs content-class="mt-3">
                <b-tab title="Subir archivos" active>
                    <div class="col-12 mt-3">
                        <form action="post" enctype="multipart/form-data" @submit.prevent="storeImage">
                            <div class="col-12 text-center my-2">
                                <h5>Subir archivos</h5>
                            </div>
                            <div class="row mt-3">
                                <div class="col-10 text-center">
                                    <input type="file" class="form-control" accept=" video/*, image/*"  id="foto" name="foto" v-on:change="onImageChange">
                                </div>
                                <div class="text-center col-2">
                                    <b-button block variant="success" type="submit" v-bind:disabled="loading_btn"><b-spinner small type="grow" v-if="loading_btn"></b-spinner> Agregar</b-button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row row-cols-1 row-cols-md-2 g-4 mt-4" v-if="loading_files">
                        <div class="col" v-for="(file, index) in files.files" :key="index">
                            <div class="card">
                                <div style="z-index: 1; position: absolute;">
                                    <button class="btn btn-danger btn-circle" @click="deleteFile(file.id)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <a target="_blank" :href="(file.tipo == 'video/mp4')? 'https://res.cloudinary.com/dcj3tck83/video/upload/v1650564336/'+file.file: 'https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/'+file.file" class="btn btn-info btn-circle">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                                <b-img-lazy v-if="file.tipo != 'video/mp4'" :src="'https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/'+file.file" alt="Image 1" style="height:300px;"></b-img-lazy>
                                <video class="card-img-top" height="300px" controls v-else style="height:300px;">
                                    <source :src="'https://res.cloudinary.com/dcj3tck83/video/upload/v1650564336/'+file.file" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </b-tab>
                <b-tab title="Añadir inventario">
                    <div class="col-12">
                        <div class="row">
                            <b-row class="col-6">
                                <b-col sm="12">
                                    <label>Productos</label>
                                    <b-form-select :state="inventarioValidador.sub_cotizacion_producto_id" v-model="inventario.sub_cotizacion_producto_id" :options="productos"></b-form-select>
                                    <b-form-invalid-feedback :state="inventarioValidador.sub_cotizacion_producto_id">
                                        Debe seleccionar un producto
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="inventarioValidador.sub_cotizacion_producto_id">
                                        Esta bien!
                                    </b-form-valid-feedback>
                                </b-col>
                            </b-row>
                            <b-row class="col-6">
                                <b-col sm="12">
                                    <label>Cantidad</label>
                                    <b-form-input type="number" :state="inventarioValidador.cantidad" v-model="inventario.cantidad" placeholder="Cantidad"></b-form-input>
                                    <b-form-invalid-feedback :state="inventarioValidador.cantidad">
                                        Debe asignar una cantidad
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback :state="inventarioValidador.cantidad">
                                        Esta bien!
                                    </b-form-valid-feedback>
                                </b-col>
                            </b-row>
                        </div>
                        <div class="text-center mt-3">
                            <b-button variant="success" v-bind:disabled="loading_btn_2" @click="storeProducto()"><b-spinner small type="grow" v-if="loading_btn_2"></b-spinner> Agregar</b-button>
                        </div>
                    </div>
                    <div class="table-responsive" v-if="load_table_inventario">
                        <table class="table table-bordered" id="tablaInventario" width="100%" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th class="color-gray">Foto</th>
                                    <th class="color-gray">Nombre</th>
                                    <th class="color-gray">Descripcion</th>
                                    <th class="color-gray">Referencia</th>
                                    <th class="color-gray">Marca</th>
                                    <th class="color-gray">Categoria</th>
                                    <th class="color-gray">Color</th>
                                    <th class="color-gray">Temperatura de calor</th>
                                    <th class="color-gray">Voltaje</th>
                                    <th class="color-gray">Cantidad</th>
                                    <th class="color-gray">Ubicacion</th>
                                    <th class="color-gray"></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th class="color-gray"><input type="text" class="form-control" disabled></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"><input type="text" class="form-control"></th>
                                    <th class="color-gray"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(producto, index) in inventario_actividad" :key="index">
                                    <td><img v-bind:src="producto.productos.productos.foto == 'default.png'? '/img/img_productos/'+producto.productos.productos.foto: url+producto.productos.productos.foto" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                                    <td>{{producto.productos.productos.nombre}}</td>
                                    <td>{{producto.productos.productos.descripcion}}</td>
                                    <td>{{producto.productos.productos.referencia}}</td>
                                    <td>{{producto.productos.productos.marca}}</td>
                                    <td>{{(producto.productos.productos.categoria_id == null)? 'Sin definiar' : producto.productos.productos.categoria.nombre}}</td>
                                    <td>{{producto.productos.productos.color}}</td>
                                    <td>{{producto.productos.productos.temperatura_calor}}</td>
                                    <td>{{producto.productos.productos.voltaje}}</td>
                                    <td>{{producto.cantidad}}</td>
                                    <td>{{producto.productos.ubicacion}}</td>
                                    <td class="text-center">
                                        <div class="dropdown no-arrow">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                <div class="dropdown-header">Acciones:</div>
                                                <button class="dropdown-item" href="#"><i class="fas fa-trash" ></i> Eliminar</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </b-tab>
            </b-tabs>
        </div>
    </div>
</template>

<script>
    import url from '../../../mixins/cloudinary'
    export default {
        props:['actividad_props'],
        mixins: [url],

        data(){
            return{
                proyectos: [],
                usuarios: [],
                actividad: {
                    'proyecto_id': '',
                    'empleado_id': '',
                    'fecha_inicio': '',
                    'fecha_final': '',
                    'descripcion': ''
                },
                actividadValidador: {
                    'proyecto_id': null,
                    'empleado_id': null,
                    'fecha_inicio': null,
                    'fecha_final': null,
                    'descripcion': null
                },
                inventario:{
                    'sub_cotizacion_producto_id': '',
                    'cantidad' : ''
                },
                inventarioValidador:{
                    'sub_cotizacion_producto_id': null,
                    'cantidad' : null
                },
                tipo: 'insert',
                file_tipo: '',
                image: '',
                files: {},
                loading_files: false,
                ruta: '',
                load_form_file: false,
                loading_btn: false,
                loading_btn_2: false,
                productos: [],
                load_table_inventario: false,
                inventario_actividad: {}
            }
        },

        created(){
            this.getProyectos()
            this.getUsuarios()
            if(this.actividad_props != undefined){
                this.actividad = this.actividad_props
                this.tipo = 'edit'
                this.load_form_file = true
                this.getFiles()
                this.getInventario()
                this.getInventarioActividad()
            }
        },

        methods:{

            getInventario(){
                axios.get(`/Proyectos/Inventario/get/${this.actividad.proyecto_id}`).then(res=>{
                    res.data.inventario.forEach(producto => {
                        this.productos.push({ value : producto.id, text : producto.productos.nombre+' - Disponibilidad: '+producto.cantidad})
                    });
                })
            },

            getProyectos(){
                axios.get('/Proyectos/get').then(res=>{
                    res.data.proyectos.forEach(proyecto => {
                        this.proyectos.push({ value : proyecto.id, text : proyecto.nombre})
                    });
                })
            },

            getUsuarios(){
                axios.get('/Usuarios/getAll').then(res=>{
                    res.data.usuarios.forEach(usuario => {
                        this.usuarios.push({ value : usuario.id, text : usuario.informacion_personal.documento+" - "+usuario.informacion_personal.nombres+" "+usuario.informacion_personal.apellidos})
                    });
                })
            },

            storeProducto(){
                if(this.inventario.sub_cotizacion_producto_id != '' && this.inventario.cantidad != ''){
                    axios.post(`/Proyectos/Actividades/Inventario/store/${this.actividad.id}`, this.inventario).then(res=>{
                        if(res.data.status){
                            this.alert('Producto', res.data.msg, 'success')
                            this.inventario.sub_cotizacion_producto_id = ''
                            this.inventario.cantidad = ''
                            this.getInventarioActividad()
                        }else{
                            this.alert('Producto', res.data.msg, 'error')
                        }
                    })
                }else{
                    this.inventarioValidador.sub_cotizacion_producto_id = (this.inventario.sub_cotizacion_producto_id == '')? false : true
                    this.inventarioValidador.cantidad = (this.inventario.cantidad == '')? false : true
                }
            },

            getInventarioActividad(){
                this.load_table_inventario = false
                axios.get(`/Proyectos/Actividades/Inventario/get/${this.actividad.id}`).then(res=>{
                    console.log(res.data)
                    this.inventario_actividad = res.data.inventario
                    this.load_table_inventario = true
                }).finally(() => {
                    setTimeout(() => {
                        $(`#tablaInventario`).DataTable({
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

            deleteFile(id){
                this.$fire({
                    title: 'Archivo',
                    text: 'Estas seguro de eliminar el archivo seleccionado?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    confirmButtonColor: '#FF0000',
                }).then((result) => {
                    if(result.value){
                        axios.get(`/Proyectos/Actividades/Files/delete/${id}`).then(res => {
                            if(res.data.deleted){
                                this.$fire({
                                    title: 'Archivo',
                                    text: 'Eliminado',
                                    type: 'error',
                                    timer: 3000
                                })
                                this.getFiles()
                            }
                        })
                    }
                });
            },

            store(){
                if(this.actividad.proyecto_id != '' && this.actividad.empleado_id != '' && this.actividad.fecha_inicio != '' && this.actividad.fecha_final != '' && this.actividad.descripcion != ''){
                    this.ruta = (this.tipo == 'insert')? '/Proyectos/Actividades/store' : `/Proyectos/Actividades/update/${this.actividad.id}`
                    axios.post(this.ruta, this.actividad).then(res=>{
                        if(res.data.insert){
                            this.alert('Actividad', 'Creada', 'success')
                            this.actividad = res.data.actividad
                            this.tipo = 'edit'
                            this.load_form_file = true
                            this.getInventario()
                            this.getInventarioActividad()
                        }
                        if(res.data.updated){
                            this.alert('Actividad', 'Actualizada', 'success')
                            this.actividad = res.data.actividad
                            this.tipo = 'edit'
                        }
                    })
                }else{
                    this.validar()
                }

            },

            validar(){
                this.actividadValidador.proyecto_id = (this.actividad.proyecto_id == '')? false : true
                this.actividadValidador.empleado_id = (this.actividad.empleado_id == '')? false : true
                this.actividadValidador.fecha_inicio = (this.actividad.fecha_inicio == '')? false : true
                this.actividadValidador.fecha_final = (this.actividad.fecha_final == '')? false : true
                this.actividadValidador.descripcion = (this.actividad.descripcion == '')? false : true
            },

            alert(titulo, text, tipo){
                this.$fire({
                    title: titulo,
                    text: text,
                    type: tipo,
                    timer: 3000
                })
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
                this.file_tipo = this.image.type

            },

            storeImage(){
                if(this.image != ''){
                    this.loading_btn = true
                    let data = new FormData();
                    data.append("file", this.image)
                    data.append("proyecto_actividad_id", this.actividad.id)
                    data.append("tipo", this.file_tipo)

                    axios.post('/Proyectos/Actividades/Files/store', data).then(res=>{
                        if(res.data.status){
                            this.getFiles()
                            this.alert('Archivo', 'Subido', 'success')

                        }
                        this.loading_btn = false
                        this.image = ''
                    })
                }else{
                    this.alert('Archivo', 'Sin seleccionar', 'error')
                }

            },

            getFiles(){
                axios.get(`/Proyectos/Actividades/Files/get/${this.actividad.id}`).then(res=>{
                    this.files = res.data.files
                    this.loading_files = true
                })
            }

        },

    }
</script>
