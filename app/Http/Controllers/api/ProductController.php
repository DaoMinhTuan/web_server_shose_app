<?php

namespace App\Http\Controllers\api;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return response()->json($products); 
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
        $products = new Product();
        $products->fill($request->all());
        $products->save();
 
        return response()->json([
         'status' => '200',
         'message' => "creat product successfully"
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
        $products = Product::find($id);

        if($products == null){
            return response()->json([
               'status' => '404',
               'message' => 'Product not found'
            ]);
        } 

        return response()->json([
           'status' => '200',
           'data' => $products
            
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
        $products = Product::find($id);

        if($products == null){
            return response()->json([
              'status' => '404',
              'message' => 'Product not found'
            ]);
        } 

        $products->fill($request->all());
        $products->save();

        return response()->json([
          'status' => '200',
          'message' => "update product successfully",
          'data' => $products
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
        $products = Product::find($id);

        if( $products == null ){
            return response()->json([
               'status' => '404',
               'message' => "Product not found"
            ]);
        }else{
            $products->delete();
            return response()->json([
              'status' => '200',
              'message' => "Product deleted successfully"
            ]);
        } 
    }
}
