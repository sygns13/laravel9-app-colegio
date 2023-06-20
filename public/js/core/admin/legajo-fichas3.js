const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Legajo",
            subtituloHeader: "Principal",
            subtitulo2Header: "Legajo",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            errors: [],

            ie: {
                'id': '',
                'codigo_modular': '',
                'nombre': '',
                'gestion': '',
                'sigla_gestion': '',
                'resolucion_creacion': '',
                'forma': '',
                'sigla_forma': '',
                'departamento': '',
                'provincia': '',
                'distrito': '',
                'centro_poblado': '',
                'codigo_ugel': '',
                'nombre_ugel': '',
                'caracteristica': '',
                'sigla_caracteristica': '',
                'programa': '',
                'sigla_programa': '',
                'modalidad': '',
                'modalidad_siglas': '',
                'dirección': '',
                'email': '',
                'telefono': '',
                'genero': '',
                'turno': '',
                'path_mision': '',
                'path_vision': '',
                'niveles': '',
            },
            ieEdit: {
                'id': '',
                'codigo_modular': '',
                'nombre': '',
                'gestion': '',
                'sigla_gestion': '',
                'resolucion_creacion': '',
                'forma': '',
                'sigla_forma': '',
                'departamento': '',
                'provincia': '',
                'distrito': '',
                'centro_poblado': '',
                'codigo_ugel': '',
                'nombre_ugel': '',
                'caracteristica': '',
                'sigla_caracteristica': '',
                'programa': '',
                'sigla_programa': '',
                'modalidad': '',
                'modalidad_siglas': '',
                'dirección': '',
                'email': '',
                'telefono': '',
                'genero': '',
                'turno': '',
                'path_mision': '',
                'path_vision': '',
                'niveles': '',
            },

            alumno: {
            },

            alumnoEdit: {
            },

            user: {
                'id': '',
                'name': '',
                'email': '',
                'profile_photo_path': '',
            },

            userEdit: {
                'id': '',
                'name': '',
                'email': '',
                'profile_photo_path': '',
            },

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

            labelBtnSave: 'Actualizar',

            imagen : null,
            uploadReady: true,

            verAlumno: false,
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
            
            var url = 'realumnomain';
            this.verAlumno = false;
            //var url2 = 'realumnodocumentos';

            axios.get(url).then(response => {

                this.alumno = response.data.alumno;
                this.alumnoEdit = response.data.alumno;

                this.user = response.data.user;
                this.userEdit = response.data.user;

                this.verAlumno = true;
            })

        },

        confirmUpdate:function (type) {

            let item = '';

            switch (type) {
                case 1:
                    item = 'del Código Modular';
                    break;
                case 2:
                    item = 'del Nombre de la Institución Educativa';
                    break;
                case 3:
                    item = 'de la Resolución de Creación de la Institución Educativa';
                    break;
            
                default:
                    break;
            }

            swal.fire({
                title: '¿Estás seguro?',
                text: "Desea Confirmar la Modificación "+item,
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

        update: function (type) {

            switch (type) {
                case 1:
                    this.ie.codigo_modular =this.ieEdit.codigo_modular;
                    break;
                case 2:
                    this.ie.nombre =this.ieEdit.nombre;
                    break;
                case 3:
                    this.ie.resolucion_creacion =this.ieEdit.resolucion_creacion;
                    break;
            
                default:
                    break;
            }

            var url="reie/"+this.ie.id;
            $(".editClass").attr("disabled");
            this.divloaderEdit=true;

            axios.put(url, this.ie).then(response=>{


                $(".editClass").removeAttr("disabled");
                this.divloaderEdit=false;
                
                if(response.data.result=='1'){
                    this.getDatos(this.thispage);
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }

            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $(".editClass").removeAttr("disabled");
            })
        }, 

        editPerfil:function () {
            this.cancelFoto();
            this.$nextTick(() => {
                $("#modalFotoPerfil").modal('show');
                this.uploadReady = true;
            });
        },

        editMision:function () {
            this.cancelFoto();
            this.$nextTick(() => {
                $("#modalFotoMision").modal('show');
                this.uploadReady = true;
            });
        },

        editVision:function () {
            this.cancelFoto();
            this.$nextTick(() => {
                $("#modalFotoVision").modal('show');
                this.uploadReady = true;
            });
        },



        cerrarFormPerfil: function () {
            $("#modalFotoPerfil").modal('hide');
            this.cancelFoto();
        },

        cerrarFormMision: function () {
            $("#modalFotoMision").modal('hide');
            this.cancelFoto();
        },

        cerrarFormVision: function () {
            $("#modalFotoVision").modal('hide');
            this.cancelFoto();
        },


        cancelFoto: function () {
            this.uploadReady = false;
            this.imagen = null;
        },

        procesarFotoPerfil:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "¿Desea Confirmar la modificación de la Imagen de Perfil?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    console.log("aqui llega");
                    this.updateFotoPerfil();
                }

            }).catch(swal.noop);
        },

        procesarFotoMision:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "¿Desea Confirmar la modificación de la Imagen de Misión?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    console.log("aqui llega");
                    this.updateFotoMision();
                }

            }).catch(swal.noop);
        },

        procesarFotoVision:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "¿Desea Confirmar la modificación de la Imagen de Visión?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    console.log("aqui llega");
                    this.updateFotoVision();
                }

            }).catch(swal.noop);
        },

        updateFotoPerfil: function() {
            var url='relegajoUpdate/FotoPerfil';

            $("#btnGuardarFP").attr('disabled', true);
            $("#btnCloseFP").attr('disabled', true);

            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('imagen', this.imagen);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

            axios.post(url,data,config).then(response=>{

                $("#btnGuardarFP").removeAttr("disabled");
                $("#btnCloseFP").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarFormPerfil();
                    this.getDatos();
                    this.errors=[];
                    //toastr.success(response.data.msj, {timeOut: 20000});
                    Swal.fire(
                        'Actualizado',
                        response.data.msj,
                        'success'
                      )
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnGuardarFP").removeAttr("disabled");
                $("#btnCloseFP").removeAttr("disabled");
            })

        },

        updateFotoMision: function() {
            var url='relegajoUpdate/FotoMision';

            $("#btnGuardarFM").attr('disabled', true);
            $("#btnCloseFM").attr('disabled', true);

            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('imagen', this.imagen);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

            axios.post(url,data,config).then(response=>{

                $("#btnGuardarFM").removeAttr("disabled");
                $("#btnCloseFM").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarFormMision();
                    this.getDatos();
                    this.errors=[];
                    //toastr.success(response.data.msj, {timeOut: 20000});
                    Swal.fire(
                        'Actualizado',
                        response.data.msj,
                        'success'
                      )
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnGuardarFM").removeAttr("disabled");
                $("#btnCloseFM").removeAttr("disabled");
            })

        },

        updateFotoVision: function() {
            var url='relegajoUpdate/FotoVision';

            $("#btnGuardarFV").attr('disabled', true);
            $("#btnCloseFV").attr('disabled', true);

            this.divloaderNuevo=true;

            var data = new  FormData();

            data.append('imagen', this.imagen);

            const config = { headers: { 'Content-Type': 'multipart/form-data' } };

            axios.post(url,data,config).then(response=>{

                $("#btnGuardarFV").removeAttr("disabled");
                $("#btnCloseFV").removeAttr("disabled");
                this.divloaderNuevo=false;

                if(response.data.result=='1'){
                    this.cerrarFormVision();
                    this.getDatos();
                    this.errors=[];
                    //toastr.success(response.data.msj, {timeOut: 20000});
                    Swal.fire(
                        'Actualizado',
                        response.data.msj,
                        'success'
                      )
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }
            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $("#btnGuardarFM").removeAttr("disabled");
                $("#btnCloseFM").removeAttr("disabled");
            })

        },


        getImagen(event){
            //Asignamos la imagen a  nuestra data

            if (!event.target.files.length)
            {
              this.imagen=null;
            }
            else{
            this.imagen = event.target.files[0];
            }
        },

    }
}).mount('#app')