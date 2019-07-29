<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
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
        $resp = '{"success":true,"data":{"id":1,"status":"1","sold_date":"2019-05-03"},"message":"Productos recuperados satisfactoriamente"}';        
        $response = json_decode($resp);
        if ($response->success) {
            $validator = Validator::make((array)$response->data, [
                'id' => 'required|integer',
                'status' => 'required|integer|min:0|max:1'
            ]);

            if ($validator->fails()) {
                return $this->sendError('Error de validación', $validator->error());
            }

            return $this->sendResponse($response->data->toArray(), 'reporte de ventas');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
