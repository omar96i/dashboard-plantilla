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
                <div class="card-body" id="app">
                    <div class="col-12 mb-2 text-center">
                        <a class="btn btn-success {{$tipo == 'unread' ? 'active' : ''}}" href="{{route('notificaciones.index')}}"> No leidas</a>
                        <a class="btn btn-success {{$tipo == 'read' ? 'active' : ''}}" href="{{route('notificaciones.index', ['tipo' => 'read'])}}"> Leidas</a>
                    </div>
                    @forelse ($notificaciones as $notificacion)
                        <div>
                            <div class="card mb-4 py-3 {{ $notificacion->data['accion'] == 'insert'? 'border-bottom-success': '' }} {{ $notificacion->data['accion'] == 'update'? 'border-bottom-info': '' }} {{ $notificacion->data['accion'] == 'delete'? 'border-bottom-danger': '' }} card-hover" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="mr-3">
                                            <div class="icon-circle {{ $notificacion->data['accion'] == 'insert'? 'bg-success': '' }} {{ $notificacion->data['accion'] == 'update'? 'bg-info': '' }} {{ $notificacion->data['accion'] == 'delete'? 'bg-danger': '' }}">
                                                <i class="fas fa-info-circle text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">{{ $notificacion->created_at->diffForHumans() }}</div>
                                            <span class="">{{ ($notificacion->data['tabla'] == 'users')? 'El usuario '.$notificacion->data['email'].' a sido': ''}}{{ ($notificacion->data['tabla'] == 'cotizaciones')? 'La cotizacion con el nombre del cliente "'.$notificacion->data['cliente_proyecto'].'" a sido': ''}} {{($notificacion->data['accion'] == 'insert')? 'creado': ''}}{{($notificacion->data['accion'] == 'update')? 'actualizado': ''}}{{($notificacion->data['accion'] == 'delete')? 'eliminado': ''}}</span>
                                            <div class="small text-gray-500">{{ $notificacion->created_at }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-menu dropdown-menu-left shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                <div class="dropdown-header">Acciones:</div>
                                <a class="dropdown-item" href="{{route('notificaciones.show', ['id'=>$notificacion->id])}}"><i class="fa-solid fa-eye"></i> Ver</a>
                                @if ($tipo == 'unread')
                                    <a class="dropdown-item" href="{{ route('notificaciones.read', ['id' => $notificacion->id]) }}"><i class="fa-solid fa-check"></i> Marcar como leida</a>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center">
                            Sin notificaciones
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection

