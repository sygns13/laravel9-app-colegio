const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Cambiar Contraseña",
            subtituloHeader: "Principal",
            subtitulo2Header: "Cambiar Contraseña",

            subtitle2Header: true,

            userPerfil: '{{ Auth::user()->name }}',
            mailPerfil: '{{ Auth::user()->email }}',

            registros: [],
            errors: [],



            fillobject: {
                'id': '',
                'tipo_user': '',
                'name': '',
                'email': '',
                'password_old': '',
                'password_new1': '',
                'password_new2': '',
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
            var url = 'get-cambiar-password';
            axios.get(url).then(response => {
                this.fillobject.id = response.data.user.id;
                this.fillobject.tipo_user = response.data.user.tipouser.nombre;
                this.fillobject.name = response.data.user.name;
                this.fillobject.email = response.data.user.email;
                this.fillobject.password_old = '';
                this.fillobject.password_new1 = '';
                this.fillobject.password_new2 = '';
            })
        },

        procesar:function () {
            swal.fire({
                title: '¿Estás seguro?',
                text: "¿Desea Confirmar la modificación de la Contraseña?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Confirmar'
            }).then((result) => {

                if (result.value) {
                    console.log("aqui llega");
                    this.create();
                }

            }).catch(swal.noop);
        },
        create: function () {


            var url="update-psw-v1";
            $(".btnGuardar").attr("disabled");
            this.divloaderEdit=true;

            axios.post(url, this.fillobject).then(response=>{


                $(".btnGuardar").removeAttr("disabled");
                this.divloaderEdit=false;
                
                if(response.data.result=='1'){
                    this.getDatos();
                    this.errors=[];
                    toastr.success(response.data.msj, {timeOut: 20000});
                }else{
                    $('#'+response.data.selector).focus();
                    toastr.error(response.data.msj, {timeOut: 20000});
                }

            }).catch(error=>{
                console.log(error);
                //this.errors=error.response.data;
                $(".btnGuardar").removeAttr("disabled");
            })
        }, 


    }
}).mount('#app')