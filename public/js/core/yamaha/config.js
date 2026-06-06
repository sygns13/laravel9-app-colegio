const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Gestión del Tipo de Cambio",
            subtituloHeader: "Configuración",
            subtitulo2Header: "Gestión del Tipo de Cambio",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            errors: [],

            fillobject: {
                'id': '',
                'tipo_cambio': 0,
                'tipoCambioFormat': '',
            },
            fillobjectEdit: {
                'id': '',
                'tipo_cambio': 0,
                'tipoCambioFormat': '',
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
        this.getDatos();
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
        getDatos: function() {
            var url = 'retipo-cambio';

            axios.get(url).then(response => {

                this.fillobject = response.data.tipoCambio;
                this.fillobjectEdit = response.data.tipoCambio;

            })
        },
        confirmUpdate:function (type) {

            let item = '';

            switch (type) {
                case 1:
                    item = 'del Tipo de Cambio';
                    break;
            
                default:
                    break;
            }

            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Actualización "+item,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.update();
                }

            }).catch(swal.noop);
        },

        update: function (type) {

            switch (type) {
                case 1:
                    this.fillobject.tipoCambioFormat =this.fillobjectEdit.tipoCambioFormat;
                    break;
            
                default:
                    break;
            }

            var url="retipo-cambio/"+this.fillobject.id;
            $(".editClass").attr("disabled");
            this.divloaderEdit=true;

            axios.put(url, this.fillobject).then(response=>{


                $(".editClass").removeAttr("disabled");
                this.divloaderEdit=false;
                
                if(response.data.result=='1'){
                    this.getDatos();
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                    this.getDatos();
                }

            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $(".editClass").removeAttr("disabled");
            })
        }, 

    }
}).mount('#app')