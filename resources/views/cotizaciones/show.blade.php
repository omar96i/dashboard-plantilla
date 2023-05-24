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
                <h6 class="m-0 font-weight-bold text-primary">Cotización</h6>
            </div>
            <div class="card-body">
                <div class="text-center col-12">
                    <h4>Datos Financieros</h4>
                </div>
                <div class="row p-4">
                    <div class="col-4" style="border-left: 0.01cm solid;">
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
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Dirección</h4>
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
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Dolar</h4>
                        <p class="text-muted mt-1">{{$cotizacion->dolar->valor}}</p>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach ($cotizacion['subCotizaciones'] as $sub_cotizacion)
                        <li class="nav-item">
                            <a class="nav-link" id="{{$sub_cotizacion->area}}-tab" data-toggle="tab" href="#{{$sub_cotizacion->area}}" role="tab" aria-controls="home" aria-selected="true">{{ucfirst($sub_cotizacion->area)}}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" id="abonos-tab" data-toggle="tab" href="#abonos" role="tab" aria-controls="home" aria-selected="true">Abonos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="consolidado-tab" data-toggle="tab" href="#consolidado" role="tab" aria-controls="home" aria-selected="true">Consolidado</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="planos-tab" data-toggle="tab" href="#planos" role="tab" aria-controls="home" aria-selected="true">Planos</a>
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
                                            <th>Cant. Asignada</th>
                                            <th>Cant. Usada</th>
                                            <th>Cant. Disponible</th>
                                            <th>Valor unidad</th>
                                            <th>Valor Total</th>
                                            <th>Valor unidad</th>
                                            <th>Valor Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub_cotizacion->productos as $producto)
                                            <tr>
                                                <td><img src="{{($producto->productos->foto == "default.png")? '/img/img_productos/default.png': 'https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/'.$producto->productos->foto}}" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                                                <td>{{$producto->productos->nombre}}</td>
                                                <td>{{$producto->productos->descripcion}}</td>
                                                <td>{{$producto->productos->referencia}}</td>
                                                <td>{{$producto->productos->marca}}</td>
                                                <td>{{$producto->ubicacion}}</td>
                                                <td>
                                                    @if ($producto->cantidad > $producto->productos->cantidad)
                                                        <div class="alert alert-danger" role="alert">
                                                            {{$producto->cantidad}}
                                                        </div>
                                                    @else
                                                        <div class="alert alert-success" role="alert">
                                                            {{$producto->cantidad}}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{$producto->cantidad_usada}}</td>
                                                <td>
                                                    @if ($producto->cantidad > $producto->productos->cantidad)
                                                        <div class="alert alert-danger" role="alert">
                                                            {{$producto->productos->cantidad}}
                                                        </div>
                                                    @else
                                                        <div class="alert alert-success" role="alert">
                                                            {{$producto->productos->cantidad}}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td><small>USD</small> {{($producto->productos->valores[0]->tipo == 'dolar')? $producto->productos->valores[0]->valor: '-'}}</td>
                                                <td><small>USD</small> {{($producto->productos->valores[0]->tipo == 'dolar')? $producto->productos->valores[0]->valor * $producto->cantidad: '-'}}</td>
                                                <td>{{($producto->productos->valores[0]->tipo == 'dolar')? $producto->productos->valores[0]->valor * $cotizacion->dolar->valor : $producto->productos->valores[0]->valor}}</td>
                                                <td>{{($producto->productos->valores[0]->tipo == 'dolar')? ($producto->productos->valores[0]->valor * $producto->cantidad) * $cotizacion->dolar->valor : $producto->productos->valores[0]->valor*$producto->cantidad}}</td>
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
                                        <th>Área</th>
                                        <th>Descripción</th>
                                        <th>Valor unitario</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Área</th>
                                        <th>Descripción</th>
                                        <th>Valor unitario</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cotizacion['subCotizaciones'] as $sub_cotizacion)
                                        <tr>
                                            <td>{{$sub_cotizacion->area}}</td>
                                            <td>{{$sub_cotizacion->descripcion}}</td>
                                            <td>
                                                @php
                                                    $sub_cotizacion_total = 0;
                                                    foreach ($sub_cotizacion->productos as $key => $producto) {
                                                        if($producto->productos->valores[0]->tipo == 'dolar'){
                                                            $sub_cotizacion_total = $sub_cotizacion_total + (($producto->productos->valores[0]->valor * $producto->cantidad) * $cotizacion->dolar->valor);
                                                        }else{
                                                            $sub_cotizacion_total = $sub_cotizacion_total + $producto->productos->valores[0]->valor * $producto->cantidad;
                                                        }
                                                    }
                                                    $total = $total + $sub_cotizacion_total;
                                                @endphp
                                                {{$sub_cotizacion_total}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-info" role="alert">
                            Total: {{$total}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="abonos" role="tabpanel" aria-labelledby="abonos-tab">
                        <div class="table-responsive p-4">
                            <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Valor</th>
                                        <th>Observacion</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha</th>
                                        <th>Valor</th>
                                        <th>Observacion</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($cotizacion['abonos'] as $abono)
                                        <tr>
                                            <td>{{$abono->nombre}}</td>
                                            <td>{{$abono->fecha}}</td>
                                            <td>{{$abono->valor}}</td>
                                            <td>{{$abono->observacion}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="planos" role="tabpanel" aria-labelledby="planos-tab">
                        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4" v-if="loading_files">
                            @foreach ($cotizacion['files'] as $file)
                            <div class="col">
                                <div class="card">
                                    <div style="z-index: 1; position: absolute;">
                                        <a target="_blank" href="https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/{{$file->file}}" class="btn btn-info btn-circle">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                    <img src="https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/{{$file->file}}" alt="Image 1" style="height:300px;">
                                </div>
                            </div>
                            @endforeach
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
