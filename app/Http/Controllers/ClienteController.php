<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes = Cliente::where('nome', 'like', '%'.$request->input('nome').'%')
            
            ->where('cpf', 'like', '%'.$request->input('cpf').'%')
            ->where('uf', 'like', '%'.$request->input('uf').'%')
            ->where('email', 'like', '%'.$request->input('email').'%')
            ->where('endereco', 'like', '%'.$request->input('endereco').'%')
            ->where('numerocasa', 'like', '%'.$request->input('numerocasa').'%')
            ->where('cep', 'like', '%'.$request->input('cep').'%')
            ->Paginate(5);
       
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
