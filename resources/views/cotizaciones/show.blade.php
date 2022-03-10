@extends('layouts.app')

@section('title', 'Cotizaciones')

@section('head')
@endsection

@section('page-title', 'Cotizaciones')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Cotizacion</h6>
            </div>
            <div class="card-body">
                <div class="text-center col-12">
                    <h4>Datos Financieros</h4>
                </div>
                <div class="row p-4">
                    <div class="col-4">
                        <h4>Nombre a facturar</h4>
                        <p class="text-muted mt-1">{{$cotizacion->nombre_facturar}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Cliente del proyecto</h4>
                        <p class="text-muted mt-1">{{$cotizacion->cliente_proyecto}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Nit ó Cédula</h4>
                        <p class="text-muted mt-1">{{$cotizacion->documento}}</p>
                    </div>
                    <div class="col-4">
                        <h4>Direccion</h4>
                        <p class="text-muted mt-1">{{$cotizacion->direccion}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Telefono</h4>
                        <p class="text-muted mt-1">{{$cotizacion->telefono}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Email</h4>
                        <p class="text-muted mt-1">{{$cotizacion->email}}</p>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($cotizacion['subCotizaciones'] as $sub_cotizacion)
                        <li class="nav-item">
                            <a class="nav-link" id="{{$sub_cotizacion->area}}-tab" data-toggle="tab" href="#{{$sub_cotizacion->area}}" role="tab" aria-controls="home" aria-selected="true">{{$sub_cotizacion->area}}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" id="consolidado-tab" data-toggle="tab" href="#consolidado" role="tab" aria-controls="home" aria-selected="true">consolidado</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    @foreach ($cotizacion['subCotizaciones'] as $sub_cotizacion)
                        <div class="tab-pane fade" id="{{$sub_cotizacion->area}}" role="tabpanel" aria-labelledby="{{$sub_cotizacion->area}}-tab">
                            <div class="table-responsive p-4">
                                <table class="table table-bordered tables-productos" id="{{$sub_cotizacion->area}}" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Referencia</th>
                                            <th>Descripcion</th>
                                            <th>Referencia</th>
                                            <th>Marca</th>
                                            <th>Ubicacion</th>
                                            <th>Cant</th>
                                            <th>Valor unidad</th>
                                            <th>Valor Total</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Foto</th>
                                            <td>Nombre</td>
                                            <th>Descripcion</th>
                                            <th>Referencia</th>
                                            <th>Marca</th>
                                            <th>Ubicacion</th>
                                            <th>Cant</th>
                                            <th>Valor unidad</th>
                                            <th>Valor Total</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($sub_cotizacion->productos as $producto)
                                            <tr>
                                                <td>{{$producto->productos->foto}}</td>
                                                <td>{{$producto->productos->nombre}}</td>
                                                <td>{{$producto->productos->descripcion}}</td>
                                                <td>{{$producto->productos->referencia}}</td>
                                                <td>{{$producto->productos->marca}}</td>
                                                <td>{{$producto->ubicacion}}</td>
                                                <td>{{$producto->cantidad}}</td>
                                                <td>por definir...</td>
                                                <td>por definir...</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                    <div class="tab-pane fade" id="consolidado" role="tabpanel" aria-labelledby="consolidado-tab">
                        <div class="table-responsive p-4">
                            <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Area</th>
                                        <th>Descripcion</th>
                                        <th>Observaciones</th>
                                        <th>Valor unitario</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Area</th>
                                        <th>Descripcion</th>
                                        <th>Observaciones</th>
                                        <th>Valor unitario</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($cotizacion['subCotizaciones'] as $sub_cotizacion)
                                        <tr>
                                            <td>{{$sub_cotizacion->area}}</td>
                                            <td>{{$sub_cotizacion->descripcion}}</td>
                                            <td>Por definir</td>
                                            <td>por definir...</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".tables-productos").DataTable()
    });
</script>
@endsection
