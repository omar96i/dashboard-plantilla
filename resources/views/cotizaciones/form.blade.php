@extends('layouts.app')

@section('title', 'Cotizaciones - Form')

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
                <div class="card-body">
                    <form action="">
                        <div class="form-group row">
							<div class="col-12 col-sm-4">
								<label for="a-i" class="col-form-label">Nombre cliente:</label>
								<input type="text" id="a-i" class="form-control" name="a-i" placeholder="Nombre cliente...">
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
							<div class="col-12 col-sm-4">
								<label for="b-i" class="col-form-label">Cliente del proyecto:</label>
								<input type="text" id="b-i" class="form-control" name="b-i" placeholder="Cliente del proyecto...">
                            	<div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
							<div class="col-12 col-sm-4">
								<label for="c-i" class="col-form-label">Nit ó Cédula:</label>
								<input type="text" name="c-i" id="c-i" class="form-control" placeholder="Nit o Cedula...">
                            	<div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
						</div>

                        <div class="form-group row">
							<div class="col-12 col-sm-4">
								<label for="d-i" class="col-form-label">Direccion:</label>
								<input type="text" id="d-i" class="form-control" name="d-i" placeholder="Nombre cliente...">
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
							<div class="col-12 col-sm-4">
								<label for="e-i" class="col-form-label">Telefono:</label>
								<input type="text" id="e-i" class="form-control" name="e-i" placeholder="Telefono...">
                            	<div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
							<div class="col-12 col-sm-4">
								<label for="f-i" class="col-form-label">Email:</label>
								<input type="text" name="f-i" id="f-i" class="form-control" placeholder="Email...">
                            	<div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
						</div>
                        <div class="col-12 text-center">
                            <button class="btn btn-success btn-sm">Guardar</button>
                        </div>
                    </form>

                    <hr>

                    <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Sub cotizacion</h6>
                        <button href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#modalSubCotizacion">
                            <span class="icon text-white-50">
                                <i class="fa-solid fa-plus"></i>
                            </span>
                            <span class="text">Sub cotizacion</span>
                        </button>
                    </div>

                    <div class="col-12 mb-5">
                        <div class="form-group row">
							<div class="col-12 col-sm-6">
								<label for="a-i" class="col-form-label">Selecciona el area:</label>
                                <select name="" id="" class="form-control">
                                    <option value="" selected>Sin seleccionar...</option>
                                </select>
                                <div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
							<div class="col-12 col-sm-6">
								<label for="e-i" class="col-form-label">Descripcion:</label>
								<input type="text" id="e-i" class="form-control" name="e-i" placeholder="Descripcion...">
                            	<div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
                            <div class="col-12">
								<label for="e-i" class="col-form-label">Observacion:</label>
                                <textarea name="" id="" rows="4" class="form-control" placeholder="Observacion..."></textarea>
                            	<div class="invalid-feedback">El campo no debe quedar vacío</div>
							</div>
                            <div class="col-12 text-center mt-4">
                                <button class="btn btn-success btn-sm">Guardar</button>
                            </div>
						</div>
                    </div>

                    <hr>

                    <div class="py-3 my-2 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Productos</h6>
                        <button href="#" class="btn btn-success btn-sm btn-icon-split" data-toggle="modal" data-target="#modalSubCotizacion">
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

    <!-- Modal Sub Cotizacion -->
    <div class="modal fade" id="modalSubCotizacion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Agregar Sub cotizacion</h5>
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

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#dataTable").DataTable()
        });
    </script>
@endsection
