<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Mantenimiento de Docentes</h3>
                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                    Volver</a>
                </div>
                <form>
                  <div class="card-body">
                    <div class="col-md-12">
                        <div class="form-group">
                          <x-adminlte-button @click="nuevo()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Nuevo Docente" theme="primary" icon="fas fa-plus-square"/>
                        </div>
                      </div>
                  </div>
                </form>
              </div>
        </div>

        @include('admin.docente.form')

        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Listado de Docentes</h3>
                </div>
                <form>
                  <div class="card-body">
                    <div class="col-md-12" style="margin-bottom:15px;">
                        <div class="input-group input-group-sm" style="max-width: 300px;">
                          <input type="text" name="table_search" class="form-control" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtn()">
                          <span class="input-group-append">
                            <button type="submit" class="btn btn-default" @click.prevent="buscarBtn()"><i class="fa fa-search"></i></button>
                        </span>
                        </div>
                      </div>

                    <div class="table-responsive p-0" v-if="registros.length > 0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th style="font-size: 13px; width: 4%">#</th>
                                    <th style="font-size: 13px; width: 8%">Documento de Identidad</th>
                                    <th style="font-size: 13px; width: 12%">Nombres y Apellidos</th>
                                    <th style="font-size: 13px; width: 8%">Código de Plaza</th>
                                    <th style="font-size: 13px; width: 10%">Especialidad</th>
                                    <th style="font-size: 13px; width: 5%">Genero</th>
                                    <th style="font-size: 13px; width: 6%">Teléfono</th>
                                    <th style="font-size: 13px; width: 12%">Dirección</th>
                                    <th style="font-size: 13px; width: 8%">Username</th>
                                    <th style="font-size: 13px; width: 12%">Email</th>
                                    <th style="font-size: 13px; width: 5%">Estado</th>
                                    <th style="font-size: 13px; width: 10%">Gestión</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(registro, indexS) in registros">
                                    <td style="font-size: 12px; padding: 5px;">@{{indexS+pagination.from}}.</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.tipo_documentos_sigla}}: @{{registro.num_documento}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.nombre}} @{{registro.apellidos}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.codigo_plaza}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.especialidad}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.genero}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.telefono}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.direccion}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.users_name}}</td>
                                    <td style="font-size: 12px; padding: 5px;">@{{registro.users_email}}</td>
                                    <td style="font-size: 12px; padding: 5px; text-align: center;">
                                        <small style="font-size: 12px;" class="badge badge-success" v-if="registro.activo=='1'">Activo</small>
                                        <small style="font-size: 12px;" class="badge badge-warning" v-if="registro.activo=='0'">Inactivo</small>
                                      </td>
                                    <td>
                                        <center>
                                        <x-adminlte-button v-if="registro.activo=='1'" @click="baja(registro)" id="btnBaja" class="bg-gradient btn-sm" type="button" label="" theme="info" icon="fas fa-arrow-circle-down"
                                        data-placement="top" data-toggle="tooltip" title="Dar de baja registro" style="margin-right: 5px;"/>

                                        <x-adminlte-button v-if="registro.activo=='0'" @click="alta(registro)" id="btnAlta" class="bg-gradient btn-sm" type="button" label="" theme="success" icon="fas fa-check-circle"
                                        data-placement="top" data-toggle="tooltip" title="Dar de alta registro" style="margin-right: 5px;"/>

                                        <x-adminlte-button @click="edit(registro)" id="btnEdit" class="bg-gradient btn-sm" type="button" label="" theme="warning" icon="fas fa-edit"
                                        data-placement="top" data-toggle="tooltip" title="Editar registro" style="margin-right: 5px;"/>

                                        <x-adminlte-button @click="borrar(registro)" id="btnBorrar" class="bg-gradient btn-sm" type="button" label="" theme="danger" icon="fas fa-trash"
                                        data-placement="top" data-toggle="tooltip" title="Eliminar registro" />
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div style="padding: 15px;">
                            <div><h5>Registros por Página: @{{ pagination.per_page }}</h5></div>
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
                           <div><h5>Registros Totales: @{{ pagination.total }}</h5></div>
                           </div>
                    </div>
                    <div v-else>
                        <h6>No existen registros de Docentes</h6>
                    </div>
                  </div>
                </form>
              </div>
        </div>
    </div>
</div>