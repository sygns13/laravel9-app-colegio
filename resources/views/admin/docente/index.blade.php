@extends('adminlte::page')

@section('title', 'Docentes')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')
    @include('admin.docente.main')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script src="{{ asset('js/core/admin/docente.js')}}"  type="text/javascript"></script>
@stop
