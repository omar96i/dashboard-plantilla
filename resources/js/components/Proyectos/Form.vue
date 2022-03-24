<template>
    <div class="col-12">
        <div class="form-group row">
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="cotizaciones">Cotizaciones</label>
                <b-form-input list="input-list-cotizaciones" id="cotizaciones" v-model="proyecto.cotizacion_id" :state="validacion_cotizacion"></b-form-input>
                <b-form-datalist id="input-list-cotizaciones" :options="options"></b-form-datalist>
                <b-form-invalid-feedback :state="validacion_cotizacion">
                    Selecciona una cotizacion
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="validacion_cotizacion">
                    OK!.
                </b-form-valid-feedback>
            </div>
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="nombre_proyecto">Nombre del proyecto</label>
                <b-form-input v-model="proyecto.nombre" :state="validacion_nombre" id="nombre_proyecto"></b-form-input>
                <b-form-invalid-feedback :state="validacion_nombre">
                    El campo no puede estar vacio
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="validacion_nombre">
                    OK!.
                </b-form-valid-feedback>
            </div>
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="fecha_inicial">Fecha inicial</label>
                <b-form-datepicker id="fecha_inicial" class="mb-2" :state="validacion_fecha_inicial" v-model="proyecto.fecha_inicial" placeholder="Selecciona una fecha"></b-form-datepicker>
                <b-form-invalid-feedback :state="validacion_fecha_inicial">
                    El campo no puede estar vacio
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="validacion_fecha_inicial">
                    OK!.
                </b-form-valid-feedback>
            </div>
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="fecha_final">Fecha final</label>
                <b-form-datepicker id="fecha_final" class="mb-2" :state="validacion_fecha_final" v-model="proyecto.fecha_final" placeholder="Selecciona una fecha"></b-form-datepicker>
                <b-form-invalid-feedback :state="validacion_fecha_final">
                    El campo no puede estar vacio
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="validacion_fecha_final">
                    OK!.
                </b-form-valid-feedback>
            </div>
        </div>

        <div class="text-center col-12">
            <b-button variant="success btn-sm" @click="store()">{{ (tipo == 'insert')? 'Crear' : 'Actualizar'}}</b-button>
        </div>

    </div>
</template>

<script>
export default {
    props: ['proyecto_props'],
    data() {
        return {
            options: [],
            proyecto: {
                'nombre' : '',
                'cotizacion_id' : '',
                'fecha_inicial': '',
                'fecha_final' : ''
            },
            tipo: 'insert',
            ruta: '',
        }
    },
    created(){
        if(this.proyecto_props != undefined){
            this.tipo = 'edit'
            this.getCotizaciones(this.proyecto_props.cotizacion)
            this.proyecto = this.proyecto_props
        }else{
            this.getCotizaciones()
        }
    },
    methods:{
        getCotizaciones(adicion = false){
            axios.get('/Cotizaciones/getEnabled').then(res=>{
                this.options = []
                for (let i = 0; i < res.data.cotizaciones.length; i++) {
                    this.options.push({value : res.data.cotizaciones[i].id, text : res.data.cotizaciones[i].nombre_facturar+" - "+res.data.cotizaciones[i].cliente_proyecto})
                }
                if(adicion != false){
                    this.options.push({value : adicion.id, text : adicion.nombre_facturar+" - "+adicion.cliente_proyecto})
                }
            })
        },
        store(){
            if(
                this.proyecto.nombre.length > 0 &&
                this.proyecto.cotizacion_id.length > 0 &&
                this.proyecto.fecha_inicial.length > 0 &&
                this.proyecto.fecha_final.length > 0
            ){
                this.ruta = (this.tipo == 'insert')? '/Proyectos/store' : `/Proyectos/edit/${this.proyecto.id}`
                axios.post(this.ruta, this.proyecto).then(res=>{
                    if(res.data.saved){
                        this.alert('Proyecto', 'Creado', 'success')
                        this.proyecto = res.data.proyecto
                        this.tipo = 'edit'
                        this.getCotizaciones(res.data.cotizacion)
                    }
                    if(res.data.edited){
                        this.alert('Proyecto', 'Actualizado', 'success')
                        this.proyecto = res.data.proyecto
                        this.getCotizaciones(res.data.cotizacion)
                    }
                })

            }else{
                this.alert('Proyecto', 'Faltan espacios sin llenar, por favor llenalos', 'warning')
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
    },
    computed: {
        validacion_nombre() {
            return this.proyecto.nombre.length > 0
        },
        validacion_cotizacion(){
            return this.proyecto.cotizacion_id.length > 0
        },
        validacion_fecha_inicial(){
            return this.proyecto.fecha_inicial.length > 0
        },
        validacion_fecha_final(){
            return this.proyecto.fecha_final.length > 0
        }
    }
}
</script>
