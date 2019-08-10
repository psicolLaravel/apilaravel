<?php

namespace App\Http\Controllers;

use App\Announce;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Validator;

class AnnounceController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announce = Announce::all();

        try {
            return $this->sendResponse($announce->toArray(), 'Anuncios recuperados satisfactoriamente!');
        } catch (\Throwable $th) {
            return $this->sendError($th, 'Falla al recuperar la data');
        }
        
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
        // $curl = curl_init();
        // // Set some options - we are passing in a useragent too here
        // curl_setopt_array($curl, [
        //     CURLOPT_RETURNTRANSFER => 1,
        //     CURLOPT_URL => 'http://testcURL.com/?item1=value&item2=value2',
        //     CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        // ]);
        // // Send the request & save response to $resp
        // $resp = curl_exec($curl);
        // // Close request to clear up some resources
        // curl_close($curl);
        //$status_resp = http_response_code();

        $resp = '{"success":true,"data":{"id":1,"name":"carro","description":"carro con 8 puertas, melo","cant":1,"valor":100},"message":"Productos recuperados satisfactoriamente"}';
        
        $response = json_decode($resp);

        // dd((array)$response->data);

        if ($response->success) {

            $validator = Validator::make((array)$response->data, [
                'id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Error de validación', $validator->error());
            }

            //Validar el request
            $input = $request->all();            
            $input['product_id'] = $response->data->id;

            $validator = Validator::make($input, [
                'description' => 'required|string',
                'product_id'  => 'required|integer',
                'status'      => 'required|integer|min:0|max:1'
            ]);

            $announce = Announce::create($input);

            return $this->sendResponse($announce->toArray(), 'Anuncio creado satisfactoriamente!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function show(Announce $announce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function edit(Announce $announce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announce $announce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Announce  $announce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announce $announce)
    {
        //
    }
}