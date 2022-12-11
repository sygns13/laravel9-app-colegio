@extends('adminlte::page')

@section('title', 'Conclusión de Matrículas de Alumnos')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')
    @include('admin.conclusion.main')
    {{-- @include('admin.conclusion.form') --}}
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
    .rows-table2{
        font-size: 15px; padding: 5px;
    }
    </style>
@stop

@section('js')
<script type="text/javascript">

@if($cicloActivo)
    var ciclo_escolar_id = '{{$cicloActivo->id}}';
@else
    var ciclo_escolar_id = 0;
@endif
</script>
<script src="{{ asset('js/core/admin/conclusion.js')}}"  type="text/javascript"></script>
@stop
