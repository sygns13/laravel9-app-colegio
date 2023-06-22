<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            @if(!$cicloActivo)
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Asistencia del Alumno</h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                        Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <h4 class="text-danger">No existe Año Escolar Activo, para visualizar su Asistencia es necesario que un Año Escolar se encuentre Activo.</h4>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>

            @else

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" v-if="verTablaZero"> <b>Asistencia del Alumno</b>
                        <br>
                        <b>Año Escolar</b>: {{$cicloActivo->year}}
                        <br>
                        <b>Nivel</b>: @{{registro.nivel.nombre}} <b>Grado</b>: @{{registro.grado.nombre}} <b>Sección</b>: @{{registro.cicloSeccion.nombre}}
                        <br>
                        <br>
                        <b>Alumno</b>: @{{registro.alumno.apellido_paterno}} @{{registro.alumno.apellido_materno}}, @{{registro.alumno.nombres}}
                        
                        <b>@{{registro.alumno.tipoDocumento.sigla}}</b>: @{{registro.alumno.num_documento}}
                    </h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                        Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="txtfecha" class="col-sm-2 col-form-label">Fecha de Semana</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fecha" @change="changeFecha">
                            </div>
                          </div>


                        <template v-if="verTabla">
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
                                            <th style="width: 18%">Viernes @{{registrosFilters.dia5_ok}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(hora, indexHora) in horas">
                                            <tr v-if ="hora.turno_id == data.cicloSeccion.turno_id">
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
                                                                    Estado: 
                                                                    <template v-if="horario.lunes[hora.id].asistencia.asistenciaAlumno == null">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.lunes[hora.id].asistencia.asistenciaAlumno != null && horario.lunes[hora.id].asistencia.asistenciaAlumno.estado == '0'">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.lunes[hora.id].asistencia.asistenciaAlumno != null && horario.lunes[hora.id].asistencia.asistenciaAlumno.estado == '1'">
                                                                        <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                    </template>
                                                                    <template v-if="horario.lunes[hora.id].asistencia.asistenciaAlumno != null && horario.lunes[hora.id].asistencia.asistenciaAlumno.estado == '2'">
                                                                        <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                    </template>

                                                                </template>
                                                                <template v-else>
                                                                    <span style="color:red;">Tema: Sin Registro</span> <br>
                                                                    <span style="color:red;">Asistencia: Sin Registro</span>
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
                                                                    Estado: 
                                                                    <template v-if="horario.martes[hora.id].asistencia.asistenciaAlumno == null">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.martes[hora.id].asistencia.asistenciaAlumno != null && horario.martes[hora.id].asistencia.asistenciaAlumno.estado == '0'">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.martes[hora.id].asistencia.asistenciaAlumno != null && horario.martes[hora.id].asistencia.asistenciaAlumno.estado == '1'">
                                                                        <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                    </template>
                                                                    <template v-if="horario.martes[hora.id].asistencia.asistenciaAlumno != null && horario.martes[hora.id].asistencia.asistenciaAlumno.estado == '2'">
                                                                        <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                    </template>

                                                                </template>
                                                                <template v-else>
                                                                    <span style="color:red;">Tema: Sin Registro</span> <br>
                                                                    <span style="color:red;">Asistencia: Sin Registro</span>
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
                                                                    Estado: 
                                                                    <template v-if="horario.miercoles[hora.id].asistencia.asistenciaAlumno == null">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.miercoles[hora.id].asistencia.asistenciaAlumno != null && horario.miercoles[hora.id].asistencia.asistenciaAlumno.estado == '0'">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.miercoles[hora.id].asistencia.asistenciaAlumno != null && horario.miercoles[hora.id].asistencia.asistenciaAlumno.estado == '1'">
                                                                        <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                    </template>
                                                                    <template v-if="horario.miercoles[hora.id].asistencia.asistenciaAlumno != null && horario.miercoles[hora.id].asistencia.asistenciaAlumno.estado == '2'">
                                                                        <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                    </template>
                                                                </template>
                                                                <template v-else>
                                                                    <span style="color:red;">Tema: Sin Registro</span> <br>
                                                                    <span style="color:red;">Asistencia: Sin Registro</span>
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
                                                                    Estado: 
                                                                    <template v-if="horario.jueves[hora.id].asistencia.asistenciaAlumno == null">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.jueves[hora.id].asistencia.asistenciaAlumno != null && horario.jueves[hora.id].asistencia.asistenciaAlumno.estado == '0'">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.jueves[hora.id].asistencia.asistenciaAlumno != null && horario.jueves[hora.id].asistencia.asistenciaAlumno.estado == '1'">
                                                                        <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                    </template>
                                                                    <template v-if="horario.jueves[hora.id].asistencia.asistenciaAlumno != null && horario.jueves[hora.id].asistencia.asistenciaAlumno.estado == '2'">
                                                                        <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                    </template>
                                                                </template>
                                                                <template v-else>
                                                                    <span style="color:red;">Tema: Sin Registro</span> <br>
                                                                    <span style="color:red;">Asistencia: Sin Registro</span>
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
                                                                    Estado: 
                                                                    <template v-if="horario.viernes[hora.id].asistencia.asistenciaAlumno == null">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.viernes[hora.id].asistencia.asistenciaAlumno != null && horario.viernes[hora.id].asistencia.asistenciaAlumno.estado == '0'">
                                                                        <span style="color:red;">Faltó</span>
                                                                    </template>
                                                                    <template v-if="horario.viernes[hora.id].asistencia.asistenciaAlumno != null && horario.viernes[hora.id].asistencia.asistenciaAlumno.estado == '1'">
                                                                        <span style="color:rgb(0, 17, 252);">Asistió</span>
                                                                    </template>
                                                                    <template v-if="horario.viernes[hora.id].asistencia.asistenciaAlumno != null && horario.viernes[hora.id].asistencia.asistenciaAlumno.estado == '2'">
                                                                        <span style="color:rgb(255, 174, 0);">Tardanza</span>
                                                                    </template>
                                                                </template>
                                                                <template v-else>
                                                                    <span style="color:red;">Tema: Sin Registro</span> <br>
                                                                    <span style="color:red;">Asistencia: Sin Registro</span>
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
                        </template>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer" v-if="verTabla">
                        <button style="margin-right:5px;" id="btnGuardar" type="button" class="btn btn-success" @click="imprimir()"><span class="fas fa-print"></span> Imprimir</button>
                        {{-- <button id="btnGuardar" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button> --}}
                      </div>
                </form>
            </div>

            @endif
        </div>


    </div>
</div>