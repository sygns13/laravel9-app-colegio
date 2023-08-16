  <div class="col-md-12" v-if="divFormulario">
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">@{{labelBtnSave}}</h3>
      </div>
        <div class="card-body">
          <div class="col-md-12">
            <div class="form-group">
              <label for="txtDestinatarios" style="margin-right:5px;">Destinatarios <spam style="color:red;">*</spam></label>
              {{-- <input type="text" class="form-control" id="txtDestinatarios" placeholder="" v-model="destinatarios"> --}}

              <x-adminlte-button style="margin-right:5px;" @click="selAlumnos()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Sel. Todos los Alumnos" theme="warning" icon="fas fa-users"/>
              <x-adminlte-button style="margin-right:5px;" @click="selPadres()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Sel. Todos los Padres" theme="warning" icon="fas fa-users"/>
              <x-adminlte-button style="margin-right:5px;" @click="selDirectores()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Sel. Todos los Directores" theme="warning" icon="fas fa-users"/>
              <x-adminlte-button style="margin-right:5px;" @click="selDocentes()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Sel. Todos los Docentes" theme="warning" icon="fas fa-users"/>

              <div class="form-group">
                <div class="input-group input-group-sm">
                  <input type="text" name="table_search" class="form-control" placeholder="Buscar" v-model="buscar" @keyup.enter="buscarBtnZ()" id="txtbuscarZ">
                  <span class="input-group-append">
                    {{-- <button type="submit" class="btn btn-default" @click.prevent="buscarBtn()"><i class="fa fa-search"></i></button> --}}
                    <x-adminlte-button @click="buscarBtnZ()" id="btnSearch" class="btn btn-default" type="button" label="Buscar" theme="primary" icon="fas fa-search"/>
                </span>
                </div>
                
              </div>

              <div v-for="(item, index) in users" style="display: inline-block;">
                <input style="background-color:#f0f0f0; cursor: pointer;" class="vT" v-bind:value="item.persona+'['+item.tipo+']'" readonly="" v-on:click="users.splice(index, 1)" v-bind:id="item.id">
              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="txtmensaje">Mensaje <spam style="color:red;">*</spam></label>
              {{-- <textarea class="form-control" rows="4" placeholder="Escriba un Mensaje ..." id="txtmensaje" v-model="fillobject.mensaje"></textarea> --}}
              <ckeditor :editor="editor" :config="editorConfig" v-model="fillobject.mensaje"></ckeditor>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button style="margin-right:5px;" id="btnGuardar" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> Enviar Mensaje</button>
          <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
        </div>
    </div>
</div>