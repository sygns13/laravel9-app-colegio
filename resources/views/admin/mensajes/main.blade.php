<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Lista de Mensajes</h3>
                  <a style="float: right; padding: all; color: black;" type="button" class="btn btn-default btn-sm" href="{{URL::to('admin')}}"><i class="fa fa-reply-all" aria-hidden="true"></i> 
                    Volver</a>
                </div>
                <form>
                  <div class="card-body">
                    <div class="col-md-12">
                      <div class="form-group">
                        <x-adminlte-button @click="recibidos()" id="btnRecibido" class="bg-gradient btn-sm" type="button" label="Mensajes Recibidos" theme="success" icon="fas fa-envelope-open" style="margin-right: 5px;"/>
                        <x-adminlte-button @click="enviados()" id="btnEnviado" class="bg-gradient btn-sm" type="button" label="Mensajes Enviados" theme="info" icon="fas fa-envelope" style="margin-right: 5px;"/>
                        <x-adminlte-button @click="nuevo()" id="btnNuevo" class="bg-gradient btn-sm" type="button" label="Nuevo Mensaje" theme="primary" icon="fas fa-plus-square"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
        </div>

        @include('admin.mensajes.form')
        @include('admin.mensajes.recibidos')
        @include('admin.mensajes.enviados')

        
    </div>
</div>