<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Produto::where('nome', 'like', '%'.$request->input('nome').'%')
            
            ->where('marca', 'like', '%'.$request->input('marca').'%')
            ->where('descricao', 'like', '%'.$request->input('descricao').'%')
            ->where('preco', 'like', '%'.$request->input('preco').'%')
            ->where('estoque', 'like', '%'.$request->input('estoque').'%')
            ->Paginate(30);
       
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
            'estoque' => 'required',
            


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'preco.gte' => 'O preço não pode ser menor que 0',
            'nome.min' => 'O nome deve conter no mínimo 3 caracteres',
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
            'estoque' => 'required',
            


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'preco.gte' => 'O preço não pode ser menor que 0',
            'nome.min' => 'O nome deve conter no mínimo 3 caracteres',
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
        $produto->delete();

        
        return redirect()->route('home');
    }
}