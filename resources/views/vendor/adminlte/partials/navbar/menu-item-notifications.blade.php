<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
      <i class="far fa-bell"></i>
      @if($mensajes && count($mensajes) > 0)
        <span class="badge badge-danger navbar-badge" style="font-size: .8rem!important;">{{count($mensajes)}}</span>
      @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">

        @if($mensajes && count($mensajes) > 0)
            @foreach ($mensajes as $index => $mensaje)
                <a href="{{URL::to('admin/mensajes')}}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('images/user_profile.avif') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                        <h3 class="dropdown-item-title">
                            @if($mensaje->tipo_users_id == '1' && $mensaje->director != null)
                                Director: {{$mensaje->director->nombre}} {{$mensaje->director->apellidos}}
                            @elseif($mensaje->tipo_users_id == '3' && $mensaje->docente != null)
                                Docente: {{$mensaje->docente->nombre}} {{$mensaje->docente->apellidos}}
                            @elseif($mensaje->tipo_users_id == '4' && $mensaje->alumno != null)
                                Alumno: {{$mensaje->alumno->nombres}} {{$mensaje->alumno->apellido_paterno}} {{$mensaje->alumno->apellido_materno}}
                            @elseif($mensaje->tipo_users_id == '5' && $mensaje->apoderado != null)
                                Apoderado: {{$mensaje->apoderado->nombres}} {{$mensaje->apoderado->apellido_paterno}} {{$mensaje->apoderado->apellido_materno}}
                            @endif
                            {{-- <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span> --}}
                        </h3>

                        <div style="max-height: 25px;overflow: hidden;">
                            <p class="text-sm">{!! $mensaje->mensaje !!}</p>
                        </div>

                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$mensaje->fecha}} {{$mensaje->hora}}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>

                <div class="dropdown-divider"></div>
            @endforeach
        @endif

      <a href="{{URL::to('admin/mensajes')}}" class="dropdown-item dropdown-footer"><b>Ver Todos los Mensajes</b></a>
    </div>
  </li>