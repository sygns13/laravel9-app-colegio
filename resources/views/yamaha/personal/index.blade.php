@extends('adminlte::page')

@section('title', 'Gestión de Usuarios')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('yamaha.partials.content-header')
@stop

@section('content')
    @include('yamaha.personal.main')
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
<script src="{{ asset('js/core/yamaha/personal.js')}}"  type="text/javascript"></script>
@stop
