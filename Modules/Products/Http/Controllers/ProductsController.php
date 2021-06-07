<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Entities\Products;

class ProductsController extends Controller
{

    private $array  = ["error" => "", "result" => []];
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $Products =  Products::all();
        foreach ($Products as $value) {
            $this->array['result'][] = [
                'id' => $value->id,
                'Titulo' => $value->title,
                'Description' => $value->description
                
              
            ];
        }
        return $this->array;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('products::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $title         = $request->input("title");
        $description   = $request->input("description");

      
        $Products = new Products();
        $Products->title    = $title;
        $Products->description = $description;
        $Products->save();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $Products = Products::where('id',$id)->get();

        if ($Products) {
            $this->array['result'] = $Products;
        } else {
            $this->array['error']  = "ID não encontrado";
        }
        return $this->array;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request)
    {
        $id            = $request->input("id");
        $title         = $request->input("title");
        $description   = $request->input("description");        
        $Products      =  Products::find($id);

        $Products->title    = $title;
        $Products->description = $description;
        $Products->save();

        $result = $this->array['result'] = [
            'id'=>$id,
            'Titulo'=>$title,
            'Descricao'=>$description
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
        $Products =  Products::find($id);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $Products = Products::find($id);
        if ($Products) {
            $Products->delete();
        } else {
            $this->array['error']  = "ID não encontrado";
        }
        return $this->array;
    }
}
