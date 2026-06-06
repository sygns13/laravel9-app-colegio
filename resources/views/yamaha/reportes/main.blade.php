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

                    <div class="form-group row">
                      <label for="txtDateIni" class="col-sm-2 col-form-label" >Fecha Inicial:</label>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fillobject.fechaIni">
                        </div>
                      </div>

                      <label for="txtDateFin" class="col-sm-2 col-form-label" >Fecha Final:</label>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fillobject.fechaFin">
                        </div>
                      </div>
                    </div>


                    <div class="form-group row">
                      <label for="txtDateIni" class="col-sm-2 col-form-label" >Número de Cotización:</label>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="text" class="form-control" id="txtnombres" placeholder="Año" v-model="fillobject.year" maxlength="4" >
                        </div>
                      </div>
                
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="text" class="form-control" id="txtnombres" placeholder="Número" v-model="fillobject.numero" maxlength="8" >
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="txtDateIni" class="col-sm-2 col-form-label" >Tipo de Doc (Cliente):</label>
                      <div class="col-md-2">
                        <div class="form-group">
                          <select class="form-control" style="width: 100%;" v-model="fillobject.tipo_documento_id" id="cbutipo_documento_id">
                            <option value="0">TODOS</option>
                            @foreach ($tipoDocumentos as $dato)
                              <option value="{{$dato->id}}">{{$dato->sigla}}</option> 
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <label for="txtDateFin" class="col-sm-2 col-form-label" >Doocumento:</label>
                      <div class="col-md-2">
                        <div class="form-group">
                          <input type="text" class="form-control" id="txtdocumento" placeholder="N° de Documento" v-model="fillobject.documento" maxlength="20" >
                        </div>
                      </div>
                    </div>
                    


                    <div class="col-md-12">
                      <div class="form-group">
                        <x-adminlte-button @click="buscarDatos()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Realizar Búsqueda" theme="primary" icon="fas fa-search" style="margin: 5px;"/>
                        <x-adminlte-button @click="exportarExcel()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Exportar Datos" theme="success" icon="fa fa-file-excel" style="margin: 5px;"/>
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


                  <h3 class="card-title">Listado de Cotizaciones</h3>


                </div>
                <form>
                  <div class="card-body">
                    {{-- <div class="col-md-12" style="margin-bottom:15px;">
                        <div class="input-group input-group-sm" style="max-width: 300px;">
                          <input type="text" name="table_search" class="form-control" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtn()">
                          <span class="input-group-append">
                            <button type="submit" class="btn btn-default" @click.prevent="buscarBtn()"><i class="fa fa-search"></i></button>
                        </span>
                        </div>
                      </div> --}}

                    <div class="table-responsive p-0" v-if="registros.length > 0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="titles-table" style="width: 4%">#</th>
                                    <th class="titles-table" style="width: 8%">Empresa</th>
                                    <th class="titles-table" style="width: 8%">Cotizador</th>
                                    <th class="titles-table" style="width: 6%">Documento de Cotizador</th>
                                    <th class="titles-table" style="width: 6%">Número de Cotización</th>
                                    <th class="titles-table" style="width: 6%">Fecha de Cotización</th>
                                    <th class="titles-table" style="width: 5%">Código de la Motocicleta</th>
                                    <th class="titles-table" style="width: 6%">Modelo de la Motocicleta</th>
                                    <th class="titles-table" style="width: 3%">Año de la Motocicleta</th>
                                    <th class="titles-table" style="width: 6%">Color de la Motocicleta</th>
                                    <th class="titles-table" style="width: 5%">Precio U$</th>
                                    <th class="titles-table" style="width: 5%">Descuento U$</th>
                                    <th class="titles-table" style="width: 5%">Precio Final U$</th>
                                    <th class="titles-table" style="width: 5%">Tipo de Cambio S/</th>
                                    <th class="titles-table" style="width: 5%">Precio Final S/</th>
                                    <th class="titles-table" style="width: 8%">Cliente</th>
                                    <th class="titles-table" style="width: 6%">Documento de Cliente</th>
                                    <th class="titles-table" style="width: 4%">Descargar Cotización</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(registro, indexS) in registros">
                                    <td class="rows-table">@{{indexS+pagination.from}}.</td>                                    
                                    <td class="rows-table">@{{registro.personal_empresa}}</td>
                                    <td class="rows-table">@{{registro.personal_nombres}} @{{registro.personal_apellidos}}</td>
                                    <td class="rows-table">@{{registro.tpP_sigla}} @{{registro.personal_documento}}</td>
                                    <td class="rows-table">@{{registro.year}}-@{{registro.numero}}</td>
                                    <td class="rows-table">
                                      @{{registro.fecha.substring(8,10)}}/
                                      @{{registro.fecha.substring(5,7)}}/
                                      @{{registro.fecha.substring(0,4)}} -
                                      @{{registro.hora}}
                                    </td>
                                    <td class="rows-table">@{{registro.data_cotizacions_codigo}}</td>
                                    <td class="rows-table">@{{registro.modelo}}</td>
                                    <td class="rows-table">@{{registro.data_cotizacions_year}}</td>
                                    <td class="rows-table">@{{registro.data_cotizacions_color_comercial}}</td>
                                    <td class="rows-table">@{{registro.precioIni}}</td>
                                    <td class="rows-table">@{{registro.precioDto}}</td>
                                    <td class="rows-table">@{{registro.precioFin}}</td>
                                    <td class="rows-table">@{{registro.tipoCambio}}</td>
                                    <td class="rows-table">@{{registro.precioFinPen}}</td>

                                    <td class="rows-table">@{{registro.cli_nombres}} @{{registro.cli_apellidos}}</td>
                                    <td class="rows-table">@{{registro.tpP_sigla}} @{{registro.cli_documento}}</td>
                                    <td>
                                        <center>
                                        <x-adminlte-button @click="imprimirCotización(registro.id)" id="btnBorrar" class="bg-gradient btn-sm" type="button" label="" theme="danger" icon="fas fa-file-pdf"
                                        data-placement="top" data-toggle="tooltip" title="Descargar  Cotización" />
                                        </center>
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
                        <h6>No existen registros de Cotizaciones Actualmente</h6>
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>