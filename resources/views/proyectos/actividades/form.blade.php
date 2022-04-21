@extends('layouts.app')

@section('title', 'Proyectos - Actividad')

@section('head')
@endsection

@section('page-title', 'Proyectos - Actividad')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 text-primary">Actividad</h6>
                </div>
                <div class="card-body" id="app">
                    <proyectos-actividades-form @isset($actividad)
                    :actividad_props="{{$actividad}}"
                @endisset></proyectos-actividades-form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection
