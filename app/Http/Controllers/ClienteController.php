<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\PedidoProduto;
use App\Models\Pedido;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::orderby('id', 'asc')->Paginate(30)->withQueryString();
       


       



        return view('Client.index', ['clientes' => $clientes, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Client.cadastro');
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
            'email' => 'email|unique:clientes,email',
            'cpf' => 'cpf|unique:clientes,cpf',
            'sexo' => 'required',
            'endereco' => 'required|min:3',
            'numerocasa' => 'required|min:1',
            'cep' => 'required',
            'uf' => 'required|uf',


            

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

        //dd($request);

        /*
        $clientes = new Cliente();
        $clientes->nome = $request->get('nome');
        $clientes->email = $request->get('email');
        $clientes->cpf = $request->get('cpf');
        $clientes->sexo = $request->get('sexo');
        $clientes->endereco = $request->get('endereco');
        $clientes->numerocasa = $request->get('numerocasa');
        $clientes->cep = $request->get('cep');
        $clientes->uf = $request->get('uf');

        
        $clientes->save();
        */

        Cliente::create($request->all());

        return redirect()->route('clientes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        
        return view('Client.editar', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $rules = [
            'nome' => 'required|min:3|max:40',
            'email' => 'email|unique:clientes,email,' .$cliente->id,
            'endereco' => 'required|min:3',
            'numerocasa' => 'required|min:1',
            'cep' => 'required',
            'uf' => 'required|uf',


            

        ];

        $feedback = [

            'required' => 'O campo :attribute deve ser preenchido',
            'email' => 'O email deve ser válido!',
            'unique' => 'O campo :attribute já existe',
            'nome.min' => 'O nome deve conter no mínimo 3 caracteres',
            'nome.max' => 'O nome deve conter no máximo 40 caracteres',
            'endereco.min' => 'O endereço deve conter ao menos 3 caracteres!',
            'numerocasa.min' => 'O numero da casa deve conter ao menos 1 caractere!',
            'formato_cpf' => 'O cpf não está com o formato certo!',
            'uf' => 'A uf não é válida'
        ];



        $request->validate($rules, $feedback);

        

        
        $cliente->update($request->all());
        
        return redirect()->route('clientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $deletar = Pedido::where('cliente_id', $cliente->id)->get();
        
        foreach ($deletar as $deleta) {
           // dd($deleta->getAttributes()['id']);
          

            $excluir = PedidoProduto::where('pedido_id', $deleta->getAttributes()['id']);
            $excluir->delete();
            $deleta->delete();
            
        }

        
        
        //$deletar->delete();
        $cliente->delete();

       


        
        return redirect()->route('clientes.index');
    }
}
