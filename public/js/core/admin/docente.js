const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Gestión de Docentes",
            subtituloHeader: "Docentes",
            subtitulo2Header: "",

            subtitle2Header: false,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            tipoDocumentos: [],
            errors: [],

            fillobject: {
                'type':'C',
                'id': '',
                'tipo_documento_id': '0',
                'num_documento': '',
                'apellidos': '',
                'nombre': '',
                'especialidad': '',
                'genero': 'M',
                'telefono': '',
                'celular': '',
                'condicion': '',
                'dedicacion': '',
                'cargo': '',
                'direccion': '',
                'codigo_plaza': '',
                'name': '',
                'email': '',
                'password': '',
                'activo': '1',
                'modifPsw': '0',
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
            divFormulario: false,
            divloaderNuevo: false,

            mostrarPalenIni: true,

            thispage: '1',
            divprincipal: false,

            labelBtnSave: 'Registrar',

            tipoDocSelect: {
                'id': '',
                'nombre': 'Documento',
                'sigla': '',
                'digitos': '0',
            },

           
        }
    },
    created: function() {
        this.getDatos(this.thispage);
        console.log("created");
    },
    mounted: function() {
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
    methods: {

        changeTipoDoc: function() {
            this.tipoDocumentos.forEach((element) => {
                if(element.id == this.fillobject.tipo_documento_id){
                    this.tipoDocSelect = element;
                }
            });
            this.fillobject.num_documento = '';
        },
        getDatos: function(page) {
            var busca = this.buscar;
            var url = 'redocentes?page=' + page + '&busca=' + busca;

            axios.get(url).then(response => {

                this.registros= response.data.registros.data;
                this.pagination= response.data.pagination;
                this.tipoDocumentos= response.data.tipoDocumentos;

                //this.mostrarPalenIni=true;

                if(this.registros.length==0 && this.thispage!='1'){
                    var a = parseInt(this.thispage) ;
                    a--;
                    this.thispage=a.toString();
                    this.changePage(this.thispage);
                }
            })
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getDatos(page);
            this.thispage = page;
        },
        nuevo:function () {
            this.cancelForm();
            this.labelBtnSave = 'Registrar';
            this.fillobject.type = 'C';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#cbutipo_documento_id').focus();
            });
        },
        cerrarForm: function () {
            this.divFormulario=false;
            this.cancelForm();
        },
        cancelForm: function () {
            this.fillobject = {
                'type':'C',
                'id': '',
                'tipo_documento_id': '0',
                'num_documento': '',
                'apellidos': '',
                'nombre': '',
                'especialidad': '',
                'genero': 'M',
                'telefono': '',
                'celular': '',
                'condicion': '',
                'dedicacion': '',
                'cargo': '',
                'direccion': '',
                'codigo_plaza': '',
                'name': '',
                'email': '',
                'password': '',
                'activo': '1',
                'modifPsw': '0',
            };
            this.tipoDocSelect = {
                'id': '',
                'nombre': 'Documento',
                'sigla': '',
                'digitos': '0',
            };

            this.$nextTick(() => {
                $('#cbutipo_documento_id').focus();
            });
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
                text: "Desea Confirmar el Registro del Docente",
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
            var url='redocentes';
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
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
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
            this.fillobject.tipo_documento_id=dato.tipo_documento_id;
            this.fillobject.num_documento=dato.num_documento;
            this.fillobject.apellidos=dato.apellidos;
            this.fillobject.nombre=dato.nombre;
            this.fillobject.especialidad=dato.especialidad;
            this.fillobject.genero=dato.genero;
            this.fillobject.telefono=dato.telefono;
            this.fillobject.celular=dato.celular;
            this.fillobject.condicion=dato.condicion;
            this.fillobject.dedicacion=dato.dedicacion;
            this.fillobject.cargo=dato.cargo;
            this.fillobject.direccion=dato.direccion;
            this.fillobject.codigo_plaza=dato.codigo_plaza;
            this.fillobject.name=dato.users_name;
            this.fillobject.email=dato.users_email;
            this.fillobject.activo=dato.users_activo;
            this.fillobject.modifPsw= 0;
            this.fillobject.password= '';
            this.labelBtnSave = 'Modificar';
            this.fillobject.type = 'U';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#cbutipo_documento_id').focus();
            });

        },
        confirmActualizar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Modificación del Docente",
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

            var url="redocentes/"+this.fillobject.id;
            $("#btnGuardar").attr("disabled");
            $("#btnClose").attr("disabled");
            this.divloaderEdit=true;

            axios.put(url, this.fillobject).then(response=>{


                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
                this.divloaderEdit=false;
                
                if(response.data.result=='1'){
                    this.getDatos(this.thispage);
                    this.errors=[];
                    this.cerrarForm();
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
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
                text: "Desea Eliminar el registro del Docente",
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
            var url = 'redocentes/'+dato.id;
            axios.delete(url).then(response=>{//eliminamos

                if(response.data.result=='1'){
                    this.getDatos(this.thispage);//listamos
                    toastr.success(response.data.msj, {timeOut: 20000});//mostramos mensaje
                }else{
                    // $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            });
        },

        baja:function (dato) {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea dar de baja al Docente",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {
  
              if (result.value) {
                this.altabajadocente(dato.id,0);
              }
  
          }).catch(swal.noop);
        },
        alta:function (dato) {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea activar al Docente",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {
  
              if (result.value) {
                this.altabajadocente(dato.id,1);
              }
          }).catch(swal.noop);
        },

        altabajadocente:function (id, estado) {
            var url = 'redocentes/altabajadocente/'+id+'/'+estado;
            axios.get(url).then(response=>{//get
                if(response.data.result=='1'){
                    this.getDatos(this.thispage);//listamos
                    toastr.success(response.data.msj, {timeOut: 20000});//mostramos mensaje
                }else{
                    // $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            });
        },

        generateUsername:function (){

            if (this.fillobject.nombre != null){
                this.fillobject.nombre = this.fillobject.nombre.trim();
            }
            if (this.fillobject.apellidos != null){
                this.fillobject.apellidos = this.fillobject.apellidos.trim();
            }

            this.fillobject.name = "";

            if(this.fillobject.nombre != null && this.fillobject.nombre != "" && this.fillobject.apellidos != null && this.fillobject.apellidos != ""){
                var arrayApellidos = this.fillobject.apellidos.split(" ");
                let username = this.fillobject.nombre.substring(0, 1) + arrayApellidos[0];

                //this.fillobject.name = username;

                var url='redocentes/generateusername';
                axios.post(url, {_username: username}).then(response=>{

                    if(response.data.result == '1'){
                        this.fillobject.name = response.data.username;
                        //toastr.success(response.data.msj, {timeOut: 20000});
                    }
                }).catch(error=>{
                    console.log(error);
                })
            }
            
        },
    }
}).mount('#app')