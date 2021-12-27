@extends('adminlte::page')

@section('title', 'Listagem de Pedidos')

@section('content_header')
    <h1 align="center">Listagem do Pedido {{$pedidoProduto->pedido_id}}</h1>
@stop

@section('content')
    
            



        @php
        $heads = [

            
           
            ['label' => 'Produto', 'width' => 20],
            ['label' => 'Marca',  'width' => 20],
            ['label' => 'Descrição', 'width' => 40],
            ['label' => 'Preço Unitário',  'width' => 5],
            ['label' => 'Quantidade', 'no-export' => true,  'width' => 2],
            ['label' => 'Preço', 'no-export' => true,  'width' => 10],
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



        


        
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        
        <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable with-buttons beautify>
            @foreach($produtos as $produto)
                <tr>
                    
                    
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->marca}}</td>
                    <td>{{$produto->descricao}} </td>
                    <td>{{'R$ '.$produto->preco.',00'}}</td>
                    <td>{{$quantidades[$produto->id]}}</td>
                    <td>{{'R$ '.$quantidades[$produto->id] * $produto->preco.',00'}}</td>
                    <td>
                    
                    <form action="{{route('pedidosProdutos.edit', $produto->id)}}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </form>
                    
                    
                    

                    
                    
                    

                    
                    <form method="post" action="{{route('pedidosProdutos.destroy', $produto->id)}}">


                        <x-adminlte-modal id="{{ 'ctz'.$produto->id }}" title="Confirmar Exclusão" size="md" theme="warning"
                            icon="fas fa-exclamation-circle" v-centered static-backdrop >
                            <div style="height:50px;">Você tem Certeza que deseja excluir este produto?</div>
                            <x-slot name="footerSlot">
                                <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Sim"/>
                                
                                
                                <x-adminlte-button theme="danger" label="Não" data-dismiss="modal"/>
                                @csrf
                            </x-slot>
                        </x-adminlte-modal>

                       

                        
                        @method('DELETE')
                        
                        
                    </form>
                    
                    <button class="btn btn-xs btn-default text-danger mx-1 shadow"  data-toggle="modal" data-target="{{ '#ctz'.$produto->id }}" title="Deletar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                
                    </td>
                </tr>
            @endforeach
                
        </x-adminlte-datatable>
        

        <x-adminlte-button class="btn-flat" type="button" onclick="window.location='{{ route('pedido-produto.create', ['id' => $id, 'primeiro' => $primeiro, 'pedido' => $pedidoProduto->pedido_id,  ]) }}'" label="Adicionar" theme="success" icon="fas fa-lg fa-save"/>
        
       
        
        <br>
        
        <br>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop