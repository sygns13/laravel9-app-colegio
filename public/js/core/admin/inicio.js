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

            fillobject: {
                'type':'C',
                'id': '',
                'year': '',
                'fecha_ini_clases': '',
                'fecha_fin_clases': '',
                'activo': '1',
                'activo_matricula': '0',
                'opcion': '1',
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

            matriculas: [],

        }
    },
    created: function() {
        //this.getDatos(this.thispage);
    },
    mounted: function() {
        console.log("mounted");
        this.graficarChart();
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
        graficarChart:function () {
            
            Highcharts.setOptions({
                colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                    return {
                        radialGradient: {
                            cx: 0.5,
                            cy: 0.3,
                            r: 0.7
                        },
                        stops: [
                            [0, color],
                            [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                        ]
                    };
                })
            });

            // Build the chart
            Highcharts.chart('container-chart', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Alumnos Matriculados, 2022',
                    align: 'left'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            connectorColor: 'silver'
                        }
                    }
                },
                series: [{
                    name: 'Cantidad',
                    data: [
                        { name: 'Varones', y: 49.24 },
                        { name: 'Mujeres', y: 50.76 },
                    ]
                }]
            });

        },

    }
}).mount('#app')