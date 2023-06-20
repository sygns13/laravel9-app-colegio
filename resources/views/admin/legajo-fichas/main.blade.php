<div class="container-fluid">
    <div class="row">

        @if($user->tipo_user_id == "4") {{-- Alumno --}}
        
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-widget widget-user" v-if="verAlumno">
                        <div class="widget-user-header bg-primary">
                            <h3 class="widget-user-username">@{{alumno.nombres}} @{{alumno.apellido_paterno}} @{{alumno.nombres}}</h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" :src="'{{ asset('web/perfil/alumno/') }}/'+user.profile_photo_path" alt="User Avatar" v-if="user.profile_photo_path !=''">
                            {{-- <button type="buttton" class="btn btn-info" @click="editPerfil"><i class="fas fa-edit"></i></button> --}}
                        </div>
                        <div class="card-body box-profile">
                            <br>
                            <br>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                            <b>Nivel</b> <a class="float-right">@{{alumno.nivel.nombre}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Grado</b> <a class="float-right">@{{alumno.grado.nombre}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Seccion</b> <a class="float-right" v-if="alumno.seccion != null">@{{alumno.seccion.sigla}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Cargo</b> <a class="float-right">Alumno</a>
                            </li>

                            <li class="list-group-item">
                            <b>Teléfono</b> <a class="float-right">@{{alumno.telefono}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Celular</b> <a class="float-right">@{{alumno.celular}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Correo</b> <a class="float-right">@{{user.email}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Dirección</b> <a class="float-right">@{{alumno.direccion}}</a>
                            </li>
                        </ul>
                        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        <a href="{{ URL::to('/admin/legajo-nuevo') }}" class="btn btn-info btn-block"><b>Editar Datos</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>

        @elseif($user->tipo_user_id == "3") {{-- Docente --}}

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-primary">
                            <h3 class="widget-user-username">@{{docente.nombre}} @{{docente.apellidos}}</h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" :src="'{{ asset('web/perfil/docente/') }}/'+user.profile_photo_path" alt="User Avatar" v-if="user.profile_photo_path !=''">
                            {{-- <button type="buttton" class="btn btn-info" @click="editPerfil"><i class="fas fa-edit"></i></button> --}}
                        </div>
                        <div class="card-body box-profile">
                            <br>
                            <br>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                            <b>Condición</b> <a class="float-right">@{{docente.condicion}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Dedicación</b> <a class="float-right">@{{docente.dedicacion}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Cargo</b> <a class="float-right">@{{docente.cargo}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Especialidad</b> <a class="float-right">@{{docente.especialidad}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Código</b> <a class="float-right">@{{docente.codigo_plaza}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Teléfono</b> <a class="float-right">@{{docente.telefono}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Celular</b> <a class="float-right">@{{docente.celular}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Correo</b> <a class="float-right">@{{user.email}}</a>
                            </li>
                            <li class="list-group-item">
                            <b>Dirección</b> <a class="float-right">@{{docente.direccion}}</a>
                            </li>
                        </ul>
                        {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                        <a href="{{ URL::to('/admin/legajo-nuevo') }}" class="btn btn-info btn-block"><b>Editar Datos</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>

        @elseif($user->tipo_user_id == "1" || $user->tipo_user_id == "2") {{-- Admin --}}
        <div class="col-md-12">
            <div class="row">

            <div class="col-md-4">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-primary">
                        <h3 class="widget-user-username">@{{director.nombre}} @{{director.apellidos}}</h3>
                        <h5 class="widget-user-desc">@{{director.cargo}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" :src="'{{ asset('web/perfil/admin/') }}/'+user.profile_photo_path" alt="User Avatar">
                        <button type="buttton" class="btn btn-info" @click="editPerfil"><i class="fas fa-edit"></i></button>
                    </div>
                    <div class="card-body box-profile">
                        <br>
                        <br>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Condición</b> <a class="float-right">@{{director.condicion}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Dedicación</b> <a class="float-right">@{{director.dedicacion}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Cargo</b> <a class="float-right">@{{director.cargo}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Teléfono</b> <a class="float-right">@{{director.telefono}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Celular</b> <a class="float-right">@{{director.celular}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Correo</b> <a class="float-right">@{{director.email}}</a>
                        </li>
                      </ul>
                      <a href="{{ URL::to('/admin/legajo-nuevo') }}" class="btn btn-info btn-block"><b>Editar Datos</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-8">

                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Información de la I.E.</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <strong><i class="fas fa-chevron-right"></i> DRE: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.departamento}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> UGEL: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.nombre_ugel}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Nombre / N° de la I.E.: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.nombre}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Nivel / Modalidad: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.niveles}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Distrito: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.distrito}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Provincia: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.provincia}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Departamento: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.departamento}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Centro Poblado: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.centro_poblado}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Dirección: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.direccion}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Email: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.email}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Teléfono: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.telefono}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Tipo de Gestión: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.gestion}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Género de los Alumnos: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.genero}}</p>
                      <hr style="margin-top: 0px;">

                      <strong><i class="fas fa-chevron-right"></i> Forma de Atención: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.forma}}</p>
                      <hr style="margin-top: 0px;">

                      <strong><i class="fas fa-chevron-right"></i> Turno de Atención: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.turno}}</p>

      
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-12" style="padding-top: 25px;">
            <div class="row">
                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Misión de la IE</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <button type="buttton" class="btn btn-info" @click="editMision"><i class="fas fa-edit"></i> Modificar Misión</button>

                                <img class="img img-responsive img-fluid pad" :src="'{{ asset('web/img/mision/') }}/'+ie.path_mision" alt="Photo" style="height:340px;">
                            </div>
                            <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Visión de la IE</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <button type="buttton" class="btn btn-info" @click="editVision"><i class="fas fa-edit"></i> Modificar Visión</button>

                                <img class="img img-responsive img-fluid pad" :src="'{{ asset('web/img/vision/') }}/'+ie.path_vision" alt="Photo" style="height:340px;">
                            </div>
                            <!-- /.card-body -->
                    </div>
                </div>


                </div>
            </div>
            
        @endif


        


    
    
        </div>
</div>
