<!DOCTYPE html>
<html>
<head>
    <title>ASISTENCIA POR SESIONES</title>
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
            padding: 10px!important;
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
    
        .celdaNormalEsp{
            text-align:center; 
            font-size: 12px; 
            border: 1px solid black; 
            width: 0.5cm!important;
            height: 14px;
            padding: 2px!important;
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
        .celdaNormal{
            text-align:left; 
            font-size: 9px; 
            border: 0px; 
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
              <th style="vertical-align: top; width: 160px;" >
                <div class="widget-user-image" style="padding: 0px!important; width: 154.3px;" >
                    <table>
                        <tr>
                            <td class="celdaNormal"><center>
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

              <th style="text-align: center;" >
                <p style="font-size: 20px; font-weight:bolder; margin-top: 10px;">AÑO ESCOLAR -
                    {{$horarioSeccion->ciclo->year}}
                </p>
            </th>
            <th style="width: 163px;"></th>
            </tr>
        </table>

        <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <th style="text-align: center;">
                    <p style="font-size: 15px; font-weight:bolder; margin-top: 0px;">
                        CONTROL DE ASISTENCIA Y DESARROLLO DE SESIONES DE
                        {{strtoupper($horarioSeccion->ciclo_grado->nombre)}}
                        DEL NIVEL
                        {{strtoupper($horarioSeccion->ciclo_nivel->nombre)}}
                        SECCIÓN:
                        {{strtoupper($horarioSeccion->sigla)}} <br>
                        DESDE EL {{substr(strval($horarioSeccion->dia1),8,2)}}/{{substr(strval($horarioSeccion->dia1),5,2)}}/{{substr(strval($horarioSeccion->dia1),0,4)}}
                        HASTA EL {{substr(strval($horarioSeccion->dia5),8,2)}}/{{substr(strval($horarioSeccion->dia5),5,2)}}/{{substr(strval($horarioSeccion->dia5),0,4)}}
                    </p>
                </th>
            </tr>
        </table>

        <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <th class="celdaFondoGrisBold1" style="width: 10%">HORA</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Lunes {{substr(strval($horarioSeccion->dia1),8,2)}}/{{substr(strval($horarioSeccion->dia1),5,2)}}/{{substr(strval($horarioSeccion->dia1),0,4)}}</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Martes {{substr(strval($horarioSeccion->dia2),8,2)}}/{{substr(strval($horarioSeccion->dia2),5,2)}}/{{substr(strval($horarioSeccion->dia2),0,4)}}</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Miercoles {{substr(strval($horarioSeccion->dia3),8,2)}}/{{substr(strval($horarioSeccion->dia3),5,2)}}/{{substr(strval($horarioSeccion->dia3),0,4)}}</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Jueves {{substr(strval($horarioSeccion->dia4),8,2)}}/{{substr(strval($horarioSeccion->dia4),5,2)}}/{{substr(strval($horarioSeccion->dia4),0,4)}}</th>
                <th class="celdaFondoGrisBold1" style="width: 18%">Viernes {{substr(strval($horarioSeccion->dia5),8,2)}}/{{substr(strval($horarioSeccion->dia5),5,2)}}/{{substr(strval($horarioSeccion->dia5),0,4)}}</th>
            </tr>

            @foreach( $horas as $indexHora => $hora)
                <tr>
                    <td class="celdaNormalEsp">{{$hora->horaini}} - {{$hora->horafin}}</td>
                    <td class="celdaNormalEsp">
                        @if($hora->tipo == 1)
                            @foreach( $horarioSeccion->horarios as $indexHorario => $horario)
                                @if ($horario->dia_semana == 1 && $horario->hora_id == $hora->id && isset($horario->curso))
                                    {{$horario->curso->nombre}}
                                    @if(isset($horario->curso) && isset($horario->curso->asignacion) && isset($horario->curso->asignacion->docente))
                                        Docente: {{$horario->curso->asignacion->docente->nombre}} {{$horario->curso->asignacion->docente->apellidos}}<br>
                                    @else
                                        <div style="color:red!important;">Docente:  No Registrado</div>
                                    @endif

                                    @if(isset($horario->asistencia))
                                        Tema:  {{$horario->asistencia->tema}}<br>
                                        Asistentes: {{$horario->asistencia->cantAsistencia}}
                                    @else
                                        <div style="color:red!important;">Tema: Sin Registros</div>
                                        <div style="color:red!important;">Asistentes: Sin Registros</div>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            RECREO
                        @endif
                    </td>                               
                    <td class="celdaNormalEsp">
                        @if($hora->tipo == 1)
                            @foreach( $horarioSeccion->horarios as $indexHorario => $horario)
                                @if ($horario->dia_semana == 2 && $horario->hora_id == $hora->id && isset($horario->curso))
                                    {{$horario->curso->nombre}}
                                    @if(isset($horario->curso) && isset($horario->curso->asignacion) && isset($horario->curso->asignacion->docente))
                                        Docente: {{$horario->curso->asignacion->docente->nombre}} {{$horario->curso->asignacion->docente->apellidos}}<br>
                                    @else
                                        <div style="color:red!important;">Docente:  No Registrado</div>
                                    @endif

                                    @if(isset($horario->asistencia))
                                        Tema:  {{$horario->asistencia->tema}}<br>
                                        Asistentes: {{$horario->asistencia->cantAsistencia}}
                                    @else
                                        <div style="color:red!important;">Tema: Sin Registros</div>
                                        <div style="color:red!important;">Asistentes: Sin Registros</div>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            RECREO
                        @endif
                    </td>                               
                    <td class="celdaNormalEsp">
                        @if($hora->tipo == 1)
                            @foreach( $horarioSeccion->horarios as $indexHorario => $horario)
                                @if ($horario->dia_semana == 3 && $horario->hora_id == $hora->id && isset($horario->curso))
                                    {{$horario->curso->nombre}}
                                    @if(isset($horario->curso) && isset($horario->curso->asignacion) && isset($horario->curso->asignacion->docente))
                                        Docente: {{$horario->curso->asignacion->docente->nombre}} {{$horario->curso->asignacion->docente->apellidos}}<br>
                                    @else
                                            <div style="color:red!important;">Docente:  No Registrado</div>
                                    @endif

                                    @if(isset($horario->asistencia))
                                        Tema:  {{$horario->asistencia->tema}}<br>
                                        Asistentes: {{$horario->asistencia->cantAsistencia}}
                                    @else
                                        <div style="color:red!important;">Tema: Sin Registros</div>
                                        <div style="color:red!important;">Asistentes: Sin Registros</div>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            RECREO
                        @endif
                    </td>                               
                    <td class="celdaNormalEsp">
                        @if($hora->tipo == 1)
                            @foreach( $horarioSeccion->horarios as $indexHorario => $horario)
                                @if ($horario->dia_semana == 4 && $horario->hora_id == $hora->id && isset($horario->curso))
                                    {{$horario->curso->nombre}}
                                    @if(isset($horario->curso) && isset($horario->curso->asignacion) && isset($horario->curso->asignacion->docente))
                                        Docente: {{$horario->curso->asignacion->docente->nombre}} {{$horario->curso->asignacion->docente->apellidos}}<br>
                                    @else
                                            <div style="color:red!important;">Docente:  No Registrado</div>
                                    @endif

                                    @if(isset($horario->asistencia))
                                        Tema:  {{$horario->asistencia->tema}}<br>
                                        Asistentes: {{$horario->asistencia->cantAsistencia}}
                                    @else
                                        <div style="color:red!important;">Tema: Sin Registros</div>
                                        <div style="color:red!important;">Asistentes: Sin Registros</div>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            RECREO
                        @endif
                    </td>                               
                    <td class="celdaNormalEsp">
                        @if($hora->tipo == 1)
                            @foreach( $horarioSeccion->horarios as $indexHorario => $horario)
                                @if ($horario->dia_semana == 5 && $horario->hora_id == $hora->id && isset($horario->curso))
                                    {{$horario->curso->nombre}}
                                    @if(isset($horario->curso) && isset($horario->curso->asignacion) && isset($horario->curso->asignacion->docente))
                                        Docente: {{$horario->curso->asignacion->docente->nombre}} {{$horario->curso->asignacion->docente->apellidos}}<br>
                                    @else
                                            <div style="color:red!important;">Docente:  No Registrado</div>
                                    @endif

                                    @if(isset($horario->asistencia))
                                        Tema:  {{$horario->asistencia->tema}}<br>
                                        Asistentes: {{$horario->asistencia->cantAsistencia}}
                                    @else
                                        <div style="color:red!important;">Tema: Sin Registros</div>
                                        <div style="color:red!important;">Asistentes: Sin Registros</div>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            RECREO
                        @endif
                    </td>                               
                </tr>
            @endforeach
        </table>
    </div>
</body>