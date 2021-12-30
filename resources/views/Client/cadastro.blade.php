@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')
    <h1 align="center">Cadastro de Clientes</h1>
@stop

@section('content')


    <form method="post" action="{{ route('clientes.store') }}">
         @csrf
            {{-- Minimal --}}
        <div class="row">
            <x-adminlte-input enable-old-support name="nome" type="name" placeholder="Henrique gabriel" fgroup-class="col-md-5" label="Nome"/>

            {{-- Email type --}}
            
            <x-adminlte-input enable-old-support name="email" type="email" placeholder="mail@example.com" fgroup-class="col-md-5" label="Email"/>

            {{-- With label, invalid feedback disabled and form group class --}}
            
                <x-adminlte-input enable-old-support name="cpf" type="number" label="CPF" placeholder="11111111111"
                    fgroup-class="col-md-2"/>
        </div>
        <div class="row">
            <x-adminlte-select enable-old-support label="Sexo" name="sexo" fgroup-class="col-md-3">
                <x-adminlte-options :options="['Masculino', 'Feminino', 'Outros']"
                    empty-option="Selecione uma opção"/>
            </x-adminlte-select>
        
            <x-adminlte-input enable-old-support name="endereco" type="name" placeholder="Rua Joaquim Costa" fgroup-class="col-md-4" label="Endereço"/>

            <x-adminlte-input enable-old-support name="numerocasa" type="name" label="Número" placeholder="2"
                    fgroup-class="col-md-1"/>

            <x-adminlte-input enable-old-support name="cep" type="name" label="CEP" placeholder="39402000"
            fgroup-class="col-md-2"/>

            <x-adminlte-input enable-old-support name="uf" type="name" placeholder="MG" fgroup-class="col-md-2" label="UF"/>
        </div>
        
        
            <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
        




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop