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
        .celdaNormal6NoBorder{
            text-align:center; 
            font-size: 7px; 
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
                <td style="width: 50%;" valign="top">

                    <table class="table" style="margin-bottom: 0px; width:96%">
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
                            <p style="font-size: 11px; font-weight:bolder; margin-top:0px;">INFORME DE PROGRESO DEL APRENDIZAJE DEL ESTUDIANTE - {{$calificacionesAlumno->ciclo->year}}</p>

                            <table class="table" style="margin-bottom: 0px; width:100%">
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important; width: 25%">DRE</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important; width: 25%">DRE {{strtoupper($institucionEductiva->departamento)}}</td>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important; width: 25%">UGEL</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important; width: 25%">{{strtoupper($institucionEductiva->nombre_ugel)}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Nivel</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important;">{{$calificacionesAlumno->nivel->nombre}}</td>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Código Modular</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important;">{{$institucionEductiva->codigo_modular}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Institución Educativa</td>
                                    <td colspan="3" class="celdaNormal6" style="padding:1.5px!important;">{{strtoupper($institucionEductiva->nombre)}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Grado</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important;">{{$calificacionesAlumno->grado->nombre}}</td>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Sección</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important;">{{$calificacionesAlumno->seccion->sigla}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Apellidos y Nombres del Estudiante</td>
                                    <td colspan="3" class="celdaNormal6" style="padding:1.5px!important;">{{$calificacionesAlumno->matricula->apellido_paterno_alu}}
                                        {{$calificacionesAlumno->matricula->apellido_materno_alu}},
                                        {{$calificacionesAlumno->matricula->nombres_alu}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Código del Estudiante</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">{{$calificacionesAlumno->matricula->sigla_tipodoc}}</td>
                                    <td class="celdaNormal6" style="padding:1.5px!important;">{{$calificacionesAlumno->matricula->num_documento_alu}}</td>
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


                    <table class="table" style="margin-bottom: 0px; width:96%; margin-top:7px;">
                        <tr>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 15.75%">ÁREA CURRICULAR</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 27%">COMPETENCIAS</td>
                            <td colspan="3" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 18.75%">CALIFICATIVO POR PERIODO</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">Calif. anual de Comp</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">Calif. anual de Área</td>
                            <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 26%">Conclusión descriptiva de final del periodo lectivo</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">1</td>
                            <td class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">2</td>
                            <td class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">3</td>
                        </tr>

                        @foreach ($calificacionesAlumno->matricula->cursos as $key =>  $curso)
                            @if($key < 8)
                                @php
                                    $flag = true;
                                @endphp

                                    @foreach ($curso->competencias as $keyC =>  $competencia)
                                        <tr>
                                            @if($flag)
                                                <td class="celdaNormal6" rowspan="{{count($curso->competencias)}} + 1" style="font-weight: padding:1.5px!important;">{{$curso->curso}}</td>
                                            @endif

                                            <td class="celdaNormal6" style="padding:1.5px!important;"> {{$competencia->nombre}}</td>
                                            <td class="celdaNormal6" style="padding:1.5px!important;">
                                                @if($competencia->notaPrimerPeriodo != null)
                                                    {{$competencia->notaPrimerPeriodo->nota_num}}
                                                @endif
                                            </td>
                                            <td class="celdaNormal6" style="padding:1.5px!important;">
                                                @if($competencia->notaSegundoPeriodo != null)
                                                    {{$competencia->notaSegundoPeriodo->nota_num}}
                                                @endif
                                            </td>
                                            <td class="celdaNormal6" style="padding:1.5px!important;">
                                                @if($competencia->notaTercerPeriodo != null)
                                                    {{$competencia->notaTercerPeriodo->nota_num}}
                                                @endif
                                            </td>
                                            <td class="celdaNormal6" style="padding:1.5px!important;">
                                                @if($competencia->notaFinal != null)
                                                    {{$competencia->notaFinal->nota_num}}
                                                @endif
                                            </td>

                                            @if($flag)
                                                <td class="celdaNormal6" rowspan="{{count($curso->competencias)}} + 1" style="font-weight: bold; padding:1.5px!important;">
                                                    @if($curso->notaFinal != null)
                                                        {{$competencia->notaFinal->nota_num}}
                                                    @endif
                                                </td>
                                                <td class="celdaNormal6" rowspan="{{count($curso->competencias)}} + 1" style="font-weight: bold; padding:1.5px!important;"></td>
                                            @endif
                                        </tr>
                                        @php
                                            $flag = false;
                                        @endphp
                                    @endforeach
                            @endif
                        @endforeach

                    </table>

                </td>
                
                <td style="width: 50%" valign="top">

                    
                    <table class="table" style="width:96%; margin-top:7px; float: right;">
                        <tr>
                            <td>
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 15.75%">ÁREA CURRICULAR</td>
                                        <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 27%">COMPETENCIAS</td>
                                        <td colspan="3" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 18.75%">CALIFICATIVO POR PERIODO</td>
                                        <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">Calif. anual de Comp</td>
                                        <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">Calif. anual de Área</td>
                                        <td rowspan="2" class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 26%">Conclusión descriptiva de final del periodo lectivo</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">1</td>
                                        <td class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">2</td>
                                        <td class="celdaFondoGrisBold6" style="padding:1.5px!important; width: 6.25%">3</td>
                                    </tr>
            
                                    @foreach ($calificacionesAlumno->matricula->cursos as $key =>  $curso)
                                        @if($key >= 8)
                                            @php
                                                $flag = true;
                                            @endphp
            
                                                @foreach ($curso->competencias as $keyC =>  $competencia)
                                                    <tr>
                                                        @if($flag)
                                                            <td class="celdaNormal6" rowspan="{{count($curso->competencias)}} + 1" style="font-weight: padding:1.5px!important;">{{$curso->curso}}</td>
                                                        @endif
            
                                                        <td class="celdaNormal6" style="padding:1.5px!important;"> {{$competencia->nombre}}</td>
                                                        <td class="celdaNormal6" style="padding:1.5px!important;">
                                                            @if($competencia->notaPrimerPeriodo != null)
                                                                {{$competencia->notaPrimerPeriodo->nota_num}}
                                                            @endif
                                                        </td>
                                                        <td class="celdaNormal6" style="padding:1.5px!important;">
                                                            @if($competencia->notaSegundoPeriodo != null)
                                                                {{$competencia->notaSegundoPeriodo->nota_num}}
                                                            @endif
                                                        </td>
                                                        <td class="celdaNormal6" style="padding:1.5px!important;">
                                                            @if($competencia->notaTercerPeriodo != null)
                                                                {{$competencia->notaTercerPeriodo->nota_num}}
                                                            @endif
                                                        </td>
                                                        <td class="celdaNormal6" style="padding:1.5px!important;">
                                                            @if($competencia->notaFinal != null)
                                                                {{$competencia->notaFinal->nota_num}}
                                                            @endif
                                                        </td>
            
                                                        @if($flag)
                                                            <td class="celdaNormal6" rowspan="{{count($curso->competencias)}} + 1" style="font-weight: bold; padding:1.5px!important;">
                                                                @if($curso->notaFinal != null)
                                                                    {{$competencia->notaFinal->nota_num}}
                                                                @endif
                                                            </td>
                                                            <td class="celdaNormal6" rowspan="{{count($curso->competencias)}} + 1" style="font-weight: bold; padding:1.5px!important;"></td>
                                                        @endif
                                                    </tr>
                                                    @php
                                                        $flag = false;
                                                    @endphp
                                                @endforeach
                                        @endif
                                    @endforeach
            
                                </table>
            
                                <table class="table" style="margin-bottom: 0px; width:100%; margin-top:25px;">
                                    <tr>
                                        <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 10%">Periodo</td>
                                        <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 35%">Competencia</td>
                                        <td class="celdaNormal6" style="text-align:center;  font-weight:bold; padding:1.5px!important; width: 55%">Conclusión Descriptiva</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"><div style="height: 14px;"></div></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"><div style="height: 14px;"></div></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"><div style="height: 14px;"></div></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                    </tr>
                                </table>

                                <table class="table" style="margin-bottom: 0px; width:100%; margin-top:25px;">
                                    <tr>
                                        <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 10%">Periodo</td>
                                        <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 90%">Conclusión Descriptiva por Periodo</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal6" style="text-align:center; padding:1.5px!important;" valign="middle"><div style="height: 12px;">1</div></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal6" style="text-align:center; padding:1.5px!important;" valign="middle"><div style="height: 12px;">2</div></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal6" style="text-align:center; padding:1.5px!important;" valign="middle"><div style="height: 12px;">3</div></td>
                                        <td class="celdaNormal6" style="padding:1.5px!important;"></td>
                                    </tr>
                                </table>


                                <table class="table" style="margin-bottom: 0px; width:100%; margin-top:25px;">

                                    <tr>
                                        <td class="celdaNormal6NoBorder" style="text-align:center; width:50%" valign="top">

                                            <b>Resumen de asistencia del Estudiante</b>

                                            <table class="table" style="margin-bottom: 0px; width:100%; margin-top:10px;">
                                                <tr>
                                                    <td rowspan="2" class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 16%">Periodo</td>
                                                    <td colspan="2" class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 42%">Inasistencias</td>
                                                    <td colspan="2" class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 42%">Tardanzas</td>
                                                </tr>
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%">Justificadas</td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%">Injustificadas</td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%">Justificadas</td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%">Injustificadas</td>
                                                </tr>
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 16%">1</td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                </tr>
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 16%">2</td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                </tr>
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 16%">3</td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 21%"></td>
                                                </tr>
                                            </table>

                                        </td>

                                        <td  style="text-align:center; width:5%" valign="top">
                                        </td>

                                        <td class="celdaNormal6NoBorder" style="text-align:center; width:45%" valign="top">
                                            <b>ESCALA DE CALIFICACIONES DEL CNEB</b>

                                            <table class="table" style="margin-bottom: 0px; width:100%; margin-top:10px;">
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important; width: 5%">AD</td>
                                                    <td class="celdaNormal6" style="text-align:left; font-weight:normal; padding:1.5px!important; width: 95%">
                                                    Logro destacado <br>
                                                    Cuando el estudiante evidencia un nivel superior a lo esperado respecto a la competencia. 
                                                    Esto quiere decir que demuestra aprendizajes que van más allá del nivel esperado.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important;">A</td>
                                                    <td class="celdaNormal6" style="text-align:left; font-weight:normal; padding:1.5px!important;">
                                                    Logro esperado <br>
                                                    Cuando el estudiante evidencia el nivel esperado respecto a la competencia, demostrando 
                                                    manejo satisfactorio en todas las tareas propuestas y en el tiempo programado.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important;">B</td>
                                                    <td class="celdaNormal6" style="text-align:left; font-weight:normal; padding:1.5px!important;">
                                                    En proceso <br>
                                                    Cuando el estudiante está próximo o cerca al nivel esperado respecto a la competencia, para
                                                    lo cual requiere acompañamiento durante un tiempo razonable para lograrlo.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="celdaNormal6" style="text-align:center; font-weight:bold; padding:1.5px!important;">B</td>
                                                    <td class="celdaNormal6" style="text-align:left; font-weight:normal; padding:1.5px!important;">
                                                    En inicio <br>
                                                    Cuando el estudiante muestra un progreso mínimo en una competencia de acuerdo al nivel esperado.
                                                    Evidencia con frecuencia dificultades en el desarrollo de las tareas, por lo que necesita mayor tiempo de
                                                    acompañamiento e intervención del docente.
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>



                                <table class="table" style="margin-bottom: 0px; width:100%; margin-top:100px;">
                                    <td style="width: 13%;"></td>
                                    <td style="width: 30.5%; text-align:center;font-size: 8px; border-top: 1px solid black;">Firma y sello del Docente o Tutor(a)</td>
                                    <td style="width: 13%;"></td>
                                    <td style="width: 30.5%; text-align:center;font-size: 8px; border-top: 1px solid black;">Firma y sello del Director(a)</td>
                                    <td style="width: 13%;"></td>
                                </table>
            
                            </td>
                        </tr>

                    

                   

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