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
        img="{{ Auth::user()->image == null ? 'https://thispersondoesnotexist.com' : asset('storage/' . $imagem) }}">
        <x-adminlte-profile-col-item title="Quantidade de pedidos recebidos" text="{{ Pedido::count() }}" url="#" />
        <x-adminlte-profile-col-item title="Quantidade de produtos a venda" text="{{ Produto::count() }}" url="#" />
        <x-adminlte-profile-col-item title="Quantidade de clientes" text="{{ Cliente::count() }}" url="#" />
    </x-adminlte-profile-widget>




        {{-- Esta parte ainda está com erro --}}

    <form method="post" action="{{ route('usuarios.update', ['usuario' => auth()->user()->id]) }}">
        @csrf
        @method("patch")
        <div class="mb-3">
            <label for="imagem" class="form-label">Enviar Imagem</label>
            <input class="form-control-file" type="file" name="imagem" id="imagem" enctype="multipart/form-data">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

    {{-- Fim da parte com erro --}}


@stop

{{-- @section('plugins.BsCustomFileInput', true) --}}

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop

@section('footer')
    <h6 align="center">Happy System - <a href="https://github.com/Henriquegab">Henrique gabriel</a> Todos os Direitos
        Reservados</h6>

@stop
