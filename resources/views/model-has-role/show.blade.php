@extends('layouts.app')

@section('template_title')
    {{ $modelHasRole->name ?? 'Show Model Has Role' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Model Has Role</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('model-has-roles.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Role Id:</strong>
                            {{ $modelHasRole->role_id }}
                        </div>
                        <div class="form-group">
                            <strong>Model Type:</strong>
                            {{ $modelHasRole->model_type }}
                        </div>
                        <div class="form-group">
                            <strong>Model Id:</strong>
                            {{ $modelHasRole->model_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
