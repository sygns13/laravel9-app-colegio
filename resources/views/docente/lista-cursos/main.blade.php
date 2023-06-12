<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

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


                        <template v-if="verFormulario && registros != null && registros.niveles != undefined && registros.niveles != null">

                            <div class="col-md-12" v-for="(nivel, indexN) in registros.niveles">
                                <div class="card card-primary">
                                    <div class="card-header">
                    
                    
                                    <h3 class="card-title">Nivel @{{nivel.nombre}}</h3>
                    
                    
                                    </div>
                                    <form>
                                    <div class="card-body">

                    
                                        <div class="table-responsive p-0" v-if="nivel.listaGeneral.length > 0">
                                            <table class="table table-bordered table-sm">
                                                <thead>
                                                    <tr>
                                                        <th class="titles-table" style="width: 5%">#</th>
                                                        <th class="titles-table" style="width: 23%">Curso</th>
                                                        <th class="titles-table" style="width: 18%">Grado</th>
                                                        <th class="titles-table" style="width: 13%">Seccion</th>
                                                        <th class="titles-table" style="width: 8%">Turno</th>
                                                        <th class="titles-table" style="width: 8%">N° Matriculados</th>
                                                        <th class="titles-table" style="width: 10%">Plan Anual</th>
                                                        <th class="titles-table" style="width: 15%">Gestión del Plan Anual</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(registro, indexR) in nivel.listaGeneral">
                                                        <td class="rows-table">@{{indexR+1}}.</td>                                    
                                                        <td class="rows-table">@{{registro.curso}}</td>
                                                        <td class="rows-table">@{{registro.grado}}</td>
                                                        <td class="rows-table">@{{registro.sigla}}</td>
                                                        <td class="rows-table">@{{registro.turno}}</td>
                                                        <td class="rows-table">@{{registro.matriculados}}</td>
                                                        <td class="rows-table">
                                                            <center>
                                                                <a v-if="registro.plan_anual != null && registro.plan_anual !=''" v-bind:href="'{{ asset('/web/curso/plananual')}}'+'/'+registro.plan_anual"  class="btn btn-primary btn-xs" download> Descargar</a>
                                                            </center>
                                                        </td>
                                                        <td>
                                                            <center>
                                                            {{-- <x-adminlte-button @click="detalles(registro, nivel)" id="btnEdit" class="bg-gradient btn-sm" type="button" label="Ver Detalles" theme="info" icon="fas fa-list-ol"
                                                            data-placement="top" data-toggle="tooltip" title="Editar registro" style="margin-right: 5px;"/> --}}
                                                            <x-adminlte-button @click="edit(registro)" id="btnEdit" class="bg-gradient btn-sm" type="button" label="" theme="warning" icon="fas fa-edit"
                                                            data-placement="top" data-toggle="tooltip" title="Editar Plan de Curso" style="margin-right: 5px;"/>

                                                            <x-adminlte-button @click="borrar(registro)" id="btnBorrar" class="bg-gradient btn-sm" type="button" label="" theme="danger" icon="fas fa-trash"
                                                            data-placement="top" data-toggle="tooltip" title="Eliminar Plan de Curso" />
                                                            </center>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                    
                                        </div>
                                        <div v-else>
                                            <h6>No tiene cursos asignados en el Nivel @{{nivel.nombre}}</h6>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </template>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
        </div>


    </div>
</div>