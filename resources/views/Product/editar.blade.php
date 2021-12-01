@extends('adminlte::page')

@section('title', 'Edição de produtos')

@section('content_header')
    <h1 align="center">Edição de produtos</h1>
@stop

@section('content')


    <form method="post" action="{{ route('produtos.update', 'produto' => $produto) }}">
         @csrf
         @method('PUT')
            {{-- Minimal --}}
        <div class="row">
            <x-adminlte-input enable-old-support name="nome" type="name" value="{{ $produto->nome }}" placeholder="Iphone 13" fgroup-class="col-md-5" label="Nome"/>

            {{-- Email type --}}
            
            <x-adminlte-input enable-old-support name="marca" type="string" value="{{ $produto->marca }}" placeholder="Apple" fgroup-class="col-md-5" label="Marca"/>

            {{-- With label, invalid feedback disabled and form group class --}}
            
                <x-adminlte-input enable-old-support name="descricao" type="text" value="{{ $produto->descricao }}" label="Descrição" placeholder="Digite a descrição..."
                    fgroup-class="col-md-2"/>
        </div>
        <div class="row">
            
        
            <x-adminlte-input enable-old-support name="preco" type="number" value="{{ $produto->preco }}" placeholder="1000" fgroup-class="col-md-4" label="Preço"/>

            <x-adminlte-input enable-old-support name="estoque" type="number" value="{{ $produto->estoque }}" label="Estoque" placeholder="2"
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