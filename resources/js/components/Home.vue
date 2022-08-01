<template>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4" >
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body" v-if="load">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Dolar (COP)
                        </div>
                        <div class="h5 mb-1 font-weight-bold text-gray-800">{{dolar.valor}}</div>
                        <div class="font-weight-bold text-gray-500">
                            {{dolar.vigencia_desde}} - {{dolar.vigencia_hasta}}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4" @click="verCalendario" style="cursor: pointer;">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body" v-if="load">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Calendario
                        </div>
                        <div class="font-weight-bold text-gray-500">
                            Ver calendario
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</template>

<script>
    export default {
        props:['date'],
        data(){
            return{
                dolar:{},
                load: false,
                show: true,
            }
        },
        created(){
            this.getTRM()
        },
        methods:{
            getTRM(){
                axios.get(`https://www.datos.gov.co/resource/32sa-8pi3.json?vigenciadesde=2022-07-30T00:00:00.000`).then(res=>{
                    if(res.data.length > 0){
                        this.dolar={
                            'valor' : res.data[0].valor,
                            'unidad' : res.data[0].unidad,
                            'vigencia_desde' : res.data[0].vigenciadesde,
                            'vigencia_hasta' : res.data[0].vigenciahasta,
                        }
                        this.storeTRM()
                    }else{
                        this.getTRMDolar()
                    }
                })
            },
            storeTRM(){
                axios.post('/TRM/store', this.dolar).then(res=>{
                    if(res.data.status){
                        this.dolar = res.data.trm
                        this.load = true
                    }else{
                        this.getTRMDolar()
                    }
                })
            },
            getTRMDolar(){
                axios.get('/TRM/get').then(res=>{
                    this.dolar = res.data.trm
                    this.load = true

                })
            },
            verCalendario(){
                window.open('https://calendar.google.com/calendar/u/0/embed?src=c_lra5iagliorc6qpfjt1opcjr0o@group.calendar.google.com&ctz=America/Bogota&pli=1', '_blank');
            }
        }
    }
</script>
