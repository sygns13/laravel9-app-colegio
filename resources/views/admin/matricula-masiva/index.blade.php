@extends('adminlte::page')

@section('title', 'Registro de Matrículas Masivas')

@section('plugins.Stepper', true)

@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')
    @include('admin.matricula-masiva.main')
    @include('admin.matricula-masiva.table')
    @include('admin.matricula-masiva.final')
{{--     @include('admin.matricula-masiva.form-alumno')
    @include('admin.matricula-masiva.form-gestion-alumno') --}}
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
<script>
    // BS-Stepper Init
    /* document.addEventListener('DOMContentLoaded', function () {
  var stepper = new Stepper(document.querySelector('.bs-stepper'))
}) */
</script>
<script src="{{ asset('js/core/admin/matricula-masiva.js')}}"  type="text/javascript"></script>

@stop
