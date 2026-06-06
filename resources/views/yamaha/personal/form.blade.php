  <div class="col-md-12" v-if="divFormulario">
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">@{{labelBtnSave}} Usuario</h3>
      </div>

      <form>
        <div class="card-body">

            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label for="cbutipo_documento_id">Tipo de Documento de Identidad <spam style="color:red;">*</spam></label>
                  <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_documento_id" id="cbutipo_documento_id" @change="changeTipoDoc()">
                    <option value="0" disabled>Seleccione ...</option>
                      @foreach ($tipoDocumentos as $dato)
                        <option value="{{$dato->id}}">{{$dato->sigla}}</option> 
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="txtdocumento">Número de @{{tipoDocSelect.sigla}} <spam style="color:red;">*</spam></label>
                  <input type="text" class="form-control" id="txtdocumento" placeholder="Documento de Identidad" v-model="fillobject.documento" v-bind:maxlength="tipoDocSelect.digitos">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="txtempresa">Empresa del Usuario <spam style="color:red;">*</spam></label>
                  <input type="text" class="form-control" id="txtempresa" placeholder="Código de Plaza" v-model="fillobject.empresa" maxlength="150">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtapellidos">Apellidos <spam style="color:red;">*</spam></label>
                  <input type="text" class="form-control" id="txtapellidos" placeholder="Apellidos" v-model="fillobject.apellidos" maxlength="250" @change="generateUsername">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtnombres">nombres <spam style="color:red;">*</spam></label>
                  <input type="text" class="form-control" id="txtnombres" placeholder="Nombres" v-model="fillobject.nombres" maxlength="250" @change="generateUsername">
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="txtcelular">Celular <spam style="color:red;">*</spam></label>
                  <input type="text" class="form-control" id="txtcelular" placeholder="Celular" v-model="fillobject.celular" minlength="9" maxlength="11" onkeypress="return soloNumeros(event);">
                </div>
              </div>


            </div>

            
            <div class="col-md-12">
              <hr>
            </div>
            <h5 style="font-weight: bold;">Datos de Usuario del Sistema:</h5>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cbutipo_user_id">Tipo de Usuario <spam style="color:red;">*</spam></label>
                  <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_user_id" id="cbutipo_user_id">
                    <option value="0" disabled>Seleccione ...</option>
                      @foreach ($tipoUsers as $dato)
                        <option value="{{$dato->id}}">{{$dato->nombre}}</option> 
                      @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtemail">Email <spam style="color:red;">*</spam></label>
                  <input type="email" class="form-control" id="txtemail" placeholder="Email" v-model="fillobject.email" maxlength="255" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtname">Username <spam style="color:red;">*</spam></label>
                  <input type="text" class="form-control" id="txtname" placeholder="Username" v-model="fillobject.name" maxlength="255">
                </div>
              </div>
            </div>

            <div class="row" v-if="fillobject.type=='U'">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cbumodifPsw">¿Modificar Password? <spam style="color:red;">*</spam></label>
                  <select class="form-control" style="width: 100%;" v-model="fillobject.modifPsw" id="cbumodifPsw">
                    <option value="0">No</option>
                    <option value="1">Si</option>
                  </select>
                </div>
              </div>
            </div>


            <div class="row" v-if="parseInt(fillobject.modifPsw)==1 || fillobject.type=='C'">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="txtpassword">Password <spam style="color:red;">*</spam></label>
                  <input type="password" class="form-control" id="txtpassword" placeholder="Password" v-model="fillobject.password" maxlength="255">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="cbuactivo">Estado del Usuario <spam style="color:red;">*</spam></label>
                  <select class="form-control" style="width: 100%;" v-model="fillobject.activo" id="cbuactivo">
                    <option value="1">Activado</option>
                    <option value="0">Desactivado</option>
                  </select>
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