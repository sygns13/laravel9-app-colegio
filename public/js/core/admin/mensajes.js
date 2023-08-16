const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Gestión de Mensajes",
            subtituloHeader: "Mensajes",
            subtitulo2Header: "",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            registrosP: [],
            tipoDocumentos: [],
            errors: [],

            fillobject: {
                'type':'C',
                'id': '',
                'titulo': '',
                'mensaje': '',
                'user_id_recibe': [],
                'fecha_leida': '',
                'hora_leida': '',
            },

            pagination: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },
            paginationP: {
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
            thispageP: '1',
            divprincipal: false,
            divRecibidos: false,
            divEnviados: false,
            divMensajeRecibido: false,
            divMensajeEnviado: false,

            labelBtnSave: 'Registrar',
            turnoNombre : '',

            destinatarios: '',

            editor: ClassicEditor,
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
            },

            users:[],

            type: 0,

            fillMsjeRecibido: {
                
            },

            fillMsjeEnviado: {
                
            },

        }
    },
    created: function() {

    },
    mounted: function() {
        this.recibidos();
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
        },

        isActivedP: function() {
            return this.paginationP.current_page;
        },
        pagesNumberP: function() {
            if (!this.paginationP.to) {
                return [];
            }

            var from = this.paginationP.current_page - this.offset
            var from2 = this.paginationP.current_page - this.offset
            if (from < 1) {
                from = 1;
            }

            var to = from2 + (this.offset * 2);
            if (to >= this.paginationP.last_page) {
                to = this.paginationP.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
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
            
            var url = 'remensajes?page=' + page + '&type=' + this.type;

            axios.get(url).then(response => {

                this.registros= response.data.registros.data;
                this.pagination= response.data.pagination;

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
            this.labelBtnSave = 'Nuevo Mensaje';
            this.fillobject.type = 'C';

            this.divFormulario=true;
            this.divRecibidos=false;
            this.divEnviados=false;
            this.divMensajeRecibido=false;
            this.divMensajeEnviado=false;

            this.$nextTick(() => {
                $('#txtmensaje').focus();
            });
        },
        cerrarForm: function () {
            this.divFormulario=false;
            this.cancelForm();
        },
        cancelForm: function () {
            this.fillobject.type = 'C';
            this.fillobject.id = '';

            this.fillobject.titulo = '';
            this.fillobject.mensaje = '';
            this.fillobject.user_id_recibe = [];
            this.fillobject.fecha_leida = '';
            this.fillobject.hora_leida = '';

            this.buscar = '';
            this.users = [];


            this.$nextTick(() => {
                $('#txtmensaje').focus();
            });
        },

        selAlumnos: function() {

            let existeElemento = this.users.find(element => element.id == 'Alu');

            if(!existeElemento){

                let user = {
                    'id':'',
                    'persona':'',
                    'tipo':'',
                    'tipo_user_id':'',
                };

                user.id = 'Alu';
                user.persona = 'Todos los Alumnos';
                user.tipo = 'Alumno';
                user.tipo_user_id = '4';
    
                this.users.push(user);
            }
        },

        selPadres: function() {

            let existeElemento = this.users.find(element => element.id == 'Pad');

            if(!existeElemento){

                let user = {
                    'id':'',
                    'persona':'',
                    'tipo':'',
                    'tipo_user_id':'',
                };

                user.id = 'Pad';
                user.persona = 'Todos los Padres';
                user.tipo = 'Padres';
                user.tipo_user_id = '5';
    
                this.users.push(user);
            }
        },

        selDirectores: function() {

            let existeElemento = this.users.find(element => element.id == 'Dir');

            if(!existeElemento){

                let user = {
                    'id':'',
                    'persona':'',
                    'tipo':'',
                    'tipo_user_id':'',
                };

                user.id = 'Dir';
                user.persona = 'Todos los Directores';
                user.tipo = 'Directores';
                user.tipo_user_id = '1';
    
                this.users.push(user);
            }
        },

        selDocentes: function() {

            let existeElemento = this.users.find(element => element.id == 'Doc');

            if(!existeElemento){

                let user = {
                    'id':'',
                    'persona':'',
                    'tipo':'',
                    'tipo_user_id':'',
                };

                user.id = 'Doc';
                user.persona = 'Todos los Docentes';
                user.tipo = 'Docentes';
                user.tipo_user_id = '3';
    
                this.users.push(user);
            }
        },

        buscarBtn: function () {
            this.getDatosPersonas();
            this.thispageP='1';
        },
        buscarBtnZ: function () {
            this.thispageP='1';
            this.getDatosPersonasZ();
        },

        getDatosPersonasZ: function(page) {
            var busca = this.buscar;
            var url = 'get-personas-mensajes?page=' + page + '&busca=' + busca;

            axios.get(url).then(response => {

                this.registrosP= response.data.registros.data;
                this.paginationP= response.data.pagination;

                $("#modalFormulario").modal('show');
                this.$nextTick(() => {
                    $('#txtbuscar').focus();
                });

                //this.mostrarPalenIni=true;

                if(this.registrosP.length==0 && this.thispageP!='1'){
                    var a = parseInt(this.thispageP) ;
                    a--;
                    this.thispageP=a.toString();
                    this.changePageP(this.thispageP);
                }
            })
        },

        getDatosPersonas: function(page) {
            var busca = this.buscar;
            var url = 'get-personas-mensajes?page=' + page + '&busca=' + busca;

            axios.get(url).then(response => {

                this.registrosP= response.data.registros.data;
                this.paginationP= response.data.pagination;

                //this.mostrarPalenIni=true;

                if(this.registrosP.length==0 && this.thispageP!='1'){
                    var a = parseInt(this.thispageP) ;
                    a--;
                    this.thispageP=a.toString();
                    this.changePageP(this.thispageP);
                }
            })
        },
        changePageP: function(page) {
            this.paginationP.current_page = page;
            this.getDatosPersonas(page);
            this.thispageP = page;
        },

        seleccionar: function(registro) {

            let existeElemento = this.users.find(element => element.id == registro.users_id);

            if(!existeElemento){

                let user = {
                    'id':'',
                    'persona':'',
                    'tipo':'',
                    'tipo_user_id':'',
                };

                user.id = registro.users_id;
                user.persona = registro.nombres + ' ' +registro.apellidos;
                user.tipo = registro.tipo_users_nombre;
                user.tipo_user_id = registro.tipo_users_id;
    
                this.users.push(user);
            }
        },

        procesar: function() {
            if(this.fillobject.type == 'C'){
                this.confirmRegistrar();
            }
            if(this.fillobject.type == 'U'){
                this.confirmActualizar();
            }
        },

        confirmRegistrar: function() {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar el Envío del Mensaje",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.create();
                }

            }).catch(swal.noop);
        },

        create:function () {
            var url='remensajes';
            $("#btnGuardar").attr('disabled', true);
            $("#btnClose").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('titulo', this.fillobject.titulo);
            data.append('mensaje', this.fillobject.mensaje);
            data.append('users', JSON.stringify(this.users));

            axios.post(url, data).then(response=>{

                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    //this.getDatos(this.thispage);
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

        //Mensajes Recibidos 
        recibidos:function () {
            this.type = 1;
            this.thispage = 1;
            this.getDatos(this.thispage);
            this.$nextTick(() => {
                this.divFormulario = false;
                this.divRecibidos = true;
                this.divEnviados = false;
                this.divMensajeRecibido=false;
                this.divMensajeEnviado=false;
            });  
        },

        //Mensajes Enviados 
        enviados:function () {
            this.type = 2;
            this.thispage = 1;
            this.getDatos(this.thispage);
            this.$nextTick(() => {
                this.divFormulario = false;
                this.divRecibidos = false;
                this.divEnviados = true;
                this.divMensajeRecibido=false;
                this.divMensajeEnviado=false;
            });  
        },

        //Leer Mensaje
        leerMensaje:function(registro){

            this.fillMsjeRecibido = registro;
            var url='remensajes-leido';

            if(registro.user_mensajes_estado == '0'){
                var data = new  FormData();

                data.append('id', registro.id);
                data.append('user_mensajes_id', registro.user_mensajes_id);
    
                axios.post(url, data).then(response=>{
    
                    if(response.data.result=='1'){
                        //this.getDatos(this.thispage);
                        this.errors=[];
                        //this.cerrarForm();
                        //toastr.success(response.data.msj, {timeOut: 20000});
                        console.log("exito");
                    }else{
                        $('#'+response.data.selector).focus();
                        //toastr.error(response.data.msj, {timeOut: 20000});
                    }
                }).catch(error=>{
                    console.log(error);
                    //this.errors=error.response.data;
                })
            }

            this.$nextTick(() => {
                this.divFormulario = false;
                this.divRecibidos = false;
                this.divEnviados = false;
                this.divMensajeRecibido = true;
                this.divMensajeEnviado = false;
            });
        },

        //Leer Mensaje Enviado
        leerMensajeEnviado:function(registro){

            this.fillMsjeEnviado = registro;

            this.$nextTick(() => {
                this.divFormulario = false;
                this.divRecibidos = false;
                this.divEnviados = false;
                this.divMensajeRecibido = false;
                this.divMensajeEnviado = true;
            });
        },

        /*
        edit:function (dato) {

            this.cancelForm();
            this.fillobject.id=dato.id;
            this.fillobject.titulo=dato.titulo;
            this.fillobject.mensaje=dato.mensaje;
            this.fillobject.user_id_recibe=dato.user_id_recibe;
            this.labelBtnSave = 'Modificar';
            this.fillobject.type = 'U';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#txttituloE').focus();
            });

        },
        confirmActualizar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Modificación de la Hora",
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

            var url="remensajes/"+this.fillobject.id;
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
                text: "Desea Eliminar el registro de la Hora",
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
            var url = 'remensajes/'+dato.id;
            axios.delete(url).then(response=>{//eliminamos

                if(response.data.result=='1'){
                    this.getDatos(this.thispage);//listamos
                    toastr.success(response.data.msj, {timeOut: 20000});//mostramos mensaje
                }else{
                    // $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            });
        }, */
    }
}).use( CKEditor ).mount('#app')