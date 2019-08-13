<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return $this->sendResponse($product->toArray(),'Listado de productos');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            $errorField = $validator->errors();
            $errorField = $errorField->getMessages();
            return $this->sendError($errorField[key($errorField)][0], "No cumple criterios", $code = 404);
        }

        $product = new Product();
        $product->nombre      = $request->nombre;
        $product->descripcion = $request->descripcion;
        $product->cantidad    = $request->cantidad;
        $product->valor       = $request->valor;
        $product->save();

        return response()->json('Producto creado exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return Product::where('id', $product->id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'valor' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            $errorField = $validator->errors();
            $errorField = $errorField->getMessages();
            return $this->sendError($errorField[key($errorField)][0], "No cumple criterios", $code = 404);
        }
        $producto =  Product::find($product->id);
        $producto->nombre      = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->cantidad    = $request->cantidad;
        $producto->valor       = $request->valor;
        $producto->save();
        return response()->json('Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //dd($product);
        //$res=Product::where('id',$product->id)->delete();
        $res = Product::destroy($product->id);
        if ($res) {
            return response()->json([
                'status' => '1',
                'msg'    => 'success'
            ], 200);
        } else {
            return response()->json([
                'status' => '0',
                'msg'    => 'fail'
            ]);
        }
    }
}
