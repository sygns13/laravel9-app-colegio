@extends('adminlte::page')

@section('title', 'Reporte de Calificaciones por Secciones')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('reporte.partials.content-header')
@stop

@section('content')
    @include('reporte.calificaciones.main')
    {{-- @include('reporte.calificaciones.form') --}}
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
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
<script src="{{ asset('js/core/reporte/calificaciones.js')}}"  type="text/javascript"></script>
@stop
