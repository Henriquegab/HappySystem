@extends('adminlte::page')

@section('title', 'Menu')

@section('content_header')
    <h1 align="center">Menu Principal</h1>
@stop

@section('content')
    <p align="center">Seja Bem-vindo!</p>


    @if (isset($notification))

    <x-adminlte-alert theme="danger" title="Aviso!">
        {{ $notification }}
    </x-adminlte-alert>


    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos Reservados</h6>
    
@stop