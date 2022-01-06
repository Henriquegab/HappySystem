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

    <div class="row">


        <div class="col-md-8">
            <x-adminlte-info-box title="Tasks" text="75/100" icon="fas fa-lg fa-tasks text-orange" theme="warning"
            icon-theme="dark" progress=50 progress-theme="dark"
            description="75% of the tasks have been completed"/>

            <x-adminlte-info-box title="Views" text="424" icon="fas fa-lg fa-eye text-dark" theme="gradient-teal"/>
        </div>
        <div class="col-md-4">
            <x-adminlte-info-box title="Views" text="424" icon="fas fa-lg fa-eye text-dark" theme="gradient-teal"/>

        </div>
    </div>
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