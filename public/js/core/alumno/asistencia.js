const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Asistencia",
            subtituloHeader: "Alumno",
            subtitulo2Header: "Asistencia",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            matriculas: [],
            errors: [],

            ciclo_id: 0,

            registro: {},
            data: {},
            headerLista: {},
            //nivel: {},

            fillobject: {},

            labelBtnSave: "Registrar",

            archivo : null,
            uploadReady: true,

            programar: false,

            fecha: null,
            hora: null,

            fillIndicador: {},
            labelProgramar: '',
            type: null,

            indexNivel: null,
            indexProgramacion: null,

            verTabla: false,

            gestionCalificacion: false,

            verTablaZero: false,

            keyCurso_bk: null,
            alumnoCurso: {},

            turnos:[],
            turnoSeleccionado: 0,
            horas:[],

            horario:{
                'lunes': [],
                'martes': [],
                'miercoles': [],
                'jueves': [],
                'viernes': [],
            },



        }
    },
    created: function() {
        this.getDatosZero(this.thispage);
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
        },
        registrosFilters: function() {

            if (!this.data) {
                return {};
            }

            var newRegistros = this.data;

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
        getDatosZero: function() {
            var url = 'get-horario';

            axios.get(url).then(response => {
                this.registro = response.data.data;
                this.verTablaZero = true;

            })
        },
        getDatos: function() {
            var url = 'get-asistencia?ciclo_id=' + this.fecha;

            axios.get(url).then(response => {
                this.data = response.data.data;
                this.turnos = response.data.turnos;
                this.horas = response.data.horas;
                this.verTabla = true;

                this.generarHorario();

            })
        },

        changeFecha:function() {
            if(this.fecha != null && this.fecha !=''){
                this.verTabla = false;
                this.getDatos();
            }else{
                this.verTabla = false;
            }
        },

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
                    if(turno.id==hora.turno_id && turno.id== this.data.cicloSeccion.turno_id){

                        let isDataLu = false;
                        let isDataMa = false;
                        let isDataMi = false;
                        let isDataJu = false;
                        let isDataVi = false;



                        this.data.horarios.forEach(horario => {
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

        imprimir: function() {
            url = 'reportepdf/asistencia-sesiones-alumno/'+this.data.ciclo_escolar_id + '/' + this.fecha + '/' + this.registro.alumno_id;
            console.log(url);
            window.open(url, '_blank').focus();
        },


      
    }
}).mount('#app')