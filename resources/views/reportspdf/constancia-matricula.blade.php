<!DOCTYPE html>
<html>
<head>
    <title>CONSTANCIA DE MATRICULA</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <style>
        @page { 
            margin-left: 0.8cm; 
            margin-top: 0.3cm;
            margin-bottom: 0.3cm;
        }
        /* body { padding: .5in; border: 2in solid orange; } */
        .table{
            border-spacing: 0!important;
        }
        .celdaFondoGrisBold1{
            text-align:center; 
            font-size: 11px; 
            border: 1px solid black; 
            background-color: #dddddd;
            font-weight: bold;
            padding: 0px!important;
        }
        .celdaFondoGrisBold2{
            text-align:center; 
            font-size: 11px; 
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
            text-align:left; 
            font-size: 8px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: normal;
            
        }
        .celdaFondoGrisBold4L{
            text-align:left; 
            font-size: 9px; 
            border: 1px solid black; 
            background-color: #dddddd;
            padding: 0px!important;
            font-weight: normal;
        }
    
        .celdaNormal{
            text-align:center; 
            font-size: 11px; 
            border: 1px solid black; 
            width: 0.5cm!important;
            height: 14px;
            padding: 0px!important;
        }
    
        .celdaNormalBig{
            text-align:center; 
            font-size: 11px; 
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
            font-size: 11px; 
            text-align:left; 
            font-weight: bold;
        }
        .notitles{
            font-size: 10px; 
            text-align:left; 
        }

        .celdaNormalBigBordeTop{
            text-align:center; 
            font-size: 11px; 
            border-top: 1px solid black; 
            padding: 0px!important;
        }
    </style>

</head>
<body>

    {{-- Pagina 1 --}}
    <div class="box" style="width: 27.5cm;">
        <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <th style="vertical-align: top;">
                    <div class="widget-user-image" style="padding: 0px!important;">
                        <table>
                            <tr>
                                <td><center>
                                    <img class="img-circle" src="{{ asset('images/escudo_nac.png') }}" alt="User Avatar" width="70px">
                                    </center>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 10px;">
                                    Ministerio de Educación
                                </td>
                            </tr>
                        </table>
                    </div>
                  </th>

                  <th style="text-align: center;">
                    <p style="font-size: 30px; font-weight:bolder; margin-bottom: 2px;">CONSTANCIA DE MATRÍCULA</p>
                  </th>

                  <th colspan="2"  style="width: 3cm;"></th>
            </tr>
        </table>

        <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <td class="celdaFondoGrisBold1" style="width: 25%;">ESTUDIANTE</td>
                <td class="celdaNormalBig" style="width: 15%;">
                    <div style="height:12px; overflow:hidden;">
                        @if($alumno !== null && $alumno->anio_ingreso !== null  && $alumno->codigo_modular !== null  && $alumno->numero_matricula !== null && $alumno->flag !== null)
                            {{strtoupper(strval($alumno->anio_ingreso))}}{{strtoupper(strval($alumno->codigo_modular))}}{{strtoupper(strval($alumno->numero_matricula))}}{{strtoupper(strval($alumno->flag))}}
                        @endif
                    </div>
                </td>
                <td class="celdaNormalBig" style="width: 60%;" colspan="4">
                    @if($alumno !== null && $alumno->fullNombre !== null)
                            {{strtoupper(strval($alumno->fullNombre))}}
                        @endif
                </td>
            </tr>
            <tr>
                <td class="celdaFondoGrisBold1">INSTITUCIÓN EDUCATIVA</td>
                <td class="celdaNormalBig">
                    <div style="height:12px; overflow:hidden;">
                        @if($institucionEductiva !== null && $institucionEductiva->codigo_modular !== null)
                            {{strtoupper(strval($institucionEductiva->codigo_modular))}}
                        @endif
                    </div>
                </td>
                <td class="celdaNormalBig"colspan="4">
                    @if($institucionEductiva !== null && $institucionEductiva->nombre !== null)
                        {{strtoupper(strval($institucionEductiva->nombre))}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaFondoGrisBold1">NIVEL EDUCATIVO</td>
                <td class="celdaNormalBig" colspan="2">
                    <div style="height:12px; overflow:hidden;">
                        @if($alumno !== null && $alumno->matricula !== null && $alumno->matricula->cicloNivel !== null && $alumno->matricula->cicloNivel->nombre !== null)
                            {{strtoupper(strval($alumno->matricula->cicloNivel->nombre))}}
                        @endif
                    </div>
                </td>
                <td class="celdaFondoGrisBold1">GRADO EDUCATIVO</td>
                <td class="celdaNormalBig" colspan="2">
                    @if($alumno !== null && $alumno->matricula !== null && $alumno->matricula->cicloGrado !== null && $alumno->matricula->cicloGrado->nombre !== null)
                        {{strtoupper(strval($alumno->matricula->cicloGrado->nombre))}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaFondoGrisBold1">SECCION</td>
                <td class="celdaNormalBig" colspan="2">
                    <div style="height:12px; overflow:hidden;">
                        @if($alumno !== null && $alumno->matricula !== null && $alumno->matricula->cicloSeccion !== null && $alumno->matricula->cicloSeccion->sigla !== null)
                            {{strtoupper(strval($alumno->matricula->cicloSeccion->sigla))}}
                        @endif
                    </div>
                </td>
                <td class="celdaFondoGrisBold1">TURNO</td>
                <td class="celdaNormalBig" colspan="2">
                    @if($alumno !== null && $alumno->matricula !== null && $alumno->matricula->turno !== null && $alumno->matricula->turno->nombre !== null)
                        {{(strval($alumno->matricula->turno->nombre))}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="celdaFondoGrisBold1">APODERADO</td>
                <td class="celdaNormalBig" colspan="3">
                    <div style="height:12px; overflow:hidden;">
                        @if($alumno !== null && $alumno->matricula !== null && $alumno->matricula->apoderadoMatricula !== null && $alumno->matricula->apoderadoMatricula->apellido_paterno !== null)
                            {{strtoupper(strval($alumno->matricula->apoderadoMatricula->apellido_paterno))}} 
                            {{strtoupper(strval($alumno->matricula->apoderadoMatricula->apellido_materno))}}
                            {{strtoupper(strval($alumno->matricula->apoderadoMatricula->nombres))}}
                        @endif
                    </div>
                </td>
                <td class="celdaFondoGrisBold1">VALIDADO</td>
                <td class="celdaNormalBig">
                    NO
                </td>
            </tr>

        </table>

        <table class="table" style="margin-top: 7cm; width:100%">
            <tr>
                <td style="width: 10cm;"></td>
                <td class="celdaNormalBigBordeTop">Director(a) | Sub Director(a) <br> Firma - Fecha y Sello</td>
                <td style="width: 10cm;"></td>
            </tr>
        </table>
    </div>

</body>
</html>