const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Legajo",
            subtituloHeader: "Principal",
            subtitulo2Header: "Legajo",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            errors: [],

            ie: {
                'id': '',
                'codigo_modular': '',
                'nombre': '',
                'gestion': '',
                'sigla_gestion': '',
                'resolucion_creacion': '',
                'forma': '',
                'sigla_forma': '',
                'departamento': '',
                'provincia': '',
                'distrito': '',
                'centro_poblado': '',
                'codigo_ugel': '',
                'nombre_ugel': '',
                'caracteristica': '',
                'sigla_caracteristica': '',
                'programa': '',
                'sigla_programa': '',
                'modalidad': '',
                'modalidad_siglas': '',
            },
            ieEdit: {
                'id': '',
                'codigo_modular': '',
                'nombre': '',
                'gestion': '',
                'sigla_gestion': '',
                'resolucion_creacion': '',
                'forma': '',
                'sigla_forma': '',
                'departamento': '',
                'provincia': '',
                'distrito': '',
                'centro_poblado': '',
                'codigo_ugel': '',
                'nombre_ugel': '',
                'caracteristica': '',
                'sigla_caracteristica': '',
                'programa': '',
                'sigla_programa': '',
                'modalidad': '',
                'modalidad_siglas': '',
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
    methods: {
        getDatos: function(page) {
            var busca = this.buscar;
            var url = 'reie?page=' + page + '&busca=' + busca;

            axios.get(url).then(response => {

                this.ie = response.data.registro;
                this.ieEdit = response.data.registro;

            })
        },
        confirmUpdate:function (type) {

            let item = '';

            switch (type) {
                case 1:
                    item = 'del Código Modular';
                    break;
                case 2:
                    item = 'del Nombre de la Institución Educativa';
                    break;
                case 3:
                    item = 'de la Resolución de Creación de la Institución Educativa';
                    break;
            
                default:
                    break;
            }

            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Modificación "+item,
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
                    this.ie.codigo_modular =this.ieEdit.codigo_modular;
                    break;
                case 2:
                    this.ie.nombre =this.ieEdit.nombre;
                    break;
                case 3:
                    this.ie.resolucion_creacion =this.ieEdit.resolucion_creacion;
                    break;
            
                default:
                    break;
            }

            var url="reie/"+this.ie.id;
            $(".editClass").attr("disabled");
            this.divloaderEdit=true;

            axios.put(url, this.ie).then(response=>{


                $(".editClass").removeAttr("disabled");
                this.divloaderEdit=false;
                
                if(response.data.result=='1'){
                    this.getDatos(this.thispage);
                    this.errors=[];
                    toastr.success(response.data.msj);
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj);
                }

            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $(".editClass").removeAttr("disabled");
            })
        }, 

    }
}).mount('#app')