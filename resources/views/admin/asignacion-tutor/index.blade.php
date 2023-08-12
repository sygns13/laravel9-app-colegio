@extends('adminlte::page')

@section('title', 'Asignación de Tutores')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')
    @include('admin.asignacion-tutor.main')
    @include('admin.asignacion-tutor.form')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="{{ asset('js/core/admin/asignacion-tutor.js')}}"  type="text/javascript"></script>
@stop
