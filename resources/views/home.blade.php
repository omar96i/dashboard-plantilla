@extends('layouts.app')

@section('title', 'Inicio')

@section('head')
@endsection

@section('page-title', 'Inicio')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
                </div>
                <div class="card-body" id="app">
                    <home-index date="{{$date}}"></home-index>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection

