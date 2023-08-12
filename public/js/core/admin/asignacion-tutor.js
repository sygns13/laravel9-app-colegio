const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Asignación de Tutores",
            subtituloHeader: "Gestión Académica",
            subtitulo2Header: "Asignación de Tutores",

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

            labelBtnSave: 'Asignar Tutor',

            seccionSeleccionada: 0,

            seccionSelect: {},

            fillobject: {
                'type':'C',
                'id': '',
                'ciclo_seccion_id': '',
                'tutor_id': '',
                'activo': '1'
            },

            seccionlbl: '',
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
        getDatos: function(page) {
            var busca = this.buscar;
            var url = 'get-asignacion-tutor?page=' + page + '&busca=' + busca;

            axios.get(url).then(response => {
                this.registros = response.data.registros;
                this.cambioSeccion();
            })
        },

        cambioSeccion: function() {

            this.registros.niveles.forEach(nivel => {
                nivel.grados.forEach(grado => {
                    grado.seccions.forEach(seccion => {
                        if(seccion.id==this.seccionSeleccionada){
                            this.seccionSelect = seccion;
                            return;
                        }
                    });
                });
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getDatos(page);
            this.thispage = page;
        },

        cerrarPanel: function() {
            this.seccionSeleccionada = 0;
            //this.generarHorario();
        },

        asignarTutor:function () {
            this.cancelForm();

            if(this.seccionSelect.tutor_id != null){
                this.fillobject.tutor_id = this.seccionSelect.tutor_id;
                this.fillobject.ciclo_seccion_id = this.seccionSelect.id;
                this.labelBtnSave = 'Modificar Asignación de Tutor';
                this.fillobject.type = 'U';
            }
            else{
                this.fillobject.tutor_id = '0';
                this.fillobject.ciclo_seccion_id = this.seccionSelect.id;
                this.labelBtnSave = 'Asignar Tutor';
                this.fillobject.type = 'C';
            }

            this.seccionlbl = this.seccionSelect.nombre;

            $("#modalFormulario").modal('show');
            this.$nextTick(() => {
                $('#cbututor_id').focus();
            });
        },


        cerrarForm: function () {
            $("#modalFormulario").modal('hide');
            this.cancelForm();
        },
        cancelForm: function () {
            this.fillobject = {
                                'type':'C',
                                'ciclo_seccion_id': '',
                                'tutor_id': '',
                                'activo': '1'
                            };

            this.$nextTick(() => {
                $('#cbututor_id').focus();
            });
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
                text: "Desea Confirmar la Asignación del Tutor a la Sección",
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
            var url='reasignacion-tutor';
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
                console.log(error);
                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
            })
        },

        confirmActualizar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Modificación de la Asignación del Tutor a la Sección",
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

            var url="reasignacion-tutor";
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
                console.log(error);
                $("#btnGuardar").removeAttr("disabled");
                $("#btnClose").removeAttr("disabled");
            })
        }, 
        
        borrarAsignacion:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Eliminar el registro de la Asignación del Tutor",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    this.delete();
                }

            }).catch(swal.noop);
        },
        delete:function () {
            var url = 'reasignacion-tutor/'+this.seccionSelect.id;
            axios.delete(url).then(response=>{//eliminamos

                if(response.data.result=='1'){
                    this.getDatos(this.thispage);//listamos
                    toastr.success(response.data.msj, {timeOut: 20000});//mostramos mensaje
                }else{
                    // $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            });
        },
      
    }
}).mount('#app')