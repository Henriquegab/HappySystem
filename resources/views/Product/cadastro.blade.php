@extends('adminlte::page')

@section('title', 'Cadastro de produtos')

@section('content_header')
    <h1 align="center">Cadastro de produtos</h1>
@stop

@section('content')


    <form method="post" action="{{ route('produtos.store') }}">
         @csrf
            {{-- Minimal --}}
        <div class="row">
            <x-adminlte-input enable-old-support name="nome" type="name" placeholder="Iphone 13" fgroup-class="col-md-5" label="Nome"/>

            {{-- Email type --}}
            
            <x-adminlte-input enable-old-support name="marca" type="string" placeholder="Apple" fgroup-class="col-md-5" label="Marca"/>

            {{-- With label, invalid feedback disabled and form group class --}}
            
                <x-adminlte-input enable-old-support name="descricao" type="text" label="Descrição" placeholder="Digite a descrição..."
                    fgroup-class="col-md-2"/>
        </div>
        <div class="row">
            
        
            <x-adminlte-input enable-old-support name="preco" type="number" placeholder="1000" fgroup-class="col-md-4" label="Preço"/>

            <x-adminlte-input enable-old-support name="estoque" type="number" label="Estoque" placeholder="2"
                    fgroup-class="col-md-1"/>

            
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