<div class="container-fluid">
    <div class="row">


        @if($user->tipo_user_id == "4") {{-- Alumno --}}
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Aviso Informativo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <h4>"No se puede editar los datos comuníquese con su director"</h4>
    
          
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>

        @elseif($user->tipo_user_id == "3") {{-- Docente --}}
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Aviso Informativo</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <h4>"No se puede editar los datos comuníquese con su director"</h4>
    
          
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>

        @elseif($user->tipo_user_id == "1" || $user->tipo_user_id == "2") {{-- Admin --}}

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Datos del Director</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="cbutipo_documento_id">Tipo de Documento de Identidad <spam style="color:red;">*</spam></label>
                                      <select class="form-control" style="width: 100%;" v-model="directorEdit.tipo_documento_id" id="cbutipo_documento_id" @change="changeTipoDoc()">
                                        <option value="0" selected="selected">Seleccione ...</option>
                                        <template v-for="(tipoDoc, index) in tipoDocumentos">
                                          <option v-bind:value="tipoDoc.id">@{{tipoDoc.nombre}}</option>
                                        </template>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="txtnum_documento">Número de @{{tipoDocSelect.sigla}} <spam style="color:red;">*</spam></label>
                                      <input type="text" class="form-control" id="txtnum_documento" placeholder="Documento de Identidad" v-model="directorEdit.num_documento" v-bind:maxlength="tipoDocSelect.digitos">
                                    </div>
                                  </div>

                                  <br>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="txtapellidos">Apellidos <spam style="color:red;">*</spam></label>
                                      <input type="text" class="form-control" id="txtapellidos" placeholder="Apellidos" v-model="directorEdit.apellidos" maxlength="250" >
                                    </div>
                                  </div>
                    
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="txtnombre">Nombres <spam style="color:red;">*</spam></label>
                                      <input type="text" class="form-control" id="txtnombre" placeholder="Nombres" v-model="directorEdit.nombre" maxlength="250" >
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="cbugenero">Género <spam style="color:red;">*</spam></label>
                                      <select class="form-control" style="width: 100%;" v-model="directorEdit.genero" id="cbugenero">
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                      </select>
                                    </div>
                                  </div>
                
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="txtcorreo">Email <spam style="color:red;">*</spam></label>
                                      <input type="text" class="form-control" id="txtcorreo" placeholder="Email" v-model="directorEdit.email" maxlength="500">
                                    </div>
                                  </div>
                      
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="txttelefono">Teléfono</label>
                                      <input type="text" class="form-control" id="txttelefono" placeholder="Telefono" v-model="directorEdit.telefono" maxlength="11" onkeypress="return soloNumeros(event);">
                                    </div>
                                  </div>
                
                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="txtcelular">Celular</label>
                                      <input type="text" class="form-control" id="txtcelular" placeholder="Celular" v-model="directorEdit.celular" maxlength="11" onkeypress="return soloNumeros(event);">
                                    </div>
                                  </div>


                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="txtcondicion">Condición <spam style="color:red;">*</spam></label>
                                      <input type="text" class="form-control" id="txtcondicion" placeholder="Condición" v-model="directorEdit.condicion" maxlength="100">
                                    </div>
                                  </div>
                    
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="txtdedicacion">Dedicación <spam style="color:red;">*</spam></label>
                                      <input type="text" class="form-control" id="txtdedicacion" placeholder="Dedicación" v-model="directorEdit.dedicacion" maxlength="100">
                                    </div>
                                  </div>
                    
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label for="txtcargo">Cargo <spam style="color:red;">*</spam></label>
                                      <input type="text" class="form-control" id="txtcargo" placeholder="Cargo" v-model="directorEdit.cargo" maxlength="100">
                                    </div>
                                  </div>
                            </div>
    
          
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button style="margin-right:5px;" id="btnGuardar"  type="button" class="btn btn-primary editClass" @click="procesar()"><span class="fas fa-save"></span> Actualizar</button>
                            <button id="btnClose" type="button" class="btn btn-default editClass" data-dismiss="modal" @click="cancelForm()"><span class="fas fa-cancel"></span> Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @else



        <div class="col-md-12">
            <div class="row">



            <div class="col-md-4">
                <div class="card card-widget widget-user">
                    <div class="widget-user-header bg-primary">
                        <h3 class="widget-user-username">@{{director.nombre}} @{{director.apellidos}}</h3>
                        <h5 class="widget-user-desc">@{{director.cargo}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" :src="'{{ asset('web/perfil/admin/') }}/'+user.profile_photo_path" alt="User Avatar">
                        <button type="buttton" class="btn btn-info" @click="editPerfil"><i class="fas fa-edit"></i></button>
                    </div>
                    <div class="card-body box-profile">
                        <br>
                        <br>
                      <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Condición</b> <a class="float-right">@{{director.condicion}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Dedicación</b> <a class="float-right">@{{director.dedicacion}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Cargo</b> <a class="float-right">@{{director.cargo}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Celular</b> <a class="float-right">@{{director.celular}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Correo</b> <a class="float-right">@{{director.email}}</a>
                        </li>
                      </ul>
                      {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>

            <div class="col-md-8">

                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Información de la I.E.</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <strong><i class="fas fa-chevron-right"></i> DRE: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.departamento}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> UGEL: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.nombre_ugel}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Nombre / N° de la I.E.: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.nombre}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Nivel / Modalidad: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.niveles}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Distrito: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.distrito}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Provincia: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.provincia}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Departamento: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.departamento}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Centro Poblado: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.centro_poblado}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Dirección: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.direccion}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Email: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.email}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Teléfono: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.telefono}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Tipo de Gestión: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.gestion}}</p>
                      <hr style="margin-top: 0px;">
      
                      <strong><i class="fas fa-chevron-right"></i> Género de los Alumnos: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.genero}}</p>
                      <hr style="margin-top: 0px;">

                      <strong><i class="fas fa-chevron-right"></i> Forma de Atención: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.forma}}</p>
                      <hr style="margin-top: 0px;">

                      <strong><i class="fas fa-chevron-right"></i> Turno de Atención: </strong>
                      <p class="text-muted" style="display:inline-flex; margin:0px;">@{{ie.turno}}</p>

      
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        </div>

        <div class="col-md-12" style="padding-top: 25px;">
            <div class="row">
                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Misión de la IE</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <button type="buttton" class="btn btn-info" @click="editMision"><i class="fas fa-edit"></i> Modificar Misión</button>

                                <img class="img img-responsive img-fluid pad" :src="'{{ asset('web/img/mision/') }}/'+ie.path_mision" alt="Photo" style="height:340px;">
                            </div>
                            <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-6">

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Visión de la IE</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                            <div class="card-body">
                                <button type="buttton" class="btn btn-info" @click="editVision"><i class="fas fa-edit"></i> Modificar Visión</button>

                                <img class="img img-responsive img-fluid pad" :src="'{{ asset('web/img/vision/') }}/'+ie.path_vision" alt="Photo" style="height:340px;">
                            </div>
                            <!-- /.card-body -->
                    </div>
                </div>


                </div>
            </div>

            @endif


    </div>
</div>
