  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">@{{labelBtnSave}}</h3>
          <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
            Volver</a>        
      </div>

      <form>
        <div class="card-body">
          <div class="form-group row">
            <label for="cbutipo_documento_id" class="col-sm-2 col-form-label">Tipo de Documento</label>
            <div class="col-sm-10">
              <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_documento_id" id="cbutipo_documento_id" @change="buscarCliente">
                <option value="0" disabled>Seleccione ...</option>
                @foreach ($tipoDocumentos as $dato)
                  <option value="{{$dato->id}}">{{$dato->sigla}}</option> 
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="txtdocumento" class="col-sm-2 col-form-label">Número de Documento</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtdocumento" placeholder="N° de Documento" v-model="fillobject.documento" maxlength="20" required @change="buscarCliente">
            </div>
          </div>

          <div class="form-group row">
            <label for="txtnombres" class="col-sm-2 col-form-label">Nombre del Cliente</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtnombres" placeholder="Nombres" v-model="fillobject.nombres" maxlength="100" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="txtcelular" class="col-sm-2 col-form-label">Celular</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtcelular" placeholder="Celular" v-model="fillobject.celular" maxlength="25" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="txtcorreo" class="col-sm-2 col-form-label">Correo Electrónico</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="txtcorreo" placeholder="Correo Electrónico" v-model="fillobject.correo" maxlength="250" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="cbumodelo" class="col-sm-2 col-form-label">Modelo</label>
            <div class="col-sm-10">
              <select class="form-control" style="width: 100%;" v-model="fillobject.modelo" id="cbumodelo" @change="buscarYear">
                <option value="0" disabled>Seleccione ...</option>
                @foreach ($modelos as $dato)
                  <option value="{{$dato->modelo}}">{{$dato->modelo}}</option> 
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="cbuyear" class="col-sm-2 col-form-label">Año</label>
            <div class="col-sm-10">
              <select class="form-control" style="width: 100%;" v-model="fillobject.year" id="cbuyear" @change="buscarColor">
                <option value="0" disabled>Seleccione ...</option>
                @foreach ($years as $dato)
                  <option value="{{$dato->year}}" v-if="fillobject.modelo == '{{$dato->modelo}}'">{{$dato->year}}</option> 
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row" v-show="cantidadOptionsValidos > 1">
            <label for="cbucolor" class="col-sm-2 col-form-label">Color</label>
            <div class="col-sm-10">
              <select class="form-control" style="width: 100%;" v-model="fillobject.maestro_modelo_id" id="cbucolor" @change="buscarModelo">
                <option value="0" disabled>Seleccione ...</option>
                @foreach ($colors as $dato)
                  <option value="{{$dato->id}}" v-if="fillobject.year == '{{$dato->year}}' && fillobject.modelo == '{{$dato->modelo}}'">{{$dato->color_comercial}}</option> 
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row" v-if="fillobject.maestro_modelo_id > 0">
            <label for="txtprecio_usd" class="col-sm-2 col-form-label">Precio de Venta USD $</label>
            <div class="col-sm-10">
              {{-- <input type="text" class="form-control" id="txtprecio_usd" placeholder="0.00" v-model="fillobject.precio_usd" maxlength="20" @change="calcularPrecioFinal" onkeypress="return soloNumerosConDecimales(event);"> --}}
              <input type="text" class="form-control" id="txtprecio_usd" placeholder="0.00" v-model="fillobject.precio_usd" maxlength="20" @change="calcularPrecioFinal" onkeypress="return soloNumerosConDecimalesReg(event, this);" readonly="true">
            </div>
          </div>

          <div class="form-group row" v-if="false">
            <label for="txtdescuento_usd" class="col-sm-2 col-form-label">Descuento USD $</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtdescuento_usd" placeholder="0.00" v-model="fillobject.descuento_usd" maxlength="20" @change="calcularPrecioFinal" onkeypress="return soloNumerosConDecimalesReg(event, this);">
            </div>
          </div>

          <div class="form-group row" v-if="fillobject.maestro_modelo_id > 0">
            <label for="txtprecio_final_usd" class="col-sm-2 col-form-label">Precio Final USD $</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtprecio_final_usd" placeholder="0.00" v-model="fillobject.precio_final_usd" maxlength="20" readonly="true">
            </div>
          </div>

          <h6><b>Políticas Opcionales</b></h6>

          <div class="form-group row">
            <div class="col-sm-6" style="padding-left:40px; ">
              <input class="form-check-input" type="checkbox" v-model="fillobject.include1" value="1" id="checkboxinclude1" disabled="true" :true-value="1" :false-value="0">
              <label class="form-check-label">Trámite de Placa y Tarjeta</label>
            </div>
            <div class="col-sm-6" style="padding-left:40px; ">
              <input class="form-check-input" type="checkbox" v-model="fillobject.include2" value="1" id="checkboxinclude2" disabled="true" :true-value="1" :false-value="0">
              <label class="form-check-label">Casco</label>
            </div>

            <div class="col-sm-6" style="padding-left:40px; "> 
              <input class="form-check-input" type="checkbox" v-model="fillobject.include3" value="1" id="checkboxinclude3" disabled="true" :true-value="1" :false-value="0">
              <label class="form-check-label">SOAT</label>
            </div>
            <div class="col-sm-6" style="padding-left:40px; ">
              <input class="form-check-input" type="checkbox" v-model="fillobject.include4" value="1" id="checkboxinclude4" disabled="true" :true-value="1" :false-value="0">
              <label class="form-check-label">Otros Gift</label>
            </div>
          </div>

          <div class="form-group row">
            <label for="txtobservaciones" class="col-sm-2 col-form-label">Observaciones</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="txtobservaciones" placeholder="Observaciones (opcional)" v-model="fillobject.observaciones" rows="2" maxlength="500"></textarea>
            </div>
          </div>

          {{-- <div class="form-group row">
            <label for="txttipo" class="col-sm-2 col-form-label">Tipo de Cotización</label>
            <div class="col-sm-10">
              <select class="form-control" style="width: 100%;" v-model="fillobject.tipo" id="txttipo">
                <option value="0" disabled>Seleccione ...</option>
                <option value="1">Cotización de Apertura de Año</option> 
                <option value="2">Cotización de Cierre de Año</option> 
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="txtnombre" class="col-sm-2 col-form-label">Nombre de Cotización</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="txtnombre" placeholder="Nombre" v-model="fillobject.nombre" maxlength="500">
            </div>
          </div>
          <div class="form-group row">
            <label for="txtyear" class="col-sm-2 col-form-label">Año de Cotización</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="txtyear" placeholder="Año" v-model="fillobject.year" maxlength="10" onkeypress="return soloNumeros(event);">
            </div>
          </div>
          <div class="form-group row">
            <label for="txtarchivo" class="col-sm-2 col-form-label">Archivo Adjunto</label>
            <div class="col-sm-10">
              <input v-if="uploadReady" name="archivo" type="file" id="archivo" class="archivo form-control" @change="getArchivo" accept=".pdf, .PDF"/>
            </div>
          </div> --}}
        </div>

          <div class="card-footer">
            <button style="margin-right:5px;" id="btnGuardar" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> Grabar</button>
            <button style="margin-right:5px;" id="btnCotizar" type="button" class="btn btn-success" @click="cotizar()"><span class="fas fa-print"></span> Cotizar</button>
            <button style="margin-right:5px;" id="btnCancel" type="button" class="btn btn-warning" @click="cancelar()"><span class="fas fa-times"></span> Cancel</button>
            {{-- <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button> --}}
          </div>

        </form>
    </div>
</div>