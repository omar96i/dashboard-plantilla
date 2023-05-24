@extends('layouts.app')

@section('title', 'Actividad')

@section('head')
@endsection

@section('page-title', 'Actividad')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Actividad</h6>
            </div>
            <div class="card-body">
                <div class="text-center col-12">
                    <h4>Datos de la Actividad</h4>
                </div>
                <div class="row p-4">
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Asignado a</h4>
                        <p class="text-muted mt-1">{{$actividad->empleado->informacionPersonal->nombres.' '.$actividad->empleado->informacionPersonal->apellidos}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Creado por</h4>
                        <p class="text-muted mt-1">{{$actividad->whoCreated->informacionPersonal->nombres.' '.$actividad->whoCreated->informacionPersonal->apellidos}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Proyecto</h4>
                        @isset($actividad->proyecto)
                            <p class="text-muted mt-1">{{$actividad->proyecto->nombre}}</p>
                        @endisset
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Fecha inicio</h4>
                        <p class="text-muted mt-1">{{$actividad->fecha_inicio}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Fecha final</h4>
                        <p class="text-muted mt-1">{{$actividad->fecha_final}}</p>
                    </div>
                    <div class="col-4" style="border-left: 0.01cm solid;">
                        <h4>Estado</h4>
                        <p class="text-muted mt-1">{{$actividad->estado}}</p>
                    </div>
                    <div class="col-12" style="border-left: 0.01cm solid;">
                        <h4>Descripción</h4>
                        <p class="text-muted mt-1">{{$actividad->descripcion}}</p>
                    </div>
                </div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="files-tab" data-toggle="tab" href="#files" role="tab" aria-controls="home" aria-selected="true">Archivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="inventario-tab" data-toggle="tab" href="#inventario" role="tab" aria-controls="home" aria-selected="true">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reportes-tab" data-toggle="tab" href="#reportes" role="tab" aria-controls="home" aria-selected="true">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pruebas-tab" data-toggle="tab" href="#pruebas" role="tab" aria-controls="home" aria-selected="true">Pruebas</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="files" role="tabpanel" aria-labelledby="files-tab">
                        <div class="row row-cols-1 row-cols-md-2 g-4 mt-4">
                            @foreach ($actividad->files as $file)
                                <div class="col">
                                    <div class="card">
                                        @if ($file->tipo == "video/mp4")
                                            <video class="card-img-top" height="300px" controls style="height:300px;">
                                                <source src="https://res.cloudinary.com/dcj3tck83/video/upload/v1650564336/{{$file->file}}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <img src="https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/{{$file->file}}" alt="Image 1" style="height:300px;">
                                        @endif
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
                                        <th>Ubicación</th>
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
                                        <th>Ubicación</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($actividad->inventario as $producto)
                                        <tr>
                                            <td><img src="{{($producto->productos->productos->foto == "default.png")? '/img/img_productos/default.png': 'https://res.cloudinary.com/dcj3tck83/image/upload/v1650566179/'.$producto->productos->productos->foto}}" style="width: 70px; border-radius: 50%; height: 60px;"></td>
                                            <td>{{$producto->productos->productos->nombre}}</td>
                                            <td>{{$producto->productos->productos->descripcion}}</td>
                                            <td>{{$producto->productos->productos->referencia}}</td>
                                            <td>{{$producto->productos->productos->marca}}</td>
                                            <td>{{$producto->productos->productos->color}}</td>
                                            <td>{{$producto->productos->productos->temperatura_calor}}</td>
                                            <td>{{$producto->productos->productos->voltaje}}</td>
                                            <td>{{$producto->cantidad}}</td>
                                            <td>{{$producto->productos->ubicacion}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="reportes" role="tabpanel" aria-labelledby="reportes-tab">
                        <div class="table-responsive p-4">
                            <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($reportes as $reporte)
                                        <tr>
                                            <td>{{$reporte->usuario->informacionPersonal->nombres.' '.$reporte->usuario->informacionPersonal->apellidos}}</td>
                                            <td>{{$reporte->producto->productos->productos->nombre}}</td>
                                            <td>{{$reporte->cantidad}}</td>
                                            <td>{{$reporte->descripcion}}</td>
                                            <td>{{$reporte->fecha}}</td>
                                            <td>{{$reporte->estado}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pruebas" role="tabpanel" aria-labelledby="pruebas-tab">
                        <div id="app">
                            <proyecto-actividad-pruebas-table :pruebas="{{ $actividad->pruebas }}"></proyecto-actividad-pruebas-table>
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
