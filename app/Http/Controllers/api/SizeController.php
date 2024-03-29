<?php

namespace App\Http\Controllers\api;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all();
        return response()->json($sizes); 
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
        $sizes = new Size();
       $sizes->fill($request->all());
       $sizes->save();

       return response()->json([
        'status' => '200',
        'message' => "creat size successfully"
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function size_product($id){
        $sizes = new Size();
        $data = $sizes->select('size','quantity')
        ->where([
            ['product_id','=',$id]
        ])->get();

        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function update_quantity(Request $request){
        $size = new Size();
        $data = $size->select()
        ->where([
            ['product_id','=',$request->product_id],
            ['size','=',$request->size]
        ])->first();

        if ($data == null) {
            return response()->json([
                'status' => 401,
                'errors' => 'size not found'
            ]);
        }

        $new_quantity = $size->find($data->id);
        $new_quantity->quantity = $request->quantity;
        $new_quantity->save();
        return response()->json([
            'status' => 201,
            'message' => 'quantity successfully'
        ]);

        
        
    }
}
