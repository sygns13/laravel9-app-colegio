@extends('adminlte::page')

@section('title', 'Mensajes')

{{-- @section('plugins.Sweetalert2', true) --}}

@section('content_header')
    @include('admin.partials.content-header')
@stop

@section('content')
    @include('admin.mensajes.main')
    @include('admin.mensajes.table')
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <style type="text/css">  

    @media (min-width: 992px){
        .modal-lg, .modal-xl {
            max-width: 1140px!important;
        }
    }
    
    .modal-lx{
        width: 1140px!important;
    }

    .titles-table{
        text-align: center;font-size: 13px;
    }
    .rows-table{
        font-size: 13px; padding: 5px;
    }

    .ck-editor__editable_inline {
        min-height: 200px;
    }

    .vT {
        -webkit-align-items: center;
        align-items: center;
        background-color: #f0f0f0;
        border: 1px solid #dadce0;
        -webkit-border-radius: 10px;
        border-radius: 10px;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        display: -webkit-inline-box;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        height: 30px;
        line-height: 20px;
        margin: 2px 0;
        padding-left: 8px;
        padding-right: 4px;
        width: 225px;
    }

    .cardco:hover {
        background-color: #d9d9d9!important;
    }
    </style>
@stop

@section('js')
<script src="{{ asset('js/core/admin/mensajes.js')}}"  type="text/javascript"></script>
@stop
