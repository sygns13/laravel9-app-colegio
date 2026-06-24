<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Filtros de Búsqueda</h3>
                    <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{ URL::to('admin') }}"><i class="fa fa-reply-all" aria-hidden="true"></i>
                        Volver</a>
                </div>
                <form>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Fecha Inicial:</label>
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="fillobjectEdit.fechaIni">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Fecha Final:</label>
                                    <input type="date" class="form-control" placeholder="dd/mm/yyyy" v-model="fillobjectEdit.fechaFin">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Tipo de Documento:</label>
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectEdit.tipo_documento">
                                        <option value="0">TODOS</option>
                                        @foreach ($tiposDocumento as $tipo)
                                            <option value="{{ $tipo }}">{{ $tipo }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>N° de Documento:</label>
                                    <input type="text" class="form-control" placeholder="N° de Documento" v-model="fillobjectEdit.numero_documento" maxlength="25">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Nombres y Apellidos:</label>
                                    <input type="text" class="form-control" placeholder="Nombres y Apellidos" v-model="fillobjectEdit.nombres_apellidos" maxlength="255">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Correo:</label>
                                    <input type="text" class="form-control" placeholder="Correo electrónico" v-model="fillobjectEdit.correo" maxlength="250">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Celular:</label>
                                    <input type="text" class="form-control" placeholder="Celular" v-model="fillobjectEdit.celular" maxlength="25">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Acepta Promociones:</label>
                                    <select class="form-control" style="width: 100%;" v-model="fillobjectEdit.acepta_promociones">
                                        <option value="">TODOS</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <x-adminlte-button @click="buscarDatos()" class="bg-gradient btn-sm" type="button" label="Realizar Búsqueda" theme="primary" icon="fas fa-search" style="margin: 5px;"/>
                                <x-adminlte-button @click="exportarExcel()" class="bg-gradient btn-sm" type="button" label="Exportar Datos" theme="success" icon="fa fa-file-excel" style="margin: 5px;"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Listado de Clientes (Promociones)</h3>
                </div>
                <form>
                    <div class="card-body">
                        <div class="table-responsive p-0" v-if="registros.length > 0">
                            <table class="table table-bordered table-sm">
                                <thead>
                                <tr>
                                    <th class="titles-table" style="width: 1%">#</th>
                                    <th class="titles-table" style="width: 12%">Tipo Documento</th>
                                    <th class="titles-table" style="width: 10%">N° Documento</th>
                                    <th class="titles-table" style="width: 22%">Nombres y Apellidos</th>
                                    <th class="titles-table" style="width: 10%">Celular</th>
                                    <th class="titles-table" style="width: 18%">Correo</th>
                                    <th class="titles-table" style="width: 9%">Acepta Privacidad</th>
                                    <th class="titles-table" style="width: 9%">Acepta Promociones</th>
                                    <th class="titles-table" style="width: 9%">Fecha de Registro</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(registro, indexS) in registros">
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ indexS + pagination.from }}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ registro.tipo_documento }}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ registro.numero_documento }}</td>
                                    <td class="rows-table" style="text-align: left;vertical-align: middle;font-size: 14px;">@{{ registro.nombres_apellidos }}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ registro.celular }}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ registro.correo }}</td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">
                                        <span :class="registro.acepta_privacidad ? 'badge badge-success' : 'badge badge-secondary'">
                                            @{{ registro.acepta_privacidad ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">
                                        <span :class="registro.acepta_promociones ? 'badge badge-success' : 'badge badge-secondary'">
                                            @{{ registro.acepta_promociones ? 'Sí' : 'No' }}
                                        </span>
                                    </td>
                                    <td class="rows-table" style="text-align: center;vertical-align: middle;font-size: 14px;">@{{ registro.fecha }}</td>
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
                            <h6>No existen registros de Promociones Actualmente</h6>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
