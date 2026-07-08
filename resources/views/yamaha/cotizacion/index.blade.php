@extends('adminlte::page')

@section('title', 'Cotizaciones')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('yamaha.partials.content-header')
@stop

@section('content')
    @include('yamaha.cotizacion.main')
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
<script type="text/javascript">
    var fechaHoy = '{{$hoy}}';
    
    @if($tipoCambio)
        var tipoCambio = '{{$tipoCambio->tipo_cambio}}';
    @else
        var tipoCambio = 3.7;
    @endif
    </script>
    <script src="{{ asset('js/core/yamaha/cotizacion.js?v=1.8')}}"  type="text/javascript"></script>
@stop
