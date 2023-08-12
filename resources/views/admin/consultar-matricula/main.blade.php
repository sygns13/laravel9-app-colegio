<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Matrículas de Alumnos</h3>
                <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                    Volver</a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group row">
                  <label for="cbuAnioEscolar" class="col-sm-2 col-form-label">Seleccione Año Escolar</label>
                  <div class="col-sm-3">
                    <select class="form-control" style="width: 100%;" v-model="ciclo_id" id="cbuAnioEscolar" @change="changeCiclo">
                      <option value="0" disabled>Seleccione ...</option>
                      @foreach ($ciclos as $dato)
                        <option value="{{$dato->id}}">{{$dato->year}}</option> 
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
                <!-- /.card-body -->
            </form>
          </div>
        </div>

        {{-- @include('admin.hora.form') --}}

        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Listado de Matrículas</h3>
            </div>
            <form>
              <div class="card-body">
                <div class="col-md-12" style="margin-bottom:15px;">
                    <div class="input-group input-group-sm" style="max-width: 300px;">
                      <input type="text" name="table_search" class="form-control" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtn()">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-default" @click.prevent="buscarBtn()"><i class="fa fa-search"></i></button>
                    </span>
                    </div>
                  </div>

                <div class="table-responsive p-0" v-if="registros.length > 0">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                              <th class="titles-table" style="width: 4%">#</th>
                              <th class="titles-table" style="width: 8%">Código de Estudiante</th>
                              <th class="titles-table" style="width: 7%">DNI del Estudiante</th>
                              <th class="titles-table" style="width: 14%">Nombres</th>
                              <th class="titles-table" style="width: 9%">Nivel matriculado</th>
                              <th class="titles-table" style="width: 9%">Grado matriculado</th>
                              <th class="titles-table" style="width: 9%">Sección matriculada</th>
                              <th class="titles-table" style="width: 7%">Fecha de Matrícula</th>
                              <th class="titles-table" style="width: 8%">Validación por el Apoderado</th>
                              <th class="titles-table" style="width: 8%">Validación por el Director</th>
                              <th class="titles-table" style="width: 9%">Estado de Matrícula</th>
                              <th class="titles-table" style="width: 8%">Consulta Matrícula</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(registro, indexS) in registros">
                                <td class="rows-table">@{{indexS+pagination.from}}.</td>
                                <td class="rows-table">@{{registro.anio_ingreso_alu}}@{{registro.codigo_modular_alu}}@{{registro.numero_matricula_alu}}@{{registro.flag_alu}}</td>
                                <td class="rows-table">@{{registro.num_documento_alu}}</td>
                                <td class="rows-table">@{{registro.apellido_paterno_alu}} @{{registro.apellido_materno_alu}} @{{registro.nombres_alu}}</td>
                                <td class="rows-table">
                                  @{{registro.nombre_ciclo_niveles}}
                                </td>
                                <td class="rows-table">
                                  @{{registro.nombre_ciclo_grados}}
                                </td>
                                <td class="rows-table">
                                  @{{registro.sigla_ciclo_seccion}}
                                </td>
                                <td class="rows-table">@{{registro.fecha}}</td>
                                <td class="rows-table">
                                  <template v-if="registro.validado_apoderado != null && registro.validado_apoderado == '1'">
                                    @{{registro.fecha_valid_apo}}
                                  </template>
                                  <template v-else>
                                    PENDIENTE
                                  </template>
                                </td>
                                <td class="rows-table">
                                  <template v-if="registro.validado_director != null && registro.validado_director == '1'">
                                    @{{registro.fecha_valid_dir}}
                                  </template>
                                  <template v-else>
                                    PENDIENTE
                                  </template>
                                </td>
                                <td class="rows-table">
                                  <template v-if="registro.estado == '5' && (registro.validado_apoderado == null || registro.validado_apoderado == '0')">
                                    EN PROCESO
                                  </template>
                                  <template v-if="registro.estado == '5' && registro.validado_apoderado != null && registro.validado_apoderado == '1'">
                                    EN PROCESO VALIDADO POR EL APODERADO
                                  </template>
                                  <template v-if="registro.estado == '1'">
                                    MATRICULADO
                                  </template>
                                  <template v-if="registro.estado == '2' || registro.estado == '3' || registro.estado == '4'">
                                    MATRICULADO FINALIZADO
                                  </template>
                                </td>
                                <td class="rows-table">
                                    <center>
                                    <x-adminlte-button @click="consultarMatricula(registro)" id="btnConsulta" class="bg-gradient btn-sm" type="button" label="" theme="info" icon="fas fa-search"
                                    data-placement="top" data-toggle="tooltip" title="Consultar Matrícula" style="margin-right: 5px;"/>

                                    <x-adminlte-button v-if="registro.estado=='5' && registro.validado_apoderado != null && registro.validado_apoderado == '1'" @click="validarMatricula(registro)" id="btnValidar" class="bg-gradient btn-sm" type="button" label="" theme="primary" icon="fas fa-check-circle"
                                    data-placement="top" data-toggle="tooltip" title="Validar Matrícula"/>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="padding: 15px;">
                        <div><h6>Registros por Página: @{{ pagination.per_page }}</h6></div>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page>1">
                            <a class="page-link" href="#" @click.prevent="changePage(1)">
                              <span><b>Inicio</b></span>
                            </a>
                          </li>
                        
                          <li class="page-item" v-if="pagination.current_page>1">
                          <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page-1)">
                            <span>Atras</span>
                          </a>
                        </li>
                        <li class="page-item" v-for="page in pagesNumber" v-bind:class="[page=== isActived ? 'active' : '']">
                        <a class="page-link" href="#" @click.prevent="changePage(page)">
                          <span>@{{ page }}</span>
                        </a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page+1)">
                          <span>Siguiente</span>
                        </a>
                        </li>
                        <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                        <a class="page-link" href="#" @click.prevent="changePage(pagination.last_page)">
                          <span><b>Ultima</b></span>
                        </a>
                        </li>
                        </ul>
                        </nav>
                        <div><h6>Registros Totales: @{{ pagination.total }}</h6></div>
                        </div>
                </div>
                <div v-else>
                    <h6>No existen registros de Docentes</h6>
                </div>
              </div>
            </form>
          </div>
      </div>
  </div>
</div>