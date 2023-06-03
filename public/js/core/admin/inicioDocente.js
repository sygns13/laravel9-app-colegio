const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Principal",
            subtituloHeader: "",
            subtitulo2Header: "Principal",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            errors: [],

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

            docente: {
                'id': '',
                'tipo_documento_id': '0',
                'num_documento': '',
                'apellidos': '',
                'nombre': '',
                'especialidad': '',
                'genero': 'M',
                'telefono': '',
                'direccion': '',
                'codigo_plaza': '',
                'user_id': '',
                'activo': '1',
                'celular': '',
                'condicion': '',
                'dedicacion': '',
                'cargo': '',
            },

            docenteEdit: {
                'id': '',
                'tipo_documento_id': '0',
                'num_documento': '',
                'apellidos': '',
                'nombre': '',
                'especialidad': '',
                'genero': 'M',
                'telefono': '',
                'direccion': '',
                'codigo_plaza': '',
                'user_id': '',
                'activo': '1',
                'celular': '',
                'condicion': '',
                'dedicacion': '',
                'cargo': '',
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
            divFormulario: false,
            divloaderNuevo: false,

            mostrarPalenIni: true,

            thispage: '1',
            divprincipal: false,

            labelBtnSave: 'Registrar',

            yearIni: '',

            imagen : null,
            uploadReady: true,

        }
    },
    created: function() {
        this.getDatos(this.thispage);
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
    },
    methods: {

        pasfechaVista: function(date) {
            if (date != null && date.length == 10) {
                date = date.slice(-2) + '/' + date.slice(-5, -3) + '/' + date.slice(0, 4);
            } else {
                return '';
            }

            return date;
        },

        getDatos: function() {
            
            var url = 'admin/redocentemain';
            var url2 = 'admin/redocentedocumentos';

            axios.get(url).then(response => {

                this.docente = response.data.docente;
                this.docenteEdit = response.data.docente;

                this.user = response.data.user;
                this.userEdit = response.data.user;
            })

            axios.get(url2).then(response => {
                this.registros = response.data;
            })
        },

        editPerfil:function () {
            this.cancelFoto();
            this.$nextTick(() => {
                $("#modalFotoPerfil").modal('show');
                this.uploadReady = true;
            });
        },

        cerrarFormPerfil: function () {
            $("#modalFotoPerfil").modal('hide');
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

        updateFotoPerfil: function() {
            var url='admin/redocenteUpdate/FotoPerfil';

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

       /*  getDatos: function(page) {
            var busca = this.buscar;
            var url = 'reciclo?page=' + page + '&busca=' + busca;

            axios.get(url).then(response => {

                this.registros= response.data.registros.data;
                this.pagination= response.data.pagination;
                this.yearIni= response.data.year;

                this.fillobject.year = this.yearIni;

                //this.mostrarPalenIni=true;

                if(this.registros.length==0 && this.thispage!='1'){
                    var a = parseInt(this.thispage) ;
                    a--;
                    this.thispage=a.toString();
                    this.changePage(this.thispage);
                }
            })
        }, */
        /* changePage: function(page) {
            this.pagination.current_page = page;
            this.getDatos(page);
            this.thispage = page;
        }, */

    }
}).mount('#app')