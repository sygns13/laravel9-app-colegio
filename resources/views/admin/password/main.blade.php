<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Actualización de Contraseña del Usuario</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                    <div class="form-group row">
                      <label for="txttipo_user" class="col-sm-2 col-form-label">Tipo de Usuario</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txttipo_user" placeholder="Nombre" v-model="fillobject.tipo_user" maxlength="500" readonly>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="txtname" class="col-sm-2 col-form-label">Usuario</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtname" placeholder="Nombre" v-model="fillobject.name" maxlength="500" readonly>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="txtname" class="col-sm-2 col-form-label">Contraseña Antigua</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="txtpassword" placeholder="Contraseña Antigua" v-model="fillobject.password_old" maxlength="255">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="txtpasswordN1" class="col-sm-2 col-form-label">Contraseña Nueva</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="txtpasswordN1" placeholder="Contraseña Nueva" v-model="fillobject.password_new1" maxlength="255">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="txtpasswordN2" class="col-sm-2 col-form-label">Ingrese Nuevamente la Contraseña Nueva</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="txtpasswordN2" placeholder="Contraseña Nueva" v-model="fillobject.password_new2" maxlength="255">
                      </div>
                    </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <button style="margin-right:5px;" id="btnGuardar"  type="button" class="btn btn-primary editClass" @click="procesar()"><span class="fas fa-save"></span> Actualizar Contraseña</button>
                  {{-- <button id="btnClose" type="button" class="btn btn-default editClass" data-dismiss="modal" @click="cancelForm()"><span class="fas fa-cancel"></span> Cancelar</button> --}}
              </div>
          </div>
      </div>



    </div>
</div>
