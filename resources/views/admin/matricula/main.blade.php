<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            @if(!$cicloActivo)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registro de Matrícula</h3>
                        <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                            Volver</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <h4 class="text-danger">No existe Año Escolar Activo, para registrar matrículas es necesario que un Año Escolar se encuentre Activo con Proceso de Matrícula Activo.</h4>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            @elseif(intval($cicloActivo->activo_matricula) == 0)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registro de Matrícula</h3>
                        <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                            Volver</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <h3>Año Escolar: {{$cicloActivo->nombre}}</h3>
                            <h4 class="text-danger">El presente Año escolar tiene el Proceso de Matrícula Cerrado, para registrar matrículas es necesario que un Año Escolar se encuentre Activo con Proceso de Matrícula Activo.</h4>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            @else

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Registro de Matrícula</h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                        Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form v-on:submit.prevent="buscarAlumno">
                    <div class="card-body">

                        <h3>Año Escolar: {{$cicloActivo->nombre}}</h3>
                        <h4 v-if="!divFormularioAlumno">Realize la búsqueda del Alumno para Matricular:</h4><br>

                        <div class="row" v-if="!divFormularioAlumno">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="cbutipo_documento_id">Tipo de Documento de Identidad <spam style="color:red;">*</spam></label>
                                <select class="form-control" style="width: 100%;" v-model="alumno.tipo_documento_id" id="cbutipo_documento_id" @change="changeTipoDoc()">
                                  <option value="0" disabled>Seleccione ...</option>
                                  <template v-for="(tipoDoc, index) in tipoDocumentos">
                                    <option v-bind:value="tipoDoc.id">@{{tipoDoc.nombre}}</option>
                                  </template>
                                </select>
                              </div>
                            </div>
              
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="txtnum_documento">Número de @{{tipoDocSelect.sigla}} <spam style="color:red;">*</spam></label>
                                <input type="text" class="form-control" id="txtnum_documento" placeholder="Documento de Identidad" v-model="alumno.num_documento" v-bind:maxlength="tipoDocSelect.digitos">
                              </div>
                            </div>
                        </div>

                        <div class="card-footer" v-if="!divFormularioAlumno">
                            <button style="margin-right:5px;" id="btnBuscar" type="button" class="btn btn-primary" @click="buscarAlumno()"><span class="fas fa-search"></span> Buscar Alumno</button>
                            
                          </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            @endif
        </div>
    </div>


    

    
</div>