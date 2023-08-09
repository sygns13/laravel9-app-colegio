<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">

            @if(!$cicloActivo)
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Registro de Matrícula Masiva</h3>
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

            <div class="card card-primary" v-if="!terceraParte">
                <div class="card-header">
                    <h3 class="card-title">Registro de Matrícula Masiva</h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                        Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form v-on:submit.prevent="buscarAlumno">
                    <div class="card-body">

                        <center><h3>Año Escolar: {{$cicloActivo->nombre}}</h3></center>

                        {{-- Formulario para buscar al alumno --}}
                        <h4 v-if="!divFormularioAlumno && !divFormularioCabecera">Matrícula Masiva: Buscar Pendientes del {{$cicloActivoLast->nombre}}</h4><br>

                        <div class="form-group row">
                          <label for="cbunivel" class="col-sm-2 col-form-label">Nivel <spam style="color:red;">*</spam></label>
                          <div class="col-sm-10">
                            <select class="form-control" style="width: 100%;" v-model="fillobject.nivel" id="cbunivel" @change="changeNivel()" :disabled="!primeraParte">
                              <option value="0" disabled>Seleccione ...</option>
                              @foreach ($niveles as $index => $nivel)
                                <option value="{{$nivel->id}}">{{$nivel->nombre}}</option> 
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="cbugrado" class="col-sm-2 col-form-label">Grado <spam style="color:red;">*</spam></label>
                          <div class="col-sm-10">
                            <select class="form-control" style="width: 100%;" v-model="fillobject.grado" id="cbugrado" @change="changeGrado()" :disabled="!primeraParte">
                              <option value="0" disabled>Seleccione ...</option>
                              @foreach ($grados as $index => $grado)
                                <option value="{{$grado->id}}" v-if="fillobject.nivel == '{{$grado->ciclo_niveles_id}}'">{{$grado->nombre}}</option> 
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="cbuseccion" class="col-sm-2 col-form-label">Sección <spam style="color:red;">*</spam></label>
                          <div class="col-sm-10">
                            <select class="form-control" style="width: 100%;" v-model="fillobject.seccion" id="cbuseccion" :disabled="!primeraParte">
                              <option value="0" disabled>Seleccione ...</option>
                              @foreach ($secciones as $index => $seccion)
                                <option value="{{$seccion->id}}" v-if="fillobject.grado == '{{$seccion->ciclo_grados_id}}'">{{$seccion->nombre}}</option> 
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="txtresponsable_matricula_nombres" class="col-sm-2 col-form-label">Responsable de Matrícula <spam style="color:red;">*</spam></label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtresponsable_matricula_nombres" placeholder="Apellidos y Nombres" v-model="fillobject.responsable_matricula_nombres" maxlength="500" :disabled="!primeraParte">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="txtfecha" class="col-sm-2 col-form-label">Fecha de Matrícula <spam style="color:red;">*</spam></label>
                          <div class="col-sm-2">
                            <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fillobject.fecha" :disabled="!primeraParte">
                          </div>
                        </div>

                        <div class="card-footer" v-if="primeraParte">
                          <button style="margin-right:5px;" id="btnBuscar" type="button" class="btn btn-primary" @click="buscarMasiva()"><span class="fas fa-search"></span> Buscar</button>
                          <button style="margin-right:5px;" id="btnCancel" type="button" class="btn btn-danger" @click="cancelar()"><span class="fas fa-times"></span> Cancelar</button>
                      </div>

                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            @endif
        </div>
    </div>   
</div>