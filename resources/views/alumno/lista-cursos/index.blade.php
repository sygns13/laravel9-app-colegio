@extends('adminlte::page')

@section('title', 'Lista de Cursos')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('alumno.partials.content-header')
@stop

@section('content')
    @include('alumno.lista-cursos.main')
    @include('alumno.lista-cursos.form')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/alumno_custom.css"> --}}
    <style type="text/css">   
    .titles-table{
        text-align: center;/* font-size: 14px; */
    }
    .rows-table{
        /* font-size: 14px; */ padding: 5px;
    }
    </style>
@stop

@section('js')
<script src="{{ asset('js/core/alumno/lista-cursos.js')}}"  type="text/javascript"></script>
@stop
