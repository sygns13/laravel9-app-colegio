const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Horario",
            subtituloHeader: "Alumno",
            subtitulo2Header: "Horario",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            matriculas: [],
            errors: [],

            ciclo_id: 0,

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
            var url = 'get-horario';

            axios.get(url).then(response => {
                this.data = response.data.data;
                this.turnos = response.data.turnos;
                this.horas = response.data.horas;
                this.verTabla = true;

                this.generarHorario();

            })
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
                    if(turno.id==hora.turno_id && turno.id==this.data.cicloSeccion.turno_id){

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



                        this.data.horarios.forEach(horario => {
                            if(hora.id == horario.hora_id){
                                if(horario.dia_semana==1){
                                    isDataLu = true;
                                    this.horario.lunes[hora.id] = horario.ciclo_curso_id;
                                    this.data.cursos.forEach(curso => {
                                        if(horario.ciclo_curso_id == curso.id){
                                            this.horario.coLunes[hora.id] = curso.color;
                                            isColorLu = true;
                                        }
                                    });
                                }
                                if(horario.dia_semana==2){
                                    isDataMa = true;
                                    this.horario.martes[hora.id] = horario.ciclo_curso_id;
                                    this.data.cursos.forEach(curso => {
                                        if(horario.ciclo_curso_id == curso.id){
                                            this.horario.coMartes[hora.id] = curso.color;
                                            isColorMa = true;
                                        }
                                    });
                                }
                                if(horario.dia_semana==3){
                                    isDataMi = true;
                                    this.horario.miercoles[hora.id] = horario.ciclo_curso_id;
                                    this.data.cursos.forEach(curso => {
                                        if(horario.ciclo_curso_id == curso.id){
                                            this.horario.coMiercoles[hora.id] = curso.color;
                                            isColorMi = true;
                                        }
                                    });
                                }
                                if(horario.dia_semana==4){
                                    isDataJu = true;
                                    this.horario.jueves[hora.id] = horario.ciclo_curso_id;
                                    this.data.cursos.forEach(curso => {
                                        if(horario.ciclo_curso_id == curso.id){
                                            this.horario.coJueves[hora.id] = curso.color;
                                            isColorJu = true;
                                        }
                                    });
                                }
                                if(horario.dia_semana==5){
                                    isDataVi = true;
                                    this.horario.viernes[hora.id] = horario.ciclo_curso_id;
                                    this.data.cursos.forEach(curso => {
                                        if(horario.ciclo_curso_id == curso.id){
                                            this.horario.coViernes[hora.id] = curso.color;
                                            isColorVi = true;
                                        }
                                    });
                                }
                            }
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


        imprimir: function() {
            url = 'reportepdf/horario-seccion/'+this.data.cicloSeccion.id;
            console.log(url);
            window.open(url, '_blank').focus();
        },





      
    }
}).mount('#app')