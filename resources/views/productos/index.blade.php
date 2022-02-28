@extends('layouts.app')

@section('title', 'Productos')

@section('head')
@endsection

@section('page-title', 'Productos')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Cotizacion</h6>
                </div>
                <div class="card-body">

                    <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Productos</h6>
                        <button href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#modalProductos">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="text">Producto</span>
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Referencia</th>
                                    <th>Descripcion</th>
                                    <th>Marca</th>
                                    <th>Ubicacion</th>
                                    <th>Cant</th>
                                    <th>Valor unidad</th>
                                    <th>Valor Total</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Foto</th>
                                    <th>Referencia</th>
                                    <th>Descripcion</th>
                                    <th>Marca</th>
                                    <th>Ubicacion</th>
                                    <th>Cant</th>
                                    <th>Valor unidad</th>
                                    <th>Valor Total</th>

                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>Foto</td>
                                    <td>Referencia</td>
                                    <td>descripcion</td>
                                    <td>Marca</td>
                                    <td><input type="text" class="form-control" value="Salon"></td>
                                    <td><input type="text" class="form-control" value="4"></td>
                                    <td>Valor unidad</td>
                                    <td>Valor Total</td>
                                </tr>
                                <tr>
                                    <td>Foto</td>
                                    <td>Referencia</td>
                                    <td>descripcion</td>
                                    <td>Marca</td>
                                    <td><input type="text" class="form-control" value="salon"></td>
                                    <td><input type="text" class="form-control" value="4"></td>
                                    <td>Valor unidad</td>
                                    <td>Valor Total</td>
                                </tr>
                                <tr>
                                    <td>Foto</td>
                                    <td>Referencia</td>
                                    <td>descripcion</td>
                                    <td>Marca</td>
                                    <td><input type="text" class="form-control" value="salon"></td>
                                    <td><input type="text" class="form-control" value="4"></td>
                                    <td>Valor unidad</td>
                                    <td>Valor Total</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Producto -->
    <div class="modal fade" id="modalProductos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group row">
                            <div class="col-12 col-sm-6">
                                <label for="a-i" class="col-form-label">Selecciona el area:</label>
                                <select name="" id="" class="form-control">
                                    <option value="" selected>Selecciona el area</option>
                                </select>
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="b-i" class="col-form-label">Descripcion:</label>
                                <input type="text" id="b-i" class="form-control" name="b-i" placeholder="Descripcion...">
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success">Agregar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

