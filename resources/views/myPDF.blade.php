<!DOCTYPE html>
<html>
<head>
    <title>FICHA ÚNICA DE MATRICULA</title>
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
        height: 10.4px
    }
    .celdaNormal6{
        text-align:left; 
        font-size: 7px; 
        border: 1px solid black; 
        padding: 0px!important;
        height: 9px;
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
                <p style="font-size: 30px; font-weight:bolder; margin-bottom: 2px;">FICHA ÚNICA DE MATRÍCULA</p>
              </th>
              <th rowspan="2"  style="width: 7cm;">
                   <table style="width: 100%;" class="table">
                    <tr>
                        <td colspan="14" class="celdaFondoGrisBold1">N° de DNI o Código del Estudiante</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="celdaFondoGrisBold2">D.N.I.</td>
                        <td colspan="2" class="celdaNormalBig"></td>
                        <td class="celdaFondoGrisBold2">C.E</td>
                        <td colspan="2" class="celdaNormalBig"></td>
                        <td colspan="2" class="celdaFondoGrisBold2">Otro</td>
                        <td class="celdaNormal" class="celdaNormalBig">X</td>
                        <td colspan="4" class="celdaFondoGrisBold2">Especificar</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="celdaFondoGrisBold2"></td>
                        <td class="celdaNormal"></td>
                        <td class="celdaNormal"></td>
                        <td class="celdaNormal"></td>
                        <td class="celdaNormal"></td>
                        <td class="celdaNormal"></td>
                        <td class="celdaNormal"></td>
                        <td class="celdaNormal"></td>
                        <td class="celdaNormal"></td>
                        <td colspan="4" class="celdaNormal"></td>
                    </tr>
                    <tr>
                        <td colspan="10" class="celdaFondoGrisBold1">Código del Estudiante</td>
                        <td colspan="4" class="celdaFondoGrisBold1"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="celdaFondoGrisBold2 vertical"><div class="verti">Año de ingreso</div></td>
                        <td colspan="7" class="celdaFondoGrisBold2 vertical"><div class="verti">Código modular de la Institución Educativa donde ingresó</div></td>
                        <td colspan="4" class="celdaFondoGrisBold2 vertical"><div class="verti">N° de Matrícula generado por la Institución Educativa</div></td>
                        <td class="celdaFondoGrisBold2 vertical"><div class="verti">Flag</div></td>
                    </tr>
                    <tr>
                        
                        <td class="celdaNormal">1</td>
                        <td class="celdaNormal">3</td>
                        <td class="celdaNormal">0</td>
                        <td class="celdaNormal">5</td>
                        <td class="celdaNormal">9</td>
                        <td class="celdaNormal">4</td>
                        <td class="celdaNormal">8</td>
                        <td class="celdaNormal">3</td>
                        <td class="celdaNormal">8</td>
                        <td class="celdaNormal">0</td>
                        <td class="celdaNormal">0</td>
                        <td class="celdaNormal">1</td>
                        <td class="celdaNormal">2</td>
                        <td class="celdaNormal">8</td>
                    </tr>
                    <tr >
                        <td colspan="14" style="font-size: 9px; font-weight:normal; text-align:left;">
                            (El código del Estudiante se anotará solo en caso de que el estudiante no
                            tenga DNI. Este número será el único que utilizará durante su
                            permanencia en el Sistema Educativo)
                        </td>
                    </tr>
                </table>

              </th>
            </tr>
            <tr>
                <th colspan="2">
                    <table class="table" style="width: 100%;">
                        <tr>
                            <td class="titles">1. Datos Generales del Estudiante</td>
                        </tr>
                        <tr>
                            <td class="titles">1.1 Datos Personales</td>
                        </tr>
                        <tr>
                            <td>
                                <table class="table" style="width: 95%;">
                                    <tr>
                                        <td class="celdaFondoGrisBold1" style="width: 20%;">Apellido Paterno</td>
                                        <td class="celdaFondoGrisBold1" style="width: 20%;">Apellido Materno</td>
                                        <td class="celdaFondoGrisBold1" style="width: 25%;">Nombres</td>
                                        <td colspan="4" class="celdaFondoGrisBold1" style="width: 10%;">Sexo</td>
                                        <td class="celdaFondoGrisBold1" style="width: 15%;">Estado Civil(1)</td>
                                        <td colspan="4" class="celdaFondoGrisBold1" style="font-size: 10px; width: 10%;">Nacimiento Registrado</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormalBig">TUTUSIMA</td>
                                        <td class="celdaNormalBig">TANANTA</td>
                                        <td class="celdaNormalBig">ERICK</td>
                                        <td class="celdaFondoGrisBold2">H</td>
                                        <td class="celdaNormalBig" style="min-width:0.3cm!important;">X</td>
                                        <td class="celdaFondoGrisBold2">M</td>
                                        <td class="celdaNormalBig" style="min-width:0.3cm!important;"></td>
                                        <td class="celdaNormalBig">SOLTERO</td>
                                        <td class="celdaFondoGrisBold2">Si</td>
                                        <td class="celdaNormalBig" style="min-width:0.3cm!important;"></td>
                                        <td class="celdaFondoGrisBold2">No</td>
                                        <td class="celdaNormalBig" style="min-width:0.3cm!important;">X</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    
                </th>
            </tr>
          </table>


          <table class="table" style="margin-bottom: 0px; width:100%">
            <tr>
                <td style="width: 60%;">
                    <table class="table" style="margin-bottom: 0px; width:100%">
                        <tr>
                            <td class="celdaNormalBig2">
                                <table class="table" style="margin-bottom: 0px; width:100%">
                                    <tr>
                                        <td rowspan="2" class="celdaFondoGrisBold3" style="width: 20%">Fecha de Nacimiento</td>
                                        <td class="celdaFondoGrisBold3" style="width: 6%">Dia</td>
                                        <td class="celdaFondoGrisBold3" style="width: 6%">Mes</td>
                                        <td class="celdaFondoGrisBold3" style="width: 8%">Año</td>
                                        <td rowspan="2" class="celdaFondoGrisBold3" style="width: 20%">Lengua Materna</td>
                                        <td rowspan="2" colspan="12" class="celdaNormalBig2" style="width: 40%">CASTELLANO</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormalBig2">03</td>
                                        <td class="celdaNormalBig2">12</td>
                                        <td class="celdaNormalBig2">2008</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaFondoGrisBold3">Lugar de Nacimiento</td>
                                        <td colspan="3" class="celdaFondoGrisBold3"></td>
                                        <td class="celdaFondoGrisBold3">Segunda Lengua</td>
                                        <td colspan="12" class="celdaNormalBig2">NINGUNO</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaFondoGrisBold3">País</td>
                                        <td colspan="3" class="celdaNormalBig2">Perú</td>
                                        <td class="celdaFondoGrisBold3">Religión</td>
                                        <td colspan="12" class="celdaNormalBig2"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaFondoGrisBold3">Departamento</td>
                                        <td colspan="3" class="celdaNormalBig2">UCAYALI</td>
                                        <td class="celdaFondoGrisBold3">Número de hermanos</td>
                                        <td colspan="3" class="celdaNormalBig2"></td>
                                        <td colspan="4" class="celdaFondoGrisBold3">Lugar que Ocupa</td>
                                        <td colspan="5" class="celdaNormalBig2"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaFondoGrisBold3">Provincia</td>
                                        <td colspan="3" class="celdaNormalBig2">CORONEL PORTILLO</td>
                                        <td class="celdaFondoGrisBold3">Tipo de Discapacidad(3)</td>
                                        <td class="celdaFondoGrisBold3">DI</td>
                                        <td class="celdaNormalBig2" style="min-width:0.3cm!important;"></td>
                                        <td class="celdaFondoGrisBold3">DA</td>
                                        <td class="celdaNormalBig2" style="min-width:0.3cm!important;"></td>
                                        <td class="celdaFondoGrisBold3">DV</td>
                                        <td class="celdaNormalBig2" style="min-width:0.3cm!important;"></td>
                                        <td class="celdaFondoGrisBold3">DM</td>
                                        <td class="celdaNormalBig2" style="min-width:0.3cm!important;"></td>
                                        <td class="celdaFondoGrisBold3">SC</td>
                                        <td class="celdaNormalBig2" style="min-width:0.3cm!important;"></td>
                                        <td class="celdaFondoGrisBold3">OT</td>
                                        <td class="celdaNormalBig2" style="min-width:0.3cm!important;"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaFondoGrisBold3">Distrito</td>
                                        <td colspan="3" class="celdaNormalBig2">CALLERIA</td>
                                        <td class="celdaFondoGrisBold3">Certif. de discapacidad * </td>
                                        <td colspan="4" class="celdaFondoGrisBold3">Tiene:</td>
                                        <td colspan="2" class="celdaNormalBig2"></td>
                                        <td colspan="4" class="celdaFondoGrisBold3">No tiene:</td>
                                        <td colspan="2" class="celdaNormalBig2">X</td>
                                    </tr>

                                </table>
                            </td>
                        </tr>
                    </table>
                </td>


                <td style="width: 40%">
                    <table class="table" style="margin-bottom: 0px; width:100%">
                        <tr>
                            <td class="titles">1.1.1 Desarrollo del Estudiante</td>
                            <td class="notitles" style="font-size: 10px;">(Obligatorio para nivel inicial)</td>
                        </tr>
                        <tr>
                            <td style="width: 40%"> 
                                <table class="table" style="margin-bottom: 0px; width:99%">
                                    <tr>
                                        <td colspan="3" class="notitles" style="font-size: 10px;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="celdaFondoGrisBold3" style="text-align: center;">Nacimiento</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaFondoGrisBold3" style="text-align: center;" style="width: 34%;">Normal</td>
                                        <td class="celdaNormal3" style="width: 9%;"></td>
                                        <td class="celdaFondoGrisBold3" style="text-align: center;" style="width: 48%;">Cesárea</td>
                                        <td class="celdaNormal3" style="width: 9%;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="celdaFondoGrisBold3" style="text-align: center;">Con complicaciones</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="celdaFondoGrisBold3" style="text-align: center;">Observaciones</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="celdaNormal3" style="height: 1.7cm;">Observaciones</td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 60%"> 
                                <table class="table" style="margin-bottom: 0px; width:100%">
                                    <tr>
                                        <td class="celdaFondoGrisBold3" style="text-align: center; width: 25%;">Aspecto</td>
                                        <td class="celdaFondoGrisBold3" style="text-align: center; width: 50%;">Actividad</td>
                                        <td class="celdaFondoGrisBold3" style="text-align: center; width: 25%;">Edad</td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3" rowspan="6">Psicomotriz</td>
                                        <td class="celdaNormal3">Levantó la cabeza</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3">Se sentó</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3">Gateó</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3">Se paró</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3">Caminó</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3">Controló su esfínteres</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3" rowspan="2">Lenguaje</td>
                                        <td class="celdaNormal3">Habló las primeras palabras</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                    <tr>
                                        <td class="celdaNormal3">Habló con fluidez</td>
                                        <td class="celdaNormal3"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
          </table>



          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0cm;">
            <tr>
                <td class="titles" style="width: 62%">1.1.2 Controles de Salud del Estudiante</td>
                <td class="titles" style="width: 38%">1.1.3 Estado de salud del Estudiante.</td>
            </tr>
            <tr>
                <td>
                    <table class="table" style="margin-bottom: 0px; width:99%;">
                        <tr>
                            <td colspan="6" class="celdaFondoGrisBold3c">Control de Peso - Talla</td>
                            <td colspan="5" class="celdaFondoGrisBold3c">Otros controles</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="celdaFondoGrisBold3c">Fecha</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Peso</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Talla</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Observaciones</td>
                            <td colspan="3" class="celdaFondoGrisBold3c">Fecha</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Tipo de Control</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Resultado</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold3c">Día</td>
                            <td class="celdaFondoGrisBold3c">Mes</td>
                            <td class="celdaFondoGrisBold3c">Año</td>
                            <td class="celdaFondoGrisBold3c">Día</td>
                            <td class="celdaFondoGrisBold3c">Mes</td>
                            <td class="celdaFondoGrisBold3c">Año</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="width: 7%; height:12px;"></td>
                            <td class="celdaNormal3" style="width: 7%;"></td>
                            <td class="celdaNormal3" style="width: 7%;"></td>
                            <td class="celdaNormal3" style="width: 7%;"></td>
                            <td class="celdaNormal3" style="width: 7%;"></td>
                            <td class="celdaNormal3" style="width: 24%;"></td>
                            <td class="celdaNormal3" style="width: 7%;"></td>
                            <td class="celdaNormal3" style="width: 7%;"></td>
                            <td class="celdaNormal3" style="width: 7%;"></td>
                            <td class="celdaNormal3" style="width: 10%;"></td>
                            <td class="celdaNormal3" style="width: 10%;"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:12px;"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:12px;"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:12px;"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:12px;"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td colspan="2" class="celdaFondoGrisBold3c">Enfermedades sufridas</td>
                            <td colspan="2" class="celdaFondoGrisBold3c">Vacunas</td>
                            <td colspan="2" class="celdaFondoGrisBold3c">Alergias</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold3c">Edad aprox.</td>
                            <td class="celdaFondoGrisBold3c">Enfermedad</td>
                            <td class="celdaFondoGrisBold3c">Edad aprox.</td>
                            <td class="celdaFondoGrisBold3c">Vacuna</td>
                            <td rowspan="2" colspan="2" class="celdaNormal3"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:12px;"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td colspan="2" class="celdaNormal3">Experiencias Traumáticas</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:12px;"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td rowspan="2" colspan="2" class="celdaNormal3"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:12px;"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                            <td class="celdaNormal3"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="width:10%;"></td>
                            <td class="celdaNormal3" style="width:20%;"></td>
                            <td class="celdaNormal3" style="width:10%;"></td>
                            <td class="celdaNormal3" style="width:20%;"></td>
                            <td class="celdaNormal3" style="width:20%;">Tipo de sangre</td>
                            <td class="celdaNormal3" style="width:20%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
          </table>











          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0cm;">
            <tr>
                <td class="titles" style="width: 64%">1.2 Datos del domicilio del Estudiante</td>
                <td class="titles" style="width: 36%">1.3 Datos de los padres</td>
            </tr>
            <tr>
                <td>
                    <table class="table" style="margin-bottom: 0px; width:99%;">
                        <tr>
                            <td class="celdaFondoGrisBold3c" style="width: 7%;">Año</td>
                            <td class="celdaFondoGrisBold3c" style="width: 22%;">Dirección</td>
                            <td class="celdaFondoGrisBold3c" style="width: 19%;">Lugar</td>
                            <td class="celdaFondoGrisBold3c" style="width: 14%;">Departamento</td>
                            <td class="celdaFondoGrisBold3c" style="width: 14%;">Provincia</td>
                            <td class="celdaFondoGrisBold3c" style="width: 14%;">Distrito</td>
                            <td class="celdaFondoGrisBold3c" style="width: 10%;">Teléfono</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:7px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                      
                    </table>
                </td>
                <td>
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td class="celdaFondoGrisBold4">Datos</td>
                            <td colspan="4" class="celdaFondoGrisBold4">Padre</td>
                            <td colspan="4" class="celdaFondoGrisBold4">Madre</td>
                            
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Apellido Paterno</td>
                            <td colspan="4" class="celdaNormal4"></td>
                            <td colspan="4" class="celdaNormal4">TANANTA</td>                           
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Apellido Materno</td>
                            <td colspan="4" class="celdaNormal4"></td>
                            <td colspan="4" class="celdaNormal4">ZAMANES</td>                           
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Nombres</td>
                            <td colspan="4" class="celdaNormal4"></td>
                            <td colspan="4" class="celdaNormal4">ALI CANDI</td>                           
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L" style="width: 32%">Vive</td>
                            <td class="celdaFondoGrisBold4L" style="width: 8.5%">Si</td>
                            <td class="celdaNormal4" style="width: 8.5%"></td>
                            <td class="celdaFondoGrisBold4L" style="width: 8.5%">No</td>
                            <td class="celdaNormal4" style="width: 8.5%"></td>
                            <td class="celdaFondoGrisBold4L" style="width: 8.5%">Si</td>
                            <td class="celdaNormal4" style="width: 8.5%"></td>
                            <td class="celdaFondoGrisBold4L" style="width: 8.5%">No</td>
                            <td class="celdaNormal4" style="width: 8.5%"></td>                         
                        </tr>
                        <tr>
                            <td rowspan="2" class="celdaFondoGrisBold4L">Fecha de Nacimiento</td>
                            <td class="celdaFondoGrisBold4L">Día</td>
                            <td class="celdaFondoGrisBold4L">Mes</td>
                            <td colspan="2" class="celdaFondoGrisBold4L">Año</td>
                            <td class="celdaFondoGrisBold4L">Día</td>
                            <td class="celdaFondoGrisBold4L">Mes</td>
                            <td colspan="2" class="celdaFondoGrisBold4L">Año</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal4"></td>
                            <td class="celdaNormal4"></td>
                            <td colspan="2" class="celdaNormal4"></td>
                            <td class="celdaNormal4">21</td>
                            <td class="celdaNormal4">05</td>
                            <td colspan="2" class="celdaNormal4">1993</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Grado de Instruccion</td>
                            <td colspan="4" class="celdaNormal4"></td>
                            <td colspan="4" class="celdaNormal4">SECUNDARIA INCOMPLETA</td>                           
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Ocupación</td>
                            <td colspan="4" class="celdaNormal4"></td>
                            <td colspan="4" class="celdaNormal4">Ama de Casa</td>                           
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Vive con el Estudiante</td>
                            <td class="celdaFondoGrisBold4L">Si</td>
                            <td class="celdaNormal4"></td>
                            <td class="celdaFondoGrisBold4L">No</td>
                            <td class="celdaNormal4"></td>
                            <td class="celdaFondoGrisBold4L">Si</td>
                            <td class="celdaNormal4"></td>
                            <td class="celdaFondoGrisBold4L">No</td>
                            <td class="celdaNormal4"></td>                         
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Religión</td>
                            <td colspan="4" class="celdaNormal4"></td>
                            <td colspan="4" class="celdaNormal4">OTRA</td>                           
                        </tr>

                    </table>
                </td>
            </tr>
          </table>


















          



          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0cm;">
            <tr>
                <td class="titles" style="width: 50%">1.4 Datos de la situación laboral de los estudiantes que trabajan</td>
                <td class="titles" style="width: 50%"></td>
            </tr>
            <tr>
                <td>
                    <table class="table" style="margin-bottom: 0px; width:99%;">
                        <tr>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Año</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Edad</td>
                            <td colspan="7" class="celdaFondoGrisBold3c">Descripción de la actividad laboral (4)</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Horas Semanales de trabajo</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold3c">OB</td>
                            <td class="celdaFondoGrisBold3c">EM</td>
                            <td class="celdaFondoGrisBold3c">TI</td>
                            <td class="celdaFondoGrisBold3c">E/O</td>
                            <td class="celdaFondoGrisBold3c">TF</td>
                            <td class="celdaFondoGrisBold3c">TH</td>
                            <td class="celdaFondoGrisBold3c">Especificar</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="width:7%; height:8px;"></td>
                            <td class="celdaNormal3" style="width:7%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:36%;"></td>
                            <td class="celdaNormal3" style="width:20%;"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                      
                      
                    </table>
                </td>
                <td>
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Año</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Edad</td>
                            <td colspan="7" class="celdaFondoGrisBold3c">Descripción de la actividad laboral (4)</td>
                            <td rowspan="2" class="celdaFondoGrisBold3c">Horas Semanales de trabajo</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold3c">OB</td>
                            <td class="celdaFondoGrisBold3c">EM</td>
                            <td class="celdaFondoGrisBold3c">TI</td>
                            <td class="celdaFondoGrisBold3c">E/O</td>
                            <td class="celdaFondoGrisBold3c">TF</td>
                            <td class="celdaFondoGrisBold3c">TH</td>
                            <td class="celdaFondoGrisBold3c">Especificar</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="width:7%; height:8px;"></td>
                            <td class="celdaNormal3" style="width:7%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:5%;"></td>
                            <td class="celdaNormal3" style="width:36%;"></td>
                            <td class="celdaNormal3" style="width:20%;"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal3" style="height:8px;"></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                            <td class="celdaNormal3" ></td>
                        </tr>
                      
                      
                    </table>
                </td>
            </tr>
          </table>

          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0.1cm;">
            <tr>
                <td style="width: 50%; font-size:8px; font-weight:normal;">
                    <b>(1)</b> S: Soltero, C: Casado, V: Viudo, D: Divorciado, Cv: Conviviente <br>
                    <b>(2)</b> (Si) si cuenta con partida de nacimiento; (No) no ha sido inscrito en el registro civil. <br>
                    <b>(4)</b> (OB)Obrero, (EM)Empleado, (TI)Trabaj.Independiente, (E/O)Empleador, (TF) Trabaj. Fam. No Remunerado, (TH)Trabaj. Del Hogar
                </td>
                <td style="width: 50%; font-size:8px; font-weight:normal;">
                    <b>(3)</b> Tipo de Discapacidad: (DI) Discapacidad Intelectual, (DA) Discapacidad Auditiva, (DV) Discapacidad Visual, (DM) Discapacidad
                    Motora, (SC)Sordoceguera (OT) Otra <br>
                    <b>*</b> Certificado de Discapacidad emitido por la autoridad competente. Dato válido sólo para fines estadísticos, no obligatorio para matrícula. <br>
                </td>
            </tr>
          </table>

    </div>












    <div style="page-break-after:always;"></div>


    {{-- Pagina 2 --}}

    <div class="box" style="width: 27.5cm;">

        <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0cm;">
            <tr>
                <td colspan="2" class="titles">2. Datos de la Escolaridad del Estudiante</td>
            </tr>
            <tr>
                <td class="titles" style="width: 14%">2.1 Matrícula</td>
                <td class="titles" style="width: 84%"></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:99%;">
                        <tr>
                            <td class="celdaFondoGrisBold2">Datos - Años</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Nombre de la Institución Educativa</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Código Modular</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Departamento</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Provincia</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Distrito</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L" style="font-size:8px;">Instancia de Gestión Educativa Descentralizada</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Nivel</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Modalidad (1)</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Programa (Sólo EBA) (2)</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Ciclo (Sólo EBA) (3)</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Forma (4)</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Grado</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Sección</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Turno (5)</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Situación final (6)</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Año Lectivo</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Recuperación Pedagógica</td>
                        </tr>
                       
                    </table>
                </td>

                <td style="vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5">289</td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>

                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;">0</td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;">5</td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;">9</td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;">4</td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;">8</td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;">3</td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;">8</td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                    <td class="celdaNormal5" style="min-width: 14.28571%;"></td>
                                </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">UCAYALI</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">CORONEL PORTILLO</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">MANANTAY</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5" style="font-size: 8px;"><div style="height:21px; overflow:hidden;">UGEL CORONEL PORTILLA</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">INICIAL - JARDÍN</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5">EBR</td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5" style="height: 10.4px;"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5" style="height: 10.4px;"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">ESCOLARIZADO</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">GRUPO 4 AÑOS</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">D</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">MAÑANA</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                    </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                       <td class="celdaNormal5" style="width: 20%;">A</td>
                                        <td class="celdaNormal5" style="width: 20%;">RR</td>
                                        <td class="celdaNormal5" style="width: 20%;">D</td>
                                        <td class="celdaNormal5" style="width: 20%;">R</td>
                                        <td class="celdaNormal5" style="width: 20%;">P</td>
                                    </tr>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                    <tr>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                        <td class="celdaNormal5" style="min-width: 20%"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                      
                       
                    </table>
                </td>
            </tr>
          </table>






















          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0cm;">
            <tr>
                <td class="titles">2.2 Traslados</td>
            </tr>
            <tr>
                <td style="vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td colspan="3" class="celdaFondoGrisBold3c">Fecha</td>
                            <td class="celdaFondoGrisBold3c">Motivo del traslado</td>
                            <td colspan="8" class="celdaFondoGrisBold3c">Institucion Educativa de Destino</td>
                            <td class="celdaFondoGrisBold3c">Vº Bº de Traslados</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4">Día</td>
                            <td class="celdaFondoGrisBold4">Mes</td>
                            <td class="celdaFondoGrisBold4">Año</td>
                            <td class="celdaFondoGrisBold4">Descripción</td>
                            <td colspan="7"class="celdaFondoGrisBold4">Código Modular</td>
                            <td class="celdaFondoGrisBold4">Nombre</td>
                            <td class="celdaFondoGrisBold4" style="font-size:6px;">Firma y Post firma del Director de la I. E. que autoriza el traslado</td>

                        </tr>
                        <tr>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 32%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 32%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 32%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 32%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 32%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 32%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 4%"></td>
                            <td class="celdaNormal6" style="width: 32%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 2%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                            <td class="celdaNormal6" style="width: 21%"></td>
                        </tr>

                       
                    </table>
                </td>
            </tr>
          </table>























          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0cm;">
            <tr>
                <td colspan="2" class="titles">3. Responsable de la Matrícula en la Institución Educativa y Fecha</td>
            </tr>
            <tr>
                <td class="titles" style="width: 14%"></td>
                <td class="titles" style="width: 84%"></td>
            </tr>
            <tr>
                <td style="vertical-align: top; width: 14%; ">
                    <table class="table" style="margin-bottom: 0px; width:99%;">
                        <tr>
                            <td class="celdaFondoGrisBold2">Datos - Años</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L" style="height: 23.07px;">Fecha</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Apellidos y Nombres</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Cargo</td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5">13</td>
                                    <td class="celdaNormal5">03</td>
                                    <td class="celdaNormal5">2013</td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                           
                        </tr>

                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;"></div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;"></div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
          </table>



















          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0cm;">
            <tr>
                <td colspan="2" class="titles">4. Datos del Apoderado</td>
            </tr>
            <tr>
                <td class="titles" style="width: 14%"></td>
                <td class="titles" style="width: 84%"></td>
            </tr>
            <tr>
                <td style="vertical-align: top; width: 14%; ">
                    <table class="table" style="margin-bottom: 0px; width:99%;">
                        <tr>
                            <td class="celdaFondoGrisBold2">Datos - Años</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Apellido Paterno</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Apellido Materno</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Nombres</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Parentesco con el Estudiante</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L" style="height: 23.07px;">Fecha de Nacimiento</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Grado de Instrucc.</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Ocupación</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Domicilio</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Teléfono</td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">TANANTA</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">ZAMANES</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">ALI CANDI</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;">MADRE</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5">13</td>
                                    <td class="celdaNormal5">03</td>
                                    <td class="celdaNormal5">2013</td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Día</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 30%;">Mes</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 40%;">Año</td>
                                </tr>
                                <tr>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                    <td class="celdaNormal5"></td>
                                </tr>
                                </table>
                            </td>
                           
                        </tr>

                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden; font-size:4px;">SECUNDARIA INCOMPLETA</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;"></div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden; font-size:4px;">3 DE DICIEMBREMZ. 8</div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                        <tr>
                            <td class="celdaNormal5"><div style="height:9.4px; overflow:hidden;"></div></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                            <td class="celdaNormal5"></td>
                        </tr>
                    </table>
                </td>
            </tr>
          </table>



















          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0.1cm;">
            <tr>
                <td colspan="2" class="titles">5. Supervivencia de los Padres</td>
            </tr>
            <tr>
                <td class="titles" style="width: 14%"></td>
                <td class="titles" style="width: 84%"></td>
            </tr>
            <tr>
                <td style="vertical-align: top; width: 14%; ">
                    <table class="table" style="margin-bottom: 0px; width:99%;">
                        <tr>
                            <td class="celdaFondoGrisBold2">Vive</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Padre</td>
                        </tr>
                        <tr>
                            <td class="celdaFondoGrisBold4L">Madre</td>
                        </tr>
                    </table>
                </td>

                <td style="vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                            <td class="celdaFondoGrisBold2" style="width: 6.6666666%">20___</td>
                        </tr>
                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                        </tr>
                        <tr>
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;">X</td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                            <td style="padding: 0px;">
                                <table class="table" style="margin-bottom: 0px; width:100%;">
                                <tr>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">Si</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                    <td class="celdaFondoGrisBold4L" style="width: 25%;">No</td>
                                    <td class="celdaNormal5" style="width: 25%;"></td>
                                </tr>
                                </table>
                            </td> 
                        </tr>
                    </table>
                </td>
            </tr>
          </table>







          <table class="table" style="margin-bottom: 0px; width:100%; margin-top:0.1cm;">
            <tr>
                <td style="width: 35%; font-size:8px; font-weight:normal; vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td style="vertical-align: top"><b>[1] Modalidad :</b></td>
                            <td>(EBR)Edu.Básica Regular, (EBR-AD)Edu.Básica Regular A Distancia. <br>
                                (EBA)Edu.Básica Alternativa, (EBE)Educación Básica Especial

                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top"><b>[2] Programa (de E.B.A.) :</b></td>
                            <td>PA, Programa de Alfabetización (PA) <br>
                                (PBJ)PEBAJA.Prog.de Educ.Bás.Alter. de Jóvenes y Adultos

                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 30%; font-size:8px; font-weight:normal; vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td style="vertical-align: top"><b>[3] Ciclo :</b></td>
                            <td>Para el caso de EBA:(IN) Inicial, (INT) Intermedio, (AV) Avanzado
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top"><b>[4] Forma :</b></td>
                            <td>(Esc) Escolarizado, (NoEsc) No Escolarizado <br>
                                Para el caso EBA: (P) Presencial, (SP) Semi Presencial, (AD) A distancia
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 35%; font-size:8px; font-weight:normal; vertical-align: top;">
                    <table class="table" style="margin-bottom: 0px; width:100%;">
                        <tr>
                            <td style="vertical-align: top"><b>[5] Turno :</b></td>
                            <td>(M) Mañana, (T) Tarde, (N) Noche
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top"><b>[6] Situación Final  :</b></td>
                            <td>(Marcar "X" donde corresponda) (A) Aprobado, <br>
                                (RR) Requiere Recuperación, (D) Desaprobado, ( R ) Retirado <br>
                                Para el caso de EBA: (RR) Requiere Recuperación, (P) Promovido
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
          </table>

    </div>

