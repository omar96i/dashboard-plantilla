<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background: #313a46">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars bg-white"></i>
    </button>

    <!-- Topbar Search -->
    <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" class="border-0 input-search-topbar" placeholder="Buscar por..."
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-search-topbar" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Alerts -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if (count(auth()->user()->unreadNotifications))
                    <span class="badge badge-danger badge-counter">{{ count(auth()->user()->unreadNotifications) }}</span>
                @endif
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                    Notificaciones
                </h6>
                @forelse (auth()->user()->unreadNotifications as $notificacion)
                    <a class="dropdown-item d-flex align-items-center" href="{{route('notificaciones.show', $notificacion->id)}}">
                        <div class="mr-3">
                            <div class="icon-circle {{$notificacion->data['accion'] == 'insert'? 'bg-success' : ''}} {{$notificacion->data['accion'] == 'update'? 'bg-info' : ''}} {{$notificacion->data['accion'] == 'delete'? 'bg-danger' : ''}}">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ $notificacion->created_at->diffForHumans() }}</div>
                            @if ($notificacion->data['tabla'] == 'users')
                                El usuario {{$notificacion->data['email']}} a sido {{($notificacion->data['accion'] == 'insert')? 'creado': ''}}{{($notificacion->data['accion'] == 'update')? 'actualizado': ''}}{{($notificacion->data['accion'] == 'delete')? 'eliminado': ''}}
                            @endif
                            @if ($notificacion->data['tabla'] == 'cotizaciones')
                                La cotizacion con el nombre de cliente "{{$notificacion->data['cliente_proyecto']}}" a sido {{($notificacion->data['accion'] == 'insert')? 'creado': ''}}{{($notificacion->data['accion'] == 'update')? 'actualizado': ''}}{{($notificacion->data['accion'] == 'delete')? 'eliminado': ''}}
                            @endif
                            @if ($notificacion->data['tabla'] == 'proyecto_actividades')
                                Se a {{($notificacion->data['accion'] == 'insert')? 'creado': ''}}{{($notificacion->data['accion'] == 'update')? 'actualizado': ''}}{{($notificacion->data['accion'] == 'delete')? 'eliminado': ''}} una actividad
                            @endif
                        </div>
                    </a>
                    @empty
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div>
                            <div class="text-gray-500">Sin notificaciones</div>
                        </div>
                    </a>
                @endforelse
                <a class="dropdown-item text-center small text-gray-500" href="{{route('notificaciones.read.all')}}">Marcar como leidas</a>
                <a class="dropdown-item text-center small text-gray-500" href="{{route('notificaciones.index')}}">Ver mas...</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @php
                    $informacion = auth()->user()->load('informacionPersonal');
                @endphp
                <span class="mr-2 d-none d-lg-inline text-white-600 small">{{$informacion->informacionPersonal->nombres.' '.$informacion->informacionPersonal->apellidos}}</span>
                <img class="img-profile rounded-circle"
                    src="{{($informacion->informacionPersonal->foto == 'default.jpg')? asset('img/img_usuarios/default.jpg'): 'https://res.cloudinary.com/dcj3tck83/image/upload/v1649869726/'.$informacion->informacionPersonal->foto}}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{route('usuarios.profile')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Mi Perfil
                </a>
                {{-- <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuracion
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Historial de actividad
                </a> --}}
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}">

                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Salir
                </a>
            </div>
        </li>
    </ul>
</nav>
