  <div class="col-md-12" v-if="divFormulario">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@{{labelBtnSave}} Año Escolar</h3>
      </div>

      <form>
        <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtyear">Año <spam style="color:red;">*</spam></label>
                  <input type="number" class="form-control" id="txtyear" placeholder="Año Escolar" v-model="fillobject.year">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtnombre">Nombre <spam style="color:red;">*</spam></label>
                  <input type="text" class="form-control" id="txtnombre" placeholder="Nombre" v-model="fillobject.nombre" maxlength="100">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtfecha_ini_clases">Fecha de Inicio de Clases <spam style="color:red;">*</spam></label>
                  <input type="date" class="form-control" id="txtfecha_ini_clases" placeholder="dd/mm/yyyy" v-model="fillobject.fecha_ini_clases">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtfecha_fin_clases">Fecha de Fin de Clases <spam style="color:red;">*</spam></label>
                  <input type="date" class="form-control" id="txtfecha_fin_clases" placeholder="dd/mm/yyyy" v-model="fillobject.fecha_fin_clases">
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>

          <div class="card-footer">
            <button style="margin-right:5px;" id="btnClose" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
            <button id="btnGuardar" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
          </div>

        </form>
    </div>
</div>