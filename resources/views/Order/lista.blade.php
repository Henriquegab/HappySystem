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



        $total = 0;


        
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        
        <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable with-buttons beautify>
            @foreach($pedido->produtos as $produto)
                <tr>
                    
                    
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->marca}}</td>
                    <td>{{$produto->descricao}} </td>
                    <td>{{'R$ '.number_format($produto->preco, 2)}}</td>
                    <td>{{$quantidades[$produto->id]}}</td>
                    <td>{{'R$ '.number_format($quantidades[$produto->id] * $produto->preco, 2)}}</td>
                    <td>
                    
                    <form action="{{route('pedido-produto.edit', ['id' => $id, 'primeiro' => $primeiro, 'pedido' => $pedido->id, 'quantidade' => $quantidades[$produto->id], 'x' => $x[$produto->id]])}}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </form>
                    
                    @php
                        $total += $quantidades[$produto->id] * $produto->preco;
                    @endphp
                    

                    
                    
                    

                    
                    <form method="post" action="{{route('pedido-produto.destroy',['pedidoProduto' => $pedidoProduto ,'primeiro' => $primeiro, 'pedido' => $pedido,'produto'=>$produto->id, 'id' => $id] )}}">


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
        
        <div>

            <x-adminlte-button class="btn-flat" type="button" onclick="window.location='{{ route('pedido-produto.create', ['id' => $id, 'primeiro' => $primeiro, 'pedido' => $pedidoProduto->pedido_id,  ]) }}'" label="Adicionar" theme="success" icon="fas fa-lg fa-plus"/>
            
                

            <x-adminlte-button style="align:right" class="btn-flat" type="button" onclick="window.location='{{ route('pedido.status', ['pedido' => $pedidoProduto->pedido_id  ]) }}'" label="Confirmar Pedido" theme="outline-success" icon="fas fa-lg fa-thumbs-up"/> 
                
                
                <div style="padding-left: 75%" >

                    <x-adminlte-info-box title="Subtotal" text="{{ 'R$ '.number_format($total, 2) }}" icon="fas fa-lg fa-dollar-sign text-dark" theme="gradient-teal"/> 
        
                </div>
            

        </div>


            
        <br>
        
             
        
        
        
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