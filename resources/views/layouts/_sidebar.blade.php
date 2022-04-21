<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #313a46">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-image"></i>
        </div>
        <div class="sidebar-brand-text mx-3">NOMBRE</div>
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

    <li class="nav-item @if(Route::is('proyectos.index')) active @endif">
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
                <a class="collapse-item" href="{{ route('proyectos.planos') }}">Planos LE</a>
                <a class="collapse-item" href="{{ route('proyectos.planos.admin.index') }}">Planos Admin</a>
                <h6 class="collapse-header">Actividades</h6>
                <a class="collapse-item" href="{{ route('proyectos.actividades.index') }}">Actividades</a>
                <!--<a class="collapse-item" href="cards.html">Reportes</a>-->
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
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
