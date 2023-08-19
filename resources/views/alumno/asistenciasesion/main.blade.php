<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Reporte de Asistencia por Secciones de Clase</h3>
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

                        <div class="form-group row">
                            <label for="txtfecha" class="col-sm-2 col-form-label">Fecha de Semana</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fecha" @change="changeCiclo">
                            </div>
                          </div>




                        <div class="card card-primary card-tabs" v-if="verFormulario">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="pt-2 px-3">
                                        <h3 class="card-title">Niveles:</h3>
                                    </li>
                                    <li class="nav-item" v-for="(nivel, index) in registros.niveles">
                                        <a data-toggle="pill" role="tab" aria-selected="true" @click="cerrarHorario()"
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
                                                                <a data-toggle="pill" role="tab" @click="cerrarHorario()"
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


                                                                <div v-if="grado.seccions.length > 0 && seccionSeleccionada > 0 && turnoSeleccionado != '0'">
                                                                    <h6>CONTROL DE ASISTENCIA Y DESARROLLO DE SESIONES SECUNDARIA DESDE EL @{{registrosFilters.dia1_ok}} HASTA EL @{{registrosFilters.dia5_ok}}</h6>

                                                                    <div class="table-responsive p-0">
                                                                        <table class="table table-bordered table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th style="width: 10%">HORA</th>
                                                                                    <th style="width: 18%">Lunes @{{registrosFilters.dia1_ok}}</th>
                                                                                    <th style="width: 18%">Martes @{{registrosFilters.dia2_ok}}</th>
                                                                                    <th style="width: 18%">Miercoles @{{registrosFilters.dia3_ok}}</th>
                                                                                    <th style="width: 18%">Jueves @{{registrosFilters.dia4_ok}}</th>
                                                                                    <th style="width: 18%">Viernes @{{registrosFilters.dia5_ok}} oro @{{turnoSeleccionado}}</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <template v-for="(hora, indexHora) in horas">
                                                                                    <tr v-if ="hora.turno_id == turnoSeleccionado">
                                                                                        <td>@{{hora.horaini}} - @{{hora.horafin}}</td>
                                                                                        <td>
                                                                                            <template v-if="hora.tipo == 1">
                                                                                                <template v-if="horario.lunes[hora.id] != null && horario.lunes[hora.id].ciclo_curso_id != '0'">
                                                                                                    <template v-if="null != horario.lunes[hora.id].curso">
                                                                                                        Curso: @{{horario.lunes[hora.id].curso.nombre}} <br>
                                                                                                        <template v-if="horario.lunes[hora.id].curso.asignacion != undefined && horario.lunes[hora.id].curso.asignacion != null">
                                                                                                            Docente: @{{horario.lunes[hora.id].curso.asignacion.docente.nombre}} @{{horario.lunes[hora.id].curso.asignacion.docente.apellidos}}<br>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Docente: No Registrado</span><br>
                                                                                                        </template>
                                                                                                        <template v-if="horario.lunes[hora.id].asistencia != null">
                                                                                                            Tema:  @{{horario.lunes[hora.id].asistencia.tema}}<br>
                                                                                                            <template v-for="(alumno, indexAlumno) in horario.lunes[hora.id].asistencia.alumnos">
                                                                                                                <br>Alumno: @{{alumno.nombres}} @{{alumno.apellido_paterno}} @{{alumno.apellido_materno}}<br>
                                                                                                                Estado: 
                                                                                                                <template v-if="alumno.asistenciaAlumno == null">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '0'">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '1'">
                                                                                                                    <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '2'">
                                                                                                                    <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                                                                </template>
                                                                                                            </template>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Tema: Sin Registros</span> <br>
                                                                                                            <span style="color:red;">Asistentes: Sin Registros</span>
                                                                                                        </template>
                                                                                                    </template>
                                                                                                </template>
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                RECREO
                                                                                            </template>
                                                                                        </td>                               
                                                                                        <td>
                                                                                            <template v-if="hora.tipo == 1">
                                                                                                <template v-if="horario.martes[hora.id] != null && horario.martes[hora.id].ciclo_curso_id != '0'">
                                                                                                    <template v-if="null != horario.martes[hora.id].curso">
                                                                                                        Curso: @{{horario.martes[hora.id].curso.nombre}} <br>
                                                                                                        <template v-if="horario.martes[hora.id].curso.asignacion != undefined && horario.martes[hora.id].curso.asignacion != null">
                                                                                                            Docente: @{{horario.martes[hora.id].curso.asignacion.docente.nombre}} @{{horario.martes[hora.id].curso.asignacion.docente.apellidos}}<br>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Docente: No Registrado</span><br>
                                                                                                        </template>
                                                                                                        <template v-if="horario.martes[hora.id].asistencia != null">
                                                                                                            Tema:  @{{horario.martes[hora.id].asistencia.tema}}<br>                                                                                                            
                                                                                                            <template v-for="(alumno, indexAlumno) in horario.martes[hora.id].asistencia.alumnos">
                                                                                                                <br>Alumno: @{{alumno.nombres}} @{{alumno.apellido_paterno}} @{{alumno.apellido_materno}}<br>
                                                                                                                Estado: 
                                                                                                                <template v-if="alumno.asistenciaAlumno == null">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '0'">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '1'">
                                                                                                                    <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '2'">
                                                                                                                    <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                                                                </template>
                                                                                                            </template>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Tema: Sin Registros</span> <br>
                                                                                                            <span style="color:red;">Asistentes: Sin Registros</span>
                                                                                                        </template>
                                                                                                    </template>
                                                                                                </template>
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                RECREO
                                                                                            </template>
                                                                                        </td>                               
                                                                                        <td>
                                                                                            <template v-if="hora.tipo == 1">
                                                                                                <template v-if="horario.miercoles[hora.id] != null && horario.miercoles[hora.id].ciclo_curso_id != '0'">
                                                                                                    <template v-if="null != horario.miercoles[hora.id].curso">
                                                                                                        Curso: @{{horario.miercoles[hora.id].curso.nombre}} <br>
                                                                                                        <template v-if="horario.miercoles[hora.id].curso.asignacion != undefined && horario.miercoles[hora.id].curso.asignacion != null">
                                                                                                            Docente: @{{horario.miercoles[hora.id].curso.asignacion.docente.nombre}} @{{horario.miercoles[hora.id].curso.asignacion.docente.apellidos}}<br>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Docente: No Registrado</span><br>
                                                                                                        </template>
                                                                                                        <template v-if="horario.miercoles[hora.id].asistencia != null">
                                                                                                            Tema:  @{{horario.miercoles[hora.id].asistencia.tema}}<br>                                                                                                            
                                                                                                                <template v-for="(alumno, indexAlumno) in horario.miercoles[hora.id].asistencia.alumnos">
                                                                                                                <br>Alumno: @{{alumno.nombres}} @{{alumno.apellido_paterno}} @{{alumno.apellido_materno}}<br>
                                                                                                                Estado: 
                                                                                                                <template v-if="alumno.asistenciaAlumno == null">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '0'">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '1'">
                                                                                                                    <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '2'">
                                                                                                                    <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                                                                </template>
                                                                                                            </template>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Tema: Sin Registros</span> <br>
                                                                                                            <span style="color:red;">Asistentes: Sin Registros</span>
                                                                                                        </template>
                                                                                                    </template>
                                                                                                </template>
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                RECREO
                                                                                            </template>
                                                                                        </td>                               
                                                                                        <td>
                                                                                            <template v-if="hora.tipo == 1">
                                                                                                <template v-if="horario.jueves[hora.id] != null && horario.jueves[hora.id].ciclo_curso_id != '0'">
                                                                                                    <template v-if="null != horario.jueves[hora.id].curso">
                                                                                                        Curso: @{{horario.jueves[hora.id].curso.nombre}} <br>
                                                                                                        <template v-if="horario.jueves[hora.id].curso.asignacion != undefined && horario.jueves[hora.id].curso.asignacion != null">
                                                                                                            Docente: @{{horario.jueves[hora.id].curso.asignacion.docente.nombre}} @{{horario.jueves[hora.id].curso.asignacion.docente.apellidos}}<br>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Docente: No Registrado</span><br>
                                                                                                        </template>
                                                                                                        <template v-if="horario.jueves[hora.id].asistencia != null">
                                                                                                            Tema:  @{{horario.jueves[hora.id].asistencia.tema}}<br>                                                                                                            
                                                                                                            <template v-for="(alumno, indexAlumno) in horario.jueves[hora.id].asistencia.alumnos">
                                                                                                                <br>Alumno: @{{alumno.nombres}} @{{alumno.apellido_paterno}} @{{alumno.apellido_materno}}<br>
                                                                                                                Estado: 
                                                                                                                <template v-if="alumno.asistenciaAlumno == null">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '0'">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '1'">
                                                                                                                    <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '2'">
                                                                                                                    <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                                                                </template>
                                                                                                            </template>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Tema: Sin Registros</span> <br>
                                                                                                            <span style="color:red;">Asistentes: Sin Registros</span>
                                                                                                        </template>
                                                                                                    </template>
                                                                                                </template>
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                RECREO
                                                                                            </template>
                                                                                        </td>                               
                                                                                        <td>
                                                                                            <template v-if="hora.tipo == 1">
                                                                                                <template v-if="horario.viernes[hora.id] != null && horario.viernes[hora.id].ciclo_curso_id != '0'">
                                                                                                    <template v-if="horario.viernes[hora.id].curso">
                                                                                                        Curso: @{{horario.viernes[hora.id].curso.nombre}} <br>
                                                                                                        <template v-if="horario.viernes[hora.id].curso.asignacion != undefined && horario.viernes[hora.id].curso.asignacion != null">
                                                                                                            Docente: @{{horario.viernes[hora.id].curso.asignacion.docente.nombre}} @{{horario.viernes[hora.id].curso.asignacion.docente.apellidos}}<br>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Docente: No Registrado</span><br>
                                                                                                        </template>
                                                                                                        <template v-if="horario.viernes[hora.id].asistencia != null">
                                                                                                            Tema:  @{{horario.viernes[hora.id].asistencia.tema}}<br>                                                                                                            
                                                                                                            <template v-for="(alumno, indexAlumno) in horario.viernes[hora.id].asistencia.alumnos">
                                                                                                                <br>Alumno: @{{alumno.nombres}} @{{alumno.apellido_paterno}} @{{alumno.apellido_materno}}<br>
                                                                                                                Estado: 
                                                                                                                <template v-if="alumno.asistenciaAlumno == null">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '0'">
                                                                                                                    <span style="color:red;">Faltó</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '1'">
                                                                                                                    <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                                                                </template>
                                                                                                                <template v-if="alumno.asistenciaAlumno != null && alumno.asistenciaAlumno.estado == '2'">
                                                                                                                    <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                                                                </template>
                                                                                                            </template>
                                                                                                        </template>
                                                                                                        <template v-else>
                                                                                                            <span style="color:red;">Tema: Sin Registros</span> <br>
                                                                                                            <span style="color:red;">Asistentes: Sin Registros</span>
                                                                                                        </template>
                                                                                                    </template>
                                                                                                </template>
                                                                                            </template>
                                                                                            <template v-else>
                                                                                                RECREO
                                                                                            </template>
                                                                                        </td>                               
                                                                                    </tr>
                                                                                </template>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                                <div class="card-footer" v-if="seccionSeleccionada > 0 && horas.length > 0 && turnoSeleccionado != '0'">
                                                    <button style="margin-right:5px;" id="btnGuardar" type="button" class="btn btn-success" @click="imprimir()"><span class="fas fa-print"></span> @{{labelBtnSave}}</button>
                                                    {{-- <button id="btnGuardar" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button> --}}
                                                </div>
                                            </template>
                                            <template v-else>
                                                <h6>Los Alumnos bajo su poder aun no tiene sección asignada o no están matriculados en el año escolar seleccionado</h6>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                                </template>
                                <template v-else>
                                    <h6>Los Alumnos bajo su poder aun no tiene sección asignada o no están matriculados en el año escolar seleccionado</h6>
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