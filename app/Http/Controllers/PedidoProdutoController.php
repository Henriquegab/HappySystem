<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(String $id, int $primeiro, Pedido $pedido)
    {
        //dd($pedido);
        $produtos = Produto::all();
        
        //$pedido->save();
        //dd($pedido);
        //dd($request->get('request'));
        //dd($primeiro);

       
        return view('Order.cadastroProduto', ['id' => $id, 'primeiro' => $primeiro, 'produtos' => $produtos, 'pedido' => $pedido]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, String $id, int $primeiro, Pedido $pedido)
    {
        

        if($primeiro == 5){
            $pedido = new Pedido();
            $pedido->cliente_id = $id;
            $pedido->save();
            

        }
        $primeiro = 0;
        
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        //dd($pedido);
        $pedidoProduto->produto_id = $request->get('produto');
        $pedidoProduto->quantidade = $request->get('quantidade');
        $pedidoProduto->save();

        //$pedidoProduto = PedidoProduto::Where('pedido_id', $pedido->id);


        //dd($pedidoProduto);

        return redirect()->route('pedido-produto.show', ['pedidoProduto' => $pedidoProduto, 'primeiro' => $primeiro, 'pedido' => $pedido, 'id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  PedidoProduto  $pedidoProduto
     * @return \Illuminate\Http\Response
     */
    public function show(PedidoProduto $pedidoProduto, String $primeiro, Pedido $pedido, String $id)
    {
        //$pedidoProduto = PedidoProduto::where('pedido_id', 'pedido->id');

        //dd($pedido->produtos);
        $pedidoProdutos = PedidoProduto::where('pedido_id', $pedido->id)->get();

        $quantidades = array();
        foreach ($pedidoProdutos as $pedidoProduto) {
            $quantidades[$pedidoProduto->produto_id] = $pedidoProduto->quantidade;
           
        }
        
        return view('Order.lista', ['quantidades' => $quantidades, 'pedidoProduto' => $pedidoProduto, 'primeiro' => $primeiro, 'produtos' => $pedido->produtos, 'id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
