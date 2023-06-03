<div class="modal" id="modalFotoPerfil">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modificar Imagen de Perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="txtsiglas" class="col-sm-2 col-form-label">Adjunte Imagen de Perfil</label>
                    <div class="col-sm-10">
                      <input v-if="uploadReady" name="imagenP" type="file" id="imagenP" class="archivo form-control" @change="getImagen" accept=".png, .jpg, .jpeg, .gif, .jpe, .PNG, .JPG, .JPEG, .GIF, .JPE"/>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button id="btnCloseFP" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarFormPerfil()"><span class="fas fa-power-off"></span> Cerrar</button>
          <button id="btnGuardarFP" type="button" class="btn btn-primary" @click="procesarFotoPerfil()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
