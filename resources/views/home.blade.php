@extends('adminlte::page')

@section('title', 'Menu')

@section('content_header')
    <h1 align="center">Menu Principal</h1>
@stop

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <p align="center">Seja Bem-vindo!</p>
    @if (isset($notification))

    <x-adminlte-alert theme="danger" title="Aviso!">
        {{ $notification }}
    </x-adminlte-alert>
    @endif

    @php
        use App\Models\Cliente;
        use App\Models\Produto;
        use App\Models\PedidoProduto;
        use App\Models\Pedido;
        use App\Models\User;

        $metaCliente = 300;
        $metaProduto = 15;
        $progressoCliente = Cliente::count() / $metaCliente * 100;
        $progressoProduto = Produto::count() / $metaProduto * 100;
        

        
        




    @endphp

    

    <div class="row">


        <div class="col-md-6">
            <x-adminlte-info-box title="Meta de Clientes" text="{{ Cliente::count() }}/{{ $metaCliente }}" icon="fas fa-lg fa-users text-orange" theme="warning"
            icon-theme="dark" progress="{{ intval($progressoCliente)  }}" progress-theme="dark"
            description="{{ intval($progressoCliente)  }}% da meta concluida!"/>
        </div>


        <div class="col-md-6">
            <x-adminlte-info-box title="Meta de Produtos" text="{{ Produto::count() }}/{{ $metaProduto }}" icon="fas fa-lg fa-shopping-bag text-dark"
            theme="danger" id="ibUpdatable" progress="{{ intval($progressoProduto) }}" progress-theme="teal"
            description="{{ intval($progressoProduto) }}% da meta concluida!"/>

            
        </div>

       
    </div>
    <div class="row">

        <div class="col-md-4">

            <x-adminlte-info-box title="Pedidos" text="{{ Pedido::count() }}" icon="fas fa-lg fa-shopping-cart text-dark" theme="pink"/>
        </div>
        <div class="col-md-4">
        
            <x-adminlte-info-box title="Valor Arrecadado" text="{{ 'R$ '.number_format($valorTotal, 2) }}" icon="fas fa-lg fa-dollar-sign text-dark" theme="green"/>


        </div>

        <div class="col-md-4">
            <x-adminlte-info-box title="{{ User::count() }}" text="Usuários Cadastrados" icon="fas fa-lg fa-user-plus text-primary"
            theme="gradient-primary" icon-theme="white"/>

            
        </div>

    </div>

    <x-adminlte-card title="Purple Card" theme="purple" icon="fas fa-lg fa-fan" removable collapsible >
        
       
            <canvas id="myChart" width="200" height="50"></canvas>
                <script>
                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Clientes', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                            datasets: [{
                                label: '# of Votes',
                                data: [<?php echo Cliente::count() ?>, 240, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
        


    </x-adminlte-card>

    







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