<?php

namespace App\Http\Controllers\api;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::all();
        return response()->json($colors); 
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
        $colors = new Color();
        $colors->fill($request->all());
        $colors->save();
 
        return response()->json([
         'status' => '200',
         'message' => "creat color successfully"
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
        $colors = Color::find($id);

        if($colors == null){
            return response()->json([
               'status' => '404',
               'message' => 'Color not found'
            ]);
        } 

        return response()->json([
           'status' => '200',
           'data' => $colors
            
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
        $colors = Color::find($id);

        if($colors == null){
            return response()->json([
              'status' => '404',
              'message' => 'Color not found'
            ]);
        } 

        $colors->fill($request->all());
        $colors->save();

        return response()->json([
          'status' => '200',
          'message' => "update color successfully",
          'data' => $colors
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
        $colors = Color::find($id);

        if( $colors == null ){
            return response()->json([
               'status' => '404',
               'message' => "Color not found"
            ]);
        }else{
            $colors->delete();
            return response()->json([
              'status' => '200',
              'message' => "Color deleted successfully"
            ]);
        } 
    }
}
