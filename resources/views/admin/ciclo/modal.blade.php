<div class="modal" id="modalTable">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Listado de Alumnos Pendientes de Conclusión de Resultado de Estudio</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive p-0" style="margin-top: 20px;">
                <hr>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th class="titles-table" style="font-size:14px; width: 5%; vertical-align: middle; text-align: center;">N°</th>
                            <th class="titles-table" style="font-size:14px; width: 15%; vertical-align: middle; text-align: center;">Nivel</th>
                            <th class="titles-table" style="font-size:14px; width: 15%; vertical-align: middle; text-align: center;">Grado</th>
                            <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Sección</th>
                            <th class="titles-table" style="font-size:14px; width: 15%; vertical-align: middle; text-align: center;">DNI o Código del Estudiante</th>
                            <th class="titles-table" style="font-size:14px; width: 30%; vertical-align: middle; text-align: center;">Apellidos y Nombres</th>
                            <th class="titles-table" style="font-size:14px; width: 10%; vertical-align: middle; text-align: center;">Sexo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(registro, indexS) in matriculas">
                            <td class="rows-table">@{{indexS+1}}.</td>
                            <td class="rows-table">@{{registro.nivel.nombre}}</td>
                            <td class="rows-table">@{{registro.grado.nombre}}</td>
                            <td class="rows-table">@{{registro.seccion.sigla}}</td>
                            <td class="rows-table">@{{registro.sigla_tipodoc}}: @{{registro.num_documento_alu}}</td>
                            <td class="rows-table">@{{registro.apellido_paterno_alu}} @{{registro.apellido_materno_alu}}, @{{registro.nombres_alu}}</td>
                            <td class="rows-table">@{{registro.genero_alu}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        <div class="modal-footer justify-content-between">
          <button id="btnGuardar" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->