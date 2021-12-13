@extends('adminlte::page')

@section('title', 'Cadastro de pedidos')

@section('content_header')
    <h1 align="center">Cadastro de pedidos</h1>
@stop

@section('content')

    
    <form method="post" action="{{ route('pedidos.store') }}">
         @csrf
            {{-- Minimal --}}
        <div class="row">

            
            <x-adminlte-select2 enable-old-support label="Cliente" name="cliente" fgroup-class="col-md-5">
                @foreach ($clientes as $cliente)
                    @if ($loop->first)
                        <x-adminlte-options

                        empty-option="Selecione uma opção"        
                        :options="$cliente->nome.' ('.$cliente->cpf.')'" 
                        
                        />
                    @endif
                    @if (!$loop->first)
                        <x-adminlte-options

                                
                        :options="$cliente->nome.' ('.$cliente->cpf.')'" 
                        
                        />
                    @endif
                    
                    
                    
                
                
                @endforeach

                

                
            </x-adminlte-select2>
            
           
        </div>
        
        <div class="row">
            
            <x-adminlte-input enable-old-support name="descricao" type="text" label="Descrição" placeholder="Digite a descrição..."
                    fgroup-class="col-md-11"/>

           

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