const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Apreciación del Tutor",
            subtituloHeader: "Gestión Docente",
            subtitulo2Header: "Apreciación del Tutor",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            matriculas: [],
            errors: [],

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

            labelBtnSave: 'Registrar Apreciación',

            seccionSeleccionada: 0,

            seccion:{},
            grado:{},
            nivel:{},

            ciclo_id: 0,

            ciclo: {
                'id': '',
                'year': '',
                'fecha_ini_clases': '',
                'fecha_fin_clases': '',
                'activo': '1',
                'activo_matricula': '0',
                'opcion': '1',
            },

            verFormulario: false,

            alumno: {},

            numOrden: '',
            codigo: '',
            fullName: '',
            nivelN: '',
            gradoN: '',
            seccionN: '',

            verAlumno: false,


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
        getDatos: function() {
            var url = 'get-alumnos-tutor'

            axios.get(url).then(response => {
                this.registros = response.data.registros;
                this.verFormulario = true;
            })
        },


        cambioSeccion: function() {
            
            this.registros.niveles.forEach(nivel => {
                nivel.grados.forEach(grado => {
                    grado.seccions.forEach(seccion => {
                        if(seccion.id==this.seccionSeleccionada){
                            this.matriculas = seccion.matriculas;
                            this.seccion = seccion;
                            this.grado = grado;
                            this.nivel = nivel;
                        }
                    });
                });
            });   
        },

        cerrarSeccion: function() {
            this.seccionSeleccionada = 0;
            /* this.turnoSeleccionado = 0;
            this.generarSeccion(); */
        },

        registrarApreciación: function (registro, indexS) {

            this.alumno = registro;

            this.numOrden = indexS + 1;
            this.codigo = registro.anio_ingreso_alu + '' + registro.codigo_modular_alu + '' + registro.numero_matricula_alu + '' + registro.flag_alu;
            this.fullName = registro.apellido_paterno_alu + ' ' + registro.apellido_materno_alu + ' ' + registro.nombres_alu;
            console.log(this.nivel);
            this.nivelN = this.nivel.nombre;
            this.gradoN = this.grado.nombre;
            this.seccionN = this.seccion.nombre;

            this.verAlumno = true;

            $("#modalFormulario").modal('show');
                this.$nextTick(() => {
                    $('#txtobservacion1').focus();
                });
        },

        cerrarForm: function () {

            this.verAlumno = false;
            $("#modalFormulario").modal('hide');
            //this.cancelForm();
        },

        procesar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "¿Desea Registrar la Apreciación del Alumno Ingresada?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    //console.log("aqui llega");
                    this.registrar();
                }

            }).catch(swal.noop);
        },

        registrar:function () {
            var url='alumnos-tutor-save';
            $("#btnGuardar").attr('disabled', true);
            $("#btnClose").attr('disabled', true);
            this.divloaderNuevo=true;

            axios.post(url, this.alumno).then(response=>{

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
                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
            })
        },


      
    }
}).mount('#app')