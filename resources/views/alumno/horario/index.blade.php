@extends('adminlte::page')

@section('title', 'Horario del Alumno')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('alumno.partials.content-header')
@stop

@section('content')
    @include('alumno.horario.main')
    @include('alumno.horario.form')
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
<script src="{{ asset('js/core/alumno/horario.js')}}"  type="text/javascript"></script>
@stop