<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            @if(!$cicloActivo)
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lista de Cursos</h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                        Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <h4 class="text-danger">No existe Año Escolar Activo, para visualizar su lista de cursos es necesario que un Año Escolar se encuentre Activo.</h4>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>

            @else

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" v-if="verTablaZero"> <b>Lista de Cursos</b>
                        <br>
                        <b>Año Escolar</b>: {{$cicloActivo->year}}
                        <br>
                        <b>Sección</b>: @{{data.cicloSeccion.nombre}}
                        <br>
                        <br>
                        <b>Alumno</b>: @{{data.alumno.apellido_paterno}} @{{data.alumno.apellido_materno}}, @{{data.alumno.nombres}}
                        
                        <b>@{{data.alumno.tipoDocumento.sigla}}</b>: @{{data.alumno.num_documento}}
                    </h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                        Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">

                
                        


                        <template v-if="verTabla">

                            <div class="table-responsive p-0" v-if="data.ciclo_cursos.length > 0">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="titles-table" style="width: 5%">#</th>
                                            <th class="titles-table" style="width: 30%">Curso</th>
                                            <th class="titles-table" style="width: 30%">Docente</th>
                                            <th class="titles-table" style="width: 10%">Turno</th>
                                            <th class="titles-table" style="width: 10%">Evaluaciones Programadas</th>
                                            <th class="titles-table" style="width: 15%">Calificaciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(curso, index) in data.ciclo_cursos">
                                            <td class="rows-table">@{{index+1}}.</td>                                    
                                            <td class="rows-table">@{{curso.nombre}}</td>
                                            <td class="rows-table">@{{curso.docente != null ? curso.docente.nombre : ''}} @{{curso.docente != null ? curso.docente.apellidos : ''}}</td>
                                            <td class="rows-table">
                                                <template v-if="data.cicloSeccion.turno_id == '1'">
                                                    Mañana
                                                </template>
                                                <template v-if="data.cicloSeccion.turno_id == '2'">
                                                    Tarde
                                                </template>
                                                <template v-if="data.cicloSeccion.turno_id == '3'">
                                                    Noche
                                                </template>
                                            </td>
                                            <td class="rows-table">@{{curso.evalProgramadas}}</td>
                                            <td class="rows-table">
                                                <center>
                                                    <x-adminlte-button @click="verCalificaciones(index)" id="btnProgramar" class="bg-gradient btn-sm" type="button" label="Ver Detalles" theme="info" icon="fas fa-list"
                                                    data-placement="top" data-toggle="tooltip" title="Ver Calificaciones del Curso" />
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
        
                            </div>
                            <div v-else>
                                <h6>Aún no tiene cursos asignados</h6>
                            </div>                            
                        </template>




                        <div class="col-md-12" v-if="gestionCalificacion && !verTabla">
                            <div class="card card-primary">
                                <div class="card-header">
                
                
                                  <h3 class="card-title">
                                    Curso: @{{alumnoCurso.nombre}}
                                    <br>
                                    Registro de Calificaciones del Alumno
                                  </h3>
                

                                  

                                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="#" @click.prevent="cerrarFormCalificaciones"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                                    Volver</a>

                                    <button style="float: right; margin-right:5px;" id="btnGuardar" type="button" class="btn btn-success btn-sm" @click="imprimir()"><span class="fas fa-print"></span> Imprimir</button>
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
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada1 != undefined && indicador.fecha_programada1 != null && indicador.fecha_programada1 != '' && indicador.activo1 == '1'">
                                                    <a href="javascript:void(null);" @click="edit(registro, indicador, indicador.notaPrimerPeriodo, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada1}} @{{indicador.hora_programada1}}</span></a> 
                                                  </div>
                                                </template>
                                                <template v-else><div style="color:red;">Pendiente 
                                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 1, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                                  class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada1 != undefined && indicador.fecha_programada1 != null && indicador.fecha_programada1 != '' && indicador.activo1 == '1'">
                                                    <a href="javascript:void(null);"  @click="nuevo(registro, indicador, 1, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada1}} @{{indicador.hora_programada1}}</span></a> 
                                                  </div>
                                                </template>
                
                                                <div style="margin-top:5px;" v-if="indicador.fecha_programada1 != undefined && indicador.fecha_programada1 != null && indicador.fecha_programada1 != '' && indicador.activo1 == '0'">
                                                  <span class="badge bg-warning" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada1}} @{{indicador.hora_programada1}}</span> 
                                                </div>
                                              </td>
                
                                              <td class="rows-table" style="text-align: center;">
                                                <template v-if="indicador.notaSegundoPeriodo != null">@{{indicador.notaSegundoPeriodo.nota_num}}
                                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Editar Calificación" @click="edit(registro, indicador, indicador.notaSegundoPeriodo, {{$cicloActivo->opcion}})" id="btnEditI" 
                                                  class="bg-gradient" type="button" label="" theme="warning" icon="fas fa-pen"/>
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada2 != undefined && indicador.fecha_programada2 != null && indicador.fecha_programada2 != '' && indicador.activo2 == '1'">
                                                    <a href="javascript:void(null);" @click="edit(registro, indicador, indicador.notaSegundoPeriodo, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada2}} @{{indicador.hora_programada2}}</span></a> 
                                                  </div>
                                                </template>
                                                <template v-else><div style="color:red;">Pendiente
                                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 2, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                                  class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada2 != undefined && indicador.fecha_programada2 != null && indicador.fecha_programada2 != '' && indicador.activo2 == '1'">
                                                    <a href="javascript:void(null);"  @click="nuevo(registro, indicador, 2, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada2}} @{{indicador.hora_programada2}}</span></a> 
                                                  </div>
                                                </template>
                
                                                <div style="margin-top:5px;" v-if="indicador.fecha_programada2 != undefined && indicador.fecha_programada2 != null && indicador.fecha_programada2 != '' && indicador.activo2 == '0'">
                                                  <span class="badge bg-warning" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada2}} @{{indicador.hora_programada2}}</span> 
                                                </div>
                                              </td>
                
                                              <td class="rows-table" style="text-align: center;">
                                                <template v-if="indicador.notaTercerPeriodo != null">@{{indicador.notaTercerPeriodo.nota_num}}
                                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Editar Calificación" @click="edit(registro, indicador, indicador.notaTercerPeriodo, {{$cicloActivo->opcion}})" id="btnEditI" 
                                                  class="bg-gradient" type="button" label="" theme="warning" icon="fas fa-pen"/>
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada3 != undefined && indicador.fecha_programada3 != null && indicador.fecha_programada3 != '' && indicador.activo3 == '1'">
                                                    <a href="javascript:void(null);" @click="edit(registro, indicador, indicador.notaTercerPeriodo, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada3}} @{{indicador.hora_programada3}}</span></a> 
                                                  </div>
                
                                                </template>
                                                <template v-else><div style="color:red;">Pendiente
                                                  <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 3, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                                  class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada3 != undefined && indicador.fecha_programada3 != null && indicador.fecha_programada3 != '' && indicador.activo3 == '1'">
                                                    <a href="javascript:void(null);"  @click="nuevo(registro, indicador, 3, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada3}} @{{indicador.hora_programada3}}</span></a> 
                                                  </div>
                                                </template>
                
                                                <div style="margin-top:5px;" v-if="indicador.fecha_programada3 != undefined && indicador.fecha_programada3 != null && indicador.fecha_programada3 != '' && indicador.activo3 == '0'">
                                                  <span class="badge bg-warning" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada3}} @{{indicador.hora_programada3}}</span> 
                                                </div>
                                              </td>
                
                                              @if($cicloActivo->opcion == 2)
                                                <td class="rows-table" style="text-align: center;">
                                                  <template v-if="indicador.notaCuartoPeriodo != null">@{{indicador.notaCuartoPeriodo.nota_num}}
                                                    <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Editar Calificación" @click="edit(registro, indicador, indicador.notaCuartoPeriodo, {{$cicloActivo->opcion}})" id="btnEditI" 
                                                  class="bg-gradient" type="button" label="" theme="warning" icon="fas fa-pen"/>
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada4 != undefined && indicador.fecha_programada4 != null && indicador.fecha_programada4 != '' && indicador.activo4 == '1'">
                                                    <a href="javascript:void(null);" @click="edit(registro, indicador, indicador.notaCuartoPeriodo, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada4}} @{{indicador.hora_programada4}}</span></a> 
                                                  </div>
                
                                                  </template>
                                                  <template v-else><div style="color:red;">Pendiente
                                                    <x-adminlte-button v-if="alumnoCurso.estado == '1' && alumnoCurso.estado_grado_alu == '1'" data-placement="top" data-toggle="tooltip" title="Registrar Calificación" @click="nuevo(registro, indicador, 4, {{$cicloActivo->opcion}})" id="btnNuevoI" 
                                                    class="bg-gradient" type="button" label="" theme="primary" icon="fas fa-pen"/></div>
                
                                                    <div style="margin-top:5px;" v-if="indicador.fecha_programada4 != undefined && indicador.fecha_programada4 != null && indicador.fecha_programada4 != '' && indicador.activo4 == '1'">
                                                      <a href="javascript:void(null);"  @click="nuevo(registro, indicador, 3, {{$cicloActivo->opcion}})"><span  class="badge bg-success" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada4}} @{{indicador.hora_programada4}}</span></a> 
                                                    </div>
                                                  </template>
                
                                                  <div style="margin-top:5px;" v-if="indicador.fecha_programada4 != undefined && indicador.fecha_programada4 != null && indicador.fecha_programada4 != '' && indicador.activo4 == '0'">
                                                    <span class="badge bg-warning" style="font-size:100%; color: #ffffff!important;">@{{indicador.fecha_programada4}} @{{indicador.hora_programada4}}</span> 
                                                  </div>
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
                

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>

            @endif
        </div>


    </div>
</div>