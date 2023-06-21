const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Lista de Cursos",
            subtituloHeader: "Alumno",
            subtitulo2Header: "Lista de Cursos",

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
            var url = 'get-lista-cursos';

            axios.get(url).then(response => {
                this.data = response.data.data;
                this.verTabla = true;
                this.verTablaZero = true;
            })
        },

        cerrarFormCalificaciones: function () {
            this.gestionCalificacion = false;
            this.keyCurso_bk = null;
            this.alumnoCurso = {};
            this.verTabla = true;
        },

        verCalificaciones: function (keyCurso) {
            this.keyCurso_bk = keyCurso;
            this.alumnoCurso = this.data.ciclo_cursos[keyCurso];

            this.$nextTick(() => {
                this.verTabla = false;
                this.gestionCalificacion = true;
            });
        },

        imprimir: function() {
            url = 'reportepdf/calificaciones-curso/'+this.data.id +'/'+this.alumnoCurso.id;
            console.log(url);
            window.open(url, '_blank').focus();
        },
 






      
    }
}).mount('#app')