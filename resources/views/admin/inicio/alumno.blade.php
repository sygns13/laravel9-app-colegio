<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-widget widget-user" v-if="verAlumno">
                        <div class="widget-user-header bg-primary">
                            <h3 class="widget-user-username">@{{alumno.nombres}} @{{alumno.apellido_paterno}} @{{alumno.nombres}}</h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" :src="'{{ asset('web/perfil/alumno/') }}/'+user.profile_photo_path" alt="User Avatar" v-if="user.profile_photo_path !=''">
                            <button type="buttton" class="btn btn-info" @click="editPerfil"><i class="fas fa-edit"></i></button>
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
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-primary" v-if="verAlumno">
                      <div class="card-header">
                          <h3 class="card-title">Resoluciones de Apertura de Año</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form>
                          <div class="card-body">
                              <div class="table-responsive p-0">
                                  <table class="table table-bordered table-sm">
                                      <thead>
                                          <tr>
                                              <th class="titles-table" style="width: 10%">#</th>
                                              <th class="titles-table" style="width: 65%">Resolución</th>
                                              <th class="titles-table" style="width: 25%">Año</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($resolucionAperturas as $index => $resolucion)
                                            <tr>
                                                <td class="rows-table">{{$index+1}}</td>
                                                <td class="rows-table">
                                                    <a download href="{{ asset('web/resolucion/') }}/{{$resolucion->archivo}}">
                                                        {{$resolucion->nombre}}
                                                    </a>
                                                </td>
                                                <td class="rows-table">{{$resolucion->year}}</td>
                                            </tr>
                                        @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <!-- /.card-body -->
                      </form>
                  </div>

                  <div class="card card-primary" v-if="verAlumno">
                    <div class="card-header">
                        <h3 class="card-title">Resoluciones de Cierre de Año</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="titles-table" style="width: 10%">#</th>
                                            <th class="titles-table" style="width: 65%">Resolución</th>
                                            <th class="titles-table" style="width: 25%">Año</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resolucionCierres as $index => $resolucion)
                                            <tr>
                                                <td class="rows-table">{{$index+1}}</td>
                                                <td class="rows-table">
                                                    <a download href="{{ asset('web/resolucion/') }}/{{$resolucion->archivo}}">
                                                        {{$resolucion->nombre}}
                                                    </a>
                                                </td>
                                                <td class="rows-table">{{$resolucion->year}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>


                </div>
                <div class="col-md-8">

                  <div class="card card-primary" v-if="verAlumno">
                    <div class="card-header">
                        <h3 class="card-title">Mis Documentos</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    {{-- <form> --}}
                        <div class="card-body">
                            {{-- <div class="table-responsive p-0">
                              <ul>
                                <li><a href="javascript:void(0);">Reporte de Asistencia de Docentes</a></li>
                                <li><a href="javascript:void(0);">Reporte de Asistencia de Alumnos</a></li>
                                <li><a href="javascript:void(0);">Legajos</a></li>
                              </ul>
                            </div> --}}
                            <div id="accordion">
                                <div class="card" v-for="(matricula, index) in alumno.data.matriculas">
                                  <div class="card-header" v-bind="{ 'id': 'heading-' + matricula.ciclo.id }">
                                    <h5 class="mb-0">
                                        <button v-bind="{ 'class': index == 0 ? 'btn btn-link' : 'btn btn-link collapsed', 'data-toggle': 'collapse', 'data-target': '#collapse-' + matricula.ciclo.id, 'aria-expanded': index == 0 ? 'true' : 'false', 'aria-controls': '#collapse-' + matricula.ciclo.id }">
                                            Año @{{matricula.ciclo.year}}
                                        </button>
                                    </h5>
                                  </div>
                              
                                  <div v-bind="{ 'id': 'collapse-' + matricula.ciclo.id, 'class': index == 0 ? 'collapse' : 'collapse', 'aria-labelledby': 'heading-' + matricula.ciclo.id, 'data-parent': '#accordion' }">
                                    <div class="card-body">

                                        <div class="table-responsive p-0">
                                            <table class="table table-bordered table-sm">

                                                <tbody>
                                                    <tr>
                                                        <td class="rows-table">
                                                            <a href="{{URL::to('admin/reporte-alu-horarios')}}">
                                                                Horarios
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="rows-table">
                                                            <a href="{{URL::to('admin/asistencia-alu-sesiones')}}">
                                                                Reporte de Asistencia
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="rows-table">
                                                            <a href="{{URL::to('admin/calificaciones')}}">
                                                                Reporte de Calificaciones
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <h5><b>Cursos Asignados</b></h5>

                                        <ul>
                                            <li v-for="(curso, indexC) in matricula.cursos">@{{curso.curso}}</li>
                                        </ul>
                                        
                                      
                                    </div>
                                  </div>
                                </div>

                              </div>
                        </div>
                        <!-- /.card-body -->
                    {{-- </form> --}}
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>