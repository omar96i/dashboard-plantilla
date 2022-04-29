@extends('layouts.app')

@section('title', 'Notificaciones')

@section('head')
@endsection

@section('page-title', 'Notificaciones')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Notificaciones</h6>
                </div>
                <div class="card-body row" id="app">
                    <div class="container col-6">
                        <div class="card mb-4 py-3 border-bottom-danger col-12">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row p-4">
                                        <div class="col-12 text-center">
                                            <h4 class="text-gray-500 font-size-tittle">Datos anteriores</h4>
                                        </div>
                                        @foreach ($notificacion as $notif)
                                            @if ($notif->data['tabla'] == 'users')
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Documento</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_documento'])?'sin definir':$notif->data['old_documento']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Nombres</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_nombres'])?'sin definir':$notif->data['old_nombres']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Apellidos</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_apellidos'])?'sin definir':$notif->data['old_apellidos']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Telefono</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_telefono'])?'sin definir':$notif->data['old_telefono']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Sexo</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_sexo'])?'sin definir':$notif->data['old_sexo']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Fecha nacimiento</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_fecha_nacimiento'])?'sin definir':$notif->data['old_fecha_nacimiento']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Ciudad</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_ciudad'])?'sin definir':$notif->data['old_ciudad']}}</p>
                                                </div>
                                            @endif
                                            @if ($notif->data['tabla'] == 'cotizaciones')
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Nombre a facturar</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_nombre_facturar'])?'sin definir':$notif->data['old_nombre_facturar']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Cliente del proyecto</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_cliente_proyecto'])?'sin definir':$notif->data['old_cliente_proyecto']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Documento</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_documento'])?'sin definir':$notif->data['old_documento']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Direccion</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_direccion'])?'sin definir':$notif->data['old_direccion']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Telefono</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_telefono'])?'sin definir':$notif->data['old_telefono']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Fecha</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_fecha'])?'sin definir':$notif->data['old_fecha']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Email</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_email'])?'sin definir':$notif->data['old_email']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Estado</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['old_estado'])?'sin definir':$notif->data['old_estado']}}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container col-6">
                        <div class="card mb-4 py-3 border-bottom-success col-12">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row p-4">
                                        <div class="col-12 text-center">
                                            <h4 class="text-gray-500 font-size-tittle">Datos Nuevos</h4>
                                        </div>
                                        @foreach ($notificacion as $notif)
                                            @if ($notif->data['tabla'] == 'users')
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Documento</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['documento'])?'sin definir':$notif->data['documento']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Nombres</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['nombres'])?'sin definir':$notif->data['nombres']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Apellidos</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['apellidos'])?'sin definir':$notif->data['apellidos']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Telefono</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['telefono'])?'sin definir':$notif->data['telefono']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Sexo</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['sexo'])?'sin definir':$notif->data['sexo']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Fecha nacimiento</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['fecha_nacimiento'])?'sin definir':$notif->data['fecha_nacimiento']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Ciudad</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['ciudad'])?'sin definir':$notif->data['ciudad']}}</p>
                                                </div>
                                            @endif
                                            @if ($notif->data['tabla'] == 'cotizaciones')
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Nombre a facturar</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['nombre_facturar'])?'sin definir':$notif->data['nombre_facturar']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Cliente del proyecto</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['cliente_proyecto'])?'sin definir':$notif->data['cliente_proyecto']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Documento</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['documento'])?'sin definir':$notif->data['documento']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Direccion</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['direccion'])?'sin definir':$notif->data['direccion']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Telefono</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['telefono'])?'sin definir':$notif->data['telefono']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Fecha</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['fecha'])?'sin definir':$notif->data['fecha']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Email</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['email'])?'sin definir':$notif->data['email']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Estado</h4>
                                                    <p class="text-muted mt-1">{{(!$notif->data['estado'])?'sin definir':$notif->data['estado']}}</p>
                                                </div>
                                                <div class="col-4" style="border-left: 0.01cm solid;">
                                                    <h4 class="text-gray-500 font-size-tittle">Detalles</h4>
                                                    <p class="text-muted mt-1"><a href="{{route('cotizaciones.show', $notif->data['id'])}}">Ver mas...</a></p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

