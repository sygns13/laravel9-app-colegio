<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Formulario de Actualización del Tipo de Cambio U$D a S/.</h3>
                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                    Volver</a>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="txttipoCambioFormat">Tipo de Cambio</label>
                      <div class="input-group mb-3">
                        <!-- /btn-group -->
                        <input id="txttipoCambioFormat" name="txttipoCambioFormat" type="text" class="form-control" v-model="fillobjectEdit.tipoCambioFormat" maxlength="20" onkeypress="return soloNumerosConDecimalesReg(event, this);">
                        <div class="input-group-prepend">
                            <button type="button" class="btn btn-success editClass" @click="confirmUpdate(1)"><i class="fas fa-edit"></i> Actualizar</button>
                          </div>
                      </div>
                    </div>

     
                  </div>
                  <!-- /.card-body -->
                </form>
              </div>
        </div>
    </div>
</div>