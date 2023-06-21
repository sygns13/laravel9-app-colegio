<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            @if(!$cicloActivo)
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Horario del Alumno</h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                        Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <h4 class="text-danger">No existe Año Escolar Activo, para visualizar su Horario es necesario que un Año Escolar se encuentre Activo.</h4>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>

            @else

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title" v-if="verTabla"> <b>Horario del Alumno</b>
                        <br>
                        <b>Año Escolar</b>: {{$cicloActivo->year}}
                        <br>
                        <b>Nivel</b>: @{{data.nivel.nombre}} <b>Grado</b>: @{{data.grado.nombre}} <b>Sección</b>: @{{data.cicloSeccion.nombre}}
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
                          <div>
                            {{-- <h6>Horario:</h6> --}}

                            <div class="table-responsive p-0">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">HORA</th>
                                            <th style="width: 18%">Lunes</th>
                                            <th style="width: 18%">Martes</th>
                                            <th style="width: 18%">Miercoles</th>
                                            <th style="width: 18%">Jueves</th>
                                            <th style="width: 18%">Viernes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(hora, indexHora) in horas">
                                            <tr v-if ="hora.turno_id == data.cicloSeccion.turno_id">
                                                <td>@{{hora.horaini}} - @{{hora.horafin}}</td>
                                                <td :style="{ backgroundColor: horario.coLunes[hora.id]}" >
                                                    <template v-if="hora.tipo == 1">
                                                        <template v-if="horario.lunes[hora.id] != '0'">
                                                            <template v-for="(curso, index) in data.cursos">
                                                                <template v-if="curso.id == horario.lunes[hora.id]">
                                                                    @{{curso.nombre}}
                                                                </template>
                                                            </template>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        RECREO
                                                    </template>
                                                </td>                               
                                                <td :style="{ backgroundColor: horario.coMartes[hora.id]}" >
                                                    <template v-if="hora.tipo == 1">
                                                        <template v-if="horario.martes[hora.id] != '0'">
                                                            <template v-for="(curso, index) in data.cursos">
                                                                <template v-if="curso.id == horario.martes[hora.id]">
                                                                    @{{curso.nombre}}
                                                                </template>
                                                            </template>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        RECREO
                                                    </template>
                                                </td>                               
                                                <td :style="{ backgroundColor: horario.coMiercoles[hora.id]}">
                                                    <template v-if="hora.tipo == 1">
                                                        <template v-if="horario.miercoles[hora.id] != '0'">
                                                            <template v-for="(curso, index) in data.cursos">
                                                                <template v-if="curso.id == horario.miercoles[hora.id]">
                                                                    @{{curso.nombre}}
                                                                </template>
                                                            </template>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        RECREO
                                                    </template>
                                                </td>                               
                                                <td :style="{ backgroundColor: horario.coJueves[hora.id]}">
                                                    <template v-if="hora.tipo == 1">
                                                        <template v-if="horario.jueves[hora.id] != '0'">
                                                            <template v-for="(curso, index) in data.cursos">
                                                                <template v-if="curso.id == horario.jueves[hora.id]">
                                                                    @{{curso.nombre}}
                                                                </template>
                                                            </template>
                                                        </template>
                                                    </template>
                                                    <template v-else>
                                                        RECREO
                                                    </template>
                                                </td>                               
                                                <td :style="{ backgroundColor: horario.coViernes[hora.id]}">
                                                    <template v-if="hora.tipo == 1">
                                                        <template v-if="horario.viernes[hora.id] != '0'">
                                                            <template v-for="(curso, index) in data.cursos">
                                                                <template v-if="curso.id == horario.viernes[hora.id]">
                                                                    @{{curso.nombre}}
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