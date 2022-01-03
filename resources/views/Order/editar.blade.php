@extends('adminlte::page')

@section('title', 'Edição de pedidos')

@section('content_header')
    <h1 align="center">Edição de pedidos</h1>
   
   
@stop

@section('content')

    
    

    
        <form method="post" action="{{ route('pedido-produto.update', ['id' => $id, 'primeiro' => $primeiro, 'pedido' => $pedido, 'quantidade' => $quantidade])}}">
    
    
    
    
            @method('PUT')
            @csrf
            
                {{-- Minimal --}}
            <div class="row">

                @php
                $optionsp = [];
            
                    foreach ($produtos as $produto) {
                        $optionsp += [$produto->id => $produto->nome];
                    }

                    //dd($produtos);
                @endphp
                
                <x-adminlte-select enable-old-support label="Produto" name="produto" fgroup-class="col-md-5" >
                
                            <x-adminlte-options :options="$optionsp[$selecionar->produto_id]" :selected="$selecionar->produto_id" />
                            
                            
                            
                            
                            
                    
                        
                        
                
                    
                    
                
                    

                    
                </x-adminlte-select>
                

                <x-adminlte-input enable-old-support name="quantidade" type="number" label="Quantidade" placeholder="2"
                fgroup-class="col-md-2" value="{{ $quantidade }}"/>
            
                
                
            </div>
            
            
            
            
                <x-adminlte-button class="btn-flat" type="submit" label="Editar" theme="success" icon="fas fa-lg fa-save"/>
    </form>
        




@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop