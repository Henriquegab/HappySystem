<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\PedidoProduto;
use App\Models\Pedido;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Produto::Paginate(30);
       
        return view('Product.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Product.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'nome' => 'required|min:3|max:40',
            'marca' => 'required',
            'descricao' => 'required',
            'preco' => 'required|gte:0',
            'estoque' => 'required|gte:1',
            


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'preco.gte' => 'O preço não pode ser menor que 0',
            'nome.min' => 'O nome deve conter no mínimo 3 caracteres',
            'estoque.gte' => 'O estoque adicionado deve ser maior que 1!',
            'nome.max' => 'O nome deve conter no máximo 40 caracteres',
            
        ];



        $request->validate($rules, $feedback);

        //dd($request);

        
        $produtos = new Produto();
        $produtos->nome = $request->get('nome');
        $produtos->marca = $request->get('marca');
        $produtos->descricao = $request->get('descricao');
        $produtos->preco = $request->get('preco');
        $produtos->estoque = $request->get('estoque');
        

        
        $produtos->save();
        
        return redirect()->route('home');
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
    public function edit(Produto $produto)
    {
        return view('Product.editar', ['produto' => $produto]);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        $rules = [
            'nome' => 'required|min:3|max:40',
            'marca' => 'required',
            'descricao' => 'required',
            'preco' => 'required|gte:0',
            'estoque' => 'required|gte:1',
            


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'preco.gte' => 'O preço não pode ser menor que 0',
            'nome.min' => 'O nome deve conter no mínimo 3 caracteres',
            'estoque.gte' => 'O estoque adicionado deve ser maior que 1!',
            'nome.max' => 'O nome deve conter no máximo 40 caracteres',
            
        ];



        $request->validate($rules, $feedback);

        //dd($request);

        
        $produto->update($request->all());
        
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $deletar = PedidoProduto::where('produto_id', $produto->id);
        $deletado = $deletar;
        
        if($deletar->exists()){
            //dd(0);
            foreach($deletar->get() as $deleta){
                //dd($deleta->getAttributes()['pedido_id']);

                $verificaUnico = PedidoProduto::where('pedido_id', $deleta->getAttributes()['pedido_id'])->where('produto_id', '!=', $produto->id)->get()->first();
                //dd(1);
                    if($verificaUnico == NULL){
                        $excluirPedido = Pedido::where('id', $deleta->getAttributes()['pedido_id'])->get()->first();
                       // dd(2);
                            if(!$excluirPedido == NULL){
                                //dd(4);
                                $deletado->delete();
                                $excluirPedido->delete();
                            }
                    }
                //dd(5);
            }
        };
       // dd(6);
        $produto->delete();

        
        return redirect()->route('home');
    }
}
