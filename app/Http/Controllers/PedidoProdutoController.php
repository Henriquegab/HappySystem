<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isEmpty;

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
    public function create(String $id, String $primeiro, Pedido $pedido)
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
    public function store(Request $request, String $id, String $primeiro, Pedido $pedido)
    {
        $verificaEstoque = Produto::where('id', $request->produto)->get();
        $verificaEstoque = $verificaEstoque->first()->getAttributes()['estoque'];
        //dd($verificaEstoque);

        $rules = [
            'produto' => 'required',
               
            
        
            'quantidade' => 'required|gte:1|lte:'.$verificaEstoque,
           


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'quantidade' => 'A quantidade deve ser maior que 1!',
            'lte' => 'O campo quantidade não pode ser maior que o estoque disponível!'
        ];



        $request->validate($rules, $feedback);
        

        
        
        if($primeiro == 5){
            $pedido = new Pedido();
            $pedido->cliente_id = $id;
            $pedido->save();
            

        }
        $primeiro = 0;
        
        $valida = PedidoProduto::where('pedido_id', $pedido->id)->where('produto_id', $request->produto)->get();
        
        
        if($valida->isEmpty()){
            

            $pedidoProduto = new PedidoProduto();
            $pedidoProduto->pedido_id = $pedido->id;
            //dd($pedido);
            $pedidoProduto->produto_id = $request->get('produto');
            $pedidoProduto->quantidade = $request->get('quantidade');
            $pedidoProduto->save();

            return redirect()->route('pedido-produto.show', ['pedidoProduto' => $pedidoProduto, 'primeiro' => $primeiro, 'pedido' => $pedido, 'id' => $id]);
        }
        else{

            //refatorável ($valida = $valida->first)


            $mudar = PedidoProduto::find($valida->get(0)->getAttributes()['id']);
            $mudar->quantidade = $valida->get(0)->getAttributes()['quantidade'] + $request->quantidade;
            $mudar->save();

            return redirect()->route('pedido-produto.show', ['pedidoProduto' => $mudar, 'primeiro' => $primeiro, 'pedido' => $pedido, 'id' => $id]);
           
        }
        

        //$pedidoProduto = PedidoProduto::Where('pedido_id', $pedido->id);


        //dd($pedidoProduto);

       
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
        //dd($id);
        $quantidades = array();
        $x = array();
        foreach ($pedidoProdutos as $pedidoProduto) {
            $quantidades[$pedidoProduto->produto_id] = $pedidoProduto->quantidade;
           $x[$pedidoProduto->produto_id] = $pedidoProduto->id;
        }

        
        
        return view('Order.lista', ['quantidades' => $quantidades, 'pedidoProduto' => $pedidoProduto, 'primeiro' => $primeiro, 'pedido' => $pedido, 'id' => $id, 'x' => $x]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(String $id, String $primeiro, Pedido $pedido, String $quantidade, $x)
    {
        //dd($pedido);
        $produtos = Produto::all();
        
        //$pedido->save();
        //dd($pedido);
        //dd($request->get('request'));
        //dd($primeiro);

        //dd($x);

        
        $selecionar = PedidoProduto::where('id', $x)->get()->first();
        //dd($selecionar);

        return view('Order.editar', ['id' => $id, 'primeiro' => $primeiro, 'produtos' => $produtos, 'pedido' => $pedido, 'quantidade' => $quantidade, 'selecionar' => $selecionar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $id, String $primeiro, Pedido $pedido, String $quantidade)
    {
        $verificaEstoque = Produto::where('id', $request->produto)->get();
        //dd($request);
        $verificaEstoque = $verificaEstoque->first()->estoque;
        
        $verificaEstoque = $verificaEstoque + $quantidade;

        $rules = [
            'produto' => 'required',
               
            
        
            'quantidade' => 'required|gte:1|lte:'.$verificaEstoque,
           


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'quantidade' => 'A quantidade deve ser maior que 1!',
            'lte' => 'O campo quantidade não pode ser maior que o estoque disponível!'
        ];



        $request->validate($rules, $feedback);
        

        
        
        if($primeiro == 5){
            $pedido = new Pedido();
            $pedido->cliente_id = $id;
            $pedido->save();
            

        }
        $primeiro = 0;

        $pedidoProduto = PedidoProduto::where('pedido_id', $pedido->id)->where('produto_id', $request->produto)->get();
        //dd($pedidoProduto->first()->produto_id);
            //$pedidoProduto->first()->pedido_id = $pedido->id;
            //dd($pedido);
            $pedidoProduto->first()->produto_id = $request->get('produto');
            $pedidoProduto->first()->quantidade = $request->get('quantidade');
            $pedidoProduto->first()->save();
        
        //dd($pedidoProduto->first()->getAttributes()['']);

            return redirect()->route('pedido-produto.show', ['pedidoProduto' => $pedidoProduto->first(), 'primeiro' => $primeiro, 'pedido' => $pedido, 'id' => $id]);
           
        
        

        //$pedidoProduto = PedidoProduto::Where('pedido_id', $pedido->id);


        //dd($pedidoProduto);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoProduto $pedidoProduto, String $primeiro, Pedido $pedido, Produto $produto,  String $id)
    {
        //dd($pedidoProduto);
        $deletar = PedidoProduto::where('pedido_id', $pedidoProduto->pedido_id)->where('produto_id', $produto->id);
        $salvar = $deletar->first()->getAttributes()['pedido_id'];
        $deletar = $deletar->first();
        $deletar->delete();

        $verificar = PedidoProduto::where('pedido_id', $pedido->id)->get();

        //dd($pedidoProduto);
        //dd($verificar[0]);

        
        if($verificar->isEmpty()){
            

            $notification = $pedido->id;
            $pedido->delete();
            
            return redirect()->route('home2', ['notification' => $notification]);
        };

        

        $pedidoProduto = PedidoProduto::where('pedido_id', $pedido->id)->get();
        //dd($pedidoProduto);

        return redirect()->route('pedido-produto.show', ['pedidoProduto' => $pedidoProduto[0], 'primeiro' => $primeiro, 'pedido' => $pedido->id, 'id' => $id]);
    }
}
