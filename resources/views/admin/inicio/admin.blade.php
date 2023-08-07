<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Resoluciones de Apertura de Año</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="titles-table" style="width: 10%">#</th>
                                            <th class="titles-table" style="width: 65%">Resolución</th>
                                            <th class="titles-table" style="width: 25%">Año</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resolucionAperturas as $index => $resolucion)
                                            <tr>
                                                <td class="rows-table">{{$index+1}}</td>
                                                <td class="rows-table">
                                                    <a download href="{{ asset('web/resolucion/') }}/{{$resolucion->archivo}}">
                                                        {{$resolucion->nombre}}
                                                    </a>
                                                </td>
                                                <td class="rows-table">{{$resolucion->year}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Resoluciones de Cierre de Año</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th class="titles-table" style="width: 10%">#</th>
                                            <th class="titles-table" style="width: 65%">Resolución</th>
                                            <th class="titles-table" style="width: 25%">Año</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($resolucionCierres as $index => $resolucion)
                                            <tr>
                                                <td class="rows-table">{{$index+1}}</td>
                                                <td class="rows-table">
                                                    <a download href="{{ asset('web/resolucion/') }}/{{$resolucion->archivo}}">
                                                        {{$resolucion->nombre}}
                                                    </a>
                                                </td>
                                                <td class="rows-table">{{$resolucion->year}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            </div>


        </div>

        <div class="col-md-6">

          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Mis Documentos</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                        <div class="table-responsive p-0">
                          <ul>
                            <li><a href="{{URL::to('admin/asistencia-docente')}}">Reporte de Asistencia de Docentes</a></li>
                            <li><a href="{{URL::to('admin/asistencia-sesiones')}}">Reporte de Asistencia de Alumnos</a></li>
                            <li><a href="{{URL::to('admin/legajo-fichas')}}">Legajos</a></li>
                          </ul>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Alumnos Matriculados 2022</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form>
                    <div class="card-body">
                      <figure class="highcharts-figure">
                        <div id="container-chart"></div>
                      </figure>
                        
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
          </div>


        </div>


    </div>
</div>
