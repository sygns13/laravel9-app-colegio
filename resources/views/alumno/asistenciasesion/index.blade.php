@extends('adminlte::page')

@section('title', 'Reporte de Asistencia por Secciones')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('alumno.partials.content-header')
@stop

@section('content')
    @include('alumno.asistenciasesion.main')
    {{-- @include('alumno.asistenciasesion.form') --}}
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
<script src="{{ asset('js/core/alumno/asistenciasesion.js')}}"  type="text/javascript"></script>
@stop