<div class="container-fluid" v-if="terceraParte">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Lista de Estudiantes Pre-Matriculados
                    </h3>
                </div>

                <form>
                    <div class="card-body">

                        <center><h3>Año Escolar: {{$cicloActivo->nombre}}</h3></center>

                        <div class="card-footer">
                            <button style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" @click="cancelFinal()"><i class="fa fa-times" aria-hidden="true"></i> 
                                Volver a Matricular</button>
                        </div>

                        <div class="table-responsive p-0" v-if="registros2.length > 0">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="titles-table" style="width: 4%">#</th>
                                        <th class="titles-table" style="width: 10%">Código de Estudiante</th>
                                        <th class="titles-table" style="width: 8%">DNI del Estudiante</th>
                                        <th class="titles-table" style="width: 20%">Nombres</th>
                                        <th class="titles-table" style="width: 10%">Nivel matriculado</th>
                                        <th class="titles-table" style="width: 10%">Grado matriculado</th>
                                        <th class="titles-table" style="width: 10%">Sección matriculada</th>
                                        <th class="titles-table" style="width: 8%">Fecha de Matrícula</th>
                                        <th class="titles-table" style="width: 10%">Estado de Matrícula</th>
                                        <th class="titles-table" style="width: 10%">Consulta Matrícula</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(registro, indexS) in registros2">
                                        <td class="rows-table">@{{indexS + 1}}.</td>                                    
                                        <td class="rows-table">@{{registro.anio_ingreso}}@{{registro.codigo_modular}}@{{registro.numero_matricula}}@{{registro.flag}}</td>
                                        <td class="rows-table">@{{registro.num_documento}}</td>
                                        <td class="rows-table">@{{registro.apellido_paterno}} @{{registro.apellido_materno}} @{{registro.nombres}}</td>
                                        <td class="rows-table">
                                            <template v-if="registro.estado_grado == '2'">
                                                @{{fillobjectPromovido.nombre_nivel}}
                                            </template>
                                            <template v-if="registro.estado_grado == '3'">
                                                @{{fillobjectRepitente.nombre_nivel}}
                                            </template>
                                        </td>
                                        <td class="rows-table">
                                            <template v-if="registro.estado_grado == '2'">
                                                @{{fillobjectPromovido.nombre_grado}}
                                            </template>
                                            <template v-if="registro.estado_grado == '3'">
                                                @{{fillobjectRepitente.nombre_grado}}
                                            </template>
                                        </td>
                                        <td class="rows-table">
                                            <template v-if="registro.estado_grado == '2'">
                                                @{{fillobjectPromovido.nombre_seccion}}
                                            </template>
                                            <template v-if="registro.estado_grado == '3'">
                                                @{{fillobjectRepitente.nombre_seccion}}
                                            </template>
                                        </td>
                                        <td class="rows-table">@{{fillobject.fecha}}</td>
                                        <td class="rows-table">EN PROCESO</td>
                                        <td class="rows-table">
                                           <center>
                                            <button type="button" class="btn btn-info btn-sm" @click="consultarMatricula(registro)"><i class="fa fa-search" aria-hidden="true"></i></button>
                                           </center>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
    
                        </div>
                        <div v-else>
                            <h6>No se realizaron Matriculas</h6>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>   
</div>