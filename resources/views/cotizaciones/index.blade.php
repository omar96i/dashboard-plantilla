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
                <div class="card-body" id="app">
                    <cotizaciones-index></cotizaciones-index>
                </div>
            </div>
        </div>
    </div>
@endsection
