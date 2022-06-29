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
                <li class="pt-2 px-3"><h3 class="card-title">Niveles:</h3></li>
                <li class="nav-item" v-for="(nivel, index) in registros.niveles">
                    <a data-toggle="pill" role="tab" aria-selected="true"
                    v-bind="{ id: 'custom-tabs-two-' + nivel.siglas+'-tab', 'class': index == 0 ? 'nav-link active' : 'nav-link', 'href': '#custom-tabs-two-' + nivel.siglas, 'aria-controls': 'custom-tabs-two-' + nivel.siglas }">@{{nivel.nombre}}</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-two-tabContent">

                <template v-for="(nivel, index) in registros.niveles">
                    <div role="tabpanel"
                    v-bind="{ 'class': index == 0 ? 'tab-pane fade show active' : 'tab-pane fade', 'id': 'custom-tabs-two-' + nivel.siglas, 'aria-labelledby': 'custom-tabs-two-' + nivel.siglas + '-tab' }">

                    {{-- @{{nivel.nombre}} --}}

                    <div class="row">
                        <div class="col-5 col-sm-3">
                          <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <template v-for="(grado, indexG) in nivel.grados">
                                <a data-toggle="pill" role="tab" aria-selected="true"
                                v-bind="{ 'class': indexG == 0 ? 'nav-link active' : 'nav-link', 'id': 'vert-tabs-gra' + nivel.siglas + grado.orden + '-tab', 'href': '#vert-tabs-gra' + nivel.siglas + grado.orden, 'aria-controls': 'vert-tabs-gra' + nivel.siglas + grado.orden }">@{{grado.nombre}}</a>
                            </template>
                          </div>
                        </div>
                        <div class="col-7 col-sm-9">
                          <div class="tab-content" id="vert-tabs-tabContent">
                            <template v-for="(grado, indexG) in nivel.grados">
                                <div role="tabpanel"
                                v-bind="{ 'class': indexG == 0 ? 'tab-pane text-left fade show active' : 'tab-pane fade', 'id': 'vert-tabs-gra' + nivel.siglas + grado.orden, 'aria-labelledby': 'vert-tabs-gra' + nivel.siglas + grado.orden + '-tab' }">
                                    @{{grado.nombre}}
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

        const { createApp } = Vue

        createApp({
            data() {
                return {
                    tituloHeader:"Gestión de Secciones",
                    subtituloHeader: "Tablas Base",
                    subtitulo2Header: "Gestión de Secciones",

                    subtitle2Header:true,

                    userPerfil:'{{ Auth::user()->name }}',
                    mailPerfil:'{{ Auth::user()->email }}',

                    registros: [],
                    errors:[],

                    fillobject:{ 'id':'', 'nombre':'', 'sigla':'', 'grado_id':'', 'activo':'1'},

                    pagination: {
                        'total': 0,
                        'current_page': 0,
                        'per_page': 0,
                        'last_page': 0,
                        'from': 0,
                        'to': 0
                    },
                    offset: 9,

                    buscar:'',
                    divNuevo:false,
                    divEdit:false,

                    divloaderNuevo:false,
                    divloaderEdit:false,

                    mostrarPalenIni:true,

                    thispage:'1',
                    divprincipal:false,
                }
            },
            created:function () {
                this.getDatos(this.thispage); 
                console.log("created");
            },
            mounted: function () {
                /* $("#divtitulo").show('slow');
                this.divloader0=false;
                this.divprincipal=true; */
                console.log("mounted");
            },
            computed:{
                isActived: function(){
                    return this.pagination.current_page;
                },
                pagesNumber: function () {
                    if(!this.pagination.to){
                        return [];
                    }

                    var from=this.pagination.current_page - this.offset 
                    var from2=this.pagination.current_page - this.offset 
                    if(from<1){
                        from=1;
                    }

                    var to= from2 + (this.offset*2); 
                    if(to>=this.pagination.last_page){
                        to=this.pagination.last_page;
                    }

                    var pagesArray = [];
                    while(from<=to){
                        pagesArray.push(from);
                        from++;
                    }
                    return pagesArray;
                }
            },
            filters:{
                mostrarNumero(value){
                
                if(value != null && value != undefined){
                    value=parseFloat(value).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }

                return value;
                },
                pasfechaVista:function(date){
                    if(date!=null && date.length==10){
                        date=date.slice(-2)+'/'+date.slice(-5,-3)+'/'+date.slice(0,4);            
                    }else{
                    return '';
                    }

                    return date;
                },
                leftpad:function(n, length) {
                    var  n = n.toString();
                    while(n.length < length)
                        n = "0" + n;
                    return n;
                },
                mescotejar:function (value) {
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
                getDatos: function (page) {
                    var busca=this.buscar;
                    var url = 'resecciones?page='+page+'&busca='+busca;

                    axios.get(url).then(response=>{

                        this.registros= response.data.registros;

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
                changePage:function (page) {
                    this.pagination.current_page=page;
                    this.getDatos(page);
                    this.thispage=page;
                },
            }
        }).mount('#app')
    </script>
@stop