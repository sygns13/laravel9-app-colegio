@extends('adminlte::page')

@section('title', 'Secciones')

{{-- @section('plugins.Sweetalert2', true) --}}


@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="pt-2 px-3">
                                <h3 class="card-title">Niveles:</h3>
                            </li>
                            <li class="nav-item" v-for="(nivel, index) in registros.niveles">
                                <a data-toggle="pill" role="tab" aria-selected="true"
                                    v-bind="{ id: 'custom-tabs-two-' + nivel.siglas+'-tab', 'class': index == 0 ? 'nav-link active' : 'nav-link', 'href': '#custom-tabs-two-' + nivel.siglas, 'aria-controls': 'custom-tabs-two-' + nivel.siglas }">@{{ nivel.nombre }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">

                            <template v-for="(nivel, index) in registros.niveles">
                                <div role="tabpanel"
                                    v-bind="{ 'class': index == 0 ? 'tab-pane fade show active' : 'tab-pane fade', 'id': 'custom-tabs-two-' + nivel.siglas, 'aria-labelledby': 'custom-tabs-two-' + nivel.siglas + '-tab' }">

                                    {{-- @{{ nivel.nombre }} --}}

                                    <div class="row">
                                        <div class="col-5 col-sm-3">
                                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <template v-for="(grado, indexG) in nivel.grados">
                                                    <a data-toggle="pill" role="tab" aria-selected="true"
                                                        v-bind="{ 'class': indexG == 0 ? 'nav-link active' : 'nav-link', 'id': 'vert-tabs-gra' + nivel.siglas + grado.orden + '-tab', 'href': '#vert-tabs-gra' + nivel.siglas + grado.orden, 'aria-controls': 'vert-tabs-gra' + nivel.siglas + grado.orden }">@{{ grado.nombre }}</a>
                                                </template>
                                            </div>
                                        </div>
                                        <div class="col-7 col-sm-9">
                                            <div class="tab-content" id="vert-tabs-tabContent">
                                                <template v-for="(grado, indexG) in nivel.grados">
                                                    <div role="tabpanel"
                                                        v-bind="{ 'class': indexG == 0 ? 'tab-pane text-left fade show active' : 'tab-pane fade', 'id': 'vert-tabs-gra' + nivel.siglas + grado.orden, 'aria-labelledby': 'vert-tabs-gra' + nivel.siglas + grado.orden + '-tab' }">
                                                        <h4>Listado de Secciones</h4>

                                                        <div class="table-responsive p-0" v-if="grado.seccions.length > 0">
                                                            <table class="table table-bordered table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="width: 5%">#</th>
                                                                        <th style="width: 20%">SIGLAS</th>
                                                                        <th style="width: 60%">Nombre</th>
                                                                        <th style="width: 15%">Gestión</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(seccion, indexS) in grado.seccions">
                                                                        <td>@{{indexS + 1}}.</td>
                                                                        <td>@{{seccion.sigla}}</td>
                                                                        <td>@{{seccion.nombre}}</td>
                                                                        <td>
                                                                            <center>
                                                                            <x-adminlte-button @click="edit(seccion)" id="btnEdit" class="bg-gradient btn-sm" type="button" label="" theme="warning" icon="fas fa-edit"
                                                                            data-placement="top" data-toggle="tooltip" title="Editar registro" style="margin-right: 5px;"/>

                                                                            <x-adminlte-button @click="borrar(seccion)" id="btnBorrar" class="bg-gradient btn-sm" type="button" label="" theme="danger" icon="fas fa-trash"
                                                                            data-placement="top" data-toggle="tooltip" title="Eliminar registro" style="margin-left: 5px;"/>
                                                                            </center>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div v-else>
                                                            <h6>No se tiene registro de secciones registradas en el grado</h6>
                                                        </div>

                                                        <x-adminlte-button @click="nuevo(grado.id)" id="btnNuevo" class="bg-gradient" type="button" label="Nueva Sección" theme="primary" icon="fas fa-plus-square"/>

                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </template>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalFormulario">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">@{{labelBtnSave}} Sección</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="card-body">
                      <div class="form-group row">
                        <label for="txtsiglas" class="col-sm-2 col-form-label">SIGLAS</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="txtsiglas" placeholder="SIGLAS" v-model="fillobject.sigla" maxlength="250">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="txtno,bre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="txtno,bre" placeholder="Nombre" v-model="fillobject.nombre" maxlength="10">
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                  </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button id="btnGuardar" type="button" class="btn btn-default" data-dismiss="modal" @click="cerrarForm()"><span class="fas fa-power-off"></span> Cerrar</button>
              <button id="btnClose" type="button" class="btn btn-primary" @click="procesar()"><span class="fas fa-save"></span> @{{labelBtnSave}}</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
    <script>
        /*  Swal.fire(
        'Good job!',
        'You clicked the button!',
        'success'
        ) */
    </script>

    <script type="text/javascript">
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    tituloHeader: "Gestión de Secciones",
                    subtituloHeader: "Tablas Base",
                    subtitulo2Header: "Gestión de Secciones",

                    subtitle2Header: true,

                    userPerfil: '{{ Auth::user()->name }}',
                    mailPerfil: '{{ Auth::user()->email }}',

                    registros: [],
                    errors: [],

                    fillobject: {
                        'type':'C',
                        'id': '',
                        'nombre': '',
                        'sigla': '',
                        'grado_id': '',
                        'activo': '1'
                    },

                    pagination: {
                        'total': 0,
                        'current_page': 0,
                        'per_page': 0,
                        'last_page': 0,
                        'from': 0,
                        'to': 0
                    },
                    offset: 9,

                    buscar: '',
                    divNuevo: false,
                    divEdit: false,

                    divloaderNuevo: false,
                    divloaderEdit: false,

                    mostrarPalenIni: true,

                    thispage: '1',
                    divprincipal: false,

                    labelBtnSave: 'Registrar',
                }
            },
            created: function() {
                this.getDatos(this.thispage);
                console.log("created");
            },
            mounted: function() {
                /* $("#divtitulo").show('slow');
                this.divloader0=false;
                this.divprincipal=true; */
                console.log("mounted");
            },
            computed: {
                isActived: function() {
                    return this.pagination.current_page;
                },
                pagesNumber: function() {
                    if (!this.pagination.to) {
                        return [];
                    }

                    var from = this.pagination.current_page - this.offset
                    var from2 = this.pagination.current_page - this.offset
                    if (from < 1) {
                        from = 1;
                    }

                    var to = from2 + (this.offset * 2);
                    if (to >= this.pagination.last_page) {
                        to = this.pagination.last_page;
                    }

                    var pagesArray = [];
                    while (from <= to) {
                        pagesArray.push(from);
                        from++;
                    }
                    return pagesArray;
                }
            },
            filters: {
                mostrarNumero(value) {

                    if (value != null && value != undefined) {
                        value = parseFloat(value).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }

                    return value;
                },
                pasfechaVista: function(date) {
                    if (date != null && date.length == 10) {
                        date = date.slice(-2) + '/' + date.slice(-5, -3) + '/' + date.slice(0, 4);
                    } else {
                        return '';
                    }

                    return date;
                },
                leftpad: function(n, length) {
                    var n = n.toString();
                    while (n.length < length)
                        n = "0" + n;
                    return n;
                },
                mescotejar: function(value) {
                    if (!value) return ''
                    value = parseInt(value.toString());
                    switch (value) {
                        case 1:
                            return "ENERO";
                            break;
                        case 2:
                            return "FEBRERO";
                            break;
                        case 3:
                            return "MARZO";
                            break;
                        case 4:
                            return "ABRIL";
                            break;
                        case 5:
                            return "MAYO";
                            break;
                        case 6:
                            return "JUNIO";
                            break;
                        case 7:
                            return "JULIO";
                            break;
                        case 8:
                            return "AGOSTO";
                            break;
                        case 8:
                            return "AGOSTO";
                            break;
                        case 9:
                            return "SETIEMBRE";
                            break;
                        case 10:
                            return "OCTUBRE";
                            break;
                        case 11:
                            return "NOVIEMBRE";
                            break;

                        case 12:
                            return "DICIEMBRE";
                            break;

                        default:
                            return "";
                            break;
                    }

                    return value
                },
            },
            methods: {
                getDatos: function(page) {
                    var busca = this.buscar;
                    var url = 'resecciones?page=' + page + '&busca=' + busca;

                    axios.get(url).then(response => {

                        this.registros = response.data.registros;

                        /* this.registros= response.data.registros.data;
                        this.pagination= response.data.pagination;

                        //this.mostrarPalenIni=true;

                        if(this.registros.length==0 && this.thispage!='1'){
                            var a = parseInt(this.thispage) ;
                            a--;
                            this.thispage=a.toString();
                            this.changePage(this.thispage);
                        } */
                    })
                },
                changePage: function(page) {
                    this.pagination.current_page = page;
                    this.getDatos(page);
                    this.thispage = page;
                },
                nuevo:function (idGrado) {
                    this.cancelForm();
                    this.fillobject.grado_id = idGrado;
                    this.labelBtnSave = 'Registrar';
                    this.fillobject.type = 'C';

                    $("#modalFormulario").modal('show');
                    this.$nextTick(() => {
                        $('#txtsiglas').focus();
                    });
                    /* this.divNuevo=true;
                    this.divloaderEdit=false;
                    this.$nextTick(function () {
                        this.cancelForm();
                    }) */
                },
                cerrarForm: function () {
                    /* this.divNuevo=false; */
                    $("#modalFormulario").modal('hide');
                    this.cancelForm();
                },
                cancelForm: function () {
                    this.fillobject = {
                                        'type':'C',
                                        'id': '',
                                        'nombre': '',
                                        'sigla': '',
                                        'grado_id': '',
                                        'activo': '1'
                                    };

                    this.$nextTick(() => {
                        $('#txtsiglas').focus();
                    });

                    /* this.divEdit=false; */
                },
                procesar: function() {
                    if(this.fillobject.type == 'C'){
                        this.confirmRegistrar();
                    }
                    if(this.fillobject.type == 'U'){
                        this.confirmActualizar();
                    }
                },
                confirmRegistrar:function () {
                    swal.fire({
                        title: '¿Estás seguro?',
                        text: "Desea Confirmar el Registro de la Sección",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Confirmar'
                    }).then((result) => {

                        if (result.value) {
                            console.log("aqui llega");
                            this.create();
                        }

                    }).catch(swal.noop);
                },
                create:function () {
                    var url='resecciones';
                    $("#btnGuardar").attr('disabled', true);
                    $("#btnClose").attr('disabled', true);
                    this.divloaderNuevo=true;

                    axios.post(url, this.fillobject).then(response=>{

                        $("#btnGuardar").removeAttr("disabled");
                        $("#btnClose").removeAttr("disabled");
                        this.divloaderNuevo=false;

                        if(response.data.result=='1'){
                            this.getDatos(this.thispage);
                            this.errors=[];
                            this.cerrarForm();
                            toastr.success(response.data.msj);
                        }else{
                            $('#'+response.data.selector).focus();
                            toastr.error(response.data.msj);
                        }
                    }).catch(error=>{
                        console.log(error);
                        //this.errors=error.response.data;
                        $("#btnGuardar").removeAttr("disabled");
                        $("#btnClose").removeAttr("disabled");
                    })
                },
                edit:function (dato) {

                    this.cancelForm();
                    this.fillobject.id=dato.id;
                    this.fillobject.nombre=dato.nombre;
                    this.fillobject.sigla=dato.sigla;
                    this.labelBtnSave = 'Modificar';
                    this.fillobject.type = 'U';

                    $("#modalFormulario").modal('show');
                    this.$nextTick(() => {
                        $('#txtsiglas').focus();
                    });

                },
                confirmActualizar:function () {
                    swal.fire({
                        title: '¿Estás seguro?',
                        text: "Desea Confirmar la Modificación de la Sección",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Confirmar'
                    }).then((result) => {

                        if (result.value) {
                            console.log("aqui llega");
                            this.update();
                        }

                    }).catch(swal.noop);
                },
                update: function () {

                    var url="resecciones/"+this.fillobject.id;
                    $("#btnGuardar").removeAttr("disabled");
                    $("#btnClose").removeAttr("disabled");
                    this.divloaderEdit=true;

                    axios.put(url, this.fillobject).then(response=>{


                        $("#btnGuardar").removeAttr("disabled");
                        $("#btnClose").removeAttr("disabled");
                        this.divloaderEdit=false;
                        
                        if(response.data.result=='1'){
                            this.getDatos(this.thispage);
                            this.errors=[];
                            this.cerrarForm();
                            toastr.success(response.data.msj);
                        }else{
                            $('#'+response.data.selector).focus();
                            toastr.error(response.data.msj);
                        }

                    }).catch(error=>{
                        console.log(error);
                        //this.errors=error.response.data;
                        $("#btnGuardar").removeAttr("disabled");
                        $("#btnClose").removeAttr("disabled");
                    })
                },  
                borrar:function (dato) {
                    swal.fire({
                        title: '¿Estás seguro?',
                        text: "Desea Eliminar el registro de la Sección",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Confirmar'
                    }).then((result) => {

                        if (result.value) {
                            this.delete(dato);
                        }

                    }).catch(swal.noop);
                },
                delete:function (dato) {
                    var url = 'resecciones/'+dato.id;
                    axios.delete(url).then(response=>{//eliminamos

                        if(response.data.result=='1'){
                            this.getDatos(this.thispage);//listamos
                            toastr.success(response.data.msj);//mostramos mensaje
                        }else{
                            // $('#'+response.data.selector).focus();
                            toastr.error(response.data.msj);
                        }
                    });
                },
            }
        }).mount('#app')
    </script>
@stop
