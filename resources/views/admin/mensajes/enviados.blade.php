<div class="col-md-12" v-if="divEnviados">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Listado de Mensajes Enviados</h3>
        </div>
        <div class="card-body">

        </div>
        <div class="card-footer card-comments">

            
            <div class="card-comment cardco" v-for="(registro, index) in registros" style="cursor: pointer;">
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