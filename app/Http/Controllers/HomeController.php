<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produto;
use App\Models\PedidoProduto;
use App\Models\Pedido;

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
