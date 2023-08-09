<div class="container-fluid" v-if="segundaParte && !terceraParte">
    <div class="row">
        <div class="col-md-12">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lista de Estudiantes Pendientes Encontrados</h3>
                    <button style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" @click="cancelMasiva()"><i class="fa fa-times" aria-hidden="true"></i> 
                        Cancelar</button>
                </div>

                <form>
                    <div class="card-body">
                        <div class="table-responsive p-0" v-if="registros.length > 0">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="titles-table" style="width: 5%">#</th>
                                        <th class="titles-table" style="width: 10%">Código de Estudiante</th>
                                        <th class="titles-table" style="width: 10%">DNI del Estudiante</th>
                                        <th class="titles-table" style="width: 20%">Nombres</th>
                                        <th class="titles-table" style="width: 10%">Nivel Anterior</th>
                                        <th class="titles-table" style="width: 10%">Grado Anterior</th>
                                        <th class="titles-table" style="width: 10%">Sección Anterior</th>
                                        <th class="titles-table" style="width: 15%">Situación</th>
                                        <th class="titles-table" style="width: 10%"> 
                                            <button id="btnSelect"  type="button" class="btn btn-info" @click="selectAll()">Seleccionar Todo</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(registro, indexS) in registros">
                                        <td class="rows-table">@{{indexS + 1}}.</td>                                    
                                        <td class="rows-table">@{{registro.anio_ingreso}}@{{registro.codigo_modular}}@{{registro.numero_matricula}}@{{registro.flag}}</td>
                                        <td class="rows-table">@{{registro.num_documento}}</td>
                                        <td class="rows-table">@{{registro.apellido_paterno}} @{{registro.apellido_materno}} @{{registro.nombres}}</td>
                                        <td class="rows-table">@{{registro.nivel.nombre}}</td>
                                        <td class="rows-table">@{{registro.grado.nombre}}</td>
                                        <td class="rows-table">@{{registro.cicloSeccion.nombre}}</td>
                                        <td class="rows-table">
                                            <template v-if="registro.estado_grado == '2'">
                                                PROMOVIDO
                                            </template>
                                            <template v-if="registro.estado_grado == '3'">
                                                REPITENTE
                                            </template>
                                            <template v-if="registro.estado_grado == '4'">
                                                EXPULSADO
                                            </template>
                                        </td>
                                        <td>
                                            <center>
                                                <input type="checkbox" id="select" :value="registro.id" v-model="selectAlumnos" @change="select()">
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    
                        </div>
                        <div v-else>
                            <h6>No existen registros de Alumnos en la sección seleccionada</h6>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Lista de Estudiantes Seleccionados</h3>
                </div>

                <form>
                    <div class="card-body">

                        <div class="card-footer">
                            <button id="btnSaveMatricula"  type="button" class="btn btn-success" @click="procesarMatricula()" style="margin-right:5px;"><span class="fas fa-save"></span> Realizar Matrícula Masiva</button>
                            {{-- <button id="btnAtrasMatricula" type="button" class="btn btn-danger" @click="atrasMatricula()" style="margin-right: 10px;"><span class="fas fa-times"></span> Atras</button> --}}
                        </div>

                        <div class="row">
    
                            <div class="col-md-6">

                                <div class="col-sm-12">
                                    <h5>Alumnos Repitentes se Matricularán en</h5>
                                </div>

                                <div class="form-group row">
                                    <label for="cbunivel" class="col-sm-2 col-form-label">Nivel <spam style="color:red;">*</spam></label>
                                    <div class="col-sm-4">
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectRepitente.nivel" id="cbunivel" disabled="true">
                                        <option value="0" disabled>Seleccione ...</option>
                                        @foreach ($nivelesNow as $index => $nivel)
                                        <option value="{{$nivel->id}}">{{$nivel->nombre}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="cbugrado" class="col-sm-2 col-form-label">Grado <spam style="color:red;">*</spam></label>
                                    <div class="col-sm-4">
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectRepitente.grado" id="cbugrado" disabled="true">
                                        <option value="0" disabled>Seleccione ...</option>
                                        @foreach ($gradosNow as $index => $grado)
                                        <option value="{{$grado->id}}" v-if="fillobjectRepitente.nivel == '{{$grado->ciclo_niveles_id}}'">{{$grado->nombre}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <label for="cbuseccion" class="col-sm-2 col-form-label">Sección <spam style="color:red;">*</spam></label>
                                    <div class="col-sm-4">
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectRepitente.seccion" id="cbuseccion">
                                        <option value="0" disabled>Seleccione ...</option>
                                        @foreach ($seccionesNow as $index => $seccion)
                                        <option value="{{$seccion->id}}" v-if="fillobjectRepitente.grado == '{{$seccion->ciclo_grados_id}}'">{{$seccion->nombre}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="col-sm-12">
                                    <h5>Alumnos Promovidos se Matricularán en</h5>
                                </div>

                                <div class="form-group row" v-if="!isQuintoSecundariaBefore">
                                    <label for="cbunivel" class="col-sm-2 col-form-label">Nivel <spam style="color:red;">*</spam></label>
                                    <div class="col-sm-4">
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectPromovido.nivel" id="cbunivel" disabled="true">
                                        <option value="0" disabled>Seleccione ...</option>
                                        @foreach ($nivelesNow as $index => $nivel)
                                        <option value="{{$nivel->id}}">{{$nivel->nombre}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
    
                                <div class="form-group row" v-if="!isQuintoSecundariaBefore">
                                    <label for="cbugrado" class="col-sm-2 col-form-label">Grado <spam style="color:red;">*</spam></label>
                                    <div class="col-sm-4">
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectPromovido.grado" id="cbugrado" disabled="true">
                                        <option value="0" disabled>Seleccione ...</option>
                                        @foreach ($gradosNow as $index => $grado)
                                        <option value="{{$grado->id}}" v-if="fillobjectPromovido.nivel == '{{$grado->ciclo_niveles_id}}'">{{$grado->nombre}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
    
                                <div class="form-group row" v-if="!isQuintoSecundariaBefore">
                                    <label for="cbuseccion" class="col-sm-2 col-form-label">Sección <spam style="color:red;">*</spam></label>
                                    <div class="col-sm-4">
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectPromovido.seccion" id="cbuseccion">
                                        <option value="0" disabled>Seleccione ...</option>
                                        @foreach ($seccionesNow as $index => $seccion)
                                        <option value="{{$seccion->id}}" v-if="fillobjectPromovido.grado == '{{$seccion->ciclo_grados_id}}'">{{$seccion->nombre}}</option> 
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="form-group row" v-if="isQuintoSecundariaBefore">
                                    <label class="col-sm-12 col-form-label" style="color: red;">No se puede Promover porque el alumno ya culminó su quinto de secundaria</label>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive p-0" v-if="registros2.length > 0">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="titles-table" style="width: 5%">#</th>
                                        <th class="titles-table" style="width: 10%">Código de Estudiante</th>
                                        <th class="titles-table" style="width: 10%">DNI del Estudiante</th>
                                        <th class="titles-table" style="width: 20%">Nombres</th>
                                        <th class="titles-table" style="width: 10%">Nivel Anterior</th>
                                        <th class="titles-table" style="width: 10%">Grado Anterior</th>
                                        <th class="titles-table" style="width: 10%">Sección Anterior</th>
                                        <th class="titles-table" style="width: 15%">Situación</th>
                                        <th class="titles-table" style="width: 10%">
                                            <button id="btnSelectRe"  type="button" class="btn btn-warning" @click="RemoveAll()">Remover Todo</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(registro, indexS) in registros2">
                                        <td class="rows-table">@{{indexS + 1}}.</td>                                    
                                        <td class="rows-table">@{{registro.anio_ingreso}}@{{registro.codigo_modular}}@{{registro.numero_matricula}}@{{registro.flag}}</td>
                                        <td class="rows-table">@{{registro.num_documento}}</td>
                                        <td class="rows-table">@{{registro.apellido_paterno}} @{{registro.apellido_materno}} @{{registro.nombres}}</td>
                                        <td class="rows-table">@{{registro.nivel.nombre}}</td>
                                        <td class="rows-table">@{{registro.grado.nombre}}</td>
                                        <td class="rows-table">@{{registro.cicloSeccion.nombre}}</td>
                                        <td class="rows-table">
                                            <template v-if="registro.estado_grado == '2'">
                                                PROMOVIDO
                                            </template>
                                            <template v-if="registro.estado_grado == '3'">
                                                REPITENTE
                                            </template>
                                            <template v-if="registro.estado_grado == '4'">
                                                EXPULSADO
                                            </template>
                                        </td>
                                        <td>
                                            <center>
                                                <x-adminlte-button @click="remove(indexS)" id="btnBorrar" class="bg-gradient btn-sm" type="button" label="" theme="danger" icon="fas fa-trash" data-placement="top" data-toggle="tooltip" title="Remover alumno" />
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    
                        </div>
                        <div v-else>
                            <h6>Aun no Tiene Alumnos seleccionados</h6>
                        </div>
                    </div>
                </form>
            </div>


        </div>
    </div>   
</div>