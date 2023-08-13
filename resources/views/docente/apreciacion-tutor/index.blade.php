@extends('adminlte::page')

@section('title', 'Apreciación del Tutor')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('docente.partials.content-header')
@stop

@section('content')
    @include('docente.apreciacion-tutor.main')
    @include('docente.apreciacion-tutor.form')
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

    .rows-table2{
        font-size: 13px; padding: 5px!important;
    }
    </style>
@stop

@section('js')
<script type="text/javascript">
var fechaHoy = '{{$hoy}}';

@if($cicloActivo)
    var ciclo_escolar_id = '{{$cicloActivo->id}}';
@else
    var ciclo_escolar_id = 0;
@endif
</script>
<script src="{{ asset('js/core/docente/apreciacion-tutor.js')}}"  type="text/javascript"></script>
@stop
