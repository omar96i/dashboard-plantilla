<template>
    <div>
         <!-- Modal planos -->
        <div class="modal fade" id="modalPlanos" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Planos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" @submit.prevent="action()" enctype="multipart/form-data">
                            <div class="form-group row text-center">

                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <div class="col-12">
                                        <img v-bind:src="imagePreview" alt="" style="width: 20em; border-radius: 12px;">
                                    </div>
                                    <div class="col-12">
                                    <label for="foto" class="btn btn-success btn-sm btn-block">Selecciona una imagen / archivo</label>
                                        <input type="file" class="form-control" style="display:none" id="foto" name="foto" v-on:change="onImageChange">
                                    </div>
                                </div>

                                <div class="col-7">
                                    <div class="col-12">
                                        <label for="b-i" class="col-form-label">Descripcion:</label>
                                        <b-form-select v-model="plano.proyecto_id" :options="options_proyectos" v-bind:class="[{ 'is-invalid': planoValidacion.proyecto_id}]"></b-form-select>
                                        <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="b-i" class="col-form-label">Descripcion:</label>
                                        <textarea v-bind:class="[{ 'is-invalid': planoValidacion.descripcion}, 'form-control']" rows="4" v-model="plano.descripcion"></textarea>
                                        <div class="invalid-feedback">El campo no debe quedar vacío</div>
                                    </div>
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
    import SpinnerView from '../../Spinner.vue'
    export default {
        components: {
			SpinnerView
		},
        props:['proyectos'],
        data(){
            return{
                imagePreview:'/img/img_productos/default.png',
                plano:{
                    'descripcion' : '',
                    'proyecto_id' : ''
                },
                planoValidacion:{
                    'descripcion' : false,
                    'proyecto_id' : false
                },
                image:'',
                ruta: '',
                options_proyectos: [],
                loading: false
            }
        },
        created(){
            this.proyectos.forEach(proyecto => {
                this.options_proyectos.push({ value : proyecto.id, text : proyecto.nombre})
            });
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
                    this.plano.descripcion == '' ||
                    this.plano.proyecto_id == '' ||
                    this.plano.image == ''
                )
                {
                    this.Validar()
                }else
                {
                    this.loading = true;
                    let data = new FormData();
                    data.append("proyecto_id", this.plano.proyecto_id)
                    data.append("descripcion", this.plano.descripcion)
                    data.append("file", this.image, this.image.name)
                    axios.post('/Proyectos/Planos/store', data).then(res=>{
                        this.loading = false
                        if(res.data.saved){
                            this.alert('Plano', 'Ingreso con exito', 'success')
                            this.$parent.getPlanos()
                            this.$parent.closeModal()
                        }
                    })

                }
            },

            Validar(){
                if(this.plano.proyecto_id == ''){
                    this.planoValidacion.proyecto_id = true
                }else{
                    this.planoValidacion.proyecto_id = false
                }
                if(this.plano.descripcion == ''){
                    this.planoValidacion.descripcion = true
                }else{
                    this.planoValidacion.descripcion = false
                }

                if(this.image == ''){
                    this.alert('Imagen', 'No seleccionada', 'warning')
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
