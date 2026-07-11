<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Filtros de Búsqueda</h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i>
                        Volver</a>
                </div>
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tipo Venta:</label>
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectEdit.tipo_sales_id" id="cbu_tipo_sales_id">
                                        <option value="0">TODOS</option>
                                        @foreach ($tipoSales as $dato)
                                            <option value="{{$dato->id}}">{{$dato->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Fecha Inicial:</label>
                                    <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fillobjectEdit.fechaIni">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>Fecha Final:</label>
                                    <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fillobjectEdit.fechaFin">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tipo de Doc (Cliente):</label>
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectEdit.tipo_documento_id" id="cbutipo_documento_id">
                                        <option value="0">TODOS</option>
                                        @foreach ($tipoDocumentos as $dato)
                                            <option value="{{$dato->id}}">{{$dato->sigla}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Documento:</label>
                                    <input type="text" class="form-control" id="txtdocumento" placeholder="N° de Documento" v-model="fillobjectEdit.documento" maxlength="20" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <x-adminlte-button @click="buscarDatos()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Realizar Búsqueda" theme="primary" icon="fas fa-search" style="margin: 5px;"/>
                                <x-adminlte-button @click="exportarExcel()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Exportar Datos" theme="success" icon="fa fa-file-excel" style="margin: 5px;"/>
                                <x-adminlte-button @click="exportarExcelDetalleMasivo()" id="btnExportarDetalles" class="bg-gradient btn-sm" type="button" label="Exportar Detalles" theme="success" icon="fa fa-file-excel" style="margin: 5px;"/>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- @include('admin.hora.form') --}}

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">


                    <h3 class="card-title">Listado de Ventas</h3>


                </div>
                <form>
                    <div class="card-body">
                        <div class="table-responsive p-0" v-if="registros.length > 0">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th class="titles-table" style="width: 1%">#</th>
                                    <th class="titles-table" style="width: 5%">Tipo Venta</th>
                                    <th class="titles-table" style="width: 10%">Cliente</th>
                                    <th class="titles-table" style="width: 7%">Documento de Cliente</th>
                                    <th class="titles-table" style="width: 7%">Telefono</th>
                                    <th class="titles-table" style="width: 8%">Correo</th>
                                    <th class="titles-table" style="width: 6%">Fecha de Venta</th>
                                    <th class="titles-table" style="width: 9%">Responsable de Registro</th>    <!-- nueva columna -->
                                    <th class="titles-table" style="width: 7%">Entregado</th>    <!-- nueva columna -->
                                    <th class="titles-table" style="width: 7%">Registrado</th>    <!-- nueva columna -->
                                    <th class="titles-table" style="width: 9%">Responsable de Facturacion</th>
                                    <th class="titles-table" style="width: 9%">Observaciones</th>
                                    <th class="titles-table" style="width: 7%">Voucher</th>
                                    <th class="titles-table" style="width: 8%">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(registro, indexS) in registros">
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{indexS+pagination.from}}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{registro.tipo_sales.descripcion}}</td>
                                    <td class="rows-table" style="text-align: left;vertical-align: middle;font-size: 14px;">@{{registro.clientes.nombres}} @{{registro.clientes.apellidos}}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{registro.clientes.tipo_documento.sigla}} @{{registro.clientes.documento}}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{registro.clientes.celular}}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{registro.clientes.correo}}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{registro.fecha}}</td>
                                    <td class="rows-table" style="text-align: left;vertical-align: middle;font-size: 14px;">@{{registro.personals.nombres}} @{{registro.personals.apellidos}}</td>
                                    <td class="text-center" style="vertical-align: middle">
                                        <input
                                        type="checkbox"
                                        style="width: 1.3rem;height: 1.3rem;"
                                        v-model="registro.entregado"
                                        :true-value="1"
                                        :false-value="0"
                                        @change="updateEntregado(registro)"
                                        />
                                    </td>

                                    <td class="text-center" style="vertical-align: middle">
                                        <input
                                        type="checkbox"
                                        style="width: 1.3rem;height: 1.3rem;"
                                        v-model="registro.registrado"
                                        :true-value="1"
                                        :false-value="0"
                                        @change="updateRegistrado(registro)"
                                        />
                                    </td>


                                    <!-- Input Responsable -->
                                    <td class="text-center" style="vertical-align: middle">
                                        <input
                                        type="text"
                                        class="form-control input-sm"
                                        v-model="registro.responsable"
                                        :disabled="!registro.registrado"
                                        placeholder="Nombre..."
                                        @keydown.enter.prevent="updateRegistrado(registro)"
                                        />
                                    </td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{registro.observacion}}</td>
                                                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">
                                        <button v-if="registro.voucher" type="button" class="btn btn-info btn-sm" style="margin-top: 0.1rem;margin-bottom: 0.1rem;" v-on:click.prevent="openModal(registro.voucher,'{{ rtrim(asset('') , '/') }}')">
                                            <i class="fas fa-money-bill"></i> Voucher
                                        </button>
                                    </td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">
                                        <button type="button"
                                                class="btn btn-success btn-sm"
                                                style="margin-top: 0.1rem;margin-bottom: 0.1rem;font-size: 0.8rem;margin: 0.2rem;"
                                                v-on:click.prevent="verDetalle(registro)">
                                            <i class="fas fa-search"></i> <b>Detalle</b>
                                        </button>
                                        <button type="button"
                                                class="btn btn-warning btn-sm"
                                                style="margin-top: 0.1rem;margin-bottom: 0.1rem;font-size: 0.8rem;margin: 0.2rem;"
                                                v-on:click.prevent="editarSales(registro.id)">
                                            <i class="fas fa-pen"></i> <b>Editar</b>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <div style="padding: 15px;">
                                <div><h6>Registros por Página: @{{ pagination.per_page }}</h6></div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item" v-if="pagination.current_page>1">
                                            <a class="page-link" href="#" @click.prevent="changePage(1)">
                                                <span><b>Inicio</b></span>
                                            </a>
                                        </li>

                                        <li class="page-item" v-if="pagination.current_page>1">
                                            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page-1)">
                                                <span>Atras</span>
                                            </a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" v-bind:class="[page=== isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="changePage(page)">
                                                <span>@{{ page }}</span>
                                            </a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page+1)">
                                                <span>Siguiente</span>
                                            </a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page< pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="changePage(pagination.last_page)">
                                                <span><b>Ultima</b></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                                <div><h6>Registros Totales: @{{ pagination.total }}</h6></div>
                            </div>
                        </div>
                        <div v-else>
                            <h6>No existen registros de Ventas Actualmente</h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para visualizar el PDF -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 40rem;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="modal-title" id="pdfModalLabel">Ver Documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí se mostrará el PDF -->
                <iframe v-if="pdfUrl" :src="pdfUrl" width="100%" height="500px"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver detalle de venta -->
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="modalDetalleLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 70rem;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #28a745;">
                <h5 class="modal-title" id="modalDetalleLabel" style="color: white;">Detalle Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12" style="margin-bottom: 10px;" id="contenidoCargo">
                    <table class="table encabezado-impresion" style="margin-bottom: 0px;font-size: 13px;">
                        <tbody>
                            <tr style="background-color: #fff;">
                                <td style="text-align: right;padding: 3px;font-size: 14px;border: 1px solid #fff0;font-weight: bold;vertical-align: top;width: 35%">
                                    <div class="widget-user-image" style="padding: 0px!important;">
                                        <img src="https://appcotizaciones-yamaha.com/images/logoyamaha-black.png" alt="User Avatar" width="70">
                                    </div>
                                </td>
                                <td style="text-align: left; padding: 3px; font-size: 18px; border: 1px solid #fff0; font-weight: bold; vertical-align: middle;width: 65%">
                                    SISTEMA DE COTIZACIONES YAMAHA
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <center>Este documento no representa un comprobante de venta</center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr class="encabezado-impresion">
                    <div class="col-md-12" style="margin-bottom: 10px;text-align: center;font-size: 15px;margin-top: 10px;">
                        <label>DETALLE DE VENTA</label>
                    </div>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td style="font-weight: bold;text-align: left;width: 15%">Cliente</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 84%">@{{ this.fillobject.nombres }} @{{ this.fillobject.apellidos }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;width: 15%">Nro Documento:</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 84%">@{{ this.fillobject.documento }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;width: 15%">Celular:</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 84%">@{{ this.fillobject.celular }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;width: 15%">Correo:</td>
                            <td style="width: 1%">:</td>
                            <td style="width: 84%">@{{ this.fillobject.correo }}</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline table-responsive">
                        <thead>
                        <tr>
                            <th width="1%" style="text-align: center;font-size: 14px;">N°</th>
                            <th width="15%" style="text-align: center;font-size: 14px;">Código</th>
                            <th width="29%" style="text-align: center;font-size: 14px;">Descripción</th>
                            <th width="10%" style="text-align: center;font-size: 14px;">Precio Unit.</th>
                            <th width="10%" style="text-align: center;font-size: 14px;">Cant.</th>
                            <th width="10%" style="text-align: center;font-size: 14px;">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(dato, index) in arrayItems" :key="dato.id" class="odd">
                            <td style="text-align: center;font-size: 14px;">@{{ index + 1 }}</td>
                            <td style="text-align: center;font-size: 14px;">@{{ dato.item.codigo }}</td>
                            <td style="text-align: center;font-size: 14px;">@{{ dato.item.descripcion }}</td>
                            <td style="text-align: center;font-size: 14px;">S./ @{{ dato.item.precio.toFixed(2) }}</td>
                            <td style="text-align: center;font-size: 14px;">
                                @{{ dato.cantidad }}
                            </td>
                            <td style="text-align: center;font-size: 14px;">S./ @{{ (dato.total).toFixed(2) }}</td>
                        </tr>
                        </tbody>

                    </table>
                    <hr>
                    <div class="col-md-12" style="padding-bottom: 10px;">
                        <div class="row">
                            <div class="col-md-12 text-end" style="text-align: right;">
                                <label style="font-weight: bold;">Total</label><br>
                                <label style="font-weight: bold;">@{{ 'S/ ' + montoTotal }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between w-100">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <div>
                    <x-adminlte-button @click="exportarExcelDetalle()" id="btnNuevo"
                                       class="bg-gradient" type="button"
                                       label="Exportar Datos" theme="success"
                                       icon="fa fa-file-excel" style="margin-right: 5px;" />

                    <x-adminlte-button @click="imprimirCargo()"
                                       class="bg-gradient" type="button"
                                       label="Imprimir" theme="info"
                                       icon="fa fa-print" style="margin-right: 5px;" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal para editar venta -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document" style="max-width: 60rem; height: 90vh;">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header" style="background-color: #28a745;">
                <h5 class="modal-title" id="modalEditarLabel" style="color: white;">Editar Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow-y: auto; max-height: calc(90vh - 130px); padding: 1rem;">
                <div class="card-body">
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo de Proceso:</label>
                                <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_sales_id" id="cbutipo_sales_id">
                                    <option value="0">--Seleccione--</option>
                                    <option v-for="(dato, index) in arrayTipoSales" :value="dato.id">@{{ dato.descripcion }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipo de Documento:</label>
                                <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_documento_id" id="tipo_documento_id" @change="buscarCliente">
                                    <option value="0" disabled>Seleccione ...</option>
                                    <option v-for="(dato, index) in arraytipoDocumentos" :value="dato.id">@{{ dato.nombre }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Número de Documento:</label>
                                <input type="text" class="form-control" id="txtdocumento" placeholder="N° de Documento" v-model="fillobject.documento" maxlength="20" required @change="buscarCliente">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nombre del Cliente:</label>
                                <input type="text" class="form-control" id="txtnombres" placeholder="Nombres" v-model="fillobject.nombres" maxlength="20" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Celular:</label>
                                <input type="text" class="form-control" id="txtcelular" placeholder="Celular" v-model="fillobject.celular" maxlength="25" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Correo Electrónico:</label>
                                <input type="email" class="form-control" id="txtcorreo" placeholder="Correo Electrónico" v-model="fillobject.correo" maxlength="250" required>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="txtobservaciones">Observaciones</label>
                                <textarea class="form-control" rows="4" placeholder="Ingrese Observación ..." id="txtobservacion" v-model="fillobject.observacion"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-12" style="padding-bottom: 10px;">
                    <div class="row">
                        <div class="col-md-8" style="padding-left: 0px;">
                            <input type="text" class="form-control" placeholder="Buscar por Código" id="buscar" v-model="buscarCodigoItem" @keyup.enter="buscarItem">
                        </div>
                        <div class="col-md-2">
                            <div>
                                <button type="button" class="btn btn-primary btn-md" v-on:click.prevent="buscarItem()"><i class="fas fa-search"></i> Buscar
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2" style="text-align: right">
                            <div>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalQR"><i class="fas fa-camera"></i>
                                    Escanear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="example1" class="table table-bordered table-striped dataTable dtr-inline table-responsive" style="margin-bottom: 30px!important;">
                    <thead>
                    <tr>
                        <th width="1%" style="text-align: center;font-size: 14px;">N°</th>
                        <th width="15%" style="text-align: center;font-size: 14px;">Código</th>
                        <th width="29%" style="text-align: center;font-size: 14px;">Descripción</th>
                        <th width="10%" style="text-align: center;font-size: 14px;">Precio Unit.</th>
                        <th width="10%" style="text-align: center;font-size: 14px;">Cant.</th>
                        <th width="10%" style="text-align: center;font-size: 14px;">Total</th>
                        <th width="10%" style="text-align: center;font-size: 14px;">Cantidad</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(dato, index) in arrayItems" :key="dato.id" class="odd">
                        <td style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ index + 1 }}</td>
                        <td style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ dato.item.codigo }}</td>
                        <td style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ dato.item.descripcion }}</td>
                        <td style="text-align: center;vertical-align: middle;">S./ @{{ dato.item.precio.toFixed(2) }}</td>
                        <td style="text-align: center;vertical-align: middle;">
                            <input type="text" maxlength="9" class="form-control" style="width: 70px; margin: auto;"
                                   v-model.number="dato.cantidad" @input="recalcularTotal(dato)" onkeypress="return soloNumeros(event);">
                        </td>
                        <td style="text-align: center;vertical-align: middle;">S./ @{{ (dato.item.precio * dato.cantidad).toFixed(2) }}</td>
                        <td style="text-align: center;vertical-align: middle;">
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
                <button type="button" class="btn btn-secondary" v-on:click.prevent="abrirCamaraVoucher()"><i class="fas fa-camera"></i>
                    Capturar Voucher
                </button>
                <div v-if="fillobject.voucher" style="text-align: center; margin-top: 10px;">
                    <label>Voucher Capturado:</label>
                    <br>
                    <img
                        :src="fillobject.voucher.startsWith('data:image') ? fillobject.voucher : '{{ asset('') }}' + fillobject.voucher"
                        alt="Voucher Capturado"
                        style="max-width: 100%; border: 1px solid #ccc; border-radius: 5px; padding: 5px; margin-bottom: 10px;">
                    <br>
                    <button class="btn btn-sm btn-danger" @click="eliminarVoucher">Eliminar Voucher</button>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button id="btnGuardar" :disabled="procesando" type="button" class="btn btn-primary" @click="procesar()">
                    <span v-if="procesando" class="fas fa-spinner fa-spin"></span>
                    <span v-else class="fas fa-save"></span>
                    @{{ procesando ? 'Procesando...' : 'Actualizar' }}
                </button>
            </div>
        </div>
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
