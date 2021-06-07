<?php

namespace Modules\Pastel\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Pastel\Entities\Pastel;

class PastelController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Pastel = Pastel::all();
        foreach ($Pastel as $value) {
            $this->array['result'][] = [
                'id' => $value->id,
                'nome' => $value->nome,
                'preco' => $value->preco,
                'foto'=>$value->foto
            ];
        }
        return $this->array;
    }



    public function store(Request $request)
    {
        $array = ['error' => ''];

        $nome  = $request->input("nome");
        $preco = $request->input("preco");

        if($request->file('foto')->isValid()){
          $file =  $request->file('foto')->store('image');
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'preco' => 'required',
        ]);
        
        if (!$validator->fails()) {
            $Pastel = new Pastel();
            $Pastel->nome = $nome;
            $Pastel->preco = $preco;
            $Pastel->foto = $file;
            $Pastel->save();
            $result= [
                'id_pastel' => $Pastel->id,
            ];
            return $result;
        } else {
            $array['error'] = $validator->errors()->first();
            return $array;

        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        {
            $Pastel = Pastel::where('id', $id)->get();

            if ($Pastel) {
                $this->array['result'] = $Pastel;
            } else {
                $this->array['error'] = "ID não encontrado";
            }
            return $this->array;
        }
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
        $preco = $request->input("preco");
        $foto = $request->input("foto");

        $validated = $request->validate([
            'nome' => 'required|max:255',
            'preco' => 'required',
        ], [
            'required' => "olha o nome",
        ]);

        $Pastel = Pastel::find($id);
        $Pastel->nome = $nome;
        $Pastel->preco = $preco;
        $Pastel->save();
        $result = $this->array['result'] = [
            'id' => $id,
            'nome' => $nome,
            'preco' => $preco,
        ];
        return $result;
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        {
            $Pastel = Pastel::find($id);
            if ($Pastel) {
                $Pastel->delete();
                $this->array['error'] = "Excluido com sucesso";
            } else {
                $this->array['error'] = "ID não encontrado";
            }
            return $this->array;
        }
    }
}
