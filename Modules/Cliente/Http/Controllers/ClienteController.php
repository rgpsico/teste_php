<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Cliente\Entities\Cliente;
use Modules\Cliente\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Cliente = Cliente::all();
        foreach ($Cliente as $value) {
            $this->array['result'][] = [
                'id' => $value->id,
                'nome' => $value->nome,
                'email' => $value->email,
            ];
        }
        return $this->array;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ClienteRequest $request)
    {
            $array = ['error'=>''];
     
            $nome = $request->input("nome");
            $email = $request->input("email");
            $Cliente = new Cliente();
            $Cliente->nome = $nome;
            $Cliente->email = $email;
            $Cliente->save();
            $result= [
                'id_Cliente' => $Cliente->id,
            ];
            return $result;
        
        } 
    

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $Cliente = Cliente::where('id', $id)->get();

        if ($Cliente) {
            $this->array['result'] = $Cliente;
        } else {
            $this->array['error'] = "ID não encontrado";
        }
        return $this->array;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(request $request)
    {
        $id = $request->input("id");
        $nome = $request->input("nome");
        $email = $request->input("email");

        $validated = $request->validate([
            'nome' => 'required|max:255',
            'email' => 'required',
        ], [
            'required' => "olha o nome",
        ]);

        $cliente = Cliente::find($id);

        $cliente->nome = $nome;
        $cliente->email = $email;
        $cliente->save();

        $result = $this->array['result'] = [
            'id' => $id,
            'nome' => $nome,
            'email' => $email,
        ];

        return $result;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        {
            $Cliente = Cliente::find($id);
            if ($Cliente) {
                $Cliente->delete();
                $this->array['error'] = "Excluido com sucesso";
            } else {
                $this->array['error'] = "ID não encontrado";
            }
            return $this->array;
        }
    }
}
