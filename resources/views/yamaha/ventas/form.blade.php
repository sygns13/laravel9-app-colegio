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
                    <label for="cbutipo_sales_id" class="col-sm-2 col-form-label">Tipo de Proceso</label>
                    <div class="col-sm-10">
                        <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_sales_id" id="cbutipo_sales_id">
                            @foreach ($tipoSales as $dato)
                                <option value="{{$dato->id}}">{{$dato->descripcion}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="cbutipo_documento_id" class="col-sm-2 col-form-label">Tipo de Documento</label>
                    <div class="col-sm-10">
                        <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_documento_id" id="cbutipo_documento_id" @change="buscarCliente($event)">
                            <option value="0" disabled>Seleccione ...</option>
                            @foreach ($tipoDocumentos as $dato)
                                <option value="{{$dato->id}}" data-digitos="{{ $dato->digitos }}">{{$dato->sigla}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtdocumento" class="col-sm-2 col-form-label">Número de Documento</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtdocumento" placeholder="N° de Documento"
                               v-model="fillobject.documento" :maxlength="maxLengthDocumento" required @change="buscarCliente($event)" @input="forzarLargoMaximo">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtnombres" class="col-sm-2 col-form-label">Nombre del Cliente</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtnombres" placeholder="Nombres" v-model="fillobject.nombres" maxlength="250" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtcelular" class="col-sm-2 col-form-label">Celular</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtcelular" placeholder="Celular" v-model="fillobject.celular" maxlength="12" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtcorreo" class="col-sm-2 col-form-label">Correo Electrónico</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="txtcorreo" placeholder="Correo Electrónico" v-model="fillobject.correo" maxlength="250" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="txtobservaciones" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="4" placeholder="Ingrese Observación ..." id="txtobservacion" v-model="fillobject.observacion"></textarea>
                    </div>
                </div>

                <div class="col-md-12" style="padding-left: 0px;padding-right: 0px;">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Añadir Items</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12" style="padding-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-9" style="padding-left: 0px;">
                                            <div style="padding: 10px;">
                                                <input type="text" class="form-control" placeholder="Buscar por Código" id="buscar" v-model="buscarCodigoItem" @keyup.enter="buscarItem">
                                            </div>
                                        </div>
                                        <div class="col-md-1" style="text-align: right">
                                            <div style="padding: 10px;">
                                                <button type="button" class="btn btn-primary btn-md" v-on:click.prevent="buscarItem()"><i class="fas fa-search"></i> Buscar
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="text-align: left">
                                            <div style="padding: 10px;">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalQR"><i class="fas fa-camera"></i>
                                                    Escanear
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline table-responsive">
                                    <thead>
                                    <tr>
                                        <th width="1%" style="text-align: center;">N°</th>
                                        <th width="15%" style="text-align: center;">Código</th>
                                        <th width="29%" style="text-align: center;">Descripción</th>
                                        <th width="10%" style="text-align: center;">Precio Unit.</th>
                                        <th width="10%" style="text-align: center;">Cant.</th>
                                        <th width="10%" style="text-align: center;">Total</th>
                                        <th width="15%" style="text-align: center;">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(dato, index) in arrayItems" :key="dato.id" class="odd">
                                        <td style="text-align: center;">@{{ index + 1 }}</td>
                                        <td style="text-align: center;">@{{ dato.codigo }}</td>
                                        <td style="text-align: center;">@{{ dato.descripcion }}</td>
                                        <td style="text-align: center;">S./ @{{ dato.precio.toFixed(2) }}</td>
                                        <td style="text-align: center;">
                                            <input type="text" maxlength="9" class="form-control" style="width: 70px; margin: auto;"
                                                   v-model.number="dato.cantidad" @input="recalcularTotal(dato)" onkeypress="return soloNumeros(event);">
                                        </td>
                                        <td style="text-align: center;">S./ @{{ (dato.precio * dato.cantidad).toFixed(2) }}</td>
                                        <td style="text-align: center;">
                                            <button type="button" class="btn btn-danger btn-sm" @click="eliminarItem(index)">
                                                <i class="fas fa-remove"></i> Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>

                                </table>
                                <div class="col-md-12" style="padding-bottom: 10px;">
                                    <div class="row">
                                        <div class="col-md-10" style="padding-left: 0px;">
                                        </div>
                                        <div class="col-md-2" style="text-align: left">
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input type="text" class="form-control" :value="'S/ ' + montoTotal" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" v-on:click.prevent="abrirCamaraVoucher()"><i class="fas fa-camera"></i>
                    Capturar Voucher
                </button>
                <div v-if="fillobject.voucher" style="text-align: center; margin-top: 10px;">
                    <label>Voucher Capturado:</label>
                    <br>
                    <img :src="fillobject.voucher" alt="Voucher Capturado" style="max-width: 100%; border: 1px solid #ccc; border-radius: 5px; padding: 5px; margin-bottom: 10px;">
                    <br>
                    <button class="btn btn-sm btn-danger" @click="eliminarVoucher">Eliminar Voucher</button>
                </div>

            </div>

            <div class="card-footer">
                <button :disabled="procesando" style="margin-right:5px;" id="btnGuardar" type="button" class="btn btn-primary" @click="procesar()"><span v-if="procesando" class="fas fa-spinner fa-spin"></span><span v-else class="fas fa-save"></span> @{{ procesando ? 'Procesando...' : 'Grabar' }}</button>
                <button :disabled="procesando" style="margin-right:5px;" id="btnCancel" type="button" class="btn btn-warning" @click="cancelar()"><span class="fas fa-times"></span> Cancel</button>
            </div>

        </form>
    </div>
</div>

<!-- Modal de escaneo QR -->
<div class="modal fade" id="modalQR" tabindex="-1" role="dialog" aria-labelledby="modalQRLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 40rem;">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalQRLabel">Escanear Código QR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" @click="detenerEscaneo">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <div class="form-group">
                    <label for="cameraQrSelect">Seleccionar Cámara</label>
                    <select id="cameraQrSelect" class="form-control" v-model="selectedCameraQrId" @change="changeDispositivo()">
                        <option v-for="cam in camerasQrDisponibles" :key="cam.deviceId" :value="cam.deviceId">
                            @{{ cam.label || 'Cámara ' + cam.deviceId }}
                        </option>
                    </select>
                </div>

                <div id="reader" style="width: 100%;" v-if="renderqr"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para capturar foto del voucher -->
<div class="modal fade" id="modalVoucher" tabindex="-1" role="dialog" aria-labelledby="modalVoucherLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 40rem;">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalVoucherLabel">Capturar Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" @click="cerrarCamaraVoucher">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="text-align: center;">
                <div class="form-group">
                    <label for="cameraSelect">Seleccionar Cámara</label>
                    <select id="cameraSelect" class="form-control" v-model="selectedCameraId" @change="changeDispositivo2()">
                        <option v-for="cam in camerasQrDisponibles" :key="cam.deviceId" :value="cam.deviceId">
                            @{{ cam.label || 'Cámara ' + cam.deviceId }}
                        </option>
                    </select>
                </div>
               <video id="videoVoucher" class="w-100" autoplay playsinline style="max-height: 40rem;"></video>
                <canvas id="canvasVoucher" style="display: none;"></canvas>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" @click="capturarVoucher" id="boton">Capturar</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="multiSelectModal" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 40rem;">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h4 class="modal-title">Seleccione el ítem correcto</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" @click="closeModal">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="text-align: center;">
            <ul class="list-group">
              <li class="list-group-item" v-for="it in multiItems" :key="it.id"
                  @click="selectItem(it)" style="cursor: pointer;">
                <strong>@{{ it.codigo }}</strong> – @{{ it.descripcion }}
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button class="btn btn-default" @click="closeModal">Cancelar</button>
          </div>
        </div>
      </div>
    </div>
