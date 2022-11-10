@extends('layouts.app')

@section('template_title')
    Model Has Permission
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Model Has Permission') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('model-has-permissions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Permission Id</th>
										<th>Model Type</th>
										<th>Model Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modelHasPermissions as $modelHasPermission)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $modelHasPermission->permission_id }}</td>
											<td>{{ $modelHasPermission->model_type }}</td>
											<td>{{ $modelHasPermission->model_id }}</td>

                                            <td>
                                                <form action="{{ route('model-has-permissions.destroy',$modelHasPermission->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('model-has-permissions.show',$modelHasPermission->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('model-has-permissions.edit',$modelHasPermission->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $modelHasPermissions->links() !!}
            </div>
        </div>
    </div>
@endsection
