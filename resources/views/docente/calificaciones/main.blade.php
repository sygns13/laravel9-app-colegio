<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reporte de Calificaciones</h3>
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


                        <div class="card card-primary card-tabs" v-if="verFormulario">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="pt-2 px-3">
                                        <h3 class="card-title">Niveles:</h3>
                                    </li>
                                    <li class="nav-item" v-for="(nivel, index) in registros.niveles">
                                        <a data-toggle="pill" role="tab" aria-selected="true" @click="cerrar()"
                                            v-bind="{ id: 'custom-tabs-two-' + nivel.siglas+'-tab', 'class': index == 0 ? 'nav-link active' : 'nav-link', 'href': '#custom-tabs-two-' + nivel.siglas, 'aria-controls': 'custom-tabs-two-' + nivel.siglas }">@{{ nivel.nombre }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">

                                <template v-if="registros.niveles.length > 0">
                                  <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <template v-for="(nivel, index) in registros.niveles">
                                        <div role="tabpanel"
                                            v-bind="{ 'class': index == 0 ? 'tab-pane fade show active' : 'tab-pane fade', 'id': 'custom-tabs-two-' + nivel.siglas, 'aria-labelledby': 'custom-tabs-two-' + nivel.siglas + '-tab' }">
                                            <template v-if="nivel.grados.length > 0">

                                            <div class="card-header p-0 pt-1 border-bottom-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                                    <template v-for="(grado, indexG) in nivel.grados">
                                                        <li class="nav-item">
                                                            <a data-toggle="pill" role="tab" @click="cerrar()"
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
                                                              </div>


                                                              <div v-if="grado.seccions.length > 0 && seccionSeleccionada > 0">
                                                                <h6>REPORTE DE CALIFICACIONES</h6>

                                                                <div class="card-footer" v-if="!verCalificacionAlumno">
                                                                  <button style="margin-right:5px;" id="btnImprimir1" type="button" class="btn btn-success" @click="imprimirAlumnosSeccion()"><span class="fas fa-print"></span> @{{labelBtnSave}}</button>
                                                                </div>

                                                                <template v-if="!verCalificacionAlumno">
                                                                    <div class="table-responsive p-0" v-if="alumnosFilters.length > 0">
                                                                        <table class="table table-bordered table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">N°</th>
                                                                                    <th class="titles-table" style="font-size:14px; width: 15%; vertical-align: middle; text-align: center;">DNI o Código del Estudiante</th>
                                                                                    <th class="titles-table" style="font-size:14px; width: 35%; vertical-align: middle; text-align: center;">Apellidos y Nombres</th>
                                                                                    <th class="titles-table" style="font-size:14px; width: 15%; vertical-align: middle; text-align: center;">Fecha de Nacimiento</th>
                                                                                    <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">Sexo</th>
                                                                                    <th class="titles-table" style="font-size:14px; width: 15%; vertical-align: middle; text-align: center;">Situación de Matrícula</th>
                                                                                    <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Gestión</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(registro, indexS) in alumnosFilters">
                                                                                    <td class="rows-table">@{{indexS+1}}.</td>
                                                                                    <td class="rows-table">@{{registro.sigla_tipodoc}}: @{{registro.num_documento_alu}}</td>
                                                                                    <td class="rows-table">@{{registro.apellido_paterno_alu}} @{{registro.apellido_materno_alu}}, @{{registro.nombres_alu}}</td>
                                                                                    <td class="rows-table">@{{registro.fecha_nacimiento_alu_ok}}</td>
                                                                                    <td class="rows-table">@{{registro.genero_alu}}</td>
                                                                                    <td class="rows-table">
                                                                                    <template v-if="registro.estado_grado_alu=='0'">
                                                                                        Ingresante
                                                                                    </template>
                                                                                    <template v-if="registro.estado_grado_alu=='1'">
                                                                                      Matriculado actualmente
                                                                                    </template>
                                                                                    <template v-if="registro.estado_grado_alu=='2'">
                                                                                        Promovido
                                                                                    </template>
                                                                                    <template v-if="registro.estado_grado_alu=='3'">
                                                                                        Permanece en el Grado
                                                                                    </template>
                                                                                    <template v-if="registro.estado_grado_alu=='4'">
                                                                                        Expulsado
                                                                                    </template>
                                                                                </td>
                                                                                <td class="rows-table">
                                                                                    <center>
                                                                                        <x-adminlte-button @click="verNotasAlumno(registro, nivel, grado)" id="btnVerNota" class="bg-gradient btn-sm" type="button" label="Ver Calificaciones" theme="info" icon="fas fa-list-ol"
                                                                                        data-placement="top" data-toggle="tooltip" title="Visualizar Calificaciones del Alumno"/>
                                                                                    </center>
                                                                                </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div v-else>
                                                                        <h6>No existen alumnos matriculados en esta sección</h6>
                                                                    </div>
                                                                </template>




                                                                <div class="col-md-12" v-if="verCalificacionAlumno && !verCalificacionAlumnoCompetencia">
                                                                  <div class="card-footer">
                                                                    <button style="margin-right:5px;" id="btnImprimir2" type="button" class="btn btn-success" @click="imprimirAlumno()"><span class="fas fa-print"></span> @{{labelBtnSave}}</button>
                                                                  </div>

                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                      
                                                      
                                                                          <h3 class="card-title">
                                                                            Estudiante: @{{alumno.data.apellido_paterno_alu}} @{{alumno.data.apellido_materno_alu}}, @{{alumno.data.nombres_alu}}
                                                                            <br>
                                                                            @{{alumno.data.sigla_tipodoc}}: @{{alumno.data.num_documento_alu}}
                                                                            {{-- <br> Sección @{{curso.seccion}}
                                                                            <br> <br> 
                                                                            Calificacion del Curso: @{{curso.curso}}  --}}
                                                                          </h3>
                                                      
                                                                          <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="#" @click.prevent="cerrarFormCalificacion"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                                                                            Volver</a>
                                                                        </div>
                                                                        <form>
                                                                          <div class="card-body">
                                                      
                                                                            <div class="table-responsive p-0" v-if="alumno.data.cursos.length > 0">
                                                                                <table class="table table-bordered table-sm">
                                                                                  <thead>
                                                                                    <tr>
                                                                                        <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">N°</th>
                                                                                        <th class="titles-table" style="font-size:14px; width: 35%; vertical-align: middle; text-align: center;">Área Curricular</th>
                                                                                        {{-- <th class="titles-table" style="font-size:14px; width: 25%; vertical-align: middle; text-align: center;">Apellidos y Nombres</th> --}}
                                                      
                                                                                        @if($cicloActivo->opcion == 1)
                                                                                          <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Primer Trimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Segundo Trimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Tercer Trimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 13%; vertical-align: middle; text-align: center; font-weight:bold;">Promedio Final</th>
                                                                                          <th class="titles-table" style="font-size:14px; width: 12%; vertical-align: middle; text-align: center;">Acción</th>  
                                                                                        @elseif($cicloActivo->opcion == 2)
                                                                                          <th class="titles-table" style="font-size:14px; width: 8%; vertical-align: middle; text-align: center;">Primer Bimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 8%; vertical-align: middle; text-align: center;">Segundo Bimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 8%; vertical-align: middle; text-align: center;">Tercer Bimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 8%; vertical-align: middle; text-align: center;">Cuarto Bimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center; font-weight:bold;">Promedio Final</th> 
                                                                                          <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Acción</th>
                                                                                        @endif
                                                                                        
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(registro, indexA) in alumno.data.cursos">
                                                                                        <td class="rows-table">@{{indexA+1}}.</td>
                                                                                        <td class="rows-table">@{{registro.curso}}</td>
                                                                                        {{-- <td class="rows-table">@{{registro.apellido_paterno_alu}} @{{registro.apellido_materno_alu}}, @{{registro.nombres_alu}}</td> --}}
                                                      
                                                                                        <td class="rows-table" style="text-align: center;">
                                                                                          <template v-if="registro.notaPrimerPeriodo != null">@{{registro.notaPrimerPeriodo.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                        </td>
                                                      
                                                                                        <td class="rows-table" style="text-align: center;">
                                                                                          <template v-if="registro.notaSegundoPeriodo != null">@{{registro.notaSegundoPeriodo.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                        </td>
                                                      
                                                                                        <td class="rows-table" style="text-align: center;">
                                                                                          <template v-if="registro.notaTercerPeriodo != null">@{{registro.notaTercerPeriodo.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                        </td>
                                                      
                                                                                        @if($cicloActivo->opcion == 2)
                                                                                          <td class="rows-table" style="text-align: center;">
                                                                                            <template v-if="registro.notaCuartoPeriodo != null">@{{registro.notaCuartoPeriodo.nota_num}}</template>
                                                                                            <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                          </td>
                                                                                        @endif
                                                      
                                                                                        <td class="rows-table" style="text-align: center; font-weight:bold;">
                                                                                          <template v-if="registro.notaFinal != null">@{{registro.notaFinal.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;"><b>Pendiente</b></div></template>
                                                                                        </td>
                                                      
                                                                                        <td class="rows-table">
                                                                                          <center>
                                                                                            <x-adminlte-button @click="calificacionCompetencia(registro)" id="btnCalificacionCompetencia" class="bg-gradient btn-sm" type="button" label="Ver por Competencias" theme="primary"
                                                                                            data-placement="top" data-toggle="tooltip" title="Ver Calificaciones por Competencia"/>
                                                                                          </center>
                                                                                      </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                            <div v-else>
                                                                                <h6>No existen cursos asignados a la sección</h6>
                                                                            </div>
                                                                          </div>
                                                                        </form>
                                                                      </div>
                                                                </div>



                                                                <div class="col-md-12" v-if="verCalificacionAlumnoCompetencia">
                                                                    <div class="card card-primary">
                                                                        <div class="card-header">
                                                        
                                                        
                                                                          <h3 class="card-title">
                                                                            Calificacion del Curso: @{{cursoS.curso}} 
                                                                            <br> <br> 
                                                                            Estudiante: @{{alumno.data.apellido_paterno_alu}} @{{alumno.data.apellido_materno_alu}}, @{{alumno.data.nombres_alu}}
                                                                            <br>
                                                                            @{{alumno.data.sigla_tipodoc}}: @{{alumno.data.num_documento_alu}}
                                                                            <br> <br> 
                                                                            Gestión de Calificaciones por Competencias -Indicadores
                                                                          </h3>
                                                        
                                                                          <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="#" @click.prevent="cerrarFormCalificacionesCompetencia"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                                                                            Volver</a>
                                                                        </div>
                                                                        <form>
                                                                          <div class="card-body">

                                                                            <div class="card-footer">
                                                                              <button style="margin-right:5px;" id="btnImprimir3" type="button" class="btn btn-success" @click="imprimirCurso()"><span class="fas fa-print"></span> @{{labelBtnSave}}</button>
                                                                            </div>
                                                                            
                                                                            <div class="table-responsive p-0" v-if="cursoS.competencias.length > 0">
                                                                                <table class="table table-bordered table-sm">
                                                                                  <thead>
                                                                                    <tr>
                                                                                        <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">N°</th>
                                                                                        <th colspan="2" class="titles-table" style="font-size:14px; width: 35%; vertical-align: middle; text-align: center;">Item</th>
                                                                                        @if($cicloActivo->opcion == 1)
                                                                                          <th class="titles-table" style="font-size:14px; width: 13%; vertical-align: middle; text-align: center;">Primer Trimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 13%; vertical-align: middle; text-align: center;">Segundo Trimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 13%; vertical-align: middle; text-align: center;">Tercer Trimestre</th>  
                                                                                          <th class="titles-table" style="font-size:14px; width: 16%; vertical-align: middle; text-align: center; font-weight:bold;">Promedio Final</th>
                                                                                          {{-- <th class="titles-table" style="font-size:14px; width: 12%; vertical-align: middle; text-align: center;">Acción</th>   --}}
                                                                                        @elseif($cicloActivo->opcion == 2)
                                                                                        <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Primer Bimestre</th>  
                                                                                        <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Segundo Bimestre</th>  
                                                                                        <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Tercer Bimestre</th>  
                                                                                        <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Cuarto Bimestre</th>  
                                                                                        <th class="titles-table" style="font-size:14px; width: 12%; vertical-align: middle; text-align: center; font-weight:bold;">Promedio Final</th> 
                                                                                        {{-- <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Acción</th> --}}
                                                                                        @endif
                                                                                        
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                  <template v-for="(registro, indexC) in cursoS.competencias">
                                                                                    <tr>
                                                                                        <td :rowspan="registro.indicadores.length + 1" class="rows-table" style="font-weight: bold;">Competencia @{{indexC+1}}.</td>
                                                                                        <td colspan="2" class="rows-table" style="font-weight: bold;">@{{registro.nombre}}</td>
                                                        
                                                                                        <td class="rows-table" style="text-align: center;">
                                                                                          <template v-if="registro.notaPrimerPeriodo != null">@{{registro.notaPrimerPeriodo.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                        </td>
                                                        
                                                                                        <td class="rows-table" style="text-align: center;">
                                                                                          <template v-if="registro.notaSegundoPeriodo != null">@{{registro.notaSegundoPeriodo.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                        </td>
                                                        
                                                                                        <td class="rows-table" style="text-align: center;">
                                                                                          <template v-if="registro.notaTercerPeriodo != null">@{{registro.notaTercerPeriodo.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                        </td>
                                                        
                                                                                        @if($cicloActivo->opcion == 2)
                                                                                          <td class="rows-table" style="text-align: center;">
                                                                                            <template v-if="registro.notaCuartoPeriodo != null">@{{registro.notaCuartoPeriodo.nota_num}}</template>
                                                                                            <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                          </td>
                                                                                        @endif
                                                        
                                                                                        <td class="rows-table" style="text-align: center; font-weight:bold;">
                                                                                          <template v-if="registro.notaFinal != null">@{{registro.notaFinal.nota_num}}</template>
                                                                                          <template v-else><div style="color:red;"><b>Pendiente</b></div></template>
                                                                                        </td>
                                                        
                                                        
                                                        
                                                                                        {{-- <td class="rows-table">
                                                                                          <center>
                                                                                            <x-adminlte-button @click="calificacionCompetencia(registro)" id="btnNuevo2" class="bg-gradient btn-sm" type="button" label="Gestión" theme="primary"
                                                                                            data-placement="top" data-toggle="tooltip" title="Registrar Calificacion" style="margin-right: 5px;"/>
                                                                                          </center>
                                                                                      </td> --}}
                                                                                    </tr>
                                                        
                                                                                    <tr v-for="(indicador, indexI) in registro.indicadores">
                                                                                      <td class="rows-table" style="width: 10%">Indicador @{{indexI+1}}.</td>
                                                                                      <td class="rows-table" style="width: 25%">@{{indicador.nombre}}</td>
                                                        
                                                                                      <td class="rows-table" style="text-align: center;">
                                                                                        <template v-if="indicador.notaPrimerPeriodo != null">@{{indicador.notaPrimerPeriodo.nota_num}}
                                                                                        </template>
                                                                                        <template v-else><div style="color:red;">Pendiente </div>
                                                                                        </template>
                                                                                      </td>
                                                        
                                                                                      <td class="rows-table" style="text-align: center;">
                                                                                        <template v-if="indicador.notaSegundoPeriodo != null">@{{indicador.notaSegundoPeriodo.nota_num}}
                                                                                        </template>
                                                                                        <template v-else><div style="color:red;">Pendiente</div>
                                                                                        </template>
                                                                                      </td>
                                                        
                                                                                      <td class="rows-table" style="text-align: center;">
                                                                                        <template v-if="indicador.notaTercerPeriodo != null">@{{indicador.notaTercerPeriodo.nota_num}}
                                                                                        </template>
                                                                                        <template v-else><div style="color:red;">Pendiente</div>
                                                                                        </template>
                                                                                      </td>
                                                        
                                                                                      @if($cicloActivo->opcion == 2)
                                                                                        <td class="rows-table" style="text-align: center;">
                                                                                          <template v-if="indicador.notaCuartoPeriodo != null">@{{indicador.notaCuartoPeriodo.nota_num}}
                                                                                          </template>
                                                                                          <template v-else><div style="color:red;">Pendiente</div>
                                                                                          </template>
                                                                                        </td>
                                                                                      @endif
                                                        
                                                                                      <td class="rows-table" style="text-align: center; font-weight:bold;">
                                                                                        <template v-if="indicador.notaFinal != null">@{{indicador.notaFinal.nota_num}}</template>
                                                                                        <template v-else><div style="color:red;"><b>Pendiente</b></div></template>
                                                                                      </td>
                                                                                    </tr>
                                                        
                                                                                    <tr>
                                                                                      @if($cicloActivo->opcion == 1)
                                                                                        <td colspan="7"> <div style="height: 5px;"></div></td>
                                                                                      @elseif($cicloActivo->opcion == 2)
                                                                                        <td colspan="8"> <div style="height: 5px;"></div></td>
                                                                                      @endif
                                                                                    </tr>
                                                                                  </template>
                                                        
                                                                                  <tr>
                                                                                    <td colspan="3" class="rows-table2" style="font-weight: bold; text-align:center;">Promedio Final</td>
                                                        
                                                                                    <td class="rows-table2" style="text-align: center; font-weight:bold;">
                                                                                      <template v-if="cursoS.notaPrimerPeriodo != null">@{{cursoS.notaPrimerPeriodo.nota_num}}</template>
                                                                                      <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                    </td>
                                                        
                                                                                    <td class="rows-table2" style="text-align: center; font-weight:bold;">
                                                                                      <template v-if="cursoS.notaSegundoPeriodo != null">@{{cursoS.notaSegundoPeriodo.nota_num}}</template>
                                                                                      <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                    </td>
                                                        
                                                                                    <td class="rows-table2" style="text-align: center; font-weight:bold;">
                                                                                      <template v-if="cursoS.notaTercerPeriodo != null">@{{cursoS.notaTercerPeriodo.nota_num}}</template>
                                                                                      <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                    </td>
                                                        
                                                                                    @if($cicloActivo->opcion == 2)
                                                                                      <td class="rows-table2" style="text-align: center; font-weight:bold;">
                                                                                        <template v-if="cursoS.notaCuartoPeriodo != null">@{{cursoS.notaCuartoPeriodo.nota_num}}</template>
                                                                                        <template v-else><div style="color:red;">Pendiente</div></template>
                                                                                      </td>
                                                                                    @endif
                                                        
                                                                                    <td class="rows-table2" style="text-align: center; font-weight:bold;">
                                                                                      <template v-if="cursoS.notaFinal != null">@{{cursoS.notaFinal.nota_num}}</template>
                                                                                      <template v-else><div style="color:red;"><b>Pendiente</b></div></template>
                                                                                    </td>
                                                                                  </tr>
                                                                                </table>
                                                                            </div>
                                                                            <div v-else>
                                                                                <h6>No existen Competencias Registradas en el Curso</h6>
                                                                            </div>
                                                                          </div>
                                                                        </form>
                                                                      </div>
                                                                </div>





                                                                
                                                              </div>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                           {{--  <div class="card-footer" v-if="seccionSeleccionada > 0">
                                                <button style="margin-right:5px;" id="btnGuardar" type="button" class="btn btn-success" @click="imprimir()"><span class="fas fa-print"></span> @{{labelBtnSave}}</button>
                                                
                                              </div> --}}
                                            </template>
                                            <template v-else>
                                              <h6>No tiene cursos asignados para poder visualizar los horarios de los alumnos</h6>
                                            </template>
                                        </div>
                                      </template>
                                    
                                  </div>
                                </template>
                                <template v-else>
                                  <h6>No tiene cursos asignados para poder visualizar los horarios de los alumnos</h6>
                                </template>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>
    </div>
</div>