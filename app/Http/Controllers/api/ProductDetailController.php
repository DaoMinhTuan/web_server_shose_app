<?php

namespace App\Http\Controllers\api;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $product_detail = ProductDetail::select()
    ->join('products', 'products.id', '=', 'product_details.product_id')    
    ->join('colors', 'colors.id', '=', 'product_details.color_id')
    ->join('sizes', 'sizes.id', '=', 'product_details.size_id')
    ->get();
        return response()->json($product_detail); 
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
        $product_detail = new ProductDetail();
        $product_detail->fill($request->all());
        $product_detail->save();

       return response()->json([
        'status' => '200',
        'message' => "creat productDetail successfully"
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
}
