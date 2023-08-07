const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Gestión de Resoluciones",
            subtituloHeader: "Tablas Base",
            subtitulo2Header: "Gestión de Resoluciones",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros1: [],
            registros2: [],

            errors: [],

            fillobject: {
                'type':'C',
                'id': '',
                'tipo': '0',
                'nombre': '',
                'year': '',
                'archivo': '',
            },

            pagination1: {
                'total': 0,
                'current_page': 0,
                'per_page': 0,
                'last_page': 0,
                'from': 0,
                'to': 0
            },

            pagination2: {
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

            thispage1: '1',
            thispage2: '1',
            divprincipal: false,

            labelBtnSave: 'Registrar',

            archivo : null,
            uploadReady: true,

        }
    },
    created: function() {
    },
    mounted: function() {
        this.getDatos1();
        this.getDatos2();
    },
    computed: {
        isActived1: function() {
            return this.pagination1.current_page;
        },
        isActived2: function() {
            return this.pagination2.current_page;
        },
        pagesNumber1: function() {
            if (!this.pagination1.to) {
                return [];
            }

            var from = this.pagination1.current_page - this.offset
            var from2 = this.pagination1.current_page - this.offset
            if (from < 1) {
                from = 1;
            }

            var to = from2 + (this.offset * 2);
            if (to >= this.pagination1.last_page) {
                to = this.pagination1.last_page;
            }

            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        pagesNumber2: function() {
            if (!this.pagination2.to) {
                return [];
            }

            var from = this.pagination2.current_page - this.offset
            var from2 = this.pagination2.current_page - this.offset
            if (from < 1) {
                from = 1;
            }

            var to = from2 + (this.offset * 2);
            if (to >= this.pagination2.last_page) {
                to = this.pagination2.last_page;
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

        getDatos1: function(page) {
            var url = 'get-resoluciones1?page=' + page;

            axios.get(url).then(response => {

                this.registros1= response.data.registros.data;
                this.pagination1= response.data.pagination;

                //this.mostrarPalenIni=true;

                if(this.registros1.length==0 && this.thispage1!='1'){
                    var a = parseInt(this.thispage1) ;
                    a--;
                    this.thispage1=a.toString();
                    this.changePage1(this.thispage1);
                }
            })
        },
        changePage1: function(page) {
            this.pagination1.current_page = page;
            this.getDatos1(page);
            this.thispage1 = page;
        },

        
        getDatos2: function(page) {
            var url = 'get-resoluciones2?page=' + page;

            axios.get(url).then(response => {

                this.registros2= response.data.registros.data;
                this.pagination2= response.data.pagination;

                //this.mostrarPalenIni=true;

                if(this.registros2.length==0 && this.thispage2!='1'){
                    var a = parseInt(this.thispage2) ;
                    a--;
                    this.thispage2=a.toString();
                    this.changePage2(this.thispage2);
                }
            })
        },
        changePage2: function(page) {
            this.pagination2.current_page = page;
            this.getDatos2(page);
            this.thispage2 = page;
        },


        nuevo:function () {
            this.cancelForm();
            this.labelBtnSave = 'Registrar';
            this.fillobject.type = 'C';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#txttipo').focus();
            });
        },
        cerrarForm: function () {
            this.divFormulario=false;
            this.cancelForm();
        },
        cancelForm: function () {
            this.fillobject.type = 'C';
            this.fillobject.id = '';
            this.fillobject.tipo = '0';
            this.fillobject.nombre = '';
            this.fillobject.year = '';
            this.fillobject.archivo = '';

            this.uploadReady = false;
            this.archivo=null;

            this.$nextTick(() => {
                $('#txttipo').focus();
                this.uploadReady = true;
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
                text: "Desea Confirmar el Registro de la Resolución",
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
            var url='reresolucion';
            $("#btnGuardar").attr('disabled', true);
            $("#btnClose").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('tipo', this.fillobject.tipo);
            data.append('nombre', this.fillobject.nombre);
            data.append('year', this.fillobject.year);
            data.append('archivo', this.archivo);


            axios.post(url, data).then(response=>{

                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.getDatos1(this.thispage1);
                    this.getDatos2(this.thispage2);
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
            this.fillobject.tipo=dato.tipo;
            this.fillobject.nombre=dato.nombre;
            this.fillobject.year=dato.year;
            this.fillobject.archivo=dato.archivo;
            this.labelBtnSave = 'Modificar';
            this.fillobject.type = 'U';

            this.divFormulario=true;

            this.$nextTick(() => {
                $('#txttipo').focus();
            });

        },
        confirmActualizar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Modificación de la Resolución",
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

            var url="reresolucion/"+this.fillobject.id;
            $("#btnGuardar").attr("disabled");
            $("#btnClose").attr("disabled");
            this.divloaderEdit=true;

            var data = new  FormData();

            data.append('tipo', this.fillobject.tipo);
            data.append('nombre', this.fillobject.nombre);
            data.append('year', this.fillobject.year);
            data.append('archivo', this.archivo);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

            data.append('_method', 'PUT');

            axios.post(url,data,config).then(response=>{


                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
                this.divloaderEdit=false;
                
                if(response.data.result=='1'){
                    this.getDatos1(this.thispage1);
                    this.getDatos2(this.thispage2);
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
                text: "Desea Eliminar el registro de la Resolución",
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
            var url = 'reresolucion/'+dato.id;
            axios.delete(url).then(response=>{//eliminamos

                if(response.data.result=='1'){
                    this.getDatos1(this.thispage1);
                    this.getDatos2(this.thispage2);
                    toastr.success(response.data.msj, {timeOut: 20000});//mostramos mensaje
                }else{
                    // $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            });
        },

        getArchivo:function (event){
            //Asignamos la imagen a  nuestra data

            if (!event.target.files.length)
            {
              this.archivo=null;
            }
            else{
            this.archivo = event.target.files[0];
            }
        },
    }
}).mount('#app')