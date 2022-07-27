<template>
    <div class="mt-2">
        <form method="post" @submit.prevent="store()" enctype="multipart/form-data">
            <div class="form-group row">
                <div class="col-12">
                    <label>Pruebas visuales</label>
                    <b-form-file placeholder="Elije las imagenes a subir" accept="image/*" multiple v-on:change="onImageChange" ref="file-input" v-if="show"></b-form-file>
                </div>
                <div class="row row-cols-1 row-cols-md-2 g-4 mt-4" v-if="loadImage">
                    <div class="col mt-2" v-for="(src, index) in urls" :key="index">
                        <div class="card">
                            <b-img :src="(!imagePreview)? src : url+src" fluid alt="Responsive image"></b-img>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center" v-if="show">
                <button type="submit" class="btn btn-success" v-if="!loading" >Subir pruebas</button>
                <spinner-view :loading="loading"></spinner-view>
            </div>
        </form>
    </div>
</template>

<script>
    import url from '../../../mixins/cloudinary'
    import SpinnerView from '../../Spinner.vue'

    export default {
        components:{
            SpinnerView
        },
        props:['interventoria_id'],
        mixins: [url],
        data(){
            return{
                files: [],
                urls: [],
                loadImage: false,
                loading: false,
                show: false,
                tipo: 'insert',
                imagePreview: false
            }
        },
        created(){
            this.getInterventoriaFiles()
        },
        methods:{
            onImageChange(e){
                this.imagePreview = false
                this.loadImage = false
                this.urls = []
                this.files = []
                let files = e.target.files
                // Image Preview
                for (let i = 0; i < files.length; i++) {
                    this.urls[i] = URL.createObjectURL(files[i]);
                }
                //
                //Set variables
                for (let i = 0; i < files.length; i++) {
                    this.files.push(files[i])
                }
                //
                setTimeout(()=>{
                    this.loadImage = true
                },500)
            },
            getInterventoriaFiles(){
                if(!this.show){
                    axios.get(`/Proyectos/Interventorias/get/${this.interventoria_id}`).then(res=>{
                        if(JSON.parse(res.data.interventoria.files.files).length > 0){
                            this.urls = JSON.parse(res.data.interventoria.files.files)
                            this.tipo = 'update'
                            this.imagePreview = true
                            this.loadImage = true
                        }
                    })
                }
                this.show = true
            },
            store(){
                this.loading = true
                let data = new FormData();
                data.append("tipo", this.tipo)
                for (let i = 0; i < this.files.length; i++) {
                    data.append('files[]', this.files[i], this.files[i].name)
                }
                const config = { 'header' : { 'Content-Type': 'multipart/form-data' }}
                axios.post(`/Proyectos/Interventorias/store/files/${this.interventoria_id}`, data, config).then(res=>{
                    if(res.data.status){
                        this.alert('Pruebas', res.data.msg, 'success')
                    }else{
                        this.alert('Pruebas', res.data.msg, 'error')
                    }
                    this.$refs['file-input'].reset()
                    this.loading = false
                }).catch(function (error) {
                    this.alert('Actividad', 'Error del servidor contactarse con el programador', 'error')
                    this.loading = false
                });
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
