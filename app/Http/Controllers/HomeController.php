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

        $valor = 0;

        $pedidosFeitos = Pedido::where('status', "2")->get();

        if (!$pedidosFeitos == NULL) {
            foreach ($pedidosFeitos as $pedidosFeito) {
                $ValorArrecadados = PedidoProduto::where('pedido_id', $pedidosFeito->getAttributes()['id']);
                
                foreach ($ValorArrecadados as $ValorArrecadado) {
                    dd($ValorArrecadado);
                    $valorProduto = Produto::where('id', $ValorArrecadado->getAttributes()['produto_id'])->get()->getAttibutes()['preco'];
                    $valorTotal = $valorProduto * $ValorArrecadado->getAttributes()['quantidade'];
                    $valor += $valorTotal;
                    

                }
            }
        }



    


        return view('home');
    }

    public function index2(String $notification)
    {
        return view('home', ['notification' => $notification]);
    }

}
