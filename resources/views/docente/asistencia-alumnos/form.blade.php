  <div class="modal" id="modalFormulario">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@{{labelBtnSave}} @{{fillobject.apellidos}} @{{fillobject.nombre}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="txtobservacion" class="col-sm-2 col-form-label">Observación del Registro</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="4" placeholder="Ingrese Observación ..." id="txtobservacion" v-model="fillobject.observacion"></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button id="btnGuardar" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
          <button id="btnClose" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal" id="modalValidar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Brigadier: @{{fillobject.apellidos}} @{{fillobject.nombre}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="txtobservacion" class="col-sm-2 col-form-label">Usuario</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtname" placeholder="Username" v-model="fillobject.name" maxlength="255">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="txtobservacion" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="txtpassword" placeholder="Password" v-model="fillobject.password" maxlength="255">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button id="btnGuardar2" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm2()"><span class="fas fa-power-off"></span> Cerrar</button>
          <button id="btnClose2" type="button" class="btn btn-primary" @click="procesar2()"><span class="fas fa-save"></span> Validar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->