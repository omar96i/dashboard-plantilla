@extends('layouts.app')

@section('title', 'Reportes')

@section('head')
@endsection

@section('page-title', 'Reportes')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Reportes</h6>
                </div>
                <div class="card-body" id="app">
                    <proyectos-reportes></proyectos-reportes>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection

