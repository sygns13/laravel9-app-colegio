{{-- <div class="modal" id="modalFormulario">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Agregar Plan Anual del Curso @{{fillobject.curso}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="form-horizontal">
              <div class="card-body">
                <div class="form-group row">
                  <label for="txtobservacion" class="col-sm-2 col-form-label">Plan Anual</label>
                  <div class="col-sm-10">
                    <input v-if="uploadReady" name="archivo2" type="file" id="archivo2" class="archivo form-control" @change="getArchivo" accept=".pdf, .PDF"/> 
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
        <button id="btnGuardar" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal" id="modalFormularioProgramar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Programar Fechas de Calificaciones del Curso @{{fillobject.curso}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive p-0" v-if="programar && fillobject.competencias.length > 0">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                  <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">N°</th>
                  <th colspan="2" class="titles-table" style="font-size:14px; width: 35%; vertical-align: middle; text-align: center;">Item</th>
                  @if($cicloActivo->opcion == 1)
                    <th class="titles-table" style="font-size:14px; width: 13%; vertical-align: middle; text-align: center;">Primer Trimestre</th>  
                    <th class="titles-table" style="font-size:14px; width: 13%; vertical-align: middle; text-align: center;">Segundo Trimestre</th>  
                    <th class="titles-table" style="font-size:14px; width: 13%; vertical-align: middle; text-align: center;">Tercer Trimestre</th>  
                    
                  @elseif($cicloActivo->opcion == 2)
                  <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Primer Bimestre</th>  
                  <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Segundo Bimestre</th>  
                  <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Tercer Bimestre</th>  
                  <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Cuarto Bimestre</th>  
                  
                  @endif
                  
              </tr>
          </thead>
          <tbody>
            <template v-for="(registro, indexC) in fillobject.competencias">
              <tr>
                  <td :rowspan="registro.indicadores.length + 1" class="rows-table" style="font-weight: bold;">Competencia @{{indexC+1}}.</td>
                  @if($cicloActivo->opcion == 1)
                  <td colspan="5" class="rows-table" style="font-weight: bold;">@{{registro.nombre}}</td>

                  @elseif($cicloActivo->opcion == 2)
                  <td colspan="6" class="rows-table" style="font-weight: bold;">@{{registro.nombre}}</td>
                  @endif
              </tr>

              <tr v-for="(indicador, indexI) in registro.indicadores">
                <td class="rows-table" style="width: 10%">Indicador @{{indexI+1}}.</td>
                <td class="rows-table" style="width: 25%">@{{indicador.nombre}}</td>

                <td class="rows-table" style="text-align: center;">
                  <x-adminlte-button data-placement="top" data-toggle="tooltip" title="Programar" @click="programarCalificacion(indicador, 1)" id="btnProgramar" 
                    class="bg-gradient btn-xs" type="button" label="Programar" theme="success"/>

                    <div style="margin-top:5px;">
                      <span class="badge bg-warning" v-if="indicador.fecha_programada1 != null && indicador.fecha_programada1 != ''">@{{indicador.fecha_programada1}} @{{indicador.hora_programada1}}</span>
                      <span class="badge bg-warning" v-else>No Programado</span>
                    </div>
                </td>

                <td class="rows-table" style="text-align: center;">
                  <x-adminlte-button data-placement="top" data-toggle="tooltip" title="Programar" @click="programarCalificacion(indicador, 2)" id="btnProgramar" 
                    class="bg-gradient btn-xs" type="button" label="Programar" theme="success"/>

                    <div style="margin-top:5px;">
                      <span class="badge bg-warning"  v-if="indicador.fecha_programada2 != null && indicador.fecha_programada2 != ''">@{{indicador.fecha_programada2}} @{{indicador.hora_programada2}}</span>
                      <span class="badge bg-warning" v-else>No Programado</span>
                    </div>
                </td>

                <td class="rows-table" style="text-align: center;">
                  <x-adminlte-button data-placement="top" data-toggle="tooltip" title="Programar" @click="programarCalificacion(indicador, 3)" id="btnProgramar" 
                    class="bg-gradient btn-xs" type="button" label="Programar" theme="success"/>

                    <div style="margin-top:5px;">
                      <span class="badge bg-warning" v-if="indicador.fecha_programada3 != null && indicador.fecha_programada3 != ''">@{{indicador.fecha_programada3}} @{{indicador.hora_programada3}}</span>
                      <span class="badge bg-warning" v-else>No Programado</span>
                    </div>
                </td>

                @if($cicloActivo->opcion == 2)
                  <td class="rows-table" style="text-align: center;">
                    <x-adminlte-button data-placement="top" data-toggle="tooltip" title="Programar" @click="programarCalificacion(indicador, 4)" id="btnProgramar" 
                    class="bg-gradient btn-xs" type="button" label="Programar" theme="success"/>

                    <div style="margin-top:5px;">
                      <span class="badge bg-warning" v-if="indicador.fecha_programada4 != null && indicador.fecha_programada4 != ''">@{{indicador.fecha_programada4}} @{{indicador.hora_programada4}}</span>
                      <span class="badge bg-warning" v-else>No Programado</span>
                    </div>
                  </td>
                @endif
              </tr>

              <tr>
                @if($cicloActivo->opcion == 1)
                  <td colspan="6"> <div style="height: 5px;"></div></td>
                @elseif($cicloActivo->opcion == 2)
                  <td colspan="7"> <div style="height: 5px;"></div></td>
                @endif
              </tr>
            </template>
          </table>
      </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
        <button id="btnGuardar" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal" id="modalProgramar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" v-if="fillIndicador.nombre != undefined">Indicador: @{{fillIndicador.nombre}}<br>Programar Calificación del  @{{labelProgramar}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="form-horizontal">
              <div class="card-body">
                <div class="form-group row">
                  <label for="txtobservacion" class="col-sm-2 col-form-label">Fecha</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" id="txtfecha" placeholder="dd/mm/yyyy" v-model="fecha">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="txtobservacion" class="col-sm-2 col-form-label">Hora</label>
                  <div class="col-sm-10">
                    <input type="time" class="form-control" id="txthoraini" placeholder="00:00" v-model="hora">
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button id="btnCloseP" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarFormP()"><span class="fas fa-power-off"></span> Cerrar</button>
        <button id="btnGuardarP" type="button" class="btn btn-primary" @click="procesarProgramacion()"><span class="fas fa-save"></span> Programar</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal --> --}}