const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Reporte de Asistencia por Secciones",
            subtituloHeader: "Reporte Académico",
            subtitulo2Header: "Reporte de Asistencia por Secciones",

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

            fecha: '',
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
        registrosFilters: function() {

            if (!this.registros) {
                return {};
            }

            var newRegistros = this.registros;

            if (newRegistros.dia1 != null && newRegistros.dia1.length == 10) {
                newRegistros.dia1_ok = newRegistros.dia1.slice(-2) + '/' + newRegistros.dia1.slice(-5, -3) + '/' + newRegistros.dia1.slice(0, 4);
            } else {
                newRegistros.dia1_ok = '';
            }

            if (newRegistros.dia2 != null && newRegistros.dia2.length == 10) {
                newRegistros.dia2_ok = newRegistros.dia2.slice(-2) + '/' + newRegistros.dia2.slice(-5, -3) + '/' + newRegistros.dia2.slice(0, 4);
            } else {
                newRegistros.dia2_ok = '';
            }

            if (newRegistros.dia3 != null && newRegistros.dia3.length == 10) {
                newRegistros.dia3_ok = newRegistros.dia3.slice(-2) + '/' + newRegistros.dia3.slice(-5, -3) + '/' + newRegistros.dia3.slice(0, 4);
            } else {
                newRegistros.dia3_ok = '';
            }

            if (newRegistros.dia4 != null && newRegistros.dia4.length == 10) {
                newRegistros.dia4_ok = newRegistros.dia4.slice(-2) + '/' + newRegistros.dia4.slice(-5, -3) + '/' + newRegistros.dia4.slice(0, 4);
            } else {
                newRegistros.dia4_ok = '';
            }

            if (newRegistros.dia5 != null && newRegistros.dia5.length == 10) {
                newRegistros.dia5_ok = newRegistros.dia5.slice(-2) + '/' + newRegistros.dia5.slice(-5, -3) + '/' + newRegistros.dia5.slice(0, 4);
            } else {
                newRegistros.dia5_ok = '';
            }

            return newRegistros;
        }
    },
    methods: {
        getDatos: function(ciclo_id, fecha) {
            
            var url = 'asistenciasesiongetapo?ciclo_id=' + ciclo_id + '&fecha=' + fecha;

            axios.get(url).then(response => {

                this.registros = response.data.registros;
                this.turnos = response.data.turnos;
                this.horas = response.data.horas;

                this.verFormulario = true;

                this.generarHorario();

            })
        },

        changeCiclo:function() {
            if(this.ciclo_id != 0 && this.fecha != null && this.fecha !=''){
                this.verFormulario = false;
                this.getDatos(this.ciclo_id, this.fecha);
            }else{
                this.verFormulario = false;
            }
        },

        cambioSeccion: function() {

            this.registros.niveles.forEach(nivel => {
                nivel.grados.forEach(grado => {
                    grado.seccions.forEach(seccion => {
                        if(seccion.id==this.seccionSeleccionada){
                            this.turnoSeleccionado = seccion.turno_id;
                            console.log("turnoSeleccionado");
                            console.log(this.turnoSeleccionado);
                            this.generarHorario();
                        }
                    });
                });
            });   
        },

        /* cambioTurno: function() {
            this.generarHorario();
        }, */

        generarHorario: function() {

            this.horario = {
                'lunes': [],
                'martes': [],
                'miercoles': [],
                'jueves': [],
                'viernes': [],
            };

            this.turnos.forEach(turno => {
                this.horas.forEach(hora => {
                    if(turno.id==hora.turno_id && turno.id==this.turnoSeleccionado){

                        let isDataLu = false;
                        let isDataMa = false;
                        let isDataMi = false;
                        let isDataJu = false;
                        let isDataVi = false;

                        this.registros.niveles.forEach(nivel => {
                            nivel.grados.forEach(grado => {
                                grado.seccions.forEach(seccion => {
                                    if(seccion.id==this.seccionSeleccionada){
                                        seccion.horarios.forEach(horario => {
                                            if(hora.id == horario.hora_id){
                                                if(horario.dia_semana==1){
                                                    isDataLu = true;
                                                    this.horario.lunes[hora.id] = horario;
                                                }
                                                if(horario.dia_semana==2){
                                                    isDataMa = true;
                                                    this.horario.martes[hora.id] = horario;
                                                }
                                                if(horario.dia_semana==3){
                                                    isDataMi = true;
                                                    this.horario.miercoles[hora.id] = horario;
                                                }
                                                if(horario.dia_semana==4){
                                                    isDataJu = true;
                                                    this.horario.jueves[hora.id] = horario;
                                                }
                                                if(horario.dia_semana==5){
                                                    isDataVi = true;
                                                    this.horario.viernes[hora.id] = horario;
                                                }
                                            }
                                        });
                                    }
                                });
                            });
                        });

                        if(!isDataLu){
                            this.horario.lunes[hora.id] = null;
                        }
                        if(!isDataMa){
                            this.horario.martes[hora.id] = null;
                        }
                        if(!isDataMi){
                            this.horario.miercoles[hora.id] = null;
                        }
                        if(!isDataJu){
                            this.horario.jueves[hora.id] = null;
                        }
                        if(!isDataVi){
                            this.horario.viernes[hora.id] = null;
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
            url = 'reportepdf/asistencia-sesiones/'+this.seccionSeleccionada + '/' + this.fecha;
            console.log(url);
            window.open(url, '_blank').focus();
        },




      
    }
}).mount('#app')