<?php

namespace App\Http\Controllers\api;
use App\Models\Oder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class OderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
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
        $oders = new Oder();
        
        $oders->fill($request->all());
        $oders->save();
 
        return response()->json([
         'status' => '200',
         'message' => "creat oder successfully"
        ]);
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
    public function edit($id)
    {
        $oders = Oder::find($id);

        if($oders == null){
            return response()->json([
               'status' => '404',
               'message' => 'Oders not found'
            ]);
        } 

        return response()->json([
           'status' => '200',
           'data' => $oders
            
        ]);
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
        $oders = Oder::find($id);

        if($oders == null){
            return response()->json([
              'status' => '404',
              'message' => 'Oder not found'
            ]);
        } 

        $oders->fill($request->all());
        $oders->save();

        return response()->json([
          'status' => '200',
          'message' => "update oder successfully",
          'data' => $oders
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oders = Oder::find($id);

        if( $oders == null ){
            return response()->json([
               'status' => '404',
               'message' => "Oder not found"
            ]);
        }else{
            $oders->delete();
            return response()->json([
              'status' => '200',
              'message' => "Oder deleted successfully"
            ]);
        } 
    }
}
