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

       /* $rules = [
            'produto' => 'required|'
               
            
        
            'quantidade' => 'email|unique:clientes,email',
           


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'email' => 'O email deve ser válido!',
            'unique' => 'O campo :attribute já existe',
            'nome.min' => 'O nome deve conter no mínimo 3 caracteres',
            'nome.max' => 'O nome deve conter no máximo 40 caracteres',
            'endereco.min' => 'O endereço deve conter ao menos 3 caracteres!',
            'numerocasa.min' => 'O numero da casa deve conter ao menos 1 caractere!',
            'cpf' => 'O cpf não é válido!',
            'formato_cpf' => 'O cpf não está com o formato certo!',
            'uf' => 'A uf não é válida'
        ];



        $request->validate($rules, $feedback);
        
*/
        
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        
    }
}
