<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #313a46">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center m-3" href="{{route('home')}}">
            <img src="{{asset('img/icons/icono.png')}}" class="img-fluid">
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

    <!-- Heading -->
    <div class="sidebar-heading">
        Administrar
    </div>

    @can('cotizaciones.view')
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
                    <!--<a class="collapse-item" href="cards.html">Reportes</a>-->
                </div>
            </div>
        </li>
    @endcan

    @can('proyectos.view')
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
                    @can('proyectos.crear')
                        <a class="collapse-item" href="{{ route('proyectos.form') }}">Crear</a>
                    @endcan
                    <h6 class="collapse-header">Planos</h6>
                    @can('proyectos.planos.admin')
                        <a class="collapse-item" href="{{ route('proyectos.planos.admin.index') }}">Planos Admin</a>
                    @endcan
                    @can('proyectos.planos')
                        <a class="collapse-item" href="{{ route('proyectos.planos') }}">Planos</a>
                    @endcan
                    <h6 class="collapse-header">Actividades</h6>
                    @can('proyectos.actividades.view')
                        <a class="collapse-item" href="{{ route('proyectos.actividades.index') }}">Actividades</a>
                    @endcan
                    @can('proyectos.actividades.solicitudes')
                        <a class="collapse-item" href="{{ route('proyectos.actividades.solicitudes.index') }}">Solicitudes</a>
                    @endcan
                    @can('proyectos.actividades.reportes')
                        <a class="collapse-item" href="{{ route('proyectos.actividades.reportes.index') }}">Reportes</a>
                    @endcan
                    @can('proyectos.actividades.asistencias')
                        <a class="collapse-item" href="{{ route('proyectos.actividades.asistencias.index') }}">Asistencias</a>
                    @endcan
                    @can('proyectos.actividades.reagendamientos')
                        <a class="collapse-item" href="{{ route('proyectos.actividades.reagendamientos.index') }}">Reagendamientos</a>
                    @endcan
                    <h6 class="collapse-header">Documentos</h6>
                    @can('proyectos.interventorias.view')
                        <a class="collapse-item" href="{{ route('proyectos.interventoria.index') }}">Interventoria</a>
                    @endcan
                </div>
            </div>
        </li>
    @endcan

    @can('actividades.view')
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
    @endcan

    @can('productos.view')
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
                    @can('productos.solicitudes')
                    <a class="collapse-item" href="{{ route('proyectos.actividades.solicitudes.index') }}">Solicitudes de productos</a>
                    @endcan
                    @can('productos.reabastecimientos')
                    <a class="collapse-item" href="{{ route('productos.reabastecimientos.index') }}">Reabastecimientos</a>
                    @endcan
                    <!--<a class="collapse-item" href="cards.html">Reportes</a>-->
                </div>
            </div>
        </li>
    @endcan

    @can('usuario.view')
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
    @endcan

    @can('roles.permisos.view')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse-roles"
                aria-expanded="true" aria-controls="collapse-roles">
                <i class="fa-solid fa-scale-balanced"></i>
                <span>Roles</span>
            </a>
            <div id="collapse-roles" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Administrar</h6>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Roles</a>
                </div>
            </div>
        </li>
    @endcan

    @can('configuraciones.view')
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
    @endcan

    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
