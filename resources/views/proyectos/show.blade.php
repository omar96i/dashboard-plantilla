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
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="planos" role="tabpanel" aria-labelledby="planos-tab">
                        <div class="table-responsive p-4">
                            <table class="table table-bordered tables-productos" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Creado por</th>
                                        <th>Descripcion</th>
                                        <th>Estado</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Creado por</th>
                                        <th>Descripcion</th>
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
