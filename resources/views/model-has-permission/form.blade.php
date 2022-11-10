<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('permission_id') }}
            {{ Form::text('permission_id', $modelHasPermission->permission_id, ['class' => 'form-control' . ($errors->has('permission_id') ? ' is-invalid' : ''), 'placeholder' => 'Permission Id']) }}
            {!! $errors->first('permission_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('model_type') }}
            {{ Form::text('model_type', $modelHasPermission->model_type, ['class' => 'form-control' . ($errors->has('model_type') ? ' is-invalid' : ''), 'placeholder' => 'Model Type']) }}
            {!! $errors->first('model_type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('model_id') }}
            {{ Form::text('model_id', $modelHasPermission->model_id, ['class' => 'form-control' . ($errors->has('model_id') ? ' is-invalid' : ''), 'placeholder' => 'Model Id']) }}
            {!! $errors->first('model_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>