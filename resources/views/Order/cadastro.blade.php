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
            
            @php
            $optionsp = [];
           
                foreach ($produtos as $produto) {
                    $optionsp += [$produto->id => $produto->nome];
                }

                
            @endphp
            
            <x-adminlte-select2 enable-old-support label="Produto" name="produto" fgroup-class="col-md-5">
               
                        <x-adminlte-options

                        empty-option="Selecione uma opção"        
                        :options="$optionsp" 
                        
                        />
                   
                    
                    
                    
                
                
               
                

                
            </x-adminlte-select2>
            

            <x-adminlte-input enable-old-support name="quantidade" type="number" label="Quantidade" placeholder="2"
            fgroup-class="col-md-2"/>
           
        </div>
        
        <div class="row">
            
            <x-adminlte-input enable-old-support name="descricao" type="text" label="Descrição" placeholder="Digite a descrição..."
                    fgroup-class="col-md-11"/>

           

           

            
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