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
                            <p style="font-size: 11px; font-weight:bolder; margin-top:0px;">REPORTE DE CALIFICACIONES POR COMPETENCIAS - INDICADORES - {{$calificacionesAlumnoCurso->ciclo->year}}</p>

                            <table class="table" style="margin-bottom: 0px; width:100%">
                                <tr>
                                    <td class="celdaFondoGrisBold3" style="padding:1.5px!important; width: 25%">DRE</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important; width: 25%">DRE {{strtoupper($institucionEductiva->departamento)}}</td>
                                    <td class="celdaFondoGrisBold3" style="padding:1.5px!important; width: 25%">UGEL</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important; width: 25%">{{strtoupper($institucionEductiva->nombre_ugel)}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold3" style="padding:1.5px!important;">Nivel</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important;">{{$calificacionesAlumnoCurso->nivel->nombre}}</td>
                                    <td class="celdaFondoGrisBold3" style="padding:1.5px!important;">Código Modular</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important;">{{$institucionEductiva->codigo_modular}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold3" style="padding:1.5px!important;">Institución Educativa</td>
                                    <td colspan="3" class="celdaNormal3" style="padding:1.5px!important;">{{strtoupper($institucionEductiva->nombre)}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold3" style="padding:1.5px!important;">Grado</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important;">{{$calificacionesAlumnoCurso->grado->nombre}}</td>
                                    <td class="celdaFondoGrisBold3" style="padding:1.5px!important;">Sección</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important;">{{$calificacionesAlumnoCurso->seccion->sigla}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Apellidos y Nombres del Estudiante</td>
                                    <td colspan="3" class="celdaNormal3" style="padding:1.5px!important;">{{$calificacionesAlumnoCurso->matricula->apellido_paterno_alu}}
                                        {{$calificacionesAlumnoCurso->matricula->apellido_materno_alu}},
                                        {{$calificacionesAlumnoCurso->matricula->nombres_alu}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Código del Estudiante</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important;"></td>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">{{$calificacionesAlumnoCurso->matricula->sigla_tipodoc}}</td>
                                    <td class="celdaNormal3" style="padding:1.5px!important;">{{$calificacionesAlumnoCurso->matricula->num_documento_alu}}</td>
                                </tr>
                                <tr>
                                    <td class="celdaFondoGrisBold5L" style="padding:1.5px!important;">Área Curricular</td>
                                    <td colspan="3" class="celdaNormal3" style="padding:1.5px!important;">{{$calificacionesAlumnoCurso->curso->curso}}</td>
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
                            <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 10%">N°</td>
                            <td colspan="2" class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 40%">Item</td>

                            @if($calificacionesAlumnoCurso->ciclo->opcion == 1)
                                <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 12%">Primer Trimestre</td>
                                <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 12%">Segundo Trimestre</td>
                                <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 12%">Tercer Trimestre</td>
                                <td class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 14%">Promedio Final</td>

                            @elseif($calificacionesAlumnoCurso->ciclo->opcion == 2)
                                <th class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 9%">Primer Bimestre</th>  
                                <th class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 9%">Segundo Bimestre</th>  
                                <th class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 9%">Tercer Bimestre</th>  
                                <th class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 9%">Cuarto Bimestre</th>  
                                <th class="celdaFondoGrisBold3c" style="padding: 1.5px; width: 14%">Promedio Final</th> 
                            @endif
                        </tr>

                        @foreach ($calificacionesAlumnoCurso->curso->competencias as $indexC =>  $registro)
                            <tr>
                                <td rowspan="{{count($registro->indicadores) + 1}}" class="celdaNormal3" style="font-weight: bold; padding:1.5px!important;">Competencia {{$indexC+1}}.</td>
                                <td colspan="2" class="celdaNormal3" style="font-weight: bold; padding:1.5px!important;">{{$registro->nombre}}</td>

                                <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                  @if($registro->notaPrimerPeriodo != null)
                                    {{$registro->notaPrimerPeriodo->nota_num}}
                                  @else
                                    <div style="color:red;">P</div>
                                  @endif
                                </td>

                                <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                  @if($registro->notaSegundoPeriodo != null)
                                    {{$registro->notaSegundoPeriodo->nota_num}}
                                  @else
                                    <div style="color:red;">P</div>
                                  @endif
                                </td>

                                <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                  @if($registro->notaTercerPeriodo != null)
                                    {{$registro->notaTercerPeriodo->nota_num}}
                                  @else
                                    <div style="color:red;">P</div>
                                  @endif
                                </td>

                                @if($calificacionesAlumnoCurso->ciclo->opcion == 2)
                                    <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                    @if($registro->notaCuartoPeriodo != null)
                                        {{$registro->notaCuartoPeriodo->nota_num}}
                                    @else
                                        <div style="color:red;">P</div>
                                    @endif
                                    </td>
                                @endif

                                <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                    @if($registro->notaFinal != null)
                                      {{$registro->notaFinal->nota_num}}
                                    @else
                                      <div style="color:red;">P</div>
                                    @endif
                                </td>
                            </tr>

                            @foreach ($registro->indicadores as $indexI =>  $indicador)

                                <tr>
                                    <td class="celdaNormal3" style="width: 10%; padding:1.5px!important;">Indicador {{$indexI+1}}.</td>
                                    <td class="celdaNormal3" style="width: 25%; padding:1.5px!important;">{{$indicador->nombre}}</td>

                                    <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                        @if($indicador->notaPrimerPeriodo != null)
                                            {{$indicador->notaPrimerPeriodo->nota_num}}
                                        @else
                                            <div style="color:red;">P</div>
                                        @endif
                                    </td>

                                    <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                        @if($indicador->notaSegundoPeriodo != null)
                                            {{$indicador->notaSegundoPeriodo->nota_num}}
                                        @else
                                            <div style="color:red;">P</div>
                                        @endif
                                    </td>

                                    <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                        @if($indicador->notaTercerPeriodo != null)
                                            {{$indicador->notaTercerPeriodo->nota_num}}
                                        @else
                                            <div style="color:red;">P</div>
                                        @endif
                                    </td>

                                    @if($calificacionesAlumnoCurso->ciclo->opcion == 2)
                                        <td class="celdaNormal3" style="text-align: center; padding:1.5px!important;">
                                            @if($indicador->notaCuartoPeriodo != null)
                                                {{$indicador->notaCuartoPeriodo->nota_num}}
                                            @else
                                                <div style="color:red;">P</div>
                                            @endif
                                        </td>

                                    @endif

                                    <td class="celdaNormal3" style="text-align: center; font-weight:bold; padding:1.5px!important;">
                                        @if($indicador->notaFinal != null)
                                            {{$indicador->notaFinal->nota_num}}
                                        @else
                                            <div style="color:red;">P</div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                              @if($calificacionesAlumnoCurso->ciclo->opcion == 1)
                                <td colspan="7"> <div style="height: 5px;"></div></td>
                              @elseif($calificacionesAlumnoCurso->ciclo->opcion == 2)
                                <td colspan="8"> <div style="height: 5px;"></div></td>
                              @endif
                            </tr>
                        @endforeach

                          <tr>
                            <td colspan="3" class="celdaNormal3" style="font-weight: bold; text-align:center; padding:1.5px!important;">Promedio Final</td>

                            <td class="celdaNormal3" style="text-align: center; font-weight:bold; padding:1.5px!important;">
                                @if($calificacionesAlumnoCurso->curso->notaPrimerPeriodo != null)
                                    {{$indicador->notaPrimerPeriodo->nota_num}}
                                @else
                                    <div style="color:red;">P</div>
                                @endif
                            </td>

                            <td class="celdaNormal3" style="text-align: center; font-weight:bold; padding:1.5px!important;">
                                @if($calificacionesAlumnoCurso->curso->notaSegundoPeriodo != null)
                                    {{$indicador->notaSegundoPeriodo->nota_num}}
                                @else
                                    <div style="color:red;">P</div>
                                @endif
                            </td>

                            <td class="celdaNormal3" style="text-align: center; font-weight:bold; padding:1.5px!important;">
                                @if($calificacionesAlumnoCurso->curso->notaTercerPeriodo != null)
                                    {{$indicador->notaTercerPeriodo->nota_num}}
                                @else
                                    <div style="color:red;">P</div>
                                @endif
                            </td>

                            @if($calificacionesAlumnoCurso->ciclo->opcion == 2)
                              <td class="celdaNormal3" style="text-align: center; font-weight:bold; padding:1.5px!important;">
                                @if($calificacionesAlumnoCurso->curso->notaCuartoPeriodo != null)
                                    {{$indicador->notaCuartoPeriodo->nota_num}}
                                @else
                                    <div style="color:red;">P</div>
                                @endif
                              </td>
                            @endif

                            <td class="celdaNormal3" style="text-align: center; font-weight:bold; padding:1.5px!important;">
                                @if($calificacionesAlumnoCurso->curso->notaFinal != null)
                                    {{$indicador->notaFinal->nota_num}}
                                @else
                                    <div style="color:red;">P</div>
                                @endif
                            </td>
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