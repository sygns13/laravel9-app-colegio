<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-primary">
                            <h3 class="widget-user-username">@{{docente.nombre}} @{{docente.apellidos}}</h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" :src="'{{ asset('web/perfil/docente/') }}/'+user.profile_photo_path" alt="User Avatar" v-if="user.profile_photo_path !=''">
                            <button type="buttton" class="btn btn-info" @click="editPerfil"><i class="fas fa-edit"></i></button>
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
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <div class="card card-primary">
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
                                          <tr>
                                              <td class="rows-table">1.</td>
                                              <td class="rows-table">
                                                  <a href="javascript:void(0);">
                                                      Resolución N° 2022
                                                  </a>
                                              </td>
                                              <td class="rows-table">2022</td>
                                          </tr>
                                          <tr>
                                              <td class="rows-table">2.</td>
                                              <td class="rows-table">
                                                  <a href="javascript:void(0);">
                                                      Resolución N° 2023
                                                  </a>
                                              </td>
                                              <td class="rows-table">2023</td>
                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                          <!-- /.card-body -->
                      </form>
                  </div>

                  <div class="card card-primary">
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
                                        <tr>
                                            <td class="rows-table">1.</td>
                                            <td class="rows-table">
                                                <a href="javascript:void(0);">
                                                    Resolución N° 2022
                                                </a>
                                            </td>
                                            <td class="rows-table">2022</td>
                                        </tr>
                                        <tr>
                                            <td class="rows-table">2.</td>
                                            <td class="rows-table">
                                                <a href="javascript:void(0);">
                                                    Resolución N° 2023
                                                </a>
                                            </td>
                                            <td class="rows-table">2023</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>


                </div>
                <div class="col-md-8">

                  <div class="card card-primary">
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
                                <div class="card" v-for="(year, index) in registros">
                                  <div class="card-header" v-bind="{ 'id': 'heading-' + year.id }">
                                    <h5 class="mb-0">
                                        <button v-bind="{ 'class': index == 0 ? 'btn btn-link' : 'btn btn-link collapsed', 'data-toggle': 'collapse', 'data-target': '#collapse-' + year.id, 'aria-expanded': index == 0 ? 'true' : 'false', 'aria-controls': '#collapse-' + year.id }">
                                            Año @{{year.year}}
                                        </button>
                                    </h5>
                                  </div>
                              
                                  <div v-bind="{ 'id': 'collapse-' + year.id, 'class': index == 0 ? 'collapse' : 'collapse', 'aria-labelledby': 'heading-' + year.id, 'data-parent': '#accordion' }">
                                    <div class="card-body">

                                        <div id="accordionN">
                                            <div class="card" v-for="(nivel, indexN) in year.niveles">
                                              <div class="card-header" v-bind="{ 'id': 'headingN-' + nivel.id }">
                                                <h5 class="mb-0">
                                                    <button v-bind="{ 'class': indexN == 0 ? 'btn btn-link' : 'btn btn-link collapsed', 'data-toggle': 'collapse', 'data-target': '#collapseN-' + nivel.id, 'aria-expanded': indexN == 0 ? 'true' : 'false', 'aria-controls': '#collapseN-' + nivel.id }">
                                                        Nivel @{{nivel.nombre}}
                                                    </button>
                                                </h5>
                                              </div>
                                          
                                              <div v-bind="{ 'id': 'collapseN-' + nivel.id, 'class': indexN == 0 ? 'collapse' : 'collapse', 'aria-labelledby': 'headingN-' + nivel.id, 'data-parent': '#accordionN' }">
                                                <div class="card-body">

                                                    <template v-for="(grado, indexG) in nivel.grados">
                                                        <p>
                                                            <button class="btn btn-primary" type="button" data-toggle="collapse" aria-expanded="false"
                                                            v-bind="{ 'data-target': '#collapseG-' + grado.id, 'aria-controls': 'collapseG-' + grado.id }">
                                                                Grado @{{grado.nombre}}
                                                            </button>
                                                          </p>
                                                          <div class="collapse" v-bind="{ 'id': 'collapseG-' + grado.id }">
                                                            <div class="card card-body">
                                                              
                                                                <template v-for="(seccion, indexS) in grado.secciones">
                                                                    <p>
                                                                        <button class="btn btn-success" type="button" data-toggle="collapse" aria-expanded="false"
                                                                        v-bind="{ 'data-target': '#collapseS-' + seccion.id, 'aria-controls': 'collapseS-' + seccion.id }">
                                                                            Sección @{{seccion.sigla}}
                                                                        </button>
                                                                      </p>
                                                                      <div class="collapse" v-bind="{ 'id': 'collapseS-' + seccion.id }">
                                                                        <div class="card card-body">
                                                                          <h4>Cursos Asignados</h4>
                                                                            <template v-for="(curso, indexC) in seccion.cursos">
                                                                                <p>
                                                                                    <button class="btn btn-info" type="button" data-toggle="collapse" aria-expanded="false"
                                                                                    v-bind="{ 'data-target': '#collapseC-' + curso.id, 'aria-controls': 'collapseC-' + curso.id }">
                                                                                        @{{curso.nombre}}
                                                                                    </button>
                                                                                  </p>
                                                                                  <div class="collapse" v-bind="{ 'id': 'collapseC-' + curso.id }">
                                                                                    <div class="card card-body">
                                                                                        <div class="table-responsive p-0">
                                                                                            <table class="table table-bordered table-sm">

                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <td class="rows-table">
                                                                                                            <a href="javascript:void(0);">
                                                                                                                Horarios
                                                                                                            </a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="rows-table">
                                                                                                            <a href="javascript:void(0);">
                                                                                                                Reporte de Asistencia de Alumnos
                                                                                                            </a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td class="rows-table">
                                                                                                            <a href="javascript:void(0);">
                                                                                                                Reporte de Asistencia de Docente
                                                                                                            </a>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                  </div>
                                                                            </template>
            
                                                                        </div>
                                                                      </div>
                                                                </template>

                                                            </div>
                                                          </div>
                                                    </template>

                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                  </div>
                                </div>
{{-- 
                                <div class="card">
                                  <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0">
                                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Collapsible Group Item #2
                                      </button>
                                    </h5>
                                  </div>
                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                  </div>
                                </div>
                                <div class="card">
                                  <div class="card-header" id="headingThree">
                                    <h5 class="mb-0">
                                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Collapsible Group Item #3
                                      </button>
                                    </h5>
                                  </div>
                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                  </div>
                                </div>
                                 --}}
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