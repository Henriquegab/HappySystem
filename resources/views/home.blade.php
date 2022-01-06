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

    @php
        use App\Models\Cliente;
        use App\Models\Produto;
        use App\Models\Pedido;

        $metaCliente = 300;
        $progresso = Cliente::count() / $metaCliente * 100;
    @endphp

    <div class="row">


        <div class="col-md-6">
            <x-adminlte-info-box title="Meta de Clientes" text="{{ Cliente::count() }}/{{ $metaCliente }}" icon="fas fa-lg fa-users text-orange" theme="warning"
            icon-theme="dark" progress="{{ intval($progresso)  }}" progress-theme="dark"
            description="{{ intval($progresso)  }}% da meta concluida!"/>
        </div>


        <div class="col-md-6">
            <x-adminlte-info-box title="Reputation" text="0/1000" icon="fas fa-lg fa-medal text-dark"
            theme="danger" id="ibUpdatable" progress=0 progress-theme="teal"
            description="0% reputation completed to reach next level"/>

            
        </div>

       
    </div>
    <div class="row">

        <div class="col-md-4">

            <x-adminlte-info-box title="Views" text="424" icon="fas fa-lg fa-eye text-dark" theme="gradient-teal"/>
        </div>
        <div class="col-md-4">
        
            <x-adminlte-info-box title="Views" text="424" icon="fas fa-lg fa-eye text-dark" theme="gradient-teal"/>


        </div>

        <div class="col-md-4">
            <x-adminlte-info-box title="528" text="User Registrations" icon="fas fa-lg fa-user-plus text-primary"
            theme="gradient-primary" icon-theme="white"/>

            
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