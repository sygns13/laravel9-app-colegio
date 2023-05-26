<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Formulario de Actualización de Datos de la Institución Educativa</h3>
                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                    Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="txtcodigo_modular">Código Modular</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtcodigo_modular" name="txtcodigo_modular" type="text" class="form-control" v-model="fillobjectEdit.codigo_modular" maxlength="8" onkeypress="return soloNumeros(event);">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(1)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtnombre">Nombre</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtnombre" name="txtnombre" type="text" class="form-control" v-model="fillobjectEdit.nombre" maxlength="500">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(2)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Resolución de Creación</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.resolucion_creacion" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(3)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">DREA</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.departamento" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(4)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">UGEL</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.nombre_ugel" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(5)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Distrito</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.distrito" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(6)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Provincia</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.provincia" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(7)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Departamento</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.departamento" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(8)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Centro Poblado</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.centro_poblado" maxlength="200">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(9)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Dirección</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.direccion" maxlength="500">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(10)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Email</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.email" maxlength="500">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(11)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Teléfono</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.telefono" maxlength="20">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(12)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Tipo de Gestión</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.gestion" maxlength="250">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(13)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Género de los Alumnos</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.genero" maxlength="45">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(14)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Forma de Atención</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.forma" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(15)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="txtresolucion_creacion">Turno de Atención</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txtresolucion_creacion" name="txtresolucion_creacion" type="text" class="form-control" v-model="fillobjectEdit.turno" maxlength="100">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(16)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
        </div>
    </div>
</div>