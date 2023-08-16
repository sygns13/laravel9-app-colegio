<div class="col-md-12" v-if="divEnviados">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Listado de Mensajes Enviados</h3>
        </div>
        <div class="card-body">

        </div>
        <div class="card-footer card-comments">

            
            <div class="card-comment cardco" v-for="(registro, index) in registros" style="cursor: pointer;" @click="leerMensajeEnviado(registro)">
              <!-- User image -->
              <img class="img-circle img-sm" src="{{ asset('images/user_profile.avif') }}" alt="User Image">

              <div class="comment-text">
                <span class="username">
                    Enviado a
                    <template v-for="(registroRep, indexRep) in registro.recibidos">
                        <template v-if="registroRep.tipo_users_id == '1' && registroRep.director != null">
                            Director: @{{registroRep.director.nombre}} @{{registroRep.director.apellidos}}.
                        </template>
                        <template v-if="registroRep.tipo_users_id == '3' && registroRep.docente != null">
                            Docente: @{{registroRep.docente.nombre}} @{{registroRep.docente.apellidos}}.
                        </template>
                        <template v-if="registroRep.tipo_users_id == '4' && registroRep.alumno != null">
                            Alumno: @{{registroRep.alumno.nombres}} @{{registroRep.alumno.apellido_paterno}} @{{registroRep.alumno.apellido_materno}}.
                        </template>
                        <template v-if="registroRep.tipo_users_id == '5' && registroRep.apoderado != null">
                            Apoderado: @{{registroRep.apoderado.nombres}} @{{registroRep.apoderado.apellido_paterno}} @{{registroRep.apoderado.apellido_materno}}.
                        </template>
                    </template>

                  <span class="text-muted float-right">@{{registro.fecha}} @{{registro.hora}}</span>

                </span><!-- /.username -->
                <div style="max-height: 30px;overflow: hidden;">
                    <div v-html="registro.mensaje"></div>
                </div>
              </div>
              <!-- /.comment-text -->
            </div>
            <!-- /.card-comment -->

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
      </div>
</div>


<div class="col-md-12" v-if="divMensajeEnviado">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Leer Mensaje Enviado</h3>
  
        <div class="card-tools">
          {{-- <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
          <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a> --}}
          <button id="btnCloseM" type="button" class="btn btn-default" data-dismiss="modal" @click="enviados()"><span class="fas fa-power-off"></span> Cerrar</button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="mailbox-read-info">
          <h5>Titulo</h5>
          <h6>Enviado a: 
            
            <template v-for="(registroRep, indexRep) in fillMsjeEnviado.recibidos">
                <template v-if="registroRep.tipo_users_id == '1' && registroRep.director != null">
                    Director: @{{registroRep.director.nombre}} @{{registroRep.director.apellidos}}.
                </template>
                <template v-if="registroRep.tipo_users_id == '3' && registroRep.docente != null">
                    Docente: @{{registroRep.docente.nombre}} @{{registroRep.docente.apellidos}}.
                </template>
                <template v-if="registroRep.tipo_users_id == '4' && registroRep.alumno != null">
                    Alumno: @{{registroRep.alumno.nombres}} @{{registroRep.alumno.apellido_paterno}} @{{registroRep.alumno.apellido_materno}}.
                </template>
                <template v-if="registroRep.tipo_users_id == '5' && registroRep.apoderado != null">
                    Apoderado: @{{registroRep.apoderado.nombres}} @{{registroRep.apoderado.apellido_paterno}} @{{registroRep.apoderado.apellido_materno}}.
                </template>
            </template>

            <span class="mailbox-read-time float-right">@{{fillMsjeEnviado.fecha}} @{{fillMsjeEnviado.hora}}</span></h6>
        </div>
        <!-- /.mailbox-read-info -->
        {{-- <div class="mailbox-controls with-border text-center">
          <div class="btn-group">
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Delete">
              <i class="far fa-trash-alt"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Reply">
              <i class="fas fa-reply"></i>
            </button>
            <button type="button" class="btn btn-default btn-sm" data-container="body" title="Forward">
              <i class="fas fa-share"></i>
            </button>
          </div>
          <!-- /.btn-group -->
          <button type="button" class="btn btn-default btn-sm" title="Print">
            <i class="fas fa-print"></i>
          </button>
        </div> --}}
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
          <div v-html="fillMsjeEnviado.mensaje"></div>
        </div>
        <!-- /.mailbox-read-message -->
      </div>
      <!-- /.card-body -->
      {{--<div  class="card-footer bg-white">
        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
          <li>
            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
  
            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span>1,245 KB</span>
                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                  </span>
            </div>
          </li>
          <li>
            <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>
  
            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span>1,245 KB</span>
                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                  </span>
            </div>
          </li>
          <li>
            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>
  
            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span>2.67 MB</span>
                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                  </span>
            </div>
          </li>
          <li>
            <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>
  
            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo2.png</a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span>1.9 MB</span>
                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                  </span>
            </div>
          </li>
        </ul>
      </div> --}}
      <!-- /.card-footer -->
      {{-- <div class="card-footer">
        <div class="float-right">
          <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
          <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button>
        </div>
        <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
        <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
      </div> --}}
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>