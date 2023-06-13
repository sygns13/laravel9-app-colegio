const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Lista de Cursos",
            subtituloHeader: "Docente",
            subtitulo2Header: "Lista de Cursos",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            matriculas: [],
            errors: [],

            ciclo_id: 0,

            verFormulario: false,

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


        }
    },
    created: function() {
/*         this.getDatos(this.thispage);
        console.log("created"); */
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
            var url = 'regetlista-cursos?ciclo_id=' + ciclo_id;

            axios.get(url).then(response => {
                this.registros = response.data;
                this.verFormulario = true;

                if(this.indexNivel != null && this.indexProgramacion != null){
                    console.log("aca");
                    this.edit2(this.indexNivel, this.indexProgramacion);
                }
            })
        },
 
        changeCiclo:function() {
            this.getDatos(this.ciclo_id);
        },
        borrar:function (dato) {

            if(dato.plan_anual == null || dato.plan_anual == ""){
                toastr.error("No se puede eliminar porque No se tiene Plan Anual Registrado", {timeOut: 20000});
            }else{
                swal.fire({
                    title: '¿Estás seguro?',
                    text: "Desea Eliminar el Plan Anual del Curso",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Confirmar'
                }).then((result) => {
                    if (result.value) {
                        this.delete(dato);
                    }
                }).catch(swal.noop);
            }
        },
        delete:function (dato) {
            var url = 'regetlista-cursos/'+dato.id;
            axios.delete(url).then(response=>{//eliminamos

                if(response.data.result=='1'){
                    this.getDatos(this.ciclo_id);
                    toastr.success(response.data.msj, {timeOut: 20000});//mostramos mensaje
                }else{
                    // $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            });
        },

        edit:function (dato) {

            this.fillobject = dato;
            this.archivo=null;
            this.uploadReady = false
            $("#modalFormulario").modal('show');

            this.$nextTick(() => {
                this.uploadReady = true;
                $('#archivo2').focus();
            });

        },

        getArchivo:function (event){
            //Asignamos la imagen a  nuestra data

            if (!event.target.files.length)
            {
              this.archivo=null;
            }
            else{
            this.archivo = event.target.files[0];
            }
        },

        procesar:function () {

            if(this.archivo == null || this.archivo == ""){
                toastr.error("Adjunte el Plan Anual del Curso", {timeOut: 20000});
            }else{
                swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Desea Confirmar el Registro/Actualización del Plan Anual?",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Confirmar'
                }).then((result) => {

                    if (result.value) {
                        console.log("aqui llega");
                        this.update();
                    }

                }).catch(swal.noop);
            }
        },

        procesar:function () {
            var url='regetlista-cursos/'+this.fillobject.id;
            $("#btnGuardar").attr('disabled', true);
            $("#btnClose").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('archivo', this.archivo);

            data.append('_method', 'PUT');

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

            axios.post(url,data,config).then(response=>{

                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarForm();
                    this.getDatos(this.ciclo_id);
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                    /* Swal.fire(
                        'Exito',
                        response.data.msj,
                        'success'
                      ) */
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
            })
        },

        cerrarForm: function () {
            $("#modalFormulario").modal('hide');
        },

        /*
        detalles:function(registro, nivel) {

            var url = 'regetlista-alumnos-asignacion?id=' + registro.id;
            this.headerLista = registro;
            this.nivel = nivel;

            axios.get(url).then(response => {
                this.matriculas = response.data;
                $("#modalFormulario").modal('show');
            })
            
        },
        cerrarForm: function () {
            $("#modalFormulario").modal('hide');
        },


        imprimirNomina:function () {
            //console.log("imprimirMatricula");
            url = 'reportepdf/nomina-matricula/'+this.seccionSeleccionada;
            console.log(url);
            window.open(url, '_blank').focus();
        }, */

        edit2:function (indexN, indexP) {

            this.indexNivel = indexN;
            this.indexProgramacion = indexP;

            this.fillobject = this.registros.niveles[indexN].listaGeneral[indexP];
            this.$nextTick(() => {
                this.programar = true;
                $("#modalFormularioProgramar").modal('show');
            });

        },

        programarCalificacion:function (dato, type) {

            this.fecha = null;
            this.hora = null;
            this.type = type;
            this.labelProgramar = '';

            this.fillIndicador = dato;

            if(this.registros.ciclo.opcion == 1){
                this.labelProgramar = 'Primer Trimestre';
            }
            if(this.registros.ciclo.opcion == 2){
                this.labelProgramar = 'Primer Bimestre';
            }

            switch (type) {
                case 1:
                    this.fecha = this.fillIndicador.fecha_programada1;
                    this.hora = this.fillIndicador.hora_programada1;
                break;
                case 2:
                    this.fecha = this.fillIndicador.fecha_programada2;
                    this.hora = this.fillIndicador.hora_programada2;
                break;
                case 3:
                    this.fecha = this.fillIndicador.fecha_programada3;
                    this.hora = this.fillIndicador.hora_programada3;
                break;
                case 4:
                    this.fecha = this.fillIndicador.fecha_programada4;
                    this.hora = this.fillIndicador.hora_programada4;
                break;
            
                default:
                    this.fecha = null;
                    this.hora = null;
                break;
            }

            this.$nextTick(() => {
                this.programar = true;
                $("#modalProgramar").modal('show');
                console.log("mensaje");
            });


        },

        cerrarFormP: function () {
            $("#modalProgramar").modal('hide');
        },

        procesarProgramacion:function () {

            if(this.fecha == null || this.fecha == ""){
                toastr.error("Ingrese la fecha de Programación", {timeOut: 20000});
            }else{
                if(this.hora == null || this.hora == ""){
                    toastr.error("Ingrese la hora de Programación", {timeOut: 20000});
                } else {
                    swal.fire({
                        title: '¿Estás seguro?',
                        text: "¿Desea Confirmar la Programación de la Fecha de Calificación Ingresada?",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Confirmar'
                    }).then((result) => {
    
                        if (result.value) {
                            console.log("aqui llega");
                            this.upsertFecha();
                        }
    
                    }).catch(swal.noop);
                }
            }
        },

        upsertFecha:function () {
            var url='regfecha-calificacion';
            $("#btnGuardarP").attr('disabled', true);
            $("#btnCloseP").attr('disabled', true);
            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('fecha', this.fecha);
            data.append('hora', this.hora);
            data.append('type', this.type);
            data.append('indicator', this.fillIndicador.id);

            axios.post(url,data).then(response=>{

                $("#btnGuardarP").removeAttr("disabled");
                $("#btnCloseP").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    $("#modalFormularioProgramar").modal('hide');
                    this.cerrarFormP();
                    this.cerrarForm();
                    this.getDatos(this.ciclo_id);
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                    /* Swal.fire(
                        'Exito',
                        response.data.msj,
                        'success'
                      ) */
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnGuardarP").removeAttr("disabled");
                $("#btnCloseP").removeAttr("disabled");
            })
        },

      
    }
}).mount('#app')