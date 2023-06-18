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

    @if($user->tipo_user_id == 1 || $user->tipo_user_id == 2)
        <script src="{{ asset('js/core/admin/inicio.js')}}"  type="text/javascript"></script>
    @elseif($user->tipo_user_id == 3)
        <script src="{{ asset('js/core/admin/inicioDocente.js')}}"  type="text/javascript"></script>
    @elseif($user->tipo_user_id == 4)
        <script src="{{ asset('js/core/admin/inicioAlumno.js')}}"  type="text/javascript"></script>
    @endif

    <script>
       /*  Swal.fire(
    'Good job!',
    'You clicked the button!',
    'success'
    ) */
    </script>
@stop