<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">


          @if(!$cicloActivo)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registro de Apreciación de Alumnos</h3>
                        <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                            Volver</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <h4 class="text-danger">No existe Año Escolar Activo, para registrar apreciaciones de alumnos es necesario que un Año Escolar se encuentre Activo.</h4>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            @else

            <div class="card card-primary">
              <div class="card-header">
                  <h3 class="card-title">Registro de Apreciación del Tutor</h3>
                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                      Volver</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                  <div class="card-body">


                      <div class="card card-primary card-tabs" v-if="verFormulario">
                          <div class="card-header p-0 pt-1">
                              <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                  <li class="pt-2 px-3">
                                      <h3 class="card-title">Niveles:</h3>
                                  </li>
                                  <li class="nav-item" v-for="(nivel, index) in registros.niveles">
                                      <a data-toggle="pill" role="tab" aria-selected="true" @click="cerrarSeccion()"
                                          v-bind="{ id: 'custom-tabs-two-' + nivel.siglas+'-tab', 'class': index == 0 ? 'nav-link active' : 'nav-link', 'href': '#custom-tabs-two-' + nivel.siglas, 'aria-controls': 'custom-tabs-two-' + nivel.siglas }">@{{ nivel.nombre }}</a>
                                  </li>
                              </ul>
                          </div>
                          <div class="card-body">
                              <div class="tab-content" id="custom-tabs-two-tabContent">
                                  <template v-for="(nivel, index) in registros.niveles">
                                      <div role="tabpanel"
                                          v-bind="{ 'class': index == 0 ? 'tab-pane fade show active' : 'tab-pane fade', 'id': 'custom-tabs-two-' + nivel.siglas, 'aria-labelledby': 'custom-tabs-two-' + nivel.siglas + '-tab' }">

                                          <template v-if="nivel.grados.length > 0">
                                              <div class="card-header p-0 pt-1 border-bottom-0">
                                                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                      <template v-for="(grado, indexG) in nivel.grados">
                                                          <li class="nav-item">
                                                              <a data-toggle="pill" role="tab" @click="cerrarSeccion()"
                                                              v-bind="{ 'class': indexG == 0 ? 'nav-link active' : 'nav-link', 'id': 'custom-tabs-gra' + nivel.siglas + grado.orden + '-tab', 'href': '#custom-tabs-gra' + nivel.siglas + grado.orden, 'aria-controls': 'custom-tabs-gra' + nivel.siglas + grado.orden, 'aria-selected': indexG == 0 ? 'true' : 'false' }">@{{ grado.nombre }}</a>
                                                          </li>
                                                      </template>
                                                  </ul>
                                              </div>
                                              <div class="card-body">
                                                  <div class="tab-content" id="custom-tabs-three-tabContent">
                                                      <template v-for="(grado, indexG) in nivel.grados">
                                                          <div role="tabpanel"
                                                              v-bind="{ 'class': indexG == 0 ? 'tab-pane fade show active' : 'tab-pane fade', 'id': 'custom-tabs-gra' + nivel.siglas + grado.orden, 'aria-labelledby': 'custom-tabs-gra' + nivel.siglas + grado.orden + '-tab' }">

                                                              <div class="form-group row">
                                                                  <label for="cbuseccion" class="col-sm-2 col-form-label">Seleccione Sección</label>
                                                                  <div class="col-sm-10" v-if="grado.seccions.length > 0">
                                                                      <select class="custom-select rounded-0" id="cbuseccion" v-model="seccionSeleccionada" @change="cambioSeccion">
                                                                          <option value="0">Seleccione Sección</option>
                                                                          <template v-for="(seccion, indexS) in grado.seccions">
                                                                              <option v-bind:value="seccion.id">@{{seccion.nombre}}</option>
                                                                          </template>
                                                                      </select>
                                                                  </div>
                                                                  <div class="col-sm-10" v-else>
                                                                      <h6>No se tiene registro de secciones registradas en el grado</h6>
                                                                  </div>
                                                              </div>                                                          </div>
                                                      </template>
                                                  </div>
                                              </div>
                                          </template>
                                          <template v-else>
                                              <h6>No tiene sección asignada como tutor para registrar las apreciaciones de los alumnos</h6>
                                          </template>
                                      </div>
                                  </template>
                              </div>
                          </div>
                          <!-- /.card -->
                      </div>
                  </div>
                  <!-- /.card-body -->
              </form>
          </div>
        </div>

        <div class="col-md-12" v-if="seccionSeleccionada > 0 ">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" style="width: 100%;">
                  <div class="form-group row"  style="justify-content: center; margin-bottom: 0px;">
                      Alumnos - @{{registros.ciclo.year}}: @{{grado.nombre}} del Nivel @{{nivel.nombre}}, Sección: @{{seccion.sigla}}
                  </div>
                </h3>
              </div>
              <form>
                <div class="card-body">
                  <div class="table-responsive p-0" v-if="matriculas.length > 0">
                      <table class="table table-bordered table-sm">
                          <thead>
                              <tr>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">N° de Orden</th>
                                  <th class="titles-table" style="font-size:14px; width: 8%; vertical-align: middle; text-align: center;">DNI o Código del Estudiante</th>
                                  <th class="titles-table" style="font-size:14px; width: 20%; vertical-align: middle; text-align: center;">Apellidos y Nombres</th>
                                  <th class="titles-table" style="font-size:14px; width: 7%; vertical-align: middle; text-align: center;">Fecha de Nacimiento</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Sexo</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Situación de Matrícula</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">País</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Padre Vive</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Madre Vive</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Lengua Materna</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Segunda Lengua</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Trabaja el Estudiante</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Horas Semanales que labora</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Nacimiento Registrado</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Tipo de Discapacidad</th>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Apreciación</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(registro, indexS) in matriculas">
                                  <td class="rows-table">@{{indexS+1}}.</td>
                                  <td class="rows-table">@{{registro.sigla_tipodoc}}: @{{registro.num_documento_alu}}</td>
                                  <td class="rows-table">@{{registro.apellido_paterno_alu}} @{{registro.apellido_materno_alu}}, @{{registro.nombres_alu}}</td>
                                  <td class="rows-table">@{{registro.fecha_nacimiento_alu}}</td>
                                  <td class="rows-table">@{{registro.genero_alu}}</td>
                                  <td class="rows-table">
                                      <template v-if="registro.old_estado_grado_alu=='0'">
                                          I
                                      </template>
                                      <template v-if="registro.old_estado_grado_alu=='2'">
                                          P
                                      </template>
                                      <template v-if="registro.old_estado_grado_alu=='3'">
                                          PG
                                      </template>
                                      <template v-if="registro.old_estado_grado_alu=='4'">
                                          RE
                                      </template>
                                  </td>
                                  <td class="rows-table">@{{registro.sigla_pais_alu}}</td>
                                  <td class="rows-table">
                                      <template v-if="registro.vive_padre=='0'">
                                          NO
                                      </template>
                                      <template v-if="registro.vive_padre=='1'">
                                          SI
                                      </template>
                                  </td>
                                  <td class="rows-table">
                                      <template v-if="registro.vive_madre=='0'">
                                          NO
                                      </template>
                                      <template v-if="registro.vive_madre=='1'">
                                          SI
                                      </template>
                                  </td>
                                  <td class="rows-table">@{{registro.lengua_materna_alu}}</td>
                                  <td class="rows-table">@{{registro.segunda_lengua_alu}}</td>
                                  <td class="rows-table">
                                      <template v-if="registro.trabaja=='0'">
                                          NO
                                      </template>
                                      <template v-if="registro.trabaja=='1'">
                                          SI
                                      </template>
                                  </td>
                                  <td class="rows-table">@{{registro.horas_semanales}}</td>
                                  <td class="rows-table">
                                      <template v-if="registro.nacimiento_registrado_alu=='0'">
                                          NO
                                      </template>
                                      <template v-if="registro.nacimiento_registrado_alu=='1'">
                                          SI
                                      </template>
                                  </td>
                                  <td class="rows-table">
                                      <template v-if="registro.DI_alu=='1'">
                                          DI
                                      </template>
                                      <template v-if="registro.DA_alu=='1'">
                                          DA
                                      </template>
                                      <template v-if="registro.DV_alu=='1'">
                                          DV
                                      </template>
                                      <template v-if="registro.DM_alu=='1'">
                                          DM
                                      </template>
                                      <template v-if="registro.SC_alu=='1'">
                                          SC
                                      </template>
                                      <template v-if="registro.OT_alu=='1'">
                                          OT
                                      </template>
                                  </td>
                                  <td class="rows-table">
                                    <center>
                                      <x-adminlte-button @click="registrarApreciación(registro, indexS)" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="" theme="primary"
                                      icon="fas fa-comment" data-placement="top" data-toggle="tooltip" title="Registrar Apreciación del Alumno"/>
                                    </center>
                                  </td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                  <div v-else>
                      <h6>No existen registros de Alumnos Matriculados</h6>
                  </div>
                </div>
              </form>
            </div>
      </div>

        @endif
    </div>
</div>