@extends('adminlte::page')

@section('title', 'Menu')

@section('content_header')
    <h1>Menu Principal</h1>
@stop

@section('content')
    
<?php /*

        <div class="">


            <div class="menu">
                <ul>
                    <li><a href="{{route('clientes.create')}}">Novo</a></li>
                    
                </ul>
            </div>

            <div class="informacao-pagina">
                <div style="width: 90%; margin-left: auto; margin-right: auto;">
                    <table border="1" width="100%">
                        <thead>
                            <tr>    
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>UF</th>
                                <th>Endereço</th>
                                <th>Número</th>
                                <th></th>
                                <th></th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>    
                                    <td>{{$cliente->nome}}</td>
                                    <td>{{$cliente->email}}</td>
                                    <td>{{$cliente->cpf}}</td>
                                    <td>{{$cliente->uf}}</td>
                                    <td>{{$cliente->endereco}}</td>
                                    <td>{{$cliente->numerocasa}}</td>
                                    <td><a href="{{route('clientes.destroy', $cliente->id)}}"> Excluir</a></td>
                                    <td><a href="{{route('clientes.edit', $cliente->id)}}">Editar</a></td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                
                        
                    </table>
                        {{ $clientes->appends($request)->links() }}

                        <br>

                    
                        <br>
                        <br>
                    
                        
                </div>
            </div>
        </div>

*/
?>



        @php
        $heads = [
            
            ['label' => 'Nome', 'width' => 20],
            ['label' => 'Email', 'width' => 20],
            ['label' => 'CPF', 'no-export' => true, 'width' => 5],
            ['label' => 'UF', 'no-export' => true, 'width' => 2],
            ['label' => 'Endereço', 'no-export' => true, 'width' => 15],
            ['label' => 'Número', 'no-export' => true, 'width' => 5],
            ['label' => 'CEP', 'no-export' => true, 'width' => 10],
            ['label' => 'Ações', 'no-export' => true, 'width' => 5],
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
            
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
        
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table2" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable>
            @foreach($clientes as $cliente)
                <tr>
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->email}}</td>
                    <td>{{$cliente->cpf}}</td>
                    <td>{{$cliente->uf}}</td>
                    <td>{{$cliente->endereco}}</td>
                    <td>{{$cliente->numerocasa}}</td>
                    <td>{{$cliente->cep}}</td>
                    <td>
                        
                    <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>
                
                    <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Deletar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                
                    
                
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>







@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop