@extends('layouts.app')

@section('title', 'Roles')

@section('head')
@endsection

@section('page-title', 'Roles')

@section('content')
    <div class="row">
        <div class="col-12" id="app">
            <roles-index></roles-index>
        </div>
    </div>

@endsection

@section('scripts')
<script src="{{ mix('js/role.js') }}"></script>
@endsection

