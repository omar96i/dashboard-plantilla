<template>
  <div v-if="load">
    <div v-if="load_image" class="col-12">
        <b-img v-bind:src="interventoria.firma_cliente == null? '': url+img_name" fluid alt="Responsive image"></b-img>
    </div>
    <div class="col-12">
        <VueSignaturePad height="300px" ref="signaturePad" class="border border-secondary my-2" />
        <div class="text-center" v-if="!loading">
            <button @click="store" class="btn btn-success">Guardar firma</button>
            <button @click="limpiar" class="btn btn-info">Limpiar</button>
        </div>
        <div class="text-center" v-else>
            <spinner-view :loading="loading"></spinner-view>
        </div>
    </div>
  </div>
</template>
<script>
import url from '../../../mixins/cloudinary'
import SpinnerView from '../../Spinner.vue'
export default {
    props:['interventoria', 'type'],
    data(){
        return{
            load: false,
            img_name: '',
            load_image: false,
            loading: false
        }
    },
    components: {
        SpinnerView,
    },
    mixins: [url],
    created(){
        setTimeout(()=>{
            this.load = true
            if(this.type == 'cliente'){
                this.img_name = this.interventoria.firma_cliente
            }else{
                this.img_name = this.interventoria.firma_operario
            }
            if(this.interventoria.firma_cliente != null && this.type == 'cliente'){
                this.load_image = true
            }
            if(this.interventoria.firma_operario != null && this.type == 'operario'){
                this.load_image = true
            }

        },1000)
    },
    methods: {
        limpiar() {
            this.$refs.signaturePad.clearSignature();
        },
        store(){
            var png = this.$refs.signaturePad.saveSignature()
            var block = png.data.split(";");
            // Get the content type of the image
            var contentType = block[0].split(":")[1];// In this case "image/gif"
            // get the real base64 content of the file
            var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."

            // Convert it to a blob to upload
            var blob = this.b64toBlob(realData, contentType);

            let data = new FormData()
            data.append('img', blob)
            if(this.type == 'cliente'){
                data.append('type', 'cliente')
            }else{
                data.append('type', 'operario')
            }
            this.load_image = false
            this.loading = true
            axios.post(`/Proyectos/Interventorias/store/firma/${this.interventoria.id}`, data).then(res=>{
                if(res.data.status){
                    this.alert('Firma', res.data.msg, 'success')
                    this.img_name = res.data.img
                    this.load_image = true
                }
                this.loading = false
            }).catch(function (error) {
                console.log(error.response)
            })
        },
        b64toBlob(b64Data, contentType, sliceSize) {
            contentType = contentType || '';
            sliceSize = sliceSize || 512;

            var byteCharacters = atob(b64Data);
            var byteArrays = [];

            for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                var slice = byteCharacters.slice(offset, offset + sliceSize);

                var byteNumbers = new Array(slice.length);
                for (var i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }

                var byteArray = new Uint8Array(byteNumbers);

                byteArrays.push(byteArray);
            }

            var blob = new Blob(byteArrays, {type: contentType});
            return blob;
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
};
</script>
