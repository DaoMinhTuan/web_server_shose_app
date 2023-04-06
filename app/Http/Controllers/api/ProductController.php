<?php

namespace App\Http\Controllers\api;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Size;
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
        $products = new Product;
        $data = $products
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_details.color', 'product_details.size', 'product_details.quantity', 'brands.brandName as branch')->where([['products.status', '=', 1]])
            ->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['image'] = json_decode($data[$i]['image']);
            $data[$i]['size'] =  json_decode($data[$i]['size']);
        }

        return response()->json($data);
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
            'message' => "creat product successfully",
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
        $products = new Product;
        $data = $products
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_details.color', 'product_details.size', 'product_details.quantity', 'brands.brandName as branch')
            ->where([
                ['products.status', '=', 1],
                ['products.id', '=', $id]
             ])
            ->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['image'] = json_decode($data[$i]['image']);
            $data[$i]['size'] =  json_decode($data[$i]['size']);
        }

        return response()->json($data);
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

        if ($products == null) {
            return response()->json([
                'status' => '404',
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

        if ($products == null) {
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

        if ($products == null) {
            return response()->json([
                'status' => '404',
                'message' => "Product not found"
            ]);
        } else {
            $products->delete();
            return response()->json([
                'status' => '200',
                'message' => "Product deleted successfully"
            ]);
        }
    }

    public function get_brach_products($id)
    {
        $products = new Product;

        $data = $products->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'brands.brandName as branch')->where([
                ['products.brandID', '=', $id],
                ['products.status', '=', 1]
            ])
            ->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['image'] = json_decode($data[$i]['image'], true);
        }
        return response()->json([
            'status' => '202',
            'message' => 'get product branch successfully',
            'data' => $data
        ]);
    }

    public function get_products_size($one_size,$id){
        $size = new Size();

        $data = $size->join('products','products.id','=','sizes.product_id')
        ->select()
        ->where([
            ['sizes.size','=', $one_size],
            ['sizes.product_id','=', $id],
        ])
        ->get();

        return response()->json([
            'products' => $data,
        ]);

    }


    public function get_products_name($name)
    {
        $products = new Product;
        $data = $products->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->select()->where([
                ['products.name', 'like', '%' . $name . '%'],
                ['products.status', '=', 1]
            ])
            ->get();
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['image'] = json_decode($data[$i]['image'], true);
            $data[$i]['size'] = json_decode($data[$i]['size'], true);
        }
        return response()->json([
            'status' => '202',
            'message' => 'get product branch successfully',
            'data' => $data
        ]);
    }
}
