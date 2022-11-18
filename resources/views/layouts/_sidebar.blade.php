<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #313a46">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">

            <img src="{{asset('img/icons/icono.jpeg')}}" class="img-fluid">

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(Route::is('home')) active @endif">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @role('sub.admin|admin')

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrador
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Route::is('cotizaciones.index') || Route::is('cotizaciones.form')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa-solid fa-file-lines"></i>
            <span>Cotizaciones</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrar</h6>
                <a class="collapse-item" href="{{ route('cotizaciones.index') }}">Cotizaciones</a>
                <a class="collapse-item" href="{{ route('cotizaciones.form') }}">Crear</a>
                <!--<a class="collapse-item" href="cards.html">Reportes</a>-->
            </div>
        </div>
    </li>

    <li class="nav-item @if(Route::is('proyectos.index')||Route::is('proyectos.actividades.reportes.index')||Route::is('proyectos.actividades.index')||Route::is('proyectos.planos.admin.index')||Route::is('proyectos.form')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-four"
            aria-expanded="true" aria-controls="collapse-four">
            <i class="fa-solid fa-diagram-project"></i>
            <span>Proyectos</span>
        </a>
        <div id="collapse-four" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrar</h6>
                <a class="collapse-item" href="{{ route('proyectos.index') }}">Proyectos</a>
                <a class="collapse-item" href="{{ route('proyectos.form') }}">Crear</a>
                <h6 class="collapse-header">Planos</h6>
                <a class="collapse-item" href="{{ route('proyectos.planos.admin.index') }}">Planos</a>
                <h6 class="collapse-header">Actividades</h6>
                <a class="collapse-item" href="{{ route('proyectos.actividades.index') }}">Actividades</a>
                <a class="collapse-item" href="{{ route('proyectos.actividades.solicitudes.index') }}">Solicitudes</a>
                <a class="collapse-item" href="{{ route('proyectos.actividades.reportes.index') }}">Reportes</a>
                <h6 class="collapse-header">Documentos</h6>
                <a class="collapse-item" href="{{ route('proyectos.actividades.index') }}">Documentos</a>
                <a class="collapse-item" href="{{ route('proyectos.interventoria.index') }}">Interventoria</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Route::is('productos.index')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-one"
            aria-expanded="true" aria-controls="collapse-one">
            <i class="fa-solid fa-box"></i>
            <span>Productos</span>
        </a>
        <div id="collapse-one" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrar</h6>
                <a class="collapse-item" href="{{ route('productos.index') }}">Productos</a>
                <a class="collapse-item" href="{{ route('proyectos.actividades.solicitudes.index') }}">Solicitudes de productos</a>
                <a class="collapse-item" href="{{ route('productos.reabastecimientos.index') }}">Reabastecimientos</a>
                <!--<a class="collapse-item" href="cards.html">Reportes</a>-->
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Route::is('usuarios.index')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-three"
            aria-expanded="true" aria-controls="collapse-three">
            <i class="fa-solid fa-user"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapse-three" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrar</h6>
                <a class="collapse-item" href="{{ route('usuarios.index') }}">Usuarios</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Route::is('configuraciones.index')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-five"
            aria-expanded="true" aria-controls="collapse-five">
            <i class="fa-solid fa-gear"></i>
            <span>Configuraciones</span>
        </a>
        <div id="collapse-five" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrar</h6>
                <a class="collapse-item" href="{{ route('configuraciones.index') }}">Iva/Datos basicos</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    @endrole

    @role('comercial|admin')

    <!-- Heading -->
    <div class="sidebar-heading">
        Comercial
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Route::is('cotizaciones.index') || Route::is('cotizaciones.form')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-c-one"
            aria-expanded="true" aria-controls="collapse-c-one">
            <i class="fa-solid fa-file-lines"></i>
            <span>Cotizaciones</span>
        </a>
        <div id="collapse-c-one" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrar</h6>
                <a class="collapse-item" href="{{ route('cotizaciones.index') }}">Cotizaciones</a>
                <a class="collapse-item" href="{{ route('cotizaciones.form') }}">Crear</a>
                <!--<a class="collapse-item" href="cards.html">Reportes</a>-->
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Route::is('productos.index')) active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-c-two"
            aria-expanded="true" aria-controls="collapse-c-two">
            <i class="fa-solid fa-box"></i>
            <span>Productos</span>
        </a>
        <div id="collapse-c-two" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Administrar</h6>
                <a class="collapse-item" href="{{ route('productos.index') }}">Productos</a>
                <a class="collapse-item" href="{{ route('proyectos.actividades.solicitudes.index') }}">Solicitudes de productos</a>
                <!--<a class="collapse-item" href="cards.html">Reportes</a>-->
            </div>
        </div>
    </li>
    @endrole
    @role('lider.electrico|admin|diseñador')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            @role('lider.electrico|admin')
                Lider Electrico
            @endrole
            @role('diseñador')
                Diseñador
            @endrole
        </div>

        <li class="nav-item @if(Route::is('proyectos.index')||Route::is('proyectos.planos')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-le-one"
                aria-expanded="true" aria-controls="collapse-le-one">
                <i class="fa-solid fa-diagram-project"></i>
                <span>Proyectos</span>
            </a>
            <div id="collapse-le-one" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Vizualizar</h6>
                    <a class="collapse-item" href="{{ route('proyectos.index') }}">Proyectos</a>
                    <h6 class="collapse-header">Planos</h6>
                    <a class="collapse-item" href="{{ route('proyectos.planos') }}">Planos</a>
                </div>
            </div>
        </li>
    @endrole

    @role('lider.ingenieria|admin')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Lider de ingenieria
        </div>

        <li class="nav-item @if(Route::is('proyectos.actividades.reportes.index')||Route::is('proyectos.actividades.solicitudes.index')||Route::is('proyectos.actividades.index')||Route::is('proyectos.index')||Route::is('proyectos.actividades.asistencias.index')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-li-one"
                aria-expanded="true" aria-controls="collapse-li-one">
                <i class="fa-solid fa-diagram-project"></i>
                <span>Proyectos</span>
            </a>
            <div id="collapse-li-one" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Administrar</h6>
                    <a class="collapse-item" href="{{ route('proyectos.index') }}">Proyectos</a>
                    <h6 class="collapse-header">Actividades</h6>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.index') }}">Actividades</a>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.asistencias.index') }}">Asistencias</a>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.solicitudes.index') }}">Solicitudes de producto</a>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.reagendamientos.index') }}">Reagendamientos</a>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.reportes.index') }}">Reportes</a>
                </div>
            </div>
        </li>
    @endrole

    @role('tecnico|admin')
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Tecnico
        </div>

        <li class="nav-item @if(Route::is('proyectos.actividades.tecnico.index')||Route::is('proyectos.actividades.calendario')) active @endif">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-t-one"
                aria-expanded="true" aria-controls="collapse-t-one">
                <i class="fa-regular fa-calendar-days"></i>
                <span>Actividades</span>
            </a>
            <div id="collapse-t-one" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Administrar</h6>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.tecnico.index') }}">Actividades</a>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.calendario') }}">Calendario</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
    @endrole

    @role('administracion.compras|admin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Administracion de compras
        </div>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-a-v-one"
                aria-expanded="true" aria-controls="collapse-a-v-one">
                <i class="fa-solid fa-box"></i>
                <span>Productos</span>
            </a>
            <div id="collapse-a-v-one" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Administrar</h6>
                    <a class="collapse-item" href="{{ route('productos.index') }}">Productos</a>
                    <a class="collapse-item" href="{{ route('proyectos.actividades.solicitudes.index') }}">Solicitudes de productos</a>
                    <a class="collapse-item" href="{{ route('productos.reabastecimientos.index') }}">Reabastecimientos</a>
                </div>
            </div>
        </li>
    @endrole


    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
