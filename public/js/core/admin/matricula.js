const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Registro de Matrículas",
            subtituloHeader: "Gestión Académica",
            subtitulo2Header: "Registro de Matrículas",

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

            labelBtnSaveAlumno: 'Registrar',
            labelBtnSave: 'Registrar Matrícula',

            seccionSeleccionada: 0,

            tipoDocumentos: [],

            alumno:{
                'type':'C',
                'id' : '',
                'tipo_documento_id' : '1',
                'num_documento' : '',
                'apellido_paterno' : '',
                'apellido_materno' : '',
                'nombres' : '',
                'fecha_nacimiento' : '',
                'genero' : 'M',
                'grado_actual' : 0,
                'nivel_actual' : 0,
                'telefono' : '',
                'direccion' : '',
                'correo' : '',
                'pais' : '',
                'sigla_pais' : '',
                'departamento' : '',
                'provincia' : '',
                'distrito' : '',
                'lugar' : '',
                'lengua_materna' : '',
                'segunda_lengua' : '',
                'num_hermanos' : '',
                'lugar_hermano' : '',
                'religion' : '',
                'DI' : '',
                'DA' : '',
                'DV' : '',
                'DM' : '',
                'SC' : '',
                'OT' : '',
                'nacimiento' : 0,
                'nacimiento_registrado' : 1,
                'obs_nacimiento' : '',
                'levanto_cabeza' : '',
                'se_sento' : '',
                'se_paro' : '',
                'se_camino' : '',
                'se_control_esfinter' : '',
                'se_primeras_palabras' : '',
                'se_hablo_fluido' : '',
                'activo' : '1',
                'tipoDocumento':{},
                'apoderados':[],
                'traslados':[],
                'situacionLaborals':{},
                'registroSalud':{},
                'controles':[],
                'domicilios':[],
                'pais_id': 1,
                'departamento_id': 2,
                'provincia_id': 8,
                'distrito_id': 86,
            },

            apoderadoMadre: {
                'id': '',
                'apellido_materno': '',
                'apellido_paterno': '',
                'nombres': '',
                'vive': 1,
                'fecha_nacimiento': '',
                'grado_instruccion': '',
                'ocupacion': '',
                'vive_con_estudiante': 1,
                'religion': '',
                'tipo_apoderado': 'Madre',
                'tipo_documento_id': 1,
                'alumno_id': 0,
                'num_documento': '',
                'telefono': '',
                'direccion': '',
                'correo': '',
                'tipo_apoderado_id': 1,
                'principal': 1,
                'activo': 1,

            },

            apoderadoPadre: {
                'id': '',
                'apellido_materno': '',
                'apellido_paterno': '',
                'nombres': '',
                'vive': 1,
                'fecha_nacimiento': '',
                'grado_instruccion': '',
                'ocupacion': '',
                'vive_con_estudiante': 1,
                'religion': '',
                'tipo_apoderado': 'Padre',
                'tipo_documento_id': 1,
                'alumno_id': 0,
                'num_documento': '',
                'telefono': '',
                'direccion': '',
                'correo': '',
                'tipo_apoderado_id': 2,
                'principal': 0,
                'activo': 1,

            },

            apoderadoOtro: {
                'id': '',
                'apellido_materno': '',
                'apellido_paterno': '',
                'nombres': '',
                'vive': 0,
                'fecha_nacimiento': '',
                'grado_instruccion': '',
                'ocupacion': '',
                'vive_con_estudiante': 0,
                'religion': '',
                'tipo_apoderado': '',
                'tipo_documento_id': 1,
                'alumno_id': 0,
                'num_documento': '',
                'telefono': '',
                'direccion': '',
                'correo': '',
                'tipo_apoderado_id': 3,
                'principal': 0,
                'activo': 1,

            },

            tipoDocSelect: {
                'id': '',
                'nombre': 'Documento',
                'sigla': '',
                'digitos': '0',
            },

            tipoDocSelectM: {
                'id': '',
                'nombre': 'Documento',
                'sigla': '',
                'digitos': '0',
            },

            tipoDocSelectP: {
                'id': '',
                'nombre': 'Documento',
                'sigla': '',
                'digitos': '0',
            },

            tipoDocSelectO: {
                'id': '',
                'nombre': 'Documento',
                'sigla': '',
                'digitos': '0',
            },

            turnos:[],
            turnoSeleccionado: 0,
            horas:[],

            divFormularioAlumno: false,

            stepper: null,
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
        changeTipoDoc: function() {
            this.tipoDocumentos.forEach((element) => {
                if(element.id == this.alumno.tipo_documento_id){
                    this.tipoDocSelect = element;
                }
            });
            this.alumno.num_documento = '';
        },
        changeTipoDocM: function() {
            this.tipoDocumentos.forEach((element) => {
                if(element.id == this.apoderadoMadre.tipo_documento_id){
                    this.tipoDocSelectM = element;
                }
            });
            this.apoderadoMadre.num_documento = '';
        },
        changeTipoDocP: function() {
            this.tipoDocumentos.forEach((element) => {
                if(element.id == this.apoderadoPadre.tipo_documento_id){
                    this.tipoDocSelectP = element;
                }
            });
            this.apoderadoPadre.num_documento = '';
        },
        changeTipoDocO: function() {
            this.tipoDocumentos.forEach((element) => {
                if(element.id == this.apoderadoOtro.tipo_documento_id){
                    this.tipoDocSelectO = element;
                }
            });
            this.apoderadoOtro.num_documento = '';
        },
        getDatos: function(page) {
            var busca = this.buscar;
            var url = 'rematricula?page=' + page + '&busca=' + busca;

            axios.get(url).then(response => {
                this.tipoDocumentos= response.data;
                this.changeTipoDoc();
                this.changeTipoDocM();
                this.changeTipoDocP();
                this.changeTipoDocO();
            })
        },

        buscarAlumno: function() {
            
            if(this.alumno.num_documento.trim() == ''){
                toastr.error('Ingrese un número de documento');
                return;
            }
            var url = 'realumnobuscar/buscar/' + this.alumno.tipo_documento_id + '/' + this.alumno.num_documento;

            axios.get(url).then(response => {
                if(response.data.result=='1'){

                    if(response.data.resultFound){
                        this.alumno = response.data.alumno;
                        this.errors=[];
                        toastr.success(response.data.msj);
                    }else{
                        //toastr.info("Alumno no encontrado en el sistema, ¿Desea registrarlo?");
                        this.confirmRegistrar();
                    }
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj);
                }
            })
        },

        confirmRegistrar:function () {
            swal.fire({
                title: 'Alumno no encontrado',
                text: "¿Desea Registrar al Nuevo Alumno?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Registrar'
            }).then((result) => {

                if (result.value) {
                    console.log("aqui llega");
                    this.nuevoAlumno();
                }

            }).catch(swal.noop);
        },

        nuevoAlumno:function () {
            this.cancelFormAlumno();
            this.labelBtnSave = 'Registrar';
            this.alumno.type = 'C';

            this.divFormularioAlumno=true;

            this.$nextTick(() => {
                $('#txtapellido_paterno').focus();
                this.stepper = new Stepper(document.querySelector('.bs-stepper'));
            });
        },
        cerrarFormAlumno: function () {
            this.divFormularioAlumno=false;
            this.cancelFormAlumno();
        },
        cancelFormAlumno: function () {
            this.alumno = {
                'type':'C',
                'id' : '',
                'tipo_documento_id' : this.alumno.tipo_documento_id,
                'num_documento' : this.alumno.num_documento,
                'apellido_paterno' : '',
                'apellido_materno' : '',
                'nombres' : '',
                'fecha_nacimiento' : '',
                'genero' : 'M',
                'grado_actual' : 0,
                'nivel_actual' : 0,
                'telefono' : '',
                'direccion' : '',
                'correo' : '',
                'pais' : '',
                'sigla_pais' : '',
                'departamento' : '',
                'provincia' : '',
                'distrito' : '',
                'lugar' : '',
                'lengua_materna' : '',
                'nacimiento_registrado' : 1,
                'segunda_lengua' : '',
                'num_hermanos' : '',
                'lugar_hermano' : '',
                'religion' : '',
                'DI' : '',
                'DA' : '',
                'DV' : '',
                'DM' : '',
                'SC' : '',
                'OT' : '',
                'nacimiento' : 0,
                'obs_nacimiento' : '',
                'levanto_cabeza' : '',
                'se_sento' : '',
                'se_paro' : '',
                'se_camino' : '',
                'se_control_esfinter' : '',
                'se_primeras_palabras' : '',
                'se_hablo_fluido' : '',
                'activo' : '1',
                'tipoDocumento':{},
                'apoderados':[],
                'traslados':[],
                'situacionLaborals':{},
                'registroSalud':{},
                'controles':[],
                'domicilios':[],
                'pais_id': 1,
                'departamento_id': 2,
                'provincia_id': 8,
                'distrito_id': 86,
            };

            this.apoderadoMadre = {
                'id': '',
                'apellido_materno': '',
                'apellido_paterno': '',
                'nombres': '',
                'vive': 1,
                'fecha_nacimiento': '',
                'grado_instruccion': '',
                'ocupacion': '',
                'vive_con_estudiante': 1,
                'religion': '',
                'tipo_apoderado': 'Madre',
                'tipo_documento_id': 1,
                'alumno_id': 0,
                'num_documento': '',
                'telefono': '',
                'direccion': '',
                'correo': '',
                'tipo_apoderado_id': 1,
                'principal': 1,
                'activo': 1,

            };
            
            this.apoderadoPadre = {
                'id': '',
                'apellido_materno': '',
                'apellido_paterno': '',
                'nombres': '',
                'vive': 1,
                'fecha_nacimiento': '',
                'grado_instruccion': '',
                'ocupacion': '',
                'vive_con_estudiante': 1,
                'religion': '',
                'tipo_apoderado': 'Padre',
                'tipo_documento_id': 1,
                'alumno_id': 0,
                'num_documento': '',
                'telefono': '',
                'direccion': '',
                'correo': '',
                'tipo_apoderado_id': 2,
                'principal': 0,
                'activo': 1,

            };

            this.apoderadoOtro = {
                'id': '',
                'apellido_materno': '',
                'apellido_paterno': '',
                'nombres': '',
                'vive': 0,
                'fecha_nacimiento': '',
                'grado_instruccion': '',
                'ocupacion': '',
                'vive_con_estudiante': 0,
                'religion': '',
                'tipo_apoderado': '',
                'tipo_documento_id': 1,
                'alumno_id': 0,
                'num_documento': '',
                'telefono': '',
                'direccion': '',
                'correo': '',
                'tipo_apoderado_id': 3,
                'principal': 0,
                'activo': 1,

            };

            this.$nextTick(() => {
                $('#txtapellido_paterno').focus();
                $("#checkboxMadreVive").prop("checked", true);
                $("#checkboxMadreViveAlumno").prop("checked", true);
                $("#checkboxMadreApodPrincipal").prop("checked", true);

                $("#checkboxPadreVive").prop("checked", true);
                $("#checkboxPadreViveAlumno").prop("checked", true);
            });
        },

        siguienteNuevoAlumno: function () {
            this.stepper.next();
        },

        atrasNuevoAlumno: function () {
            this.stepper.previous();
        },

        changePais: function () {
            this.alumno.departamento_id = 0;
            this.alumno.provincia_id = 0;
            this.alumno.distrito_id = 0;
        },

        changeDep: function () {
            this.alumno.provincia_id = 0;
            this.alumno.distrito_id = 0;
        },

        changeProv: function () {
            this.alumno.distrito_id = 0;
        },

        changeNivel: function () {
            this.alumno.grado_actual = 0;
        },

        selectApoPrincipalMadre: function () {
            this.apoderadoPadre.principal = 0;
            this.apoderadoOtro.principal = 0;
        },

        selectApoPrincipalPadre: function () {
            this.apoderadoMadre.principal = 0;
            this.apoderadoOtro.principal = 0;
        },

        selectApoPrincipalOtro: function () {
            this.apoderadoMadre.principal = 0;
            this.apoderadoPadre.principal = 0;
        },

        procesarAlumno: function() {
            this.confirmRegistrarAlumno();
        },

        confirmRegistrarAlumno:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "¿Desea Confirmar el Registro del Alumno?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    console.log("aqui llega");
                    this.createAlumno();
                }

            }).catch(swal.noop);
        },
        createAlumno:function () {
            var url='remalumno';
            $("#btnSave").attr('disabled', true);
            $("#btnCerrarL").attr('disabled', true);
            this.divloaderNuevo=true;

            axios.post(url, {alumno: this.alumno, apoderadoMadre: this.apoderadoMadre, apoderadoPadre: this.apoderadoPadre , apoderadoOtro: this.apoderadoOtro}).then(response=>{

                $("#btnSave").removeAttr("disabled");
                $("#btnCerrarL").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.buscarAlumno(this.thispage);
                    this.errors=[];
                    //this.cerrarForm();
                    toastr.success(response.data.msj);
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj);
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnSave").removeAttr("disabled");
                $("#btnCerrarL").removeAttr("disabled");
            })
        },














        cambioSeccion: function() {

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
                                                    this.horario.lunes[hora.id] = horario.ciclo_curso_id;
                                                }
                                                if(horario.dia_semana==2){
                                                    isDataMa = true;
                                                    this.horario.martes[hora.id] = horario.ciclo_curso_id;
                                                }
                                                if(horario.dia_semana==3){
                                                    isDataMi = true;
                                                    this.horario.miercoles[hora.id] = horario.ciclo_curso_id;
                                                }
                                                if(horario.dia_semana==4){
                                                    isDataJu = true;
                                                    this.horario.jueves[hora.id] = horario.ciclo_curso_id;
                                                }
                                                if(horario.dia_semana==5){
                                                    isDataVi = true;
                                                    this.horario.viernes[hora.id] = horario.ciclo_curso_id;
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
                    }
                });
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getDatos(page);
            this.thispage = page;
        },

        cerrarHorario: function() {
            this.seccionSeleccionada = 0;
            this.turnoSeleccionado = 0;
            this.generarHorario();
        },
        
       





      
    }
}).mount('#app')