<template>

<div>
    <h5>Datos del iva</h5>
    <form @submit.prevent="storeIva()">
        <div class="form-group row" >
            <div class="col-12 col-sm-4">
                <label class="col-form-label">Valor del iva:</label>
                <input type="number" class="form-control" v-model="iva.valor" placeholder="Valor del iva actual...">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
        </div>
        <div class="col-12 text-center" v-if="!spinner_one">
            <button class="btn btn-success btn-sm" type="submit">Guardar</button>
        </div>
        <div class="col-12 text-center" v-else>
            <spinner-view :loading="spinner_one"></spinner-view>
        </div>
    </form>
    <hr>
    <h5>Datos de la empresa</h5>

    <form @submit.prevent="storeDatosBasicos()">
        <div class="form-group row" >
            <div class="col-12 col-sm-4">
                <label class="col-form-label">RAZON SOCIAL:</label>
                <input type="text" class="form-control" v-model="datos_basicos.razon">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
            <div class="col-12 col-sm-4">
                <label class="col-form-label">NIT:</label>
                <input type="text" class="form-control" v-model="datos_basicos.nit">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
            <div class="col-12 col-sm-4">
                <label class="col-form-label">TELEFONO:</label>
                <input type="text" class="form-control" v-model="datos_basicos.telefono">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
        </div>
        <div class="form-group row" >
            <div class="col-12 col-sm-4">
                <label class="col-form-label">CUENTA CORRIENTE DAVIVIENDA:</label>
                <input type="text" class="form-control" v-model="datos_basicos.cuenta_corriente">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
            <div class="col-12 col-sm-4">
                <label class="col-form-label">EMAIL:</label>
                <input type="text" class="form-control" v-model="datos_basicos.email">
                <div class="invalid-feedback">El campo no debe quedar vacío</div>
            </div>
        </div>
        <div class="col-12 text-center" v-if="!spinner_two">
            <button class="btn btn-success btn-sm" type="submit">Guardar</button>
        </div>
        <div class="col-12 text-center" v-else>
            <spinner-view :loading="spinner_two"></spinner-view>
        </div>
    </form>
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
                iva:{},
                datos_basicos:{},
                spinner_one: false,
                spinner_two: false,
            }
        },
        created(){
            this.getIva()
            this.getDatosBasicos()
        },
        methods:{
            getIva(){
                axios.get('/Configuraciones/getIva').then(res=>{
                    if(res.data.iva != null){
                        this.iva = res.data.iva
                    }
                })
            },
            getDatosBasicos(){
                axios.get('/Configuraciones/getDatosBasicos').then(res=>{
                    if(res.data.datos_basicos != null){
                        this.datos_basicos = res.data.datos_basicos
                    }
                })
            },
            storeIva(){
                this.spinner_one = true
                axios.post('/Configuraciones/storeIva', this.iva).then(res=>{
                    this.alert('Iva', 'Guardado', 'success')
                    this.spinner_one = false
                })
            },
            storeDatosBasicos(){
                this.spinner_two = true
                axios.post('/Configuraciones/storeDatosBasicos', this.datos_basicos).then(res=>{
                    this.alert('Datos Basicos', 'Guardado', 'success')
                    this.spinner_two = false
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
