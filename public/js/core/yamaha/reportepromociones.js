const {
    createApp
} = Vue

createApp({
    data() {
        return {
            tituloHeader: "Promociones",
            subtituloHeader: "Reportes",
            subtitulo2Header: "Promociones",
            subtitle2Header: true,

            registros: [],

            fillobjectEdit: {
                'fechaIni': '',
                'fechaFin': '',
                'tipo_documento': '0',
                'numero_documento': '',
                'nombres_apellidos': '',
                'correo': '',
                'celular': '',
                'acepta_promociones': '',
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
            thispage: '1',
        }
    },
    created: function() {
        this.fillobjectEdit.fechaIni = fechaHoy;
        this.fillobjectEdit.fechaFin = fechaHoy;
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
        // Arma el querystring común a la búsqueda y a la exportación.
        buildParams: function() {
            const f = this.fillobjectEdit;
            return 'fechaIni=' + encodeURIComponent(f.fechaIni) +
                '&fechaFin=' + encodeURIComponent(f.fechaFin) +
                '&tipo_documento=' + encodeURIComponent(f.tipo_documento) +
                '&numero_documento=' + encodeURIComponent(f.numero_documento) +
                '&nombres_apellidos=' + encodeURIComponent(f.nombres_apellidos) +
                '&correo=' + encodeURIComponent(f.correo) +
                '&celular=' + encodeURIComponent(f.celular) +
                '&acepta_promociones=' + encodeURIComponent(f.acepta_promociones);
        },
        buscarDatos: function(page) {
            if (!page) { page = 1; }

            var url = 'reportepromociones/data?page=' + page + '&' + this.buildParams();

            axios.get(url).then(response => {
                this.registros = response.data.registros.data;
                this.pagination = response.data.pagination;

                if (this.registros.length == 0 && this.thispage != '1') {
                    var a = parseInt(this.thispage);
                    a--;
                    this.thispage = a.toString();
                    this.changePage(this.thispage);
                }
            }).catch(error => {
                console.error(error);
                toastr.error("Ocurrió un error al obtener los datos", { timeOut: 20000 });
            });
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.buscarDatos(page);
            this.thispage = page;
        },
        exportarExcel: function() {
            var url = 'reportepromocionesxls/export?' + this.buildParams();
            window.location.href = url;
        },
    }
}).mount('#app')
