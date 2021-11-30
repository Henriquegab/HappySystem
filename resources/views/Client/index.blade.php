@extends('adminlte::page')

@section('title', 'Listagem de Clientes')

@section('content_header')
    <h1 align="center">Listagem de Clientes</h1>
@stop

@section('content')
    
            



        @php
        $heads = [
            
            ['label' => 'Nome', 'width' => 20],
            ['label' => 'Email', 'width' => 20],
            ['label' => 'Sexo',  'width' => 5],
            ['label' => 'CPF',  'width' => 5],
            ['label' => 'UF', 'no-export' => true,  'width' => 2],
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
            'paging' => false,
            
            'ordering' => true,
            'order' => [[1, 'asc']],
            //'columns' => ['orderable'=> true, 'targets' => 0, null, null, null, null, null, null, null, null]
        ];
        
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table" :heads="$heads" head-theme="dark" :config="$config" theme="light" striped hoverable with-buttons beautify>
            @foreach($clientes as $cliente)
                <tr>
                    <?php
                        $sexo = $cliente->sexo;
                        if ($sexo == 0) {
                            $sexo = 'Masculino';
                        }
                        else {
                            if ($sexo == 1) {
                            $sexo = 'Feminino';
                        }
                            else {
                                $sexo = 'Outros';
                            }
                        }
                    ?>
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->email}}</td>
                    <td>{{$sexo}}</td>
                    <td>{{$cliente->cpf}} </td>
                    <td>{{$cliente->uf}}</td>
                    <td>{{$cliente->endereco}}</td>
                    <td>{{$cliente->numerocasa}}</td>
                    <td>{{$cliente->cep}}</td>
                    <td>
                    
                    <form action="{{route('clientes.edit', $cliente->id)}}">
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar" type="submit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                    </form>
                    
                    

                    
                    
                    

                    
                    <form method="post" action="{{route('clientes.destroy', $cliente->id)}}">


                        <x-adminlte-modal id="{{ 'ctz'.$cliente->id }}" title="Confirmar Exclusão" size="md" theme="warning"
                            icon="fas fa-exclamation-circle" v-centered static-backdrop >
                            <div style="height:50px;">Você tem Certeza que deseja excluir este usuário?</div>
                            <x-slot name="footerSlot">
                                <x-adminlte-button class="mr-auto" type="submit" theme="success" label="Sim"/>
                                
                                
                                <x-adminlte-button theme="danger" label="Não" data-dismiss="modal"/>
                                @csrf
                            </x-slot>
                        </x-adminlte-modal>

                       

                        
                        @method('DELETE')
                        
                        
                    </form>
                    
                    <button class="btn btn-xs btn-default text-danger mx-1 shadow"  data-toggle="modal" data-target="{{ '#ctz'.$cliente->id }}" title="Deletar">
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </button>
                
                    </td>
                </tr>
            @endforeach
           
        </x-adminlte-datatable>
        
        
       
        
        <br>
        {{ $clientes->links() }}
        <br>






@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop