<div class="modal" id="modalFormulario">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">@{{labelBtnSave}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-horizontal">
                <div class="card-body">
                    <div class="col-md-12">
                  
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                            <input type="text" name="table_search" class="form-control" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtn()" id="txtbuscar">
                            <span class="input-group-append">
                                {{-- <button type="submit" class="btn btn-default" @click.prevent="buscarBtn()"><i class="fa fa-search"></i></button> --}}
                                <x-adminlte-button @click="buscarBtn()" id="btnSearch2" class="btn btn-default" type="button" label="Buscar" theme="primary" icon="fas fa-search"/>
                            </span>
                            </div>
                            
                        </div>

                        <div class="table-responsive p-0" v-if="registrosP.length > 0">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="titles-table" style="width: 5%">#</th>
                                        <th class="titles-table" style="width: 10%">Tipo de Usuario</th>
                                        <th class="titles-table" style="width: 10%">Documento de Identidad</th>
                                        <th class="titles-table" style="width: 25%">Nombres y Apellidos</th>
                                        <th class="titles-table" style="width: 20%">Email</th>
                                        <th class="titles-table" style="width: 15%">Username</th>
                                        <th class="titles-table" style="width: 15%">Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(registro, indexS) in registrosP">
                                        <td class="rows-table">@{{indexS+paginationP.from}}.</td>
                                        <td class="rows-table">@{{registro.tipo_users_nombre}}</td>
                                        <td class="rows-table">@{{registro.tipo_documentos_sigla}}: @{{registro.num_documento}}</td>
                                        <td class="rows-table">@{{registro.nombres}} @{{registro.apellidos}}</td>
                                        <td class="rows-table">@{{registro.users_email}}</td>
                                        <td class="rows-table">@{{registro.users_name}}</td>
                                        <td>
                                            <center>
                                            <x-adminlte-button @click="seleccionar(registro)" id="btnSeleccionar" class="bg-gradient btn-sm" type="button" label="Seleccionar" theme="info" icon="fas fa-comment"
                                            data-placement="top" data-toggle="tooltip" title="Seleccionar Persona" style="margin-right: 5px;"/>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    
                            <div style="padding: 15px;">
                                <div><h6>Registros por Página: @{{ paginationP.per_page }}</h6></div>
                                <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                   <li class="page-item" v-if="paginationP.current_page>1">
                                    <a class="page-link" href="#" @click.prevent="changePageP(1)">
                                     <span><b>Inicio</b></span>
                                   </a>
                                 </li>
                               
                                 <li class="page-item" v-if="paginationP.current_page>1">
                                  <a class="page-link" href="#" @click.prevent="changePageP(paginationP.current_page-1)">
                                   <span>Atras</span>
                                 </a>
                               </li>
                               <li class="page-item" v-for="page in pagesNumberP" v-bind:class="[page=== isActivedP ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="changePageP(page)">
                                 <span>@{{ page }}</span>
                               </a>
                               </li>
                               <li class="page-item" v-if="paginationP.current_page< paginationP.last_page">
                                <a class="page-link" href="#" @click.prevent="changePageP(paginationP.current_page+1)">
                                 <span>Siguiente</span>
                               </a>
                               </li>
                               <li class="page-item" v-if="paginationP.current_page< paginationP.last_page">
                                <a class="page-link" href="#" @click.prevent="changePageP(paginationP.last_page)">
                                 <span><b>Ultima</b></span>
                               </a>
                               </li>
                               </ul>
                               </nav>
                               <div><h6>Registros Totales: @{{ paginationP.total }}</h6></div>
                               </div>
                        </div>
                        <div v-else>
                            <h6>No existen registros de Personas con el criterio buscado</h6>
                        </div>
                    

                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{-- <div class="modal-footer justify-content-between">
          <button id="btnGuardar" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
          <button id="btnClose" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
        </div> --}}
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->