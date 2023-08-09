const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Gestión de Matrícula Masiva",
            subtituloHeader: "Gestión Académica",
            subtitulo2Header: "Gestión de Matrícula Masiva",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            registros2: [],
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
            divFormularioAlumno: false,
            divFormularioCabecera: false,

            mostrarPalenIni: true,

            thispage: '1',
            divprincipal: false,


            secciones:[],
            
            fillobject:{
                nivel: 0,
                grado: 0,
                seccion: 0,
                responsable_matricula_nombres:'',
                fecha:'',
            },
            
            primeraParte: true,
            segundaParte: false,
            terceraParte: false,
            selectAlumnos:[],

            fillobjectRepitente:{
                nivel: 0,
                grado: 0,
                seccion: 0,
                nombre_nivel: '',
                nombre_grado: '',
                nombre_seccion: '',
            },

            fillobjectPromovido:{
                nivel: 0,
                grado: 0,
                seccion: 0,
                nombre_nivel: '',
                nombre_grado: '',
                nombre_seccion: '',
            },

            isQuintoSecundariaBefore: false,


        }
    },
    created: function() {
        //this.getDatos(this.thispage);
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
        changeNivel: function () {
            this.fillobject.seccion = 0;
            this.fillobject.grado = 0;
        },
        changeGrado: function () {
            this.fillobject.seccion = 0;
        },

        cancelar: function(){
            this.fillobject = {
                nivel: 0,
                grado: 0,
                seccion: 0,
                responsable_matricula_nombres:'',
                fecha:'',
            };
        },

        buscarMasiva: function(){
            this.getDatos();
        },



        getDatos: function() {
            var url = 'rematricula-masiva/buscar';

            axios.post(url, this.fillobject).then(response=>{

                if(response.data.result=='1'){
                    this.primeraParte = false;
                    this.segundaParte = true;
                    this.errors=[];
                    this.registros = response.data.registros;
                    this.registros2 = [];
                    this.selectAlumnos = [];

                    if(response.data.dataCabecera != null){
                        if(response.data.dataCabecera.nivel_R != undefined && response.data.dataCabecera.nivel_R != null){
                            this.fillobjectRepitente.nivel = response.data.dataCabecera.nivel_R.id;
                            this.fillobjectRepitente.nombre_nivel = response.data.dataCabecera.nivel_R.nombre;
                        }
                        if(response.data.dataCabecera.grado_R != undefined && response.data.dataCabecera.grado_R != null){
                            this.fillobjectRepitente.grado = response.data.dataCabecera.grado_R.id;
                            this.fillobjectRepitente.nombre_grado = response.data.dataCabecera.grado_R.nombre;
                        }
                        if(response.data.dataCabecera.seccion_R != undefined && response.data.dataCabecera.seccion_R != null){
                            this.fillobjectRepitente.seccion = response.data.dataCabecera.seccion_R.id;
                            this.fillobjectRepitente.nombre_seccion = response.data.dataCabecera.seccion_R.nombre;
                        }

                        if(response.data.dataCabecera.nivel_P != undefined && response.data.dataCabecera.nivel_P != null){
                            this.fillobjectPromovido.nivel = response.data.dataCabecera.nivel_P.id;
                            this.fillobjectPromovido.nombre_nivel = response.data.dataCabecera.nivel_P.nombre;
                        }
                        if(response.data.dataCabecera.grado_P != undefined && response.data.dataCabecera.grado_P != null){
                            this.fillobjectPromovido.grado = response.data.dataCabecera.grado_P.id;
                            this.fillobjectPromovido.nombre_grado = response.data.dataCabecera.grado_P.nombre;
                        }
                        if(response.data.dataCabecera.seccion_P != undefined && response.data.dataCabecera.seccion_P != null){
                            this.fillobjectPromovido.seccion = response.data.dataCabecera.seccion_P.id;
                            this.fillobjectPromovido.nombre_seccion = response.data.dataCabecera.seccion_P.nombre;
                        }

                        this.isQuintoSecundariaBefore = response.data.dataCabecera.isQuintoSecundariaBefore;
                    }
                    
                    //toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                    this.registros = [];
                    this.registros2 = [];
                    this.selectAlumnos = [];
                }
            }).catch(error=>{
                console.log(error);
                this.registros = [];
                this.selectAlumnos = [];
                this.registros2 = [];
                //this.errors=error.response.data;
            })
        },

        cancelMasiva: function(){
            //this.cancelar();
            this.primeraParte = true;
            this.segundaParte = false;
            this.registros = [];
            this.registros2 = [];
            this.selectAlumnos = [];
        },

        selectAll: function(){
            this.registros2 = [];
            this.selectAlumnos = [];

            this.registros.forEach(registro => {
                this.selectAlumnos.push(registro.id);
                this.registros2.push(registro);
            });
        },

        RemoveAll: function(){
            this.registros2 = [];
            this.selectAlumnos = [];
        },

        remove: function(index){
            this.registros2.splice(index, 1);
            this.selectAlumnos.splice(index, 1); 
        },

        select: function(){
            //let include = selectAlumnos.includes(id);
            this.registros2 = [];
            let include = false;

            this.registros.forEach(registro => {
                include = this.selectAlumnos.includes(registro.id);
                if(include){
                    this.registros2.push(registro);
                }
            });
        },

        procesarMatricula:function () {
            
            //Validaciones Front
            if(this.registros2.length == 0){
                toastr.error('Seleccione por lo menos un alumno para efectuar la matrícula');
                return;
            }

            let quintoValidate = false;

            if(this.isQuintoSecundariaBefore){
                this.registros2.forEach(registro => {
                    if(registro.estado_grado == 2){
                        quintoValidate = true;
                    }
                });
            }

            if(quintoValidate){
                toastr.error('No se pueden Promoveer Alumnos que finalizaron el quinto de secundaria');
                return;
            }

            this.confirmarMatricular();

        },

        confirmarMatricular:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "¿Desea Confirmar el Procesamiento de la Matrícula Masiva?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    console.log("aqui llega");
                    this.Matricular();
                }

            }).catch(swal.noop);
        },

        Matricular:function () {
            var url='rematricula-masiva/store';
            $("#btnSaveMatricula").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('cabecera', JSON.stringify(this.fillobject));
            data.append('registros', JSON.stringify(this.registros2));
            data.append('dataRepetir', JSON.stringify(this.fillobjectRepitente));
            data.append('dataPromover', JSON.stringify(this.fillobjectPromovido));


            axios.post(url, data).then(response=>{

                $("#btnSaveMatricula").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.primeraParte = false;
                    this.segundaParte = false;
                    this.terceraParte = true;
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error('Se tuvo un error en el proceso, comunicarse con el Administrador', {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnSaveMatricula").removeAttr("disabled");
                toastr.error('Se tuvo un error en el proceso, comunicarse con el Administrador', {timeOut: 20000});
            })
        },

        cancelFinal:function () {

            this.terceraParte = false;
            this.cancelMasiva();


            this.fillobjectRepitente = {
                nivel: 0,
                grado: 0,
                seccion: 0,
                nombre_nivel: '',
                nombre_grado: '',
                nombre_seccion: '',
            };

            this.fillobjectPromovido = {
                nivel: 0,
                grado: 0,
                seccion: 0,
                nombre_nivel: '',
                nombre_grado: '',
                nombre_seccion: '',
            };

            this.fillobject = {
                nivel: 0,
                grado: 0,
                seccion: 0,
                responsable_matricula_nombres:'',
                fecha:'',
            };

            this.isQuintoSecundariaBefore = false;

        },




        consultarMatricula:function (registro) {
            //console.log("imprimirMatricula");
            url = 'reportepdf/ficha-matricula/'+registro.id;
            console.log(url);
            window.open(url, '_blank').focus();
        },







      
    }
}).mount('#app')