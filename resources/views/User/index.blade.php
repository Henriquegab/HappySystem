@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    
@stop

@section('content')

@php
    use App\Models\Cliente;
        use App\Models\Produto;
        use App\Models\PedidoProduto;
        use App\Models\Pedido;
        use App\Models\User;
        use Illuminate\Support\Facades\Auth;

        $imagem = Auth::user()->image;
@endphp
    
            
        <x-adminlte-profile-widget name="{{ $nome }}" desc="Administrador" theme="teal"
        img="{{ Auth::user()->image == NULL ? 'https://avatars.githubusercontent.com/u/67250181?s=400&u=4750b82eaf738a93546dc67a2b5dfa67ea009a67&v=4' : asset('storage/'.$imagem) }}">
        <x-adminlte-profile-col-item title="Quantidade de pedidos recebidos" text="{{ Pedido::count() }}" url="#"/>
        <x-adminlte-profile-col-item title="Quantidade de produtos a venda" text="{{ Produto::count() }}" url="#"/>
        <x-adminlte-profile-col-item title="Quantidade de clientes" text="{{ Cliente::count() }}" url="#"/>
        </x-adminlte-profile-widget>

        
        

        <form method="post" action="{{ route('usuarios.update', ['usuario' => Auth::user()->id]) }}">
            

            <div class="row">
                <x-adminlte-input enable-old-support name="imagem" type="text" placeholder="Coloque aqui o link da imagem" fgroup-class="col-md-12" label="Mudar Imagem de perfil"/>

            
            </div>
            <x-adminlte-button class="btn-flat" type="submit" label="Cadastrar" theme="success" icon="fas fa-lg fa-save"/>
        </form>

        <form method="put" action="{{ route('usuarios.update' , ['usuario' => Auth::user()->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlFile1">Enviar Imagem</label>
                <input type="file" class="form-control-file" name="imagem" id="imagem">
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>




@stop

@section('plugins.BsCustomFileInput', true)

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('footer')
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos Reservados</h6>
    
@stop