@extends('adminlte::page')

@section('title', 'Principal')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')
    @include('admin.legajo.main')
    @include('admin.legajo.form')
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
    <script src="{{ asset('js/core/admin/legajo.js')}}"  type="text/javascript"></script>

    <script>
       /*  Swal.fire(
    'Good job!',
    'You clicked the button!',
    'success'
    ) */
    </script>
@stop