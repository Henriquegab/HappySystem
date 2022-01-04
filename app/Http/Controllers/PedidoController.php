<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\PedidoProduto;   
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::orderby('id', 'asc')->Paginate(30);
        $clientes = Cliente::all();

        foreach($pedidos as $pedido)
        {

            $QuantidadeProdutos = PedidoProduto::where('pedido_id', $pedido->id)->count();
            if(!($QuantidadeProdutos >= 1)){

                //dd($QuantidadeProdutos);
                $pedido->delete();
            }
        }

        //dd($pedidos->count());

        return view('Order.index', ['pedidos' => $pedidos, 'clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();

        return view('Order.cadastro', ['clientes' => $clientes]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $primeiro)
    {

        $rules = [
            'cliente' => 'required'









        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',

        ];



        $request->validate($rules, $feedback);


        $id = $request->get('cliente');
        //dd($primeiro);
        //$pedido->save();
        //dd($pedido);



        return redirect()->route('pedido-produto.create', ['id' => $id, 'primeiro' => $primeiro]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy(Pedido $pedido)
    {
        $excluir = PedidoProduto::where('pedido_id', $pedido->id);
        $excluir->delete();
        $pedido->delete();

        return redirect()->route('pedidos.index');
    }
}
