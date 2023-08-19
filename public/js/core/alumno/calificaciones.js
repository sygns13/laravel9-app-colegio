const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Reporte de Calificaciones por Secciones",
            subtituloHeader: "Reporte Académico",
            subtitulo2Header: "Reporte de Calificaciones por Secciones",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
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

            labelBtnSave: 'Imprimir',

            seccionSeleccionada: 0,
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
            verCalificacionAlumno: false,
            verCalificacionAlumnoCompetencia: false,

            alumnos: [],

            alumno: {},

            seccionS: {},

            cursoS: {},


        }
    },
    created: function() {
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
        },
        alumnosFilters: function() {

            if (!this.alumnos) {
                return [];
            }

            return this.alumnos.map(function(registro) {
                if (registro.fecha_nacimiento_alu != null && registro.fecha_nacimiento_alu.length == 10) {
                    registro.fecha_nacimiento_alu_ok = registro.fecha_nacimiento_alu.slice(-2) + '/' + registro.fecha_nacimiento_alu.slice(-5, -3) + '/' + registro.fecha_nacimiento_alu.slice(0, 4);
                } else {
                    registro.fecha_nacimiento_alu_ok = '';
                }
                return registro;
            });

        }
    },
    methods: {
        getDatos: function(ciclo_id) {
            
            var url = 'calificacionesget-alu?ciclo_id=' + ciclo_id;

            axios.get(url).then(response => {

                this.registros = response.data.registros;
                this.verFormulario = true;

            })
        },

        changeCiclo:function() {
            this.verFormulario = false;
            this.cerrar();
            this.getDatos(this.ciclo_id);
        },

        cambioSeccion: function() {
            this.alumnos = [];
            this.orderData();
        },
        orderData: function() {

            this.registros.niveles.forEach(nivel => {
                nivel.grados.forEach(grado => {
                    grado.seccions.forEach(seccion => {
                        if(seccion.id==this.seccionSeleccionada){
                            this.alumnos = seccion.alumnos;
                            this.seccionS = seccion;
                        }
                    });
                });
            });   
        },



        cerrar: function() {
            this.seccionSeleccionada = 0;
            this.verCalificacionAlumno = false;
            this.verCalificacionAlumnoCompetencia = false;
        },

        /* imprimir: function() {
            url = 'reportepdf/asistencia-sesiones/'+this.seccionSeleccionada + '/' + this.fecha;
            console.log(url);
            window.open(url, '_blank').focus();
        }, */
        


        verNotasAlumno: function(data, nivel, grado){

            this.alumno.data = data;
            this.alumno.nivel = nivel.nombre;
            this.alumno.grado = grado.nombre;
            this.alumno.seccion = this.seccionS.nombre;

            this.verCalificacionAlumno = true;
            this.verCalificacionAlumnoCompetencia = false;
        },
        cerrarFormCalificacion: function() {
            this.verCalificacionAlumno = false;
            this.alumno = {};
        },
        calificacionCompetencia: function (registro) {
            this.cursoS = registro;
            this.verCalificacionAlumnoCompetencia = true;
        },
        cerrarFormCalificacionesCompetencia:function(){
            this.verCalificacionAlumnoCompetencia = false;
            this.cursoS = {};
        },



        imprimirAlumnosSeccion: function() {
            url = 'reportepdf/calificaciones-seccion/' + this.seccionSeleccionada;
            console.log(url);
            window.open(url, '_blank').focus();
        },
        imprimirAlumno: function() {
            url = 'reportepdf/calificaciones-alumno/' + this.alumno.data.id;
            console.log(url);
            window.open(url, '_blank').focus();
        },
        imprimirCurso: function() {
            url = 'reportepdf/calificaciones-curso/' + this.alumno.data.id + '/' + this.cursoS.idcurso;
            console.log(url);
            window.open(url, '_blank').focus();
        },



      
    }
}).mount('#app')