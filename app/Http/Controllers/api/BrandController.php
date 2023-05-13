<?php

namespace App\Http\Controllers\api;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json($brands); 
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
        $brands = new Brand();
        $brands->fill($request->all());
        $brands->save();
 
        return response()->json([
         'status' => '200',
         'message' => "creat brand successfully"
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
        $brands = Brand::find($id);

        if($brands == null){
            return response()->json([
               'status' => '404',
               'message' => 'Brand not found'
            ]);
        } 

        return response()->json([
           'status' => '200',
           'data' => $brands
            
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
        $brands = Brand::find($id);

        if($brands == null){
            return response()->json([
              'status' => '404',
              'message' => 'Brand not found'
            ]);
        } 

        $brands->fill($request->all());
        $brands->save();

        return response()->json([
          'status' => '200',
          'message' => "update brand successfully",
          'data' => $brands
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
        $brands = Brand::find($id);

        if( $brands == null ){
            return response()->json([
               'status' => '404',
               'message' => "brand not found"
            ]);
        }else{
            $brands->delete();
            return response()->json([
              'status' => '200',
              'message' => "brand deleted successfully"
            ]);
        }
    }
}
