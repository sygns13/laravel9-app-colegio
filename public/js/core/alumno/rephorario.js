const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Reporte de Horarios",
            subtituloHeader: "Reporte Académico",
            subtitulo2Header: "Reporte de Horarios",

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

            horario:{
                'lunes': [],
                'martes': [],
                'miercoles': [],
                'jueves': [],
                'viernes': [],
                'coLunes': [],
                'coMartes': [],
                'coMiercoles': [],
                'coJueves': [],
                'coViernes': [],
            },

            turnos:[],
            turnoSeleccionado: 0,
            horas:[],

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
        }
    },
    created: function() {
        //this.getDatos(this.thispage);
        //console.log("created");
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
        getDatos: function(ciclo_id) {
            
            var url = 'rehorariogetalu?ciclo_id=' + ciclo_id;

            axios.get(url).then(response => {

                this.registros = response.data.registros;
                this.turnos = response.data.turnos;
                this.horas = response.data.horas;

                this.verFormulario = true;

                this.generarHorario();

            })
        },

        changeCiclo:function() {
            this.verFormulario = false;
            this.cerrarHorario();
            this.getDatos(this.ciclo_id);
        },

        cambioSeccion: function() {

            //this.turnoSeleccionado = '0';
            this.cambioTurno();

            this.registros.niveles.forEach(nivel => {
                nivel.grados.forEach(grado => {
                    grado.seccions.forEach(seccion => {
                        if(seccion.id==this.seccionSeleccionada){
                            this.turnoSeleccionado = seccion.turno_id;
                            this.cambioTurno();
                        }
                    });
                });
            });   
        },

        cambioTurno: function() {
            this.generarHorario();
        },

        generarHorario: function() {

            this.horario = {
                'lunes': [],
                'martes': [],
                'miercoles': [],
                'jueves': [],
                'viernes': [],
                'coLunes': [],
                'coMartes': [],
                'coMiercoles': [],
                'coJueves': [],
                'coViernes': [],
            };

            this.turnos.forEach(turno => {
                this.horas.forEach(hora => {
                    if(turno.id==hora.turno_id && turno.id==this.turnoSeleccionado){

                        let isDataLu = false;
                        let isDataMa = false;
                        let isDataMi = false;
                        let isDataJu = false;
                        let isDataVi = false;

                        let isColorLu = false;
                        let isColorMa = false;
                        let isColorMi = false;
                        let isColorJu = false;
                        let isColorVi = false;

                        this.registros.niveles.forEach(nivel => {
                            nivel.grados.forEach(grado => {
                                grado.seccions.forEach(seccion => {
                                    if(seccion.id==this.seccionSeleccionada){
                                        seccion.horarios.forEach(horario => {
                                            if(hora.id == horario.hora_id){
                                                if(horario.dia_semana==1){
                                                    isDataLu = true;
                                                    this.horario.lunes[hora.id] = horario.ciclo_curso_id;
                                                    grado.cursos.forEach(curso => {
                                                        if(horario.ciclo_curso_id == curso.id){
                                                            this.horario.coLunes[hora.id] = curso.color;
                                                            isColorLu = true;
                                                        }
                                                    });
                                                }
                                                if(horario.dia_semana==2){
                                                    isDataMa = true;
                                                    this.horario.martes[hora.id] = horario.ciclo_curso_id;
                                                    grado.cursos.forEach(curso => {
                                                        if(horario.ciclo_curso_id == curso.id){
                                                            this.horario.coMartes[hora.id] = curso.color;
                                                            isColorMa = true;
                                                        }
                                                    });
                                                }
                                                if(horario.dia_semana==3){
                                                    isDataMi = true;
                                                    this.horario.miercoles[hora.id] = horario.ciclo_curso_id;
                                                    grado.cursos.forEach(curso => {
                                                        if(horario.ciclo_curso_id == curso.id){
                                                            this.horario.coMiercoles[hora.id] = curso.color;
                                                            isColorMi = true;
                                                        }
                                                    });
                                                }
                                                if(horario.dia_semana==4){
                                                    isDataJu = true;
                                                    this.horario.jueves[hora.id] = horario.ciclo_curso_id;
                                                    grado.cursos.forEach(curso => {
                                                        if(horario.ciclo_curso_id == curso.id){
                                                            this.horario.coJueves[hora.id] = curso.color;
                                                            isColorJu = true;
                                                        }
                                                    });
                                                }
                                                if(horario.dia_semana==5){
                                                    isDataVi = true;
                                                    this.horario.viernes[hora.id] = horario.ciclo_curso_id;
                                                    grado.cursos.forEach(curso => {
                                                        if(horario.ciclo_curso_id == curso.id){
                                                            this.horario.coViernes[hora.id] = curso.color;
                                                            isColorVi = true;
                                                        }
                                                    });
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                        });

                        if(!isDataLu){
                            this.horario.lunes[hora.id] = 0;
                        }
                        if(!isDataMa){
                            this.horario.martes[hora.id] = 0;
                        }
                        if(!isDataMi){
                            this.horario.miercoles[hora.id] = 0;
                        }
                        if(!isDataJu){
                            this.horario.jueves[hora.id] = 0;
                        }
                        if(!isDataVi){
                            this.horario.viernes[hora.id] = 0;
                        }

                        if(!isColorLu){
                            this.horario.coLunes[hora.id] = "#fff";
                        }
                        if(!isColorMa){
                            this.horario.coMartes[hora.id] = "#fff";
                        }
                        if(!isColorMi){
                            this.horario.coMiercoles[hora.id] = "#fff";
                        }
                        if(!isColorJu){
                            this.horario.coJueves[hora.id] = "#fff";
                        }
                        if(!isColorVi){
                            this.horario.coViernes[hora.id] = "#fff";
                        }
                    }
                });
            });
        },


        cerrarHorario: function() {
            this.seccionSeleccionada = 0;
            this.turnoSeleccionado = 0;
            this.generarHorario();
        },

        imprimir: function() {
            url = 'reportepdf/horario-seccion/'+this.seccionSeleccionada;
            console.log(url);
            window.open(url, '_blank').focus();
        },




      
    }
}).mount('#app')