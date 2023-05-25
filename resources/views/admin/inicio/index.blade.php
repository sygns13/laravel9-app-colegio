@extends('adminlte::page')

@section('title', 'Principal')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    <h1>Principal</h1>
@stop

@section('content')
    <p>Bienvenido al Sistema de Gestión Académica IE. Ricardo Palma Carrillo</p>
    @include('admin.inicio.main')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style type="text/css">   
        .highcharts-credits{
            display: none!important;
        }
    </style>
@stop

@section('js')
<script src="{{ asset('js/core/admin/inicio.js')}}"  type="text/javascript"></script>

    <script>
       /*  Swal.fire(
    'Good job!',
    'You clicked the button!',
    'success'
    ) */
    </script>
@stop