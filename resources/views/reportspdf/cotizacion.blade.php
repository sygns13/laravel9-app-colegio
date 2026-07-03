@php
    // Devuelve la URL del asset solo si el archivo existe en public/web/yamaha,
    // para evitar que dompdf pinte el placeholder "Image not found".
    $imgYamaha = function ($ruta) {
        return !empty($ruta) && is_file(public_path('web/yamaha/' . $ruta))
            ? asset('web/yamaha/' . $ruta)
            : null;
    };
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>COTIZACION YAMAHA</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <style>
        /* @page {
            margin-left: 0.8cm;
            margin-top: 0.3.2cm;
            margin-bottom: 0.3.2cm;
        } */
    </style>

    <style type="text/css">
        @page {
            @top-center {
                content: element(header);
            }

            @bottom-center {
                content: element(footer);
            }
        }

        @page {
            size: A4;
            margin-top: 0cm;
            margin-left: 0.5cm;
            margin-right: 0.7cm;
        }

        @font-face {
            font-family: "Estricta";
            src: url('{{ asset('fonts\estricta-regular.ttf') }}') format('truetype');
        }

        /*@page:first {
    margin-top: 0cm;
    margin-bottom: 0cm;
    margin-left: 0cm;
    margin-right: 0cm;
    size: 210mm 847.5mm;
    }*/
        /*@page:first {
    margin-top: 0.5cm;
    margin-bottom: 0.5cm;
    margin-left: 0.5cm;
    margin-right: 0.5cm;
    size: 220mm 300mm;
    //border :1px solid black;
    //border-bottom :1px solid black;
    }*/

        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            width: 99%;
        }

        .header {
            height: 85px;
            color: #FFFFFF;
            width: 100% !important;
            margin-top: 15px;
            background: #0A2C83;
            font-size: 12px;
            font-weight: bold;
        }

        .texto-bienvenida {
            text-align: center;
        }

        .title {
            text-transform: uppercase;
            color: #0A2C83;
            font-weight: bold;
            font-size: 30px;
            margin-bottom: 0px;
        }

        .error {
            text-transform: uppercase;
            color: #3b3b3b;
            font-weight: bold;
            font-size: 30px;
            margin-bottom: 0px;
        }

        .subtitle {
            color: #0A2C83;
            text-transform: lowercase;
            font-size: 18px;
            margin-top: 0px;
        }

        .headerempresa {
            text-transform: uppercase;
        }

        .modelo {
            width: 100% !important;
            text-align: center;
        }

        .moto-texto {
            width: 100%;
        }

        .moto {
            /* width: 49% !important; */
            /*float: left;*/
            width: 100% !important;
            text-align: center;
            /* height: 100%; */
        }

        /*.texto-en-moto {
    width: 100% !important;
    float: right;
    background: #0A2C83;
    /*height: 100%;
    min-height: 280px;
    height: fit-content;
    padding: 40px 10px 0px 50px;
    color: #fff;
    line-height: 1.5;
    }*/
        .texto-en-moto {
            width: 100% !important;
            background: #0A2C83;
            padding: 20px 0px 15px 10px;
            color: #fff;
            line-height: 1.5;
            text-align: justify;
            page-break-inside: avoid;
        }

        /*.img-moto {
    position: relative;
    bottom: 45px;
    left: 21%;
    padding: 0px;
    text-align: center;
    border: 0px solid transparent;
    width: 100%;
    }*/
        .img-moto {
            /* position: relative; */
            /*     bottom: 260px;
    left: 50%; */
            padding: 0px;
            text-align: center;
            border: 0px solid transparent;
            width: 510px;
            height: 340px;
        }


        /*.titulos-subcategoria {
    background: #0A2C83;
    color: #fff;
    text-align: center;
    width: 30%;
    margin: 0 auto;
    padding: 5px;
    font-size: 20px;
    font-weight: bold;
    }*/

        .titulos-subcategoria {
            background: #0A2C83;
            color: #fff;
            text-align: center;
            width: 750px;
            margin: 0 auto;
            padding: 5px;
            font-size: 20px;
            font-weight: bold;
        }

        /* Margenes */
        .mt-10 {
            margin-top: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .mt-30 {
            margin-top: 30px;
        }

        .mt-60 {
            margin-top: 60px;
        }

        .mt-100 {
            margin-top: 100px;
        }

        .ml-10 {
            margin-left: 10px;
        }

        .ml-20 {
            margin-left: 20px;
        }

        .ml-35 {
            margin-left: 33px;
        }

        .ml-50 {
            margin-left: 50px;
        }

        .ml-70 {
            margin-left: 70px;
        }

        .ml-150 {
            margin-left: 150px;
        }

        .ml-140 {
            margin-left: 140px;
        }

        .ml-685 {
            margin-left: 685px;
        }

        .mr-20 {
            margin-right: 20px;
        }

        .mr-30 {
            margin-right: 30px;
        }

        .mr-140 {
            margin-right: 140px;
        }

        .mb-30 {
            margin-bottom: -30px;
            height: -50px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-7 {
            margin-bottom: 7px;
        }

        .beneficios {
            border: 2px solid #0A2C83;
            padding: 30px;
        }

        .motor {
            margin: 40px 0 !important;
            width: 20%;
            z-index: 999 !important;
        }

        .chasis {
            margin: 40px 0 !important;
            width: 20%;
            z-index: 999 !important;
        }

        table.datos {
            color: #3b3b3b !important;
            margin-top: -38px !important;
            margin-left: 15px;
            background: #F5F5F5 !important;
            font-size: 14px;
        }

        /*
    table.datos td {
    border:  #999 .5px solid;
    }
    
    table.datos tr {
    border:  #999 .5px solid;
    }
    */

        .titulos-subtitulo {
            color: #0A2C83;
            font-size: 35px;
            font-style: normal;
            font-weight: bold;
            text-align: center;
        }

        .compra-incluye {
            background: #0A2C83;
            width: 100%;

        }

        .texto-compra {
            color: #fff;
            font-size: 12px;
            text-align: center;
        }

        .texto-beneficio {
            color: #0A2C83;
            font-size: 14px;

            display: block;
            margin: 10px 20px;
            vertical-align: top;
            text-align: justify;
            hyphens: auto;
        }

        .td-valign-top {
            vertical-align: top;
        }

        .img-tabla {
            vertical-align: middle !important;
        }

        .precio {
            color: #fff;
            font-size: 14px;
            font-style: normal;
            font-weight: bold;
            line-height: 1;
            text-align: center;
            display: inline-block;
            padding-bottom: 10px;
            padding-top: 5px;
        }

        .caja-precios {
            margin: 0 auto;
            text-align: center;
        }

        .letra-chiquita {
            color: #3b3b3b;
            font-size: 11px;
            text-align: center;
            margin: 0 auto;
        }

        .condiciones {
            text-align: center;
            color: #3b3b3b;
            margin: 0 auto;
        }

        .titulo {
            font-weight: bold;
            font-size: 17px;
        }

        .puntitos-condiciones {
            text-align: left;
            font-size: 13px;
        }

        .titulitos-pagos {
            display: inline-block;
            width: 45%;
            color: #fff;
            margin: 0 auto;
        }

        .titulos-pagos-h1 {
            font-size: 14px;
            text-align: center;
            padding: 5px;
            background: #0A2C83;
        }

        .imagenes-financiar {
            display: inline-block;
        }

        .letra-chica {
            color: #3b3b3b;
            font-size: 13px;
            text-align: center;
            margin: 0 auto;
        }

        .caja-experto {
            margin-top: 20px;
            border-top: 3.5px solid #333;
            border-bottom: 2px solid #333;
        }

        .experto-titulo {
            color: #0A2C83;
            font-size: 20px;
            margin: 0px;
            text-align: left;
            margin-bottom: 2px !important;
        }

        .experto-nombre {
            color: #666;
            font-size: 18px;
            text-align: left;
            margin: 0px;
            margin-bottom: 6px !important;
        }

        .experto-telefono {
            color: #666;
            font-size: 12px;
            text-align: left;
            font-weight: bold;
            margin: 0px !important;
            margin-bottom: 4px !important;
        }

        .experto-email {
            color: #666;
            font-size: 12px;
            text-align: left;
            font-weight: bold;
            margin: 0px !important;

        }

        .iconos,
        .texto-iconos {
            display: inline-block;
            color: #666;
            margin: 1px;
        }

        .info-direccion {
            color: #666;
            font-size: 15px;
            text-align: center;
            margin: 0 auto;
            font-weight: bold;
        }

        a:link,
        a:visited {
            color: #fff;
            text-decoration: none;
            cursor: auto;
        }

        a:link:active,
        a:visited:active {
            color: #fff;
        }

        .vl {
            border-left: 1px solid rgb(255, 255, 255);
            height: 112px;
            margin-top: -112px;
            margin-left: 365px;
        }


        .col-1,
        .col-2,
        .col-3 {
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="header">
        <div>
            <div style="display: inline-block; vertical-align: top; float: left;">
                <div class="ml-20" style="display: inline-block;">
                    <p>
                        {{--  
                        Sucursal <apex:outputText value=" {!sucursal}"/> <br /> --}}
                        COTIZACIÓN: {{ $cotizacion->year }}-{{ $cotizacion->numero }} <br />
                        FECHA
                        {{ substr(strval($cotizacion->fecha), 8, 2) }}/{{ substr(strval($cotizacion->fecha), 5, 2) }}/{{ substr(strval($cotizacion->fecha), 0, 4) }}
                        <br />
                        HORA: {{ $cotizacion->hora }}
                        {{-- <br />
                        <div class="headerempresa">
                            {!Quote.Account.Name}
                        </div> --}}
                    </p>

                </div>
            </div>
            <div class="mr-20" style=" display: inline-block; float: right;">
                <p>
                    {{-- <img src="{!URLFOR($Resource.FotosYamaha,'fotos/YAMAHA.png')}" />  --}}
                    <img src="{{ asset('images/logoyamaha-white.png') }}" width="170px">
                    <!--  <img src="fotos/YAMAHA.png" /> -->
                </p>
            </div>
        </div>
    </div>

    <!-- CUERPO -->
    <div class="texto-bienvenida">
        <h1 class="title">
            hola {{ $cliente->nombres }} {{ $cliente->apellidos }}, conoce tu <br /> próxima yamaha
        </h1>
        <h2 class="subtitle">
            y vive momentos inolvidables
        </h2>
    </div>

    <!-- MODELO Y FOTO MOTO -->
    <div class="" style="width: 100%;">
        <div class="modelo" style="margin-top: -160px;">
            <!-- Aquí usé el campo 'imgMotoPrincipal' de Product2 y un recurso estático -->
            @if ($imgYamaha($dataCotizacion->url_logo))
                <img src="{{ $imgYamaha($dataCotizacion->url_logo) }}"
                    style="width: 600px; padding: 0px; border: 0px solid transparent;">
            @endif

            <!--<img data-assetid="13637" src="{!URLFOR($Resource.NMAX_CONNECTED, imgLogo)}" alt=""
            style="width:200px; padding: 0px; border: 0px solid transparent; height: auto;" />-->
        </div>
        <div class="moto">
            <!--<img url="{!motoPrincipalURL}"></img>-->
            <!--<img class="img-moto" data-assetid="13637" src="{!URLFOR($Resource.NMAX_CONNECTED, imgMotoPrincipal)}" alt="" />-->
            @if ($imgYamaha($dataCotizacion->url_moto_principal))
                <img class="img-moto" data-assetid="13637"
                    src="{{ $imgYamaha($dataCotizacion->url_moto_principal) }}" alt="" />
            @endif
        </div>
        <div class="moto-texto" style="width: 100%;">
            <div class="texto-en-moto">
                <h2 style="padding: 0 10px;">
                    <!--PODER TODO <br /> TERRENO-->
                    {{ $dataCotizacion->claim }}
                </h2>
                <p style="white-space: normal; padding: 10px; padding-right: 30px;">
                    {{ $dataCotizacion->descripcion }} <!-- Sale dinámico de 'Especificación de Producto' -->
                </p>
            </div>
        </div>
    </div>

    <!-- ESTILO -->
    <div class="titulos-subcategoria mt-30" style="page-break-before: always;">
        ESCOGE TU ESTILO
    </div>
    <table cellpadding="0" cellspacing="0" style="margin-top: 30px !important; margin-left: auto; width: 90%;">
        <colgroup>
            <col span="1" style="width: 33%;">
            <col span="1" style="width: 33%;">
            <col span="1" style="width: 33%;">
        </colgroup>
        <tr>
            <!-- Reemplazar {!renderEstilo1} con la condición de renderizado apropiada o eliminar si siempre se muestra -->
            <td class="col-1">
                <!-- Imagen 1 (reemplazar estilo1URL con la URL de la imagen) -->
                @if ($imgYamaha($dataCotizacion->url_color1))
                    <img src="{{ $imgYamaha($dataCotizacion->url_color1) }}"
                        style="width:140px; height:216px;" />
                @endif
            </td>
            <!-- Reemplazar {!renderEstilo2} con la condición de renderizado apropiada o eliminar si siempre se muestra -->
            <td class="col-2">
                <!-- Imagen 2 (reemplazar estilo2URL con la URL de la imagen) -->
                @if ($imgYamaha($dataCotizacion->url_color2))
                    <img src="{{ $imgYamaha($dataCotizacion->url_color2) }}"
                        style="width:140px; height:216px;" />
                @endif
            </td>
            <!-- Reemplazar {!renderEstilo3} con la condición de renderizado apropiada o eliminar si siempre se muestra -->
            <td class="col-3">
                <!-- Imagen 3 (reemplazar estilo3URL con la URL de la imagen) -->
                @if ($imgYamaha($dataCotizacion->url_color3))
                    <img src="{{ $imgYamaha($dataCotizacion->url_color3) }}"
                        style="width:140px; height:216px;" />
                @endif
            </td>
        </tr>
    </table>

    <!-- BENEFICIOS -->
    <div class="titulos-subcategoria mt-60" style=" margin-bottom: -45px; ">
        BENEFICIOS
    </div>
    <table class="beneficios" cellpadding="0" cellspacing="0"
        style="margin-top: 30px !important; margin-left: auto; margin-right: auto; width: 100%;">
        {{--         <colgroup>
            <col span="1" width="25%" />
            <col span="2" width="25%" />
            <col span="3" width="25%" />
            <col span="4" width="25%" />
        </colgroup> --}}
        <tr>
            <td align="center" style="width: 25%;">
                @if ($imgYamaha($dataCotizacion->url_beneficio1))
                    <img data-assetid="13638" src="{{ $imgYamaha($dataCotizacion->url_beneficio1) }}" alt=""
                        height="100%"
                        style="margin-left: 20px; padding: 0px;  border: 0px; width:140px; height:140px;" />
                @endif
            </td>
            <td align="center" style="width: 25%;">
                @if ($imgYamaha($dataCotizacion->url_beneficio2))
                    <img data-assetid="13639" src="{{ $imgYamaha($dataCotizacion->url_beneficio2) }}" alt=""
                        height="100%"
                        style="margin-left: 20px; padding: 0px;  border: 0px; width:140px; height:140px;" />
                @endif
            </td>
            <td align="center" style="width: 25%;">
                @if ($imgYamaha($dataCotizacion->url_beneficio3))
                    <img data-assetid="13640" src="{{ $imgYamaha($dataCotizacion->url_beneficio3) }}" alt=""
                        height="100%" style="padding: 0px;  border: 0px; width:140px; height:140px;" />
                @endif
            </td>
            <td align="center" style="width: 25%;">
                @if ($imgYamaha($dataCotizacion->url_beneficio4))
                    <img data-assetid="13640" src="{{ $imgYamaha($dataCotizacion->url_beneficio4) }}" alt=""
                        height="100%" style=" padding: 0px; border: 0px; width:140px; height:140px;" />
                @endif
            </td>
        </tr>
        <tr>
            <td class="td-valign-top">
                <p class="texto-beneficio">
                    {{ $dataCotizacion->beneficio1 }}
                </p>
            </td>
            <td class="td-valign-top">
                <p class="texto-beneficio">
                    {{ $dataCotizacion->beneficio2 }}
                </p>
            </td>
            <td class="td-valign-top">
                <p class="texto-beneficio">
                    {{ $dataCotizacion->beneficio3 }}
                </p>
            </td>
            <td class="td-valign-top">
                <p class="texto-beneficio">
                    {{ $dataCotizacion->beneficio4 }}
                </p>
            </td>
        </tr>
    </table>


    <!-- TABLAS CON INFO DETALLE -->
    <div style="background: #F5F5F5 !important; width= 80%; margin-left: 50px !important; padding-bottom: 10px;">
        <!-- MOTOR DETALLE -->
        <div class="titulos-subcategoria motor">
            MOTOR
        </div>
        <table class="datos" cellpadding="5" cellspacing="0" width= "90%">
            <colgroup>
                <col span="1" style="width: 50%;" />
                <col span="1" style="width: 50%;" />
            </colgroup>
            <tr>
                <td>
                    Tipo de motor
                </td>
                <td>
                    {{ $dataCotizacion->tipo_motor }}
                </td>
            </tr>
            <tr>
                <td>
                    Cilindrada
                </td>
                <td>
                    {{ $dataCotizacion->cilindrada }}
                </td>
            </tr>
            <tr>
                <td>
                    Potencia máxima
                </td>
                <td>
                    {{ $dataCotizacion->potencia_max }}
                </td>
            </tr>
            <tr>
                <td>
                    Torque maximo
                </td>
                <td>
                    {{ $dataCotizacion->torque_max }}
                </td>
            </tr>
            <tr>
                <td>
                    Sistema de arranque
                </td>
                <td>
                    {{ $dataCotizacion->sistema_arrranque }}
                </td>
            </tr>
            <tr>
                <td>
                    Sistema de transmisión
                </td>
                <td>
                    {{ $dataCotizacion->sistema_transmision }}
                </td>
            </tr>
            <tr>
                <td>
                    Suministro de combustible
                </td>
                <td>
                    {{ $dataCotizacion->suministro_combustible }}
                </td>
            </tr>
            <tr>
                <td>
                    Capacidad de depósito de combustible
                </td>
                <td>
                    {{ $dataCotizacion->capacidad_combustible }}
                </td>
            </tr>
        </table>
    </div>

    <br />
    <br />
    <br />
    <div
        style="background: #F5F5F5 !important; width= 80%; margin-top: 50px !important; margin-left: 50px !important; padding-bottom: 10px;">
        <!-- CHASIS DETALLE -->
        <div class="titulos-subcategoria motor">
            CHASIS
        </div>
        <table class="datos" cellpadding="5" cellspacing="0" width= "90%">
            <colgroup>
                <col span="1" style="width: 50%;" />
                <col span="1" style="width: 50%;" />
            </colgroup>
            <tr>
                <td>
                    Altura del asiento
                </td>
                <td>
                    {{ $dataCotizacion->altura_asiento }}
                </td>
            </tr>
            <tr>
                <td>
                    Peso con aceite y combustible
                </td>
                <td>
                    {{ $dataCotizacion->peso_total }}
                </td>
            </tr>
            <tr>
                <td>
                    Suspensión delantera
                </td>
                <td>
                    {{ $dataCotizacion->suspension_delantera }}
                </td>
            </tr>
            <tr>
                <td>
                    Suspensión trasera
                </td>
                <td>
                    {{ $dataCotizacion->suspencion_trasera }}
                </td>
            </tr>
            <tr>
                <td>
                    Freno delantero
                </td>
                <td>
                    {{ $dataCotizacion->freno_delantero }}
                </td>
            </tr>
            <tr>
                <td>
                    Freno trasero
                </td>
                <td>
                    {{ $dataCotizacion->freno_trasero }}
                </td>
            </tr>
            <tr>
                <td>
                    Neumático delantero
                </td>
                <td>
                    {{ $dataCotizacion->neumatico_delantero }}
                </td>
            </tr>
            <tr>
                <td>
                    Neumático trasero
                </td>
                <td>
                    {{ $dataCotizacion->numatico_trasero }}
                </td>
            </tr>
        </table>
    </div>


    <!-- TU COMPRA INCLUYE -->

    @if (count($includes) > 0)
        <div class="titulos-subtitulo mt-30" style="">
            TU COMPRA INCLUYE:
        </div>
        <div class ="compra-incluye">
            <table class="beneficios" cellpadding="0" cellspacing="0"
                style="margin-top: 30px !important; margin-left: auto; margin-right: auto; ">
                <tr align="center">
                    @foreach ($includes as $index => $include)
                        @if ($index < 4)
                            <td align="center" class="img-tabla" style="width: 25%;">
                                @if ($imgYamaha($include->urlimage))
                                    <img data-assetid="13638" src="{{ $imgYamaha($include->urlimage) }}"
                                        alt="" height="65px;"
                                        style=" padding: 0px; text-align: center; border: 0px;" />
                                @endif
                                <p class="texto-compra" style="margin-top: 10px; margin-bottom: 40px;">
                                    {{ $include->nombre }}
                                </p>
                            </td>
                        @endif
                    @endforeach
                </tr>

                @if (count($includes) > 4)
                    <tr align="center">
                        @foreach ($includes as $index => $include)
                            @if ($index >= 4 && $index < 8)
                                <td align="center" class="img-tabla" style="width: 25%;">
                                    @if ($imgYamaha($include->urlimage))
                                        <img data-assetid="13638" src="{{ $imgYamaha($include->urlimage) }}"
                                            alt="" height="65px;"
                                            style=" padding: 0px; text-align: center; border: 0px;" />
                                    @endif
                                    <p class="texto-compra" style="margin-top: 10px; margin-bottom: 40px;">
                                        {{ $include->nombre }}
                                    </p>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endif

                @if (count($includes) > 8)
                    <tr align="center">
                        @foreach ($includes as $index => $include)
                            @if ($index >= 8 && $index < 12)
                                <td align="center" class="img-tabla" style="width: 25%;">
                                    @if ($imgYamaha($include->urlimage))
                                        <img data-assetid="13638" src="{{ $imgYamaha($include->urlimage) }}"
                                            alt="" height="65px;"
                                            style=" padding: 0px; text-align: center; border: 0px;" />
                                    @endif
                                    <p class="texto-compra" style="margin-top: 10px; margin-bottom: 40px;">
                                        {{ $include->nombre }}
                                    </p>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                @endif

            </table>
        </div>
    @endif

    <!-- PRECIOS -->
    <div class ="compra-incluye">
        <div class="caja-precios">
            <hr style="color:rgb(255, 255, 255);">
            </hr>
            <p class="precio" style="padding-right: 25px;">
                PRECIO EN
                DOLARES $<br /> <br />
                <span style="font-size: 30px;">
                    U$ {{ number_format($cotizacion->precio_final_usd, 2, '.', '') }}
                </span> <!--Quote.Total__c-->
            </p>
            <p class="precio" style="padding-left: 20px;">
                PRECIO EN
                SOLES S/.<br /> <br />
                <span style="font-size: 30px;">
                    <!--S/. {!totalPEN}*</span>11,188.00-->
                    S/. {{ number_format($cotizacion->precio_final_pen, 2, '.', '') }}
            </p>
            {{-- <p style="color: #FFFFFF;padding-right: 25px; border-right: 2px solid #fff;font-size: 10px">(Precio Unitario: USD {!unitPriceUSD} (PEN {!unitPricePEN}), Unidades: {!noUnidades})</p> --}}
        </div>
    </div>

    <div class="vl"></div>
    <div class="letra-chiquita">
        <p>
            (*)Tipo de Cambio referencial de S/. {{ number_format($cotizacion->tipo_cambio, 2, '.', '') }} para hoy, el
            cual
            podrá variar sin previo aviso según el tipo de cambio del día de
            la transaccion/compra.<br />
            Stock y colores de la unidad sujeto a disponibilidad la cual puede variar sin previo aviso.
            <br />
            Consultar disponibilidad con su Experto Yamaha.
        </p>
    </div>

    <!-- CONDICIONES --> 
    <div class="mt-30 condiciones" style="page-break-before: always;">
        <p class="titulo" style="margin-bottom: 6px;">
            CONDICIONES:<br /> 
        </p>
        <p class="puntitos-condiciones" style="margin-top: 0px;">
            •  <b>Cotización vigente hasta:</b> {{ substr(strval($cotizacion->fecha), 8, 2) }}/{{ substr(strval($cotizacion->fecha), 5, 2) }}/{{ substr(strval($cotizacion->fecha), 0, 4) }}<br />  
            •  Precio puede variar sin previo aviso a excepción de una reserva con depósito confirmado en cuentas Yamaha.<br />
            •  Precio incluye todos los impuestos de ley vigentes aplicables según la zona. <br />
            •  <b>Forma de Pago:</b> Depósito o transferencia bancaria a nombre de Yamaha Motor del Peru S.A. (para Lima y Chiclayo) o Yamaha Motor Selva del Peru S.A. (para Iquitos, Tarapoto, Pucallpa y Jaén).
            •  Para el caso de uso de tarjeta de débito o crédito habrá un recargo de 3% adicional al monto a facturar. Consultar los números de cuenta del banco de su preferencia o condiciones con otros medios de pago con su experto Yamaha.<br />
            •  En caso de desistimiento de compra luego de efectuado el pago, se le aplicará un recargo del 3% por gastos administrativos.<br />
            •  El plazo de devolución tiene un tiempo máximo de 20 días útiles. <br />
            <!--• Pago con tarjeta de credito o debito
            tendra un recargo del 4% sobre el valor de
            transaccion.<br />-->
            •  Las unidades se entregan en tienda en la fecha y hora pactada con el experto Yamaha y tiene un plazo aproximado de 15 días posterior a su facturación, pasada esa fecha Yamaha no se responsabiliza del estado de la unidad y podría aplicar el costo de servicio de cochera diario por un importe de $20 (veinte dólares).
        </p>
    </div>

    <div class="">
        <div class="titulitos-pagos" style=" float: left;">
            <h1 class=" titulos-pagos-h1 ">
                ¿CON QUIÉN PUEDO FINANCIAR?
            </h1>
            <div>
                    <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/BCP.png') }}" />
                    <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/Galgo.png') }}" />
                <!--<img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/migrante.png')}" />
                <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/efectiva.png')}" />-->
            </div>
            <div>
                <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/Integra.png') }}" />
                <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/Efectiva.png') }}" />
                <!--<img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/fonbienes.png')}" />
                <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/cajapiura.png')}" />-->
            </div>
           {{--  <div>
                <apex:variable var="bcpfinan" value="{!renderBcpfinan}" rendered="{!renderBcpfinan}" >
                    <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/bcp.png')}" />
                </apex:variable>
                <apex:variable var="galgo" value="{!renderGalgo}" rendered="{!renderGalgo}" >
                    <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/Galgo.png')}" />
                </apex:variable>
                <!--<img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/fonbienes.png')}" />
                <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/cajapiura.png')}" />-->
            </div>
            <div>
                <apex:variable var="integra" value="{!renderIntegra}" rendered="{!renderIntegra}" >
                    <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/Integra.png')}" />
                </apex:variable>
                <apex:variable var="crediefectiva" value="{!renderCrediefectiva}" rendered="{!renderCrediefectiva}" >
                    <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/efectiva.png')}" />
                </apex:variable>
                <!--<img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/fonbienes.png')}" />
                <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/cajapiura.png')}" />-->
            </div> --}}
        </div>
        <div class="titulitos-pagos" style="float: right;">
            <h1 class="titulos-pagos-h1 ">
                ¿DÓNDE PUEDO PAGAR?
            </h1>
            <div>
                <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/BCP.png') }}" />
                <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/Scotiabank.png') }}" />
                <!--<img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/bcp.png')}" />
                <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/scotiabank.png')}" />-->
            </div>
            <div>
                <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/BBVA.png') }}" />
                <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/Banco-de-la-nacion.png') }}" />
                <!--<img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/bbva.png')}" />
                <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/banconacion.png')}" />-->
            </div>
            <div>
                <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/financiera/Citibank.png') }}" />
                <!--<img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/bbva.png')}" />
                <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/banconacion.png')}" />-->
            </div>
            {{-- <div>
                <apex:variable var="citibank" value="{!renderCitibank}" rendered="{!renderCitibank}" >
                    <img class="imagenes-financiar" src="{!URLFOR($Resource.FotosYamaha,'fotos/Citibank.png')}" />
                </apex:variable>
            </div> --}}
        </div>
    </div>

    <!--ENTREGA-->
    <div class="letra-chica" style="margin-top: 200px;">
        <p>
            <b>Entrega:</b> Previa
            facturacion, para los casos de productos sujetos
            a inscripción vehicular en SUNARP, el cliente
            deberá suscribir todos los documentos referentes
            a dicho trámite (placa y tarjeta de propiedad).
            SUNARP es una entidad gubernamental
            cuyos plazos, excepciones y/o retrasos no serán
            imputables a Yamaha Motor del Peru S.A. ó Yamaha Selva
            del Peru S.A.
        </p>
        </div>


    <!--EXPERTO YAMAHA-->
    <div class="caja-experto">
        <table cellpadding="0" cellspacing="0" style="margin-top: 15px !important;  width: 90%;">
            <colgroup>
                <col span="1" style="width: 25%;" />
                <col span="1" style="width: 50%;" />
                <col span="1" style="width: 25%;" />
            </colgroup>
            <tr align="">
                <td align="left">
                    {{-- <img class="imagenes-financiar" src="{!URLFOR($Resource.Vendedores, fotovendedor)}" width="220px" height="300px"/> --}}
                </td>
                <td align="center">
                    <div>
                        <h1 class="experto-titulo">
                            EXPERTO YAMAHA
                        </h1>
                        <h2 class="experto-nombre">
                            {{ $personal->nombres }} {{ $personal->apellidos }}
                        </h2>
                        <div class="experto-telefono" style="margin-top: 4px !important;">
                            <img class="iconos" width="10" height="10" src="{{ asset('web/yamaha/otros/celular.png') }}" />
                            <img class="iconos" width="10" height="10" src="{{ asset('web/yamaha/otros/whatsap.png') }}" />
                            <p  class="texto-iconos">
                                {{ $personal->celular }}
                            </p>
                            
                        </div>
                        <div class="experto-email">
                            <img class="iconos" width="10" height="10" src="{{ asset('web/yamaha/otros/email.png') }}" />
                            <p class="texto-iconos">
                                {{ $personal->correo }}
                            </p>
                            
                        </div>
                    </div>
                </td>
                <td align="right">
                    <img class="imagenes-financiar" src="{{ asset('web/yamaha/otros/kando/Kando_Blanco.png') }}"/>
                </td>
            </tr>
        </table> 
    </div>


    <div class="info-direccion">
        <p >
            YAMAHA MOTOR DEL PERU S.A. <br />
            Av. República de Panamá 4344 - 4352 Surquillo
        </p>
        <a href="https://www.facebook.com/yamahamotorperu">
            <img width="20" height="20" src="{{ asset('web/yamaha/otros/fb.png') }}" alt="icon"/>
        </a>
        <a href="https://www.instagram.com/yamahamotorperu/">
            <img width="20" height="20" src="{{ asset('web/yamaha/otros/ig.png') }}" alt="icon"/>
        </a>
        <a href="https://www.linkedin.com/company/yamahamotorperu/">
            <img width="20" height="20" src="{{ asset('web/yamaha/otros/ln.png') }}" alt="icon"/>
        </a>
        <a href="https://www.youtube.com/channel/UCumUSJUT0RWyRgOGyt-5VmA">
            <img width="20" height="20" src="{{ asset('web/yamaha/otros/yt.png') }}" alt="icon"/>
        </a>
        <!--<img class="iconos" width="20" height="20" src="{!URLFOR($Resource.FotosYamaha,'fotos/facebook.png')}" />
        <img class="iconos" width="20" height="20" src="{!URLFOR($Resource.FotosYamaha,'fotos/instagram.png')}" />
        <img class="iconos" width="20" height="20" src="{!URLFOR($Resource.FotosYamaha,'fotos/linkedin.png')}" />
        <img class="iconos    " width="20" height="20" src="{!URLFOR($Resource.FotosYamaha,'fotos/youtube.png')}" />-->
    </div>
    <div class="mt-60" style="text-align: center; margin-left: auto; margin-right: auto;">
        <img src="{{ asset('images/logoyamaha-black.png') }}"  width="200px;"/>
    </div>

</body>
