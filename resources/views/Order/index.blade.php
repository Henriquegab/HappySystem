@extends('adminlte::page')

@section('title', 'Listagem de Pedidos')

@section('content_header')
    <h1 align="center">Listagem de Pedidos</h1>
@stop

@section('content')
   
@php
use App\Models\Cliente;
use App\Models\PedidoProduto;      
@endphp


        @php
        $heads = [

            ['label' => 'Id', 'width' => 20],
            ['label' => 'Cliente', 'width' => 20],
            ['label' => 'Número de Pedidos', 'width' => 20],
            ['label' => 'Ações', 'no-export' => true, 'width' => 5]
        ];

        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </button>';

    

                    


            $config = [
            'paging' => false,
            
            'ordering' => true,
            'order' => [[0, 'asc']],
           // 'columns' => ['orderable'=> true]
        ];



        /* 
                    
                
                  
        
        */
        
        

        
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable with-buttons beautify>
            @foreach($pedidos as $pedido)
                <tr>
                    @php
                        $cliente = Cliente::where('id', $pedido->cliente_id)->get()->first()->getAttributes()['nome'];
                        $QuantidadeProdutos = PedidoProduto::where('pedido_id', $pedido->id)->count();
                    @endphp
                    <td>{{$pedido->id}}</td>
                    <td>{{$cliente}}</td>
                    <td>{{$QuantidadeProdutos}}</td>
                    
                    <td>
                    
                    
                
                    </td>
                </tr>
            @endforeach
           
        </x-adminlte-datatable>
        
        
       
        
        <br>
        {{ $pedidos->links() }}
        <br>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop