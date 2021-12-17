@extends('adminlte::page')

@section('title', 'Cadastro de pedidos')

@section('content_header')
    <h1 align="center">Cadastro de pedidos</h1>
   
   
@stop

@section('content')


    <form method="post" action="{{ route('pedido.store', ['primeiro' => 5]) }}">
        @csrf
            
            {{-- Minimal --}}
        <div class="row">

            @php
            $optionsc = [];
        
                foreach ($clientes as $cliente) {
                    $optionsc += [$cliente->id => $cliente->nome.' ('.$cliente->cpf.')'];
                }

                
            @endphp
            
            
            <x-adminlte-select2 enable-old-support label="Cliente" name="cliente" fgroup-class="col-md-5">
                <x-adminlte-options

                        empty-option="Selecione uma opção"        
                        :options="$optionsc" 
                        
                        />
                

                
            </x-adminlte-select2>
            
            
        </div>
        
        
        
        
            <x-adminlte-button class="btn-flat" type="submit" label="Continuar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
        




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop