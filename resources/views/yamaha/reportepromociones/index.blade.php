@extends('adminlte::page')

@section('title', 'Reporte de Promociones')

@section('content_header')
    @include('yamaha.partials.content-header')
@stop

@section('content')
    @include('yamaha.reportepromociones.main')
@stop

@section('css')
    <style type="text/css">
        .titles-table{
            text-align: center;font-size: 13px;
        }
        .rows-table{
            font-size: 13px; padding: 5px;
        }
    </style>
@stop

@section('js')
    <script type="text/javascript">
        var fechaHoy = '{{ $hoy }}';
    </script>
    <script src="{{ asset('js/core/yamaha/reportepromociones.js?v=1.0') }}" type="text/javascript"></script>
@stop
