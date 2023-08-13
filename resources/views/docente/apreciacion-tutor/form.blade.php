  <div class="modal" id="modalFormulario">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Registro Apreciación por Estudiante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" v-if="verAlumno">
            <form class="form-horizontal">
                <div class="card-body">
                  <div class="form-group row" style="margin-bottom: 0px;">
                    <label for="txtobservacion" class="col-sm-2 col-form-label">N° de Orden</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtOrden" placeholder="N° Orden" v-model="numOrden" disabled>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: 0px;">
                    <label for="txtCodigo" class="col-sm-2 col-form-label">Código</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtCodigo" placeholder="Código" v-model="codigo" disabled>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: 0px;">
                    <label for="txtFullName" class="col-sm-2 col-form-label">Apellidos y nombres</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtFullName" placeholder="" v-model="fullName" disabled>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: 0px;">
                    <label for="txtNivel" class="col-sm-2 col-form-label">Nivel</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtNivel" placeholder="" v-model="nivelN" disabled>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: 0px;">
                    <label for="txtGrado" class="col-sm-2 col-form-label">Grado</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtGrado" placeholder="" v-model="gradoN" disabled>
                    </div>
                  </div>

                  <div class="form-group row" style="margin-bottom: 0px;">
                    <label for="txtSeccion" class="col-sm-2 col-form-label">Sección</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="txtSeccion" placeholder="" v-model="seccionN" disabled>
                    </div>
                  </div>
                  <br>


                  <div class="form-group row">
                    <label for="txtobservacion1" class="col-sm-2 col-form-label">Areciación 1 Trimestre</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="4" placeholder="Ingrese Apreciación ..." id="txtobservacion1" v-model="alumno.aprecia_tutor_1"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="txtobservacion2" class="col-sm-2 col-form-label">Areciación 2 Trimestre</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="4" placeholder="Ingrese Apreciación ..." id="txtobservacion2" v-model="alumno.aprecia_tutor_2"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="txtobservacion3" class="col-sm-2 col-form-label">Areciación 3 Trimestre</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="4" placeholder="Ingrese Apreciación ..." id="txtobservacion3" v-model="alumno.aprecia_tutor_3"></textarea>
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
