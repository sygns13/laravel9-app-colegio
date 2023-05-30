const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Conclusión de Matrículas de Alumnos",
            subtituloHeader: "Gestión Académica",
            subtitulo2Header: "Conclusión de Matrículas de Alumnos",

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

            seccion_id_bk: null,
            alumno_id_bk: null,


        }
    },
    created: function() {
    },
    mounted: function() {
        console.log("mounted");
        this.ciclo_id = ciclo_escolar_id;
        this.getDatos();

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
        getDatos: function() {
            
            var url = 'calificacionesget?ciclo_id=' + this.ciclo_id;

            axios.get(url).then(response => {

                this.registros = response.data.registros;
                this.verFormulario = true;

                if(this.seccion_id_bk != null){
                    this.seccionSeleccionada = this.seccion_id_bk;
                    this.cambioSeccionBK();

                }

            })
        },

        changeCiclo:function() {
            this.verFormulario = false;
            this.cerrar();
            this.getDatos(this.ciclo_id);
        },

        cambioSeccionBK: function() {
            this.alumnos = [];
            this.orderData();
        },

        cambioSeccion: function() {
            this.alumno_id_bk = null;
            this.alumnos = [];
            this.orderData();
        },
        orderData: function() {

            this.registros.niveles.forEach(nivel => {
                nivel.grados.forEach(grado => {
                    grado.seccions.forEach(seccion => {
                        if(seccion.id==this.seccionSeleccionada){
                            this.seccion_id_bk = this.seccionSeleccionada;
                            this.alumnos = seccion.alumnos;
                            this.seccionS = seccion;

                            if(this.alumno_id_bk != null){
                                this.verNotasAlumno(this.alumno_id_bk, nivel, grado);
                            }
                        }
                    });
                });
            });   
        },



        cerrar: function() {
            this.seccionSeleccionada = 0;
            this.verCalificacionAlumno = false;
            this.verCalificacionAlumnoCompetencia = false;

            this.seccion_id_bk = null;
            this.alumno_id_bk = null;
        },

        cerrarProm: function() {
            this.seccionSeleccionada = 0;
            this.verCalificacionAlumno = false;
            this.verCalificacionAlumnoCompetencia = false;

        },

        /* imprimir: function() {
            url = 'reportepdf/asistencia-sesiones/'+this.seccionSeleccionada + '/' + this.fecha;
            console.log(url);
            window.open(url, '_blank').focus();
        }, */
        


        verNotasAlumno: function(indexAlumno, nivel, grado){

            this.alumno_id_bk = indexAlumno;
            this.alumno.data = this.alumnosFilters[indexAlumno];
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



        confirmPromover:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar el Promover de Grado al Alumno",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.promover();
                }

            }).catch(swal.noop);
        },

        confirmPermanecer:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar el Permanecer en el Grado al Alumno para el siguiente año escolar",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.permanecer();
                }

            }).catch(swal.noop);
        },

        confirmExpulsion:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Expulsión del Alumno para el siguiente año escolar",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.expulsar();
                }

            }).catch(swal.noop);
        },

        confirmCancelConclusion:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Cancelación de la Conclusión del Alumno del siguiente año escolar",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.cancelconclusion();
                }

            }).catch(swal.noop);
        },


        promover:function () {
            var url='matricula/promover';
            $("#btnPromover").attr('disabled', true);
            $("#btnDanger").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('v1', this.alumno.data.id);

            axios.post(url, data).then(response=>{

                $("#btnPromover").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarProm();
                    this.getDatos();
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    //$('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnPromover").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
            })
        },


        permanecer:function () {
            var url='matricula/permanecer';
            $("#btnPermanecer").attr('disabled', true);
            $("#btnDanger").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('v1', this.alumno.data.id);

            axios.post(url, data).then(response=>{

                $("#btnPermanecer").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarProm();
                    this.getDatos();
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    //$('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnPermanecer").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
            })
        },

        expulsar:function () {
            var url='matricula/expulsar';
            $("#btnExpulsar").attr('disabled', true);
            $("#btnDanger").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('v1', this.alumno.data.id);

            axios.post(url, data).then(response=>{

                $("#btnExpulsar").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarProm();
                    this.getDatos();
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    //$('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnExpulsar").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
            })
        },

        cancelconclusion:function () {
            var url='matricula/cancelconclusion';
            $("#btnCancelConclusion").attr('disabled', true);
            $("#btnDanger").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('v1', this.alumno.data.id);

            axios.post(url, data).then(response=>{

                $("#btnCancelConclusion").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarProm();
                    this.getDatos();
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    //$('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnCancelConclusion").removeAttr("disabled");
                $("#btnDanger").removeAttr("disabled");
            })
        },



      
    }
}).mount('#app')