@extends('adminlte::page')

@section('title', 'Listagem de Produtos')

@section('content_header')
    <h1 align="center">Listagem de Produtos</h1>
@stop

@section('content')
    
            



        @php
        $heads = [

            ['label' => 'Id', 'width' => 20],
            ['label' => 'Nome', 'width' => 20],
            ['label' => 'Marca', 'width' => 20],
            ['label' => 'Descrição',  'width' => 40],
            ['label' => 'Preço',  'width' => 5],
            ['label' => 'Estoque', 'no-export' => true,  'width' => 2],
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
                    
                    <td>{{$produto->id}}</td>
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->marca}}</td>
                    <td>{{$produto->descricao}} </td>
                    <td>{{$produto->preco}}</td>
                    <td>{{$produto->estoque}}</td>
                    <td>
                    
                    <form action="{{route('produtos.edit', $produto->id)}}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </form>
                    
                    

                    
                    
                    

                    
                    <form method="post" action="{{route('produtos.destroy', $produto->id)}}">


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
        
        
       
        
        <br>
        {{ $produtos->links() }}
        <br>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop