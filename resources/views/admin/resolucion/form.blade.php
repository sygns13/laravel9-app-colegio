  <div class="col-md-12" v-if="divFormulario">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@{{labelBtnSave}} Resolución</h3>
      </div>

      <form>
        <div class="card-body">
          <div class="form-group row">
            <label for="txttipo" class="col-sm-2 col-form-label">Tipo de Resolución</label>
            <div class="col-sm-10">
              <select class="form-control" style="width: 100%;" v-model="fillobject.tipo" id="txttipo">
                <option value="0" disabled>Seleccione ...</option>
                <option value="1">Resolución de Apertura de Año</option> 
                <option value="2">Resolución de Cierre de Año</option> 
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="txtnombre" class="col-sm-2 col-form-label">Nombre de Resolución</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtnombre" placeholder="Nombre" v-model="fillobject.nombre" maxlength="500">
            </div>
          </div>
          <div class="form-group row">
            <label for="txtyear" class="col-sm-2 col-form-label">Año de Resolución</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="txtyear" placeholder="Año" v-model="fillobject.year" maxlength="10" onkeypress="return soloNumeros(event);">
            </div>
          </div>
          <div class="form-group row">
            <label for="txtarchivo" class="col-sm-2 col-form-label">Archivo Adjunto</label>
            <div class="col-sm-10">
              <input v-if="uploadReady" name="archivo" type="file" id="archivo" class="archivo form-control" @change="getArchivo" accept=".pdf, .PDF"/>
            </div>
          </div>
        </div>

          <div class="card-footer">
            <button style="margin-right:5px;" id="btnGuardar" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
            <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
          </div>

        </form>
    </div>
</div>