<template>
    <div>
        <!-- Modal Condiciones -->
        <div class="modal fade" id="modalCondiciones" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel"> Condiciones</h5>
                        <button type="button" class="close" @click="$parent.closeModalSubCotizacion()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group row">
                                <div class="col-12 col-sm-6">
                                    <label for="a-i" class="col-form-label">Color:</label>
                                    <b-form-select :options="options"></b-form-select>
                                    <b-form-invalid-feedback >
                                        Se debe seleccionar una opcion!
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback >
                                        Esta bien!
                                    </b-form-valid-feedback>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <label for="nombre_proyecto">Cantidad</label>
                                    <b-form-input id="nombre_proyecto" type="number"></b-form-input>
                                    <b-form-invalid-feedback >
                                        El campo no puede estar vacio
                                    </b-form-invalid-feedback>
                                    <b-form-valid-feedback >
                                        OK!.
                                    </b-form-valid-feedback>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="$parent.closeModalSubCotizacion()">Cerrar</button>
                        <button type="button" class="btn btn-success" @click="storeCotizacion()">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                options: [
                    {
                        value : 'success', text : 'Verde'
                    },
                    {
                        value : 'danger', text : 'Rojo'
                    },
                    {
                        value : 'warning', text : 'Naranja'
                    },
                ],
                condicion: {
                    'color': '',
                    'cantidad': ''
                },
                condicionValidacion: {
                    'color': null,
                    'cantidad': null
                }
            }
        },

        methods:{
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
