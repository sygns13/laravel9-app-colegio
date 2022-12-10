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
            font-weight: normal;
        }
        .celdaFondoGrisBold3{
            text-align:left; 
            font-size: 10px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: normal;
        }
        .celdaFondoGrisBold3c{
            text-align:center; 
            font-size: 10px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: normal;
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
    <div class="box" style="width: 27.5cm;">
        <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <td style="width: 50%;">

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
                            <p style="font-size: 11px; font-weight:bolder; margin-top:0px;">INFORME DE PROGRESO DEL APRENDIZAJE DEL ESTUDIANTE - 2019</p>

                            <table class="table" style="margin-bottom: 0px; width:100%">
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="width: 25%">&nbsp;DRE</td>
                                    <td class="celdaNormal6" style="width: 25%">&nbsp;DRE ANCASH</td>
                                    <td class="celdaFondoGrisBold5L" style="width: 25%">&nbsp;UGEL</td>
                                    <td class="celdaNormal6" style="width: 25%">&nbsp;UGEL HUARAZ</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Nivel</td>
                                    <td class="celdaNormal6">&nbsp;Primaria</td>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Código Modular</td>
                                    <td class="celdaNormal6">&nbsp;0485654</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Institución Educativa</td>
                                    <td colspan="3" class="celdaNormal6">&nbsp;86005 RICARDO PALMA CARRILLO</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Grado</td>
                                    <td class="celdaNormal6">&nbsp;</td>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Sección</td>
                                    <td class="celdaNormal6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Apellidos y Nombres del Estudiante</td>
                                    <td colspan="3" class="celdaNormal6">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L">&nbsp;Código del Estudiante</td>
                                    <td class="celdaNormal6">&nbsp;</td>
                                    <td class="celdaFondoGrisBold5L">&nbsp;DNI</td>
                                    <td class="celdaNormal6">&nbsp;</td>
                                </tr>
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
                            <td rowspan="2" class="celdaFondoGrisBold6" style="width: 15.75%">&nbsp;ÁREA CURRICULAR</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="width: 27%">&nbsp;COMPETENCIAS</td>
                            <td colspan="3" class="celdaFondoGrisBold6" style="width: 18.75%">&nbsp;CALIFICATIVO POR PERIODO</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="width: 6.25%">&nbsp;Calif. anual de Comp</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="width: 6.25%">&nbsp;Calif. anual de Área</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="width: 26%">&nbsp;Conclusión descriptiva de final del periodo lectivo</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold6" style="width: 6.25%">&nbsp;1</td>
                            <td class="celdaFondoGrisBold6" style="width: 6.25%">&nbsp;2</td>
                            <td class="celdaFondoGrisBold6" style="width: 6.25%">&nbsp;3</td>
                        </tr>
                    </table>

                </td>
                
                <td style="width: 50%">

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