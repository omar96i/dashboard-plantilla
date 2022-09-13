<template>
    <div>
         <!-- Modal productos -->
        <div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Import</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="$parent.closeModal()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group row text-center">
                                <div class="col-12">
                                    <b-form-file
                                        v-model="file"
                                        placeholder="Selecciona el archivo a importar..."
                                        drop-placeholder="Suelta aqui el archivo a importar..."
                                    ></b-form-file>
                                    <button class="btn btn-success mt-3" @click="importProduct" v-if="!loading">Importar productos</button>
                                    <spinner-view :loading="loading" class="mt-3"></spinner-view>
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
        data(){
            return{
                file: '',
                loading: false
            }
        },
        methods:{
            onFileChange(e){
                this.file = e.target.files[0]
            },

            importProduct(){
                if(this.file != ''){
                    this.loading = true
                    let data = new FormData();
                    data.append("file", this.file)
                    axios.post('/Productos/store/import', data).then(res=>{
                        if(res.data.status){
                            this.alert('Producto','agregado','success')
                        }else{
                            this.alert('Producto','Archivo no seleccionado','error')
                        }
                        this.loading = false
                        setTimeout(()=>{
                            location.reload();
                        },1500)
                    }).catch(error=>{
                        this.alert('Error','Error del servidor','error')
                        console.log(error.response)
                        this.loading = false
                    })
                }else{
                    this.alert("Archivo", "No seleccionado", "error")
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
