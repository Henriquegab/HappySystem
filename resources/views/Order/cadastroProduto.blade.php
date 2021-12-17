@extends('adminlte::page')

@section('title', 'Cadastro de pedidos')

@section('content_header')
    <h1 align="center">Cadastro de pedidos</h1>
   
   
@stop

@section('content')

    
    <form method="post" action="{{ route('pedido-produto.store', ['id' => $id, 'primeiro' => $primeiro, 'pedido' => $pedido]) }}">
         @csrf
         
            {{-- Minimal --}}
        <div class="row">

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
        
        
        
        
            <x-adminlte-button class="btn-flat" type="submit" label="Adicionar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
        




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop