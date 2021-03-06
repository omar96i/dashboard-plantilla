<!DOCTYPE html>
<html lang="en">
<head>
    <title>Plantilla - @yield('title')</title>
    @include('layouts._header')
    @yield('head')
    @include('layouts._scripts_primary')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts._sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts._topbar')
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="small mb-0 text-gray-800">@yield('page-title')</h1>
                    </div>

                    @yield('content')

                </div>
            </div>
            @include('layouts._footer')
        </div>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Estas seguro de salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "Cerrar sesion" si quieres terminar la sesion actual</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" >Cerrar sesion</a>
                </div>
            </div>
        </div>
    </div>

    @include('layouts._scripts')

    @yield('scripts')
</body>

</html>
