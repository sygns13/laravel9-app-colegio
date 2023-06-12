@extends('adminlte::page')

@section('title', 'Lista de Cursos')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('docente.partials.content-header')
@stop

@section('content')
    @include('docente.lista-cursos.main')
    @include('docente.lista-cursos.form')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/docente_custom.css"> --}}
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
<script src="{{ asset('js/core/docente/lista-cursos.js')}}"  type="text/javascript"></script>
@stop
