@extends('layouts.app')

@section('title', 'Asistencia')

@section('head')
@endsection

@section('page-title', 'Asistencia')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Asistencia</h6>
                </div>
                <div class="card-body" id="app">
                    <proyectos-actividades-asistencia></proyectos-actividades-asistencia>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection

