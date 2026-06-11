@extends('adminlte::page')

@section('title', 'Ventas')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('yamaha.partials.content-header')
@stop

@section('content')
    @include('yamaha.ventas.main')
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
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="{{ asset('js/core/yamaha/ventas.js?v=2.8')}}"  type="text/javascript"></script>
@stop
