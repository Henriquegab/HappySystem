@extends('adminlte::page')

@section('title', 'Edição de Clientes')

@section('content_header')
    <h1 align="center">Edição de Clientes</h1>
@stop

@section('content')


    <form method="post" action="{{ route('clientes.update', ['cliente' => $cliente]) }}">
         @csrf
         @method('PUT')
            {{-- Minimal --}}
        <div class="row">
            <x-adminlte-input enable-old-support name="nome" value="{{ $cliente->nome }}" type="name" placeholder="Henrique gabriel" fgroup-class="col-md-5" label="Nome"/>
                
            
            {{-- Email type --}}
            
            <x-adminlte-input enable-old-support name="email" value="{{ $cliente->email }}" type="email" placeholder="mail@example.com" fgroup-class="col-md-5" label="Email"/>

            {{-- With label, invalid feedback disabled and form group class --}}
            
                <x-adminlte-input enable-old-support disabled name="cpf" value="{{ $cliente->cpf }}" type="name" label="CPF" placeholder="11111111111"
                    fgroup-class="col-md-2"/>
        </div>

       

        <div class="row">
            <x-adminlte-select enable-old-support disabled label="Sexo" name="sexo" fgroup-class="col-md-3">
                <x-adminlte-options :options="['Masculino', 'Feminino', 'Outros']" selected="{{ $cliente->sexo }}"
                    
                    empty-option="Selecione uma opção"/>
            </x-adminlte-select>
        
            <x-adminlte-input enable-old-support name="endereco" value="{{ $cliente->endereco }}" type="name" placeholder="Rua Joaquim Costa" fgroup-class="col-md-4" label="Endereço"/>

            <x-adminlte-input enable-old-support name="numerocasa" value="{{ $cliente->numerocasa }}" type="name" label="Número" placeholder="2"
                    fgroup-class="col-md-1"/>

            <x-adminlte-input enable-old-support name="cep" type="name" value="{{ $cliente->cep }}" label="CEP" placeholder="39402000"
            fgroup-class="col-md-2"/>

            <x-adminlte-input enable-old-support name="uf" type="name" value="{{ $cliente->uf }}" placeholder="MG" fgroup-class="col-md-2" label="UF"/>
        </div>
        
        
            <x-adminlte-button class="btn-flat" type="submit" label="Salvar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
        




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop