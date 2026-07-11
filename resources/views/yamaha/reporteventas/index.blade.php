@extends('adminlte::page')

@section('title', 'Reporte de Ventas')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('yamaha.partials.content-header')
@stop

@section('content')
    @include('yamaha.reporteventas.main')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/yamaha_custom.css"> --}}
    <style type="text/css">
        .titles-table{
            text-align: center;font-size: 13px;
        }
        .rows-table{
            font-size: 13px; padding: 5px;
        }
        /* Ocultar por defecto en pantalla */
        .encabezado-impresion {
            display: none;
        }

        /* Mostrar solo al imprimir */
        @media print {
            .encabezado-impresion {
                display: table !important;
            }
        }
    </style>
@stop

@section('js')
    <script type="text/javascript">
        var fechaHoy = '{{$hoy}}';

        @if($tipoCambio)
        var tipoCambio = '{{$tipoCambio->tipo_cambio}}';
        @else
        var tipoCambio = 3.7;
        @endif
    </script>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="{{ asset('js/core/yamaha/reporteventas.js?v=2.0')}}"  type="text/javascript"></script>
@stop
