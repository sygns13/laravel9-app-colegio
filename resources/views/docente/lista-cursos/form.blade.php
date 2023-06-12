<div class="modal" id="modalFormulario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Plan Anual del Curso @{{fillobject.curso}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="form-horizontal">
              <div class="card-body">
                <div class="form-group row">
                  <label for="txtobservacion" class="col-sm-2 col-form-label">Plan Anual</label>
                  <div class="col-sm-10">
                    <input v-if="uploadReady" name="archivo2" type="file" id="archivo2" class="archivo form-control" @change="getArchivo" accept=".pdf, .PDF"/> 
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
        <button id="btnGuardar" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->