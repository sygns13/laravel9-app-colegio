@extends('adminlte::page')

@section('title', 'Legajo - Registrar Nuevo')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')
    @include('admin.legajo-nuevo2.main')
    @include('admin.legajo-nuevo2.form')
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
    @if($user->tipo_user_id == "4") {{-- Alumno --}}
        <script src="{{ asset('js/core/admin/legajo-nuevo2.js')}}"  type="text/javascript"></script>

    @elseif($user->tipo_user_id == "3") {{-- Docente --}}
        <script src="{{ asset('js/core/admin/legajo-nuevo2.js')}}"  type="text/javascript"></script>

    @elseif($user->tipo_user_id == "1" || $user->tipo_user_id == "2") {{-- Admin --}}
        <script src="{{ asset('js/core/admin/legajo-nuevo.js')}}"  type="text/javascript"></script>

    @elseif($user->tipo_user_id == "5") {{-- Apoderado --}}
        <script src="{{ asset('js/core/admin/legajo-nuevo2.js')}}"  type="text/javascript"></script>
        
    @endif

    <script>
       /*  Swal.fire(
    'Good job!',
    'You clicked the button!',
    'success'
    ) */
    </script>
@stop