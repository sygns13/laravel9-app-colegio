<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">


          @if(!$cicloActivo)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registro de Calificaciones de Alumnos</h3>
                        <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                            Volver</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <h4 class="text-danger">No existe Año Escolar Activo, para realizar calificaciones es necesario que un Año Escolar se encuentre Activo.</h4>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            @else

            
              <div class="card card-primary" v-if="!tomarCalificacion">
                  <div class="card-header">
                    <h3 class="card-title">Cursos Habilitados Para Registro de Calificaciones</h3>
                  </div>
                  <form>
                    <div class="card-body">
                      <div class="row">

                        <template v-for="(nivel, indexN) in data.niveles">
                          <div class="card card-info" style="width: 100%" v-if="nivel.cantCursos > 0">
                            <div class="card-header">
                              <h3 class="card-title">Nivel: @{{nivel.nombre}}</h3>
                            </div>
                            <div class="card-body">
                              <div class="row">
                                <template v-for="(grado, indexG) in nivel.grados">
                                  <template v-if="grado.cantCursos > 0">

                                    <div class="col-md-12" style="padding-bottom: 15px; ">
                                      <div class="card-header ">
                                        <h3 class="card-title">@{{grado.nombre}} de Nivel @{{nivel.nombre}}</h3>
                                      </div>
                                    </div>

                                    <template v-for="(cursoL, indexC) in grado.cursos">
                                      <div class="col-md-3 col-sm-6 col-12"  v-if="cursoL.cantAlumnos > 0" >
                                        <div class="info-box bg-primary" style="margin-bottom: 0px; border-radius: 0.25rem 0.25rem 0px 0px;">
                                          <span class="info-box-icon"><i class="fas fa-book"></i></span>
                            
                                          <div class="info-box-content col-12" style="line-height: 1.5;">
                                            <span class="info-box-text" style="font-size: 20px;">@{{cursoL.curso}}</span>
                                            <span class="info-box-number">@{{cursoL.cantAlumnos}} Alumnos</span>
                            
                                            <div class="progress">
                                              <div class="progress-bar" style="width: 100%"></div>
                                            </div>
                                            <span class="progress-description">
                                              <br> Sección @{{cursoL.sigla}}
                                            </span>
                                          </div>
                                          <!-- /.info-box-content -->
                                        </div>
                                        <div class="small-box bg-primary" style="border-radius: 0px 0px 0.25rem 0.25rem;">
                                          <a href="#" class="small-box-footer" @click.prevent="notaCurso(indexN, indexG, indexC)">
                                            Registrar Calificaciones <i class="fas fa-arrow-circle-right"></i>
                                          </a>
                                        </div>
                                        <!-- /.info-box -->
                                      </div>
                                    </template>
                                  </template>
                                </template>
                              </div>
                            </div>
                          </div>
                        </template>
                      </template>
                      </div>
                    </div>
                  </form>
                </div>
          </div>





          <div class="col-md-12" v-if="tomarCalificacion">
              <div class="card card-primary">
                  <div class="card-header">


                    <h3 class="card-title">
                      Año Escolar: @{{data.ciclo.year}}
                      <br>
                      @{{curso.grado}} de Nivel @{{curso.nivel}} 
                      <br> Sección @{{curso.seccion}}
                      <br> <br> 
                      Calificacion del Curso: @{{curso.curso}} 
                    </h3>

                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="#" @click.prevent="cerrarFormCalificacion"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                      Volver</a>
                  </div>
                  <form>
                    <div class="card-body" v-if="!gestionCalificacion">

                      <div class="table-responsive p-0" v-if="alumnos.length > 0">
                          <table class="table table-bordered table-sm">
                            <thead>
                              <tr>
                                  <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">N°</th>
                                  <th class="titles-table" style="font-size:14px; width: 15%; vertical-align: middle; text-align: center;">DNI o Código del Estudiante</th>
                                  <th class="titles-table" style="font-size:14px; width: 25%; vertical-align: middle; text-align: center;">Apellidos y Nombres</th>

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
                              <tr v-for="(registro, indexA) in alumnos">
                                  <td class="rows-table">@{{indexA+1}}.</td>
                                  <td class="rows-table">@{{registro.sigla_tipodoc}}: @{{registro.num_documento_alu}}</td>
                                  <td class="rows-table">@{{registro.apellido_paterno_alu}} @{{registro.apellido_materno_alu}}, @{{registro.nombres_alu}}</td>

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
                                      <x-adminlte-button @click="calificacion(indexA)" id="btnNuevo1" class="bg-gradient btn-sm" type="button" label="Gestión" theme="primary"
                                      data-placement="top" data-toggle="tooltip" title="Registrar Calificacion" style="margin-right: 5px;"/>
                                    </center>
                                </td>
                              </tr>
                          </table>
                      </div>
                      <div v-else>
                          <h6>No existen alumnos matriculados en esta sección</h6>
                      </div>
                    </div>
                  </form>
                </div>
          </div>





          <div class="col-md-12" v-if="tomarCalificacion && gestionCalificacion">
            <div class="card card-primary">
                <div class="card-header">


                  <h3 class="card-title">
                    Alumno: @{{alumnoCurso.apellido_paterno_alu}} @{{alumnoCurso.apellido_materno_alu}}, @{{alumnoCurso.nombres_alu}}
                    <br>
                    @{{alumnoCurso.sigla_tipodoc}}: @{{alumnoCurso.num_documento_alu}}
                    <br> <br> 
                    Gestión de Calificaciones por Competencias -Indicadores
                  </h3>

                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="#" @click.prevent="cerrarFormCalificaciones"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                    Volver</a>
                </div>
                <form>
                  <div class="card-body">
                    
                    <div class="table-responsive p-0" v-if="alumnoCurso.competencias.length > 0">
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
                          <template v-for="(registro, indexC) in alumnoCurso.competencias">
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
                                    <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" @click="calificacionCompetencia(registro)" id="btnNuevo2" class="bg-gradient btn-sm" type="button" label="Gestión" theme="primary"
                                    data-placement="top" data-toggle="tooltip" title="Registrar Calificacion" style="margin-right: 5px;"/>
                                  </center>
                              </td> --}}
                            </tr>

                            <tr v-for="(indicador, indexI) in registro.indicadores">
                              <td class="rows-table" style="width: 10%">Indicador @{{indexI+1}}.</td>
                              <td class="rows-table" style="width: 25%">@{{indicador.nombre}}</td>

                              <td class="rows-table" style="text-align: center;">
                                <template v-if="indicador.notaPrimerPeriodo != null">@{{indicador.notaPrimerPeriodo.nota_num}}
                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Editar Calificación" @click="edit(registro, indicador, indicador.notaPrimerPeriodo, {{$cicloActivo->opcion}})" id="btnEditI" 
                                  class="bg-gradient" type="button" label="" theme="warning" icon="fas fa-pen"/>
                                </template>
                                <template v-else><div style="color:red;">Pendiente 
                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 1, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                  class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
                                </template>
                              </td>

                              <td class="rows-table" style="text-align: center;">
                                <template v-if="indicador.notaSegundoPeriodo != null">@{{indicador.notaSegundoPeriodo.nota_num}}
                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Editar Calificación" @click="edit(registro, indicador, indicador.notaPrimerPeriodo, {{$cicloActivo->opcion}})" id="btnEditI" 
                                  class="bg-gradient" type="button" label="" theme="warning" icon="fas fa-pen"/>
                                </template>
                                <template v-else><div style="color:red;">Pendiente
                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 2, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                  class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
                                </template>
                              </td>

                              <td class="rows-table" style="text-align: center;">
                                <template v-if="indicador.notaTercerPeriodo != null">@{{indicador.notaTercerPeriodo.nota_num}}
                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Editar Calificación" @click="edit(registro, indicador, indicador.notaPrimerPeriodo, {{$cicloActivo->opcion}})" id="btnEditI" 
                                  class="bg-gradient" type="button" label="" theme="warning" icon="fas fa-pen"/>
                                </template>
                                <template v-else><div style="color:red;">Pendiente
                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 3, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                  class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
                                </template>
                              </td>

                              @if($cicloActivo->opcion == 2)
                                <td class="rows-table" style="text-align: center;">
                                  <template v-if="indicador.notaCuartoPeriodo != null">@{{indicador.notaCuartoPeriodo.nota_num}}
                                    <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Editar Calificación" @click="edit(registro, indicador, indicador.notaPrimerPeriodo, {{$cicloActivo->opcion}})" id="btnEditI" 
                                  class="bg-gradient" type="button" label="" theme="warning" icon="fas fa-pen"/>
                                  </template>
                                  <template v-else><div style="color:red;">Pendiente
                                    <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 4, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                    class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
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
                              <template v-if="alumnoCurso.notaPrimerPeriodo != null">@{{alumnoCurso.notaPrimerPeriodo.nota_num}}</template>
                              <template v-else><div style="color:red;">Pendiente</div></template>
                            </td>

                            <td class="rows-table2" style="text-align: center; font-weight:bold;">
                              <template v-if="alumnoCurso.notaSegundoPeriodo != null">@{{alumnoCurso.notaSegundoPeriodo.nota_num}}</template>
                              <template v-else><div style="color:red;">Pendiente</div></template>
                            </td>

                            <td class="rows-table2" style="text-align: center; font-weight:bold;">
                              <template v-if="alumnoCurso.notaTercerPeriodo != null">@{{alumnoCurso.notaTercerPeriodo.nota_num}}</template>
                              <template v-else><div style="color:red;">Pendiente</div></template>
                            </td>

                            @if($cicloActivo->opcion == 2)
                              <td class="rows-table2" style="text-align: center; font-weight:bold;">
                                <template v-if="alumnoCurso.notaCuartoPeriodo != null">@{{alumnoCurso.notaCuartoPeriodo.nota_num}}</template>
                                <template v-else><div style="color:red;">Pendiente</div></template>
                              </td>
                            @endif

                            <td class="rows-table2" style="text-align: center; font-weight:bold;">
                              <template v-if="alumnoCurso.notaFinal != null">@{{alumnoCurso.notaFinal.nota_num}}</template>
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

        @endif
    </div>
</div>