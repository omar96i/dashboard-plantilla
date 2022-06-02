@extends('layouts.app')

@section('title', 'Productos - Reabastecimientos')

@section('head')
@endsection

@section('page-title', 'Productos - Reabastecimientos')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Reabastecimientos</h6>
                </div>
                <div class="card-body" id="app">
                    <productos-reabastecimientos-index></productos-reabastecimientos-index>
                </div>
            </div>
        </div>
    </div>


@endsection
