<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Gestión de Resoluciones</h3>
                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                    Volver</a>
                </div>
                <form>
                  <div class="card-body">
                    <div class="col-md-12">
                      <div class="form-group">
                        <x-adminlte-button @click="nuevo()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Nuevo Registro" theme="primary" icon="fas fa-plus-square"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
        </div>

        @include('admin.resolucion.form')

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Listado de Resoluciones de Apertura de Año</h3>
                </div>
                <form>
                  <div class="card-body">

                    <div class="table-responsive p-0" v-if="registros1.length > 0">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="titles-table" style="width: 5%">#</th>
                                    <th class="titles-table" style="width: 50%">Resolución</th>
                                    <th class="titles-table" style="width: 15%">Año</th>
                                    <th class="titles-table" style="width: 15%">Archivo</th>
                                    <th class="titles-table" style="width: 15%">Gestión</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(registro1, indexS) in registros1">
                                    <td class="rows-table">@{{indexS+pagination1.from}}.</td>                                    
                                    <td class="rows-table">@{{registro1.nombre}}</td>
                                    <td class="rows-table">@{{registro1.year}}</td>
                                    <td class="rows-table">
                                      <center>
                                        <a v-if="registro1.archivo != null && registro1.archivo !=''" v-bind:href="'{{ asset('/web/resolucion')}}'+'/'+registro1.archivo"  class="btn btn-primary btn-xs" download> Descargar</a>
                                    </center>
                                    </td>
                                    <td>
                                        <center>
                                        <x-adminlte-button @click="edit(registro1)" id="btnEdit" class="bg-gradient btn-sm" type="button" label="" theme="warning" icon="fas fa-edit"
                                        data-placement="top" data-toggle="tooltip" title="Editar registro" style="margin-right: 5px;"/>

                                        <x-adminlte-button @click="borrar(registro1)" id="btnBorrar" class="bg-gradient btn-sm" type="button" label="" theme="danger" icon="fas fa-trash"
                                        data-placement="top" data-toggle="tooltip" title="Eliminar registro" />
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div style="padding: 15px;">
                            <div><h6>Registros por Página: @{{ pagination1.per_page }}</h6></div>
                            <nav aria-label="Page navigation example">
                              <ul class="pagination">
                               <li class="page-item" v-if="pagination1.current_page>1">
                                <a class="page-link" href="#" @click.prevent="changePage1(1)">
                                 <span><b>Inicio</b></span>
                               </a>
                             </li>
                           
                             <li class="page-item" v-if="pagination1.current_page>1">
                              <a class="page-link" href="#" @click.prevent="changePage1(pagination1.current_page-1)">
                               <span>Atras</span>
                             </a>
                           </li>
                           <li class="page-item" v-for="page in pagesNumber1" v-bind:class="[page=== isActived ? 'active' : '']">
                            <a class="page-link" href="#" @click.prevent="changePage1(page)">
                             <span>@{{ page }}</span>
                           </a>
                           </li>
                           <li class="page-item" v-if="pagination1.current_page< pagination1.last_page">
                            <a class="page-link" href="#" @click.prevent="changePage1(pagination1.current_page+1)">
                             <span>Siguiente</span>
                           </a>
                           </li>
                           <li class="page-item" v-if="pagination1.current_page< pagination1.last_page">
                            <a class="page-link" href="#" @click.prevent="changePage1(pagination1.last_page)">
                             <span><b>Ultima</b></span>
                           </a>
                           </li>
                           </ul>
                           </nav>
                           <div><h6>Registros Totales: @{{ pagination1.total }}</h6></div>
                           </div>
                    </div>
                    <div v-else>
                        <h6>No existen registros de Resoluciones de Apertura de Año</h6>
                    </div>
                  </div>
                </form>
              </div>
        </div>


        <div class="col-md-6">
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Listado de Resoluciones de Cierre de Año</h3>
              </div>
              <form>
                <div class="card-body">

                  <div class="table-responsive p-0" v-if="registros2.length > 0">
                      <table class="table table-bordered table-sm">
                          <thead>
                              <tr>
                                  <th class="titles-table" style="width: 5%">#</th>
                                  <th class="titles-table" style="width: 50%">Resolución</th>
                                  <th class="titles-table" style="width: 15%">Año</th>
                                  <th class="titles-table" style="width: 15%">Archivo</th>
                                  <th class="titles-table" style="width: 15%">Gestión</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr v-for="(registro2, indexS) in registros2">
                                  <td class="rows-table">@{{indexS+pagination2.from}}.</td>                                    
                                  <td class="rows-table">@{{registro2.nombre}}</td>
                                  <td class="rows-table">@{{registro2.year}}</td>
                                  <td class="rows-table">
                                    <center>
                                      <a v-if="registro2.archivo != null && registro2.archivo !=''" v-bind:href="'{{ asset('/web/resolucion')}}'+'/'+registro2.archivo"  class="btn btn-primary btn-xs" download> Descargar</a>
                                  </center>
                                  </td>
                                  <td>
                                      <center>
                                      <x-adminlte-button @click="edit(registro2)" id="btnEdit" class="bg-gradient btn-sm" type="button" label="" theme="warning" icon="fas fa-edit"
                                      data-placement="top" data-toggle="tooltip" title="Editar registro" style="margin-right: 5px;"/>

                                      <x-adminlte-button @click="borrar(registro2)" id="btnBorrar" class="bg-gradient btn-sm" type="button" label="" theme="danger" icon="fas fa-trash"
                                      data-placement="top" data-toggle="tooltip" title="Eliminar registro" />
                                      </center>
                                  </td>
                              </tr>
                          </tbody>
                      </table>

                      <div style="padding: 15px;">
                          <div><h6>Registros por Página: @{{ pagination2.per_page }}</h6></div>
                          <nav aria-label="Page navigation example">
                            <ul class="pagination">
                             <li class="page-item" v-if="pagination2.current_page>1">
                              <a class="page-link" href="#" @click.prevent="changePage2(1)">
                               <span><b>Inicio</b></span>
                             </a>
                           </li>
                         
                           <li class="page-item" v-if="pagination2.current_page>1">
                            <a class="page-link" href="#" @click.prevent="changePage2(pagination2.current_page-1)">
                             <span>Atras</span>
                           </a>
                         </li>
                         <li class="page-item" v-for="page in pagesNumber2" v-bind:class="[page=== isActived ? 'active' : '']">
                          <a class="page-link" href="#" @click.prevent="changePage2(page)">
                           <span>@{{ page }}</span>
                         </a>
                         </li>
                         <li class="page-item" v-if="pagination2.current_page< pagination2.last_page">
                          <a class="page-link" href="#" @click.prevent="changePage2(pagination2.current_page+1)">
                           <span>Siguiente</span>
                         </a>
                         </li>
                         <li class="page-item" v-if="pagination2.current_page< pagination2.last_page">
                          <a class="page-link" href="#" @click.prevent="changePage2(pagination2.last_page)">
                           <span><b>Ultima</b></span>
                         </a>
                         </li>
                         </ul>
                         </nav>
                         <div><h6>Registros Totales: @{{ pagination2.total }}</h6></div>
                         </div>
                  </div>
                  <div v-else>
                      <h6>No existen registros de Resoluciones de Cierre de Año</h6>
                  </div>
                </div>
              </form>
            </div>
      </div>

    </div>
</div>