@extends('adminlte::page')

@section('title', 'Listagem de Pedidos')

@section('content_header')
    <h1 align="center">Listagem de Pedidos</h1>
@stop

@section('content')
   
@php
use App\Models\Cliente;
use App\Models\PedidoProduto;
use App\Models\Pedido;     
@endphp


        @php
        $heads = [

            ['label' => 'Número do Pedido', 'width' => 20],
            ['label' => 'Cliente', 'width' => 20],
            ['label' => 'Número de Produtos', 'width' => 20],
            ['label' => 'Status', 'width' => 20],
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
            'order' => [[0, 'dsc']],
           //'columns' => ['orderable'=> true]
        ];



        /* 
                    
                
                  
        
        */
        $primeiro = 0;
        $options = ['Pedido em andamento', 'Aguardando pagamento', 'Pedido Aprovado', 'Pedido Cancelado'];
       

        
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable with-buttons beautify>
            @foreach($pedidos as $pedido)
                <tr>
                    <?php
                        $cliente = Cliente::where('id', $pedido->cliente_id)->get()->first()->getAttributes();
                        $QuantidadeProdutos = PedidoProduto::where('pedido_id', $pedido->id)->count();
                        if (!($QuantidadeProdutos == 0)){
                            $pedidoProduto = PedidoProduto::where('pedido_id', $pedido->id)->get()->first();
                        }
                        else {
                            return redirect()->route('home');
                        }
                        
                       

                        //$pedidoProduto = new PedidoProduto();

                       
                        if (!($QuantidadeProdutos == 0)) {
                            ?>
                            <td>{{$pedido->id}}</td>
                            <td>{{$cliente['nome']}}</td>
                            <td>{{$QuantidadeProdutos}}</td>
                            <td>
                               
                            <form method="post" action="{{ route('pedido.status_save', ['pedido' => $pedido]) }}">
                                @csrf
                                <x-adminlte-select name="status" >
                        
                                            <x-adminlte-options :options="$options"  
                                            :selected="$pedido->status"
                                            
                                                />
                                        
                                </x-adminlte-select>
                            
                            
                                </td>
                                
                                <td>
                                
                                
                                    <x-adminlte-button class="btn btn-xs btn-default text-primary mx-1 shadow"  title="Salvar Status" type="submit" icon="fa fa-lg fa-fw fa-thumbs-up">
                                        
                                    </x-adminlte-button>
                            </form>



                                <form action="{{route('pedido-produto.show', ['pedidoProduto' => $pedidoProduto,  'primeiro' => $primeiro, 'pedido' => $pedido->id, 'id' => $cliente['id']  ])}}">
                                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Abrir Pedido" type="submit">
                                        <i class="fa fa-lg fa-fw fa-eye"></i>
                                    </button>
                                </form>

                                <form method="post" action="{{route('pedidos.destroy', $pedido)}}">


                                    <x-adminlte-modal id="{{ 'ctz'.$pedido->id }}" title="Confirmar Exclusão" size="md" theme="warning"
                                        icon="fas fa-exclamation-circle" v-centered static-backdrop >
                                        <div style="height:50px;">Você tem Certeza que deseja excluir este pedido?</div>
                                        <x-slot name="footerSlot">
                                            <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Sim"/>
                                            
                                            
                                            <x-adminlte-button theme="danger" label="Não" data-dismiss="modal"/>
                                            @csrf
                                        </x-slot>
                                    </x-adminlte-modal>
            
                                   
            
                                    
                                    @method('DELETE')
                                    
                                    
                                </form>
                                <button class="btn btn-xs btn-default text-danger mx-1 shadow"  data-toggle="modal" data-target="{{ '#ctz'.$pedido->id }}" title="Deletar">
                                    <i class="fa fa-lg fa-fw fa-trash"></i>
                                </button>
                                
                                
                                
            
                                
                                
                            
                        
                            </td>

                            <?php

                            
                        }
                    ?>
                    
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

@section('footer')
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos Reservados</h6>
    
@stop