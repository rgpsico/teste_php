<?php

namespace Modules\Pedido\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Pedido\Entities\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        $Pedido = Pedido::all();
        foreach ($Pedido as $value) {
            $this->array['result'][] = [
                'id' => $value->id,
                'CodigoCliente' => $value->CodigoCliente,
                'codigoPastel' => $value->codigoPastel,
            ];
        }
        return $this->array;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
   

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $CodigoCliente  = $request->input("CodigoCliente");
        $codigoPastel   = $request->input("CodigoPastel");

        $validator = Validator::make($request->all(),[
            'CodigoCliente' => 'required',
            'CodigoPastel'=>'required'
        ]);

        if(!$validator->fails()){
            $Pedido = new Pedido();
            $Pedido->CodigoCliente  = $CodigoCliente;
            $Pedido->codigoPastel = $codigoPastel;
            $Pedido->save();

        $result = ['id_Pedido' => $Pedido->id];
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
            $Pedido = Pedido::where('id', $id)->get();
    
            if ($Pedido) {
                $this->array['result'] = $Pedido;
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
        $id              = $request->input("id");
        $CodigoCliente   = $request->input("CodigoCliente");
        $CodigoPastel    = $request->input("CodigoPastel");
      

/*
        $validated = $request->validate([
            'CodigoCliente' => 'required|max:255',
            'codigoPastel' => 'required',
        ], [
            'required' => "olha o CodigoCliente",
        ]);
*/
        $Pedido = Pedido::find($id);

        $Pedido->CodigoCliente  = $CodigoCliente;
        $Pedido->CodigoPastel = $CodigoPastel;
        $Pedido->save();

        $result = $this->array['result'] = [
            'id' => $id,
            'CodigoCliente' => $CodigoCliente,
            'CodigoPastel' => $CodigoPastel,
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
            $Pedido = Pedido::find($id);
            if ($Pedido) {
                $Pedido->delete();
                $this->array['error'] = "Excluido com sucesso";
            } else {
                $this->array['error'] = "ID não encontrado";
            }
            return $this->array;
        }
    }
}
