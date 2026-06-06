<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <h3><b>Módulos del Sistema</b></h3>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <!-- small box -->
            <a href="{{ URL::to('admin/cotizaciones') }}">
                <div class="small-box bg-primary" style="box-shadow: 0px 10px 30px 0px #8d8686;">
                    <div class="inner">
                        <h3 style="font-size: 30px">Cotizaciones</h3>

                        <p>Elaborar Cotizaciones</p>
                    </div>
                    <div class="icon" style="top: 7px;">
                        <i class="fa fa-file-alt"></i>
                    </div>
                    <div id="recibosH" class="small-box-footer" style="height: 37px"><i
                            class="fa fa-arrow-circle-right" style="font-size: 30px"></i></div>
                </div>
            </a>
        </div>


        <div class="col-lg-3 col-md-6 col-xs-12">
            <!-- small box -->
            <a href="{{ URL::to('admin/reportes') }}">
                <div class="small-box bg-green" style="box-shadow: 0px 10px 30px 0px #8d8686;">
                    <div class="inner">
                        <h3 style="font-size: 30px">Reportes</h3>

                        <p>Descargar Reporte de Cotizaciones</p>
                    </div>
                    <div class="icon" style="top: 7px;">
                        <i class="fa fa-print"></i>
                    </div>
                    <div class="small-box-footer" style="height: 37px"><i class="fa fa-arrow-circle-right"
                            style="font-size: 30px"></i></div>
                </div>
            </a>
        </div>

    </div>
</div>
