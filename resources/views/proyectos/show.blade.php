@extends('layouts.app')

@section('title', 'Proyecto')

@section('head')
@endsection

@section('page-title', 'Proyecto')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Proyecto</h6>
            </div>
            <div class="card-body">
                <div class="text-center col-12">
                    <h4>Datos del Proyecto</h4>
                </div>
                <div class="row p-4">
                    <div class="col-4">
                        <h4>Nombre</h4>
                        <p class="text-muted mt-1">{{$proyecto->nombre}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Creado por</h4>
                        <p class="text-muted mt-1">{{$proyecto->whoCreated->informacionPersonal->nombres}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Fecha Inicial</h4>
                        <p class="text-muted mt-1">{{$proyecto->fecha_inicial}}</p>
                    </div>
                    <div class="col-4">
                        <h4>Fecha Final</h4>
                        <p class="text-muted mt-1">{{$proyecto->fecha_final}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Estado</h4>
                        <p class="text-muted mt-1">{{$proyecto->estado}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Cotizacion</h4>
                        <p class="text-muted mt-1"><a href="{{route('cotizaciones.show', ['cotizacion' => $proyecto->cotizacion->id])}}" target="_blank">Ver detalles...</a></p>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="planos-tab" data-toggle="tab" href="#planos" role="tab" aria-controls="home" aria-selected="true">Planos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="planos-cotizacion-tab" data-toggle="tab" href="#planos-cotizacion" role="tab" aria-controls="home" aria-selected="true">Planos cotizacion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="inventario-tab" data-toggle="tab" href="#inventario" role="tab" aria-controls="home" aria-selected="true">Inventario general</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="actividades-tab" data-toggle="tab" href="#actividades" role="tab" aria-controls="home" aria-selected="true">Actividades</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="planos" role="tabpanel" aria-labelledby="planos-tab">
                        <div class="table-responsive p-4">
                            <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Creado por</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Creado por</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($proyecto->planos as $plano)
                                        <tr>
                                            <td>{{$plano->whoCreated->informacionPersonal->nombres}}</td>
                                            <td>{{$plano->descripcion}}</td>
                                            <td>{{$plano->estado}}</td>
                                            <td class="text-center">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                        <div class="dropdown-header">Acciones:</div>
                                                        <a class="dropdown-item" href="https://res.cloudinary.com/dcj3tck83/image/upload/v1649869726/{{$plano->file}}" target="_blank"><i class="fa-solid fa-eye"></i> Ver Documento</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="planos-cotizacion" role="tabpanel" aria-labelledby="planos-tab">
                        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4" v-if="loading_files">
                            @foreach ($proyecto->cotizacion->files as $file)
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
                    <div class="tab-pane fade" id="inventario" role="tabpanel" aria-labelledby="inventario-tab">
                        <div class="table-responsive p-4">
                            <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Referencia</th>
                                        <th>Marca</th>
                                        <th>Color</th>
                                        <th>Temperatura</th>
                                        <th>Voltaje</th>
                                        <th>Cantidad asignada</th>
                                        <th>Cantidad utilizada</th>
                                        <th>Ubicación</th>
                                        <th>Categoria</th>
                                        <th>Área</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Referencia</th>
                                        <th>Marca</th>
                                        <th>Color</th>
                                        <th>Temperatura</th>
                                        <th>Voltaje</th>
                                        <th>Cantidad asignada</th>
                                        <th>Cantidad utilizada</th>
                                        <th>Ubicación</th>
                                        <th>Categoria</th>
                                        <th>Área</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($inventario[0]->cotizacion->subCotizaciones as $sub_cotizacion)
                                        @foreach ($sub_cotizacion->productos as $producto)
                                            <tr>
                                                <td><img src="{{$producto->productos->foto == 'default.png'? '/img/img_productos/default.png': 'https://res.cloudinary.com/dcj3tck83/image/upload/v1649869726/'.$producto->productos->foto}}" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                                                <td>{{$producto->productos->nombre}}</td>
                                                <td>{{$producto->productos->descripcion}}</td>
                                                <td>{{$producto->productos->referencia}}</td>
                                                <td>{{$producto->productos->marca}}</td>
                                                <td>{{$producto->productos->color}}</td>
                                                <td>{{$producto->productos->temperatura_calor}}</td>
                                                <td>{{$producto->productos->voltaje}}</td>
                                                <td>{{$producto->cantidad}}</td>
                                                <td>{{$producto->cantidad_usada}}</td>
                                                <td>{{$producto->ubicacion}}</td>
                                                <td>{{$producto->productos->categoria != null ? $producto->productos->categoria['nombre'] : ''}}</td>
                                                <td>{{$sub_cotizacion->area}}</td>
                                                <td></td>
                                            </tr>
                                        @endforeach

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="actividades" role="tabpanel" aria-labelledby="actividades-tab">
                        <div class="table-responsive p-4">
                            <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha final</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Fecha inicio</th>
                                        <th>Fecha final</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($proyecto->actividades as $actividad)
                                        <tr>
                                            <td>{{$actividad->empleado->informacionPersonal->nombres.' '.$actividad->empleado->informacionPersonal->apellidos}}</td>
                                            <td>{{$actividad->descripcion}}</td>
                                            <td>{{$actividad->fecha_inicio}}</td>
                                            <td>{{$actividad->fecha_final}}</td>
                                            <td>{{$actividad->estado}}</td>
                                            <td class="text-center">
                                                <div class="dropdown no-arrow">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-600"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                        <div class="dropdown-header">Acciones:</div>
                                                        <a class="dropdown-item" href="{{route('proyectos.actividades.show', ['actividad' => $actividad->id])}}" target="_blank"><i class="fa-solid fa-eye"></i> Ver Actividad</a>
                                                    </div>
                                                </div>
                                            </td>
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
