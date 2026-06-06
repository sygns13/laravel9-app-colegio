@extends('adminlte::page')

@section('title', 'Gestión del Tipo de Cambio')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('yamaha.partials.content-header')
@stop

@section('content')
    @include('yamaha.config.main')
    {{-- @include('yamaha.config.form') --}}
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/yamaha_custom.css"> --}}
@stop

@section('js')
<script src="{{ asset('js/core/yamaha/config.js')}}"  type="text/javascript"></script>
@stop
