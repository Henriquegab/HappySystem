<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\PedidoProduto;
use App\Models\Pedido;
use App\Models\Objeto;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentTime = Carbon::now();
        $dados_pedidos = array();

        $ano = $currentTime->toArray()['year'];
        $meses = array();
        $anos = array();
        // $nomesMeses = ['', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
        $mesAtual = $currentTime->toArray()['month'];
        for ($i = 6; $i > 0; $i--) {
            $meses[$i] = $mesAtual;
            $anos[$i] = $ano;
            $mesAtual--;
            if ($mesAtual == 0) {
                $mesAtual = 12;
                $ano--;
            }
        }







        

        $pedidosFeitos = array();
        for ($i = 6; $i <= 6; $i++) {
            $a = Pedido::where('status', "2")->whereMonth('created_at', $meses[$i])->whereYear('created_at', $anos[$i])->get()->first();
            $pedidosFeitos[$i] = $a;
        }
        dd($pedidosFeitos[$i]);

        $valorTotal = array();

        for ($i = 6; $i <= 6; $i++){

            //$pedidosFeitos = Pedido::where('status', "2")->whereMonth('created_at', $meses[6])->get();
            if (!$pedidosFeitos[$i] == NULL) {
                foreach ($pedidosFeitos as $pedidosFeito) {
                    $pedidoProdutos = PedidoProduto::where('pedido_id', $pedidosFeito->id)->get();
                    //dd(1);
                    foreach ($pedidoProdutos as $pedidoProduto) {

                        $produto = Produto::find($pedidoProduto->produto_id);
                        $valor = $produto->preco * $pedidoProduto->quantidade;
                        $valorTotal += $valor;
                    }
                    //d(0);

                }
        }

        }
        
    


        //dd($valorTotal);



        return view('home', ['valorTotal' => $valorTotal]);
    }

    public function index2(String $notification)
    {

        $valorTotal = 0;

        $pedidosFeitos = Pedido::where('status', "2")->get();

        if (!$pedidosFeitos == NULL) {
            foreach ($pedidosFeitos as $pedidosFeito) {
                $pedidoProdutos = PedidoProduto::where('pedido_id', $pedidosFeito->id)->get();
                //dd(1);
                foreach ($pedidoProdutos as $pedidoProduto) {

                    $produto = Produto::find($pedidoProduto->produto_id);
                    $valor = $produto->preco * $pedidoProduto->quantidade;
                    $valorTotal += $valor;
                }
                //d(0);

            }
        }



        return view('home', ['notification' => $notification, 'valorTotal' => $valorTotal]);
    }
}
