const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Registro de Calificaciones de Alumnos",
            subtituloHeader: "Módulo de Control",
            subtitulo2Header: "Registro de Calificaciones de Alumnos",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            alumnos: [],
            curso: {},
            alumnoCurso: {},

            data: {},
            errors: [],

            fillobject: {
                'type':'C',
                'id': '',
                'matricula_id': '',
                'tipo': '1',
                'ciclo_indicador_id': '',
                'ciclo_competencia_id': '',
                'ciclo_curso_id': '1',
                'alumno_id': '',
                'nota_num': '',
                'nota_letra': '',
                'periodo': '',
                'activo': '',
            },

            labelBtnSave: 'Registrar',
            turnoNombre : '',


            divloaderNuevo: false,

            indexRegistro : 0,
            indexNivel : 0,


            tomarCalificacion: false,

            keyNivel_bk: null,
            keyGrado_bk: null,
            keyCurso_bk: null,

            keyAlumno_bk: null,

            gestionCalificacion: false,

            competencianombre: '',
            indicadorNombre: '',
            periodoNombre: '',

        }
    },
    created: function() {
        this.getDatos(this.thispage);
    },
    mounted: function() {
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
            let url = 'renotas';
            axios.get(url).then(response => {
                this.data= response.data;

                if(!this.data.error){
                    if(this.keyNivel_bk != null && this.keyGrado_bk != null  && this.keyCurso_bk != null){ 
                        this.notaCurso(this.keyNivel_bk, this.keyGrado_bk , this.keyCurso_bk);
                    }

                }
            })
        },

        notaCurso: function (keyNivel, keyGrado, keyCurso) {

            this.keyNivel_bk = keyNivel;
            this.keyGrado_bk = keyGrado;
            this.keyCurso_bk = keyCurso;

            let nivel = this.data.niveles[keyNivel];
            let grado = nivel.grados[keyGrado];
            this.curso = grado.cursos[keyCurso];


            if(this.curso.cantAlumnos == 0){

                this.curso = {};
                this.alumnos = {};
                //toastr.error("No puede registrar la asistencia de esta sección, ya que no cuenta con alumnos matriculados");
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'No puede registrar calificaciones en esta sección, ya que no cuenta con alumnos matriculados',
                    confirmButtonText: 'Aceptar',
                  })
                return;
            }
            this.alumnos = this.curso.matriculas;

            this.$nextTick(() => {
                this.tomarCalificacion = true;
                if(this.keyAlumno_bk != null){
                    this.calificacion(this.keyAlumno_bk);
                }
            });
    
        },

        cerrarFormCalificacion: function () {
            this.tomarCalificacion = false;
            this.gestionCalificacion = false;

            this.keyNivel_bk = null;
            this.keyGrado_bk = null;
            this.keyCurso_bk = null;

            this.keyAlumno_bk = null;
            this.cancelForm();
        },
        cancelForm: function () {
            this.labelBtnSave = 'Registrar';

            this.competencianombre = '';
            this.indicadorNombre = '';
            this.periodoNombre = '';

            this.fillobject = {
                'type':'C',
                'id': '',
                'matricula_id': '',
                'tipo': '1',
                'ciclo_indicador_id': '',
                'ciclo_competencia_id': '',
                'ciclo_curso_id': '1',
                'alumno_id': '',
                'nota_num': '',
                'nota_letra': '',
                'periodo': '',
                'activo': '',
            };
        },

        calificacion: function (keyAlumno) {
            this.keyAlumno_bk = keyAlumno;
            this.alumnoCurso = this.alumnos[keyAlumno];

            this.$nextTick(() => {
                this.gestionCalificacion = true;
            });
        },

        cerrarFormCalificaciones: function () {
            this.gestionCalificacion = false;
            this.keyAlumno_bk = null;
            this.alumnoCurso = {};
        },

        nuevo:function (competencia, indicador, periodo, tipoCiclo) {
            this.cancelForm();

            this.fillobject.matricula_id = this.alumnoCurso.id;
            this.fillobject.tipo = '1';
            this.fillobject.ciclo_indicador_id = indicador.id;
            this.fillobject.ciclo_competencia_id = competencia.id;
            this.fillobject.ciclo_curso_id = this.curso.idcurso;
            this.fillobject.alumno_id = this.alumnoCurso.alumno_id;
            this.fillobject.periodo = periodo;
            this.fillobject.activo = 1;

            this.competencianombre = competencia.nombre;
            this.indicadorNombre = indicador.nombre;

            if(tipoCiclo == 1){
                switch (periodo) {
                    case 1:
                        this.periodoNombre = 'Primer Trimestre';
                    break;
                    case 2:
                        this.periodoNombre = 'Segundo Trimestre';
                    break;
                    case 3:
                        this.periodoNombre = 'Tercer Trimestre';
                    break;
                
                    default:
                        this.periodoNombre = "";
                    break;
                } 
            }

            if(tipoCiclo == 2){
                switch (periodo) {
                    case 1:
                        this.periodoNombre = 'Primer Bimestre';
                    break;
                    case 2:
                        this.periodoNombre = 'Segundo Bimestre';
                    break;
                    case 3:
                        this.periodoNombre = 'Tercer Bimestre';
                    break;
                    case 4:
                        this.periodoNombre = 'Cuarto Bimestre';
                    break;
                
                    default:
                        this.periodoNombre = "";
                    break;
                } 
            }
            
            this.fillobject.type = 'C';
            

            $("#modalFormulario").modal('show');
            this.$nextTick(() => {
                $('#txtnota_num').focus();
            });
        },

        edit:function (competencia, indicador, nota, tipoCiclo) {
            this.cancelForm();

            this.fillobject.id = nota.id;
            this.fillobject.matricula_id = nota.matricula_id;
            this.fillobject.tipo = nota.tipo;
            this.fillobject.ciclo_indicador_id = nota.ciclo_indicador_id;
            this.fillobject.ciclo_competencia_id = nota.ciclo_competencia_id;
            this.fillobject.ciclo_curso_id = nota.ciclo_curso_id;
            this.fillobject.alumno_id = nota.alumno_id;
            this.fillobject.nota_num = nota.nota_num;
            this.fillobject.nota_letra = nota.nota_letra;
            this.fillobject.periodo = nota.periodo;
            this.fillobject.activo = nota.activo;

            this.competencianombre = competencia.nombre;
            this.indicadorNombre = indicador.nombre;

            if(tipoCiclo == 1){
                switch (this.fillobject.periodo) {
                    case 1:
                        this.periodoNombre = 'Primer Trimestre';
                    break;
                    case 2:
                        this.periodoNombre = 'Segundo Trimestre';
                    break;
                    case 3:
                        this.periodoNombre = 'Tercer Trimestre';
                    break;
                
                    default:
                        this.periodoNombre = "";
                    break;
                } 
            }

            if(tipoCiclo == 2){
                switch (this.fillobject.periodo) {
                    case 1:
                        this.periodoNombre = 'Primer Bimestre';
                    break;
                    case 2:
                        this.periodoNombre = 'Segundo Bimestre';
                    break;
                    case 3:
                        this.periodoNombre = 'Tercer Bimestre';
                    break;
                    case 4:
                        this.periodoNombre = 'Cuarto Bimestre';
                    break;
                
                    default:
                        this.periodoNombre = "";
                    break;
                } 
            }
            
            this.labelBtnSave = 'Modificar';
            this.fillobject.type = 'U';
            

            $("#modalFormulario").modal('show');
            this.$nextTick(() => {
                $('#txtnota_num').focus();
            });
        },

        cerrarForm: function () {
            /* this.divNuevo=false; */
            $("#modalFormulario").modal('hide');
            this.cancelForm();
        },

        procesar: function() {
            if(this.fillobject.type == 'C'){
                this.confirmRegistrar();
            }
            if(this.fillobject.type == 'U'){
                this.confirmActualizar();
            }
        },

        confirmRegistrar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar el Registro de la Calificación",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.create();
                }

            }).catch(swal.noop);
        },

        create:function () {
            var url='renotas';
            $("#btnGuardar").attr('disabled', true);
            $("#btnClose").attr('disabled', true);
            this.divloaderNuevo=true;

            axios.post(url, this.fillobject).then(response=>{

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
                //this.errors=error.response.data;
                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
            })
        },

        confirmActualizar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Modificación de la Calificación",
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

        update: function () {

            var url="renotas/"+this.fillobject.id;
            $("#btnGuardar").attr("disabled");
            $("#btnClose").attr("disabled");
            this.divloaderEdit=true;

            axios.put(url, this.fillobject).then(response=>{


                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
                this.divloaderEdit=false;
                
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
                //this.errors=error.response.data;
                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
            })
        },  


    }
}).mount('#app')