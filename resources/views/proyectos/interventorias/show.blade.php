<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Interventoria</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- FontsAwesome styles -->
        <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Css -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- DataTable -->
        <link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    </head>
    <body>
        <div class="container">
            <div class="row border border-secondary">
                <div class="col-3 d-flex align-items-center border border-secondary">
                    <img src="{{asset('img/icons/icon.png')}}" style="height:100px;">
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-12 text-center border border-secondary">
                            <h4>UTOPIA SOUND & LIGHT S.A.S</h4>
                        </div>
                        <div class="col-8 d-flex align-items-center justify-content-center border border-secondary" style="font-size: 0.8em">
                            <strong>Interventoria / Visita Obra</strong>
                        </div>
                        <div class="col-4 text-center d-flex justify-content-center border border-secondary">
                            <table>
                                <tr>
                                    <td class="text-center" style="font-size: 0.8em"><strong>Codigo: </strong></td>
                                    <td class="text-center" style="font-size: 0.7em">{{$interventoria->id}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="font-size: 0.8em"><strong>Version: </strong></td>
                                    <td class="text-center" style="font-size: 0.7em">1</td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="font-size: 0.8em"><strong>Fecha de creacion: </strong></td>
                                    <td class="text-center" style="font-size: 0.7em">{{$interventoria->created_at}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="font-size: 0.8em"><strong>Fecha de modificacion: </strong></td>
                                    <td class="text-center" style="font-size: 0.7em">{{$interventoria->updated_at}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center border border-secondary py-2" style="font-size: 0.7em">
                    <strong>DATOS GENERALES</strong>
                </div>
                <div class="col-3 text-center border border-secondary" style="font-size: 0.8em">
                    Fecha y hora inicio
                </div>
                <div class="col-3 text-center border border-secondary" style="font-size: 0.8em">
                    {{$interventoria->fecha_inicio}} {{$interventoria->hora_inicio}}
                </div>
                <div class="col-3 text-center border border-secondary" style="font-size: 0.8em">
                    Fecha y hora fin
                </div>
                <div class="col-3 text-center border border-secondary" style="font-size: 0.8em">
                    {{$interventoria->fecha_final}} {{$interventoria->hora_final}}
                </div>
                <div class="col-3 text-center border border-secondary" style="font-size: 0.8em">
                    Obra
                </div>
                <div class="col-9 text-center border border-secondary" style="font-size: 0.8em">
                    {{$interventoria->proyecto->nombre}}
                </div>
                <div class="col-3 text-center border border-secondary" style="font-size: 0.8em">
                    Quien Realiza Interventoria
                </div>
                <div class="col-9 text-center border border-secondary" style="font-size: 0.8em">
                    {{$interventoria->usuario->informacionPersonal->nombres}} {{$interventoria->usuario->informacionPersonal->apellidos}}
                </div>
                <div class="col-3 text-center border border-secondary" style="font-size: 0.8em">
                    Proceso al que pertenece el requerimiento
                </div>
                <div class="col-9 text-center border border-secondary" style="font-size: 0.8em">
                    <div class="row">
                        <div class="col-4">
                            Dirección Comercial
                            @if ($interventoria->checkout_1 == 'Dirección Comercial')
                                <i class="fa-solid fa-square-check"></i>
                            @else
                                <i class="fa-regular fa-square"></i>
                            @endif
                        </div>
                        <div class="col-4">
                            Dirección Ingenieria
                            @if ($interventoria->checkout_1 == 'Dirección Ingenieria')
                                <i class="fa-solid fa-square-check"></i>
                            @else
                                <i class="fa-regular fa-square"></i>
                            @endif
                        </div>
                        <div class="col-4">
                            Dirección Administrativa
                            @if ($interventoria->checkout_1 == 'Dirección Administrativa')
                                <i class="fa-solid fa-square-check"></i>
                            @else
                                <i class="fa-regular fa-square"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center border border-secondary py-2" style="font-size: 0.7em">
                    <strong>Revisión de obra</strong>
                </div>
                <div class="col-12 text-center border border-secondary" style="font-size: 0.8em; min-height: 180px;">
                    {{$interventoria->descripcion_1}}
                </div>
                <div class="col-12 text-center border border-secondary py-2" style="font-size: 0.8em;">
                    Se informo a la persona encargada de obra? Si
                    @if ($interventoria->checkout_2 == 'Si')
                        <i class="fa-solid fa-square-check"></i>
                    @else
                        <i class="fa-regular fa-square"></i>
                    @endif
                    No
                    @if ($interventoria->checkout_2 == 'No')
                        <i class="fa-solid fa-square-check"></i>
                    @else
                        <i class="fa-regular fa-square"></i>
                    @endif
                </div>
                <div class="col-12 text-center border border-secondary py-2" style="font-size: 0.7em">
                    <strong>OBSERVACION CLIENTE / ENCARGADO</strong>
                </div>
                <div class="col-12 text-center border border-secondary" style="font-size: 0.8em; height: 180px;">
                    {{$interventoria->descripcion_2}}
                </div>
                <div class="col-12 text-center border border-secondary">
                    <div class="row">
                        <div class="col-3 border border-secondary" style="font-size: 0.8em;">
                            NOMBRE CLIENTE:
                        </div>
                        <div class="col-3 border border-secondary" style="font-size: 0.8em;">
                            {{$interventoria->proyecto->cotizacion->cliente_proyecto}}
                        </div>
                        <div class="col-3 border border-secondary" style="font-size: 0.8em;">
                            NOMBRE TECNICO UTOPÍA:
                        </div>
                        <div class="col-3 border border-secondary" style="font-size: 0.8em;">
                            {{$interventoria->usuario->informacionPersonal->nombres}} {{$interventoria->usuario->informacionPersonal->apellidos}}
                        </div>
                        <div class="col-3 border border-secondary d-flex align-items-center justify-content-center" style="font-size: 0.8em; height: 60px;">
                            FIRMA CLIENTE:
                        </div>
                        <div class="col-3 border border-secondary" style="font-size: 0.8em; height: 60px;">
                            <img src="https://res.cloudinary.com/dcj3tck83/image/upload/v1649869726/{{$interventoria->firma_cliente}}" class="img-fluid" alt="">
                        </div>
                        <div class="col-3 border border-secondary d-flex align-items-center justify-content-center" style="font-size: 0.8em; height: 60px;">
                            FIRMA TECNICO UTOPÍA:
                        </div>
                        <div class="col-3 border border-secondary" style="font-size: 0.8em; height: 60px;">
                            <img src="https://res.cloudinary.com/dcj3tck83/image/upload/v1649869726/{{$interventoria->firma_operario}}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('plugins/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>


        <!-- Page level plugins -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    </body>
</html>

