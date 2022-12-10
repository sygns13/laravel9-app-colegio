<!DOCTYPE html>
<html>
<head>
    <title>REPORTE DE HORARIO</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <style>
        @page { 
            margin-left: 0.8cm; 
            margin-top: 0.3.2cm;
            margin-bottom: 0.3.2cm;
        }
        /* body { padding: .5in; border: 2in solid orange; } */
        .table{
            border-spacing: 0!important;
        }
        .celdaFondoGrisBold1{
            text-align:center; 
            font-size: 14px; 
            border: 1px solid black; 
            background-color: #dddddd;
            font-weight: bold;
            padding: 0px!important;
        }
        .celdaFondoGrisBold2{
            text-align:center; 
            font-size: 10px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: bold;
        }
        .celdaFondoGrisBold3{
            text-align:left; 
            font-size: 10px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: bold;
        }
        .celdaFondoGrisBold3c{
            text-align:center; 
            font-size: 10px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: bold;
        }
    
        .celdaFondoGrisBold4{
            text-align:center; 
            font-size: 9px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: normal;
        }
        .celdaFondoGrisBold5{
            text-align:center; 
            font-size: 8px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: bold;
            
        }
        .celdaFondoGrisBold6{
            text-align:center; 
            font-size: 7px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: bold;
            
        }
        .celdaFondoGrisBold4L{
            text-align:left; 
            font-size: 9px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: normal;
        }
        .celdaFondoGrisBold5L{
            text-align:left; 
            font-size: 8px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: bold;
        }
    
        .celdaNormal{
            text-align:center; 
            font-size: 10px; 
            border: 1px solid black; 
            width: 0.5cm!important;
            height: 14px;
            padding: 0px!important;
        }
    
        .celdaNormalBig{
            text-align:center; 
            font-size: 10px; 
            border: 1px solid black; 
            padding: 0px!important;
        }
        .celdaNormalBig2{
            text-align:center; 
            font-size: 10px; 
            border: 1px solid black; 
            padding: 0px!important;
        }
        .celdaNormal3{
            text-align:left; 
            font-size: 10px; 
            border: 1px solid black; 
            padding: 0px!important;
        }
        .celdaNormal4{
            text-align:left; 
            font-size: 9px; 
            border: 1px solid black; 
            padding: 0px!important;
        }
        .celdaNormal5{
            text-align:left; 
            font-size: 8px; 
            border: 1px solid black; 
            padding: 0px!important;
            /* height: 10.4px */
        }
        .celdaNormal6{
            text-align:left; 
            font-size: 7px; 
            border: 1px solid black; 
            padding: 0px!important;
            /* height: 9px; */
        }
    
        .vertical{
            /* writing-mode: vertical-lr; */
            /* height:cm; */
            padding: 0px!important;
        }
        .verti{
            /* width:cm; */
            /* float: left;
            transform: rotate(90deg); */
            /* transform-origin: left top 0; */
        }
        .titles{
            font-size: 10px; 
            text-align:left; 
            font-weight: bold;
        }
        .notitles{
            font-size: 10px; 
            text-align:left; 
        }
    </style>


</head>
<body>

    {{-- Pagina 1 --}}
    <div class="box" style="width: 19cm;">
        <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <td style="width: 100%;">

                    <table class="table" style="margin-bottom: 0px; width:100%">
                        <tr>
                          <th style="vertical-align: top; width: 55px;" >
                            <div class="widget-user-image" style="padding: 0px!important; width: 55px; margin-top:5px; margin-right:5px;" >
                                <table>
                                    <tr>
                                        <td><center>
                                            <img class="img-circle" src="{{ asset('images/escudo_nac.png') }}" alt="User Avatar" width="55px">
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 5px;">
                                            Ministerio de Educación
                                        </td>
                                    </tr>
                                </table>
                            </div>
                          </th>
            
                          <th style="text-align: center;" >
                            <p style="font-size: 11px; font-weight:bolder; margin-top:0px;">REPORTE DE CALIFICACIONES - 2019</p>

                            <table class="table" style="margin-bottom: 0px; width:100%">
                                <tr>
                                    <td class="celdaFondoGrisBold3" style="width: 25%">&nbsp;DRE</td>
                                    <td class="celdaNormal3" style="width: 25%">&nbsp;DRE ANCASH</td>
                                    <td class="celdaFondoGrisBold3" style="width: 25%">&nbsp;UGEL</td>
                                    <td class="celdaNormal3" style="width: 25%">&nbsp;UGEL HUARAZ</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold3">&nbsp;Nivel</td>
                                    <td class="celdaNormal3">&nbsp;Primaria</td>
                                    <td class="celdaFondoGrisBold3">&nbsp;Código Modular</td>
                                    <td class="celdaNormal3">&nbsp;0485654</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold3">&nbsp;Institución Educativa</td>
                                    <td colspan="3" class="celdaNormal3">&nbsp;86005 RICARDO PALMA CARRILLO</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold3">&nbsp;Grado</td>
                                    <td class="celdaNormal3">&nbsp;</td>
                                    <td class="celdaFondoGrisBold3">&nbsp;Sección</td>
                                    <td class="celdaNormal3">&nbsp;</td>
                                </tr>
                                {{-- <tr>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Apellidos y Nombres del Estudiante</td>
                                    <td colspan="3" class="celdaNormal3">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Código del Estudiante</td>
                                    <td class="celdaNormal3">&nbsp;</td>
                                    <td class="celdaFondoGrisBold5L">&nbsp;DNI</td>
                                    <td class="celdaNormal3">&nbsp;</td>
                                </tr> --}}
                            </table>
                        </th>
                        
                        <th style="vertical-align: top; width: 55px;" >
                            <div class="widget-user-image" style="padding: 0px!important; width: 55px; margin-top:5px;" >
                                <table>
                                    <tr>
                                        <td><center>
                                            <img class="img-circle" src="{{ asset('images/logo3.png') }}" alt="User Avatar" width="70px">
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                          </th>

                        </tr>
                    </table>


                    <table class="table" style="margin-bottom: 0px; width:100%; margin-top:7px;">
                        <tr>
                            <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 5%">N°</td>
                            <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 20%">DNI o Código de Estudiante</td>
                            <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 35%">Apellidos y Nombres</td>
                            <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 15%">Fecha de Nacimiento</td>
                            <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 10%">Sexo</td>
                            <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 15%">Situación de Matrícula</td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>

{{--         <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <th style="text-align: center;">
                    <p style="font-size: 20px; font-weight:bolder; margin-top: 0px;">
                        HORARIO DEL
                        PRIMER GRADO
                        DEL NIVEL SECUNDARIA
                        SECCIÓN: ÚNICA
                    </p>
                </th>
            </tr>
        </table> --}}

{{--         <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <th class="celdaFondoGrisBold1" style="width: 10%">HORA</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Lunes</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Martes</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Miercoles</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Jueves</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Viernes</th>
            </tr>
        </table> --}}






    </div>


</body>