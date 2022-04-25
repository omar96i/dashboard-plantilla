<template>
    <div class="col-12">
        <div class="form-group row">
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="cotizaciones">Cotizaciones</label>
                <b-form-select v-model="proyecto.cotizacion_id" :options="options" :state="proyectoValidacion.cotizacion_id"></b-form-select>
                <b-form-invalid-feedback :state="proyectoValidacion.cotizacion_id">
                    Selecciona una cotizacion
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="proyectoValidacion.cotizacion_id">
                    OK!.
                </b-form-valid-feedback>
            </div>
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="nombre_proyecto">Nombre del proyecto</label>
                <b-form-input v-model="proyecto.nombre" :state="proyectoValidacion.nombre" id="nombre_proyecto"></b-form-input>
                <b-form-invalid-feedback :state="proyectoValidacion.nombre">
                    El campo no puede estar vacio
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="proyectoValidacion.nombre">
                    OK!.
                </b-form-valid-feedback>
            </div>
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="fecha_inicial">Fecha inicial</label>
                <b-form-datepicker id="fecha_inicial" class="mb-2" :state="proyectoValidacion.fecha_inicial" v-model="proyecto.fecha_inicial" placeholder="Selecciona una fecha"></b-form-datepicker>
                <b-form-invalid-feedback :state="proyectoValidacion.fecha_inicial">
                    El campo no puede estar vacio
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="proyectoValidacion.fecha_inicial">
                    OK!.
                </b-form-valid-feedback>
            </div>
            <div class="col-12 col-lg-6 mb-sm-2">
                <label for="fecha_final">Fecha final</label>
                <b-form-datepicker id="fecha_final" class="mb-2" :state="proyectoValidacion.fecha_final" v-model="proyecto.fecha_final" placeholder="Selecciona una fecha"></b-form-datepicker>
                <b-form-invalid-feedback :state="proyectoValidacion.fecha_final">
                    El campo no puede estar vacio
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="proyectoValidacion.fecha_final">
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
            proyectoValidacion:{
                'nombre' : null,
                'cotizacion_id' : null,
                'fecha_inicial': null,
                'fecha_final' : null
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
                this.proyecto.nombre != '' &&
                this.proyecto.cotizacion_id != '' &&
                this.proyecto.fecha_inicial != '' &&
                this.proyecto.fecha_final != ''
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
                this.validar()
            }
        },

        validar(){
            this.proyectoValidacion.nombre = (this.proyecto.nombre == '')? false : true
            this.proyectoValidacion.cotizacion_id = (this.proyecto.cotizacion_id == '')? false : true
            this.proyectoValidacion.fecha_inicial = (this.proyecto.fecha_inicial == '')? false : true
            this.proyectoValidacion.fecha_final = (this.proyecto.fecha_final == '')? false : true
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
}
</script>
