<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\ApiProductRequest;
use App\Http\Requests\productRequest;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color', 'product_detail.size', 'product_detail.quantity', 'brands.brandName as branch')
            ->orderBy('id', 'desc')
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
    public function store(ApiProductRequest $request)
    {
        $products = new Product();
        $product_detali = new ProductDetail();
        $sizes_product = new Size();

        /**
         * Initialize empty arrays for files and sizes, and a dictionary for sizes.
         *
         * @var array $files
         * @var array $sizes
         * @var array $sizes_table
         */
        $files = [];
        $sizes = [];
        $sizes_table = [];

        /**
         * Store the uploaded image files and set the image attribute of the product to the file path.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Product  $products
         * @return void
         */
        if ($request->hasfile('file_image')) {
            $id = 0;
            foreach ($request->file('file_image') as $file) {
                $url = asset('uploads');
                $name = $url . "/" . time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('uploads'), $name);
                $files['image' . $id + 1]['name'] =  $name;
                $files['image' . $id + 1]['id'] = $id += 1;
            }
        }

        $products->image = json_encode(array($files));
        // dd(json_decode($products->image));
        /**
         * Fill the model with an array of attributes, then save it to the database.
         *
         * @param  array  $attributes
         * @return void
         */
        $products->fill($request->all());
        $products->save();
        /**
         * Creates a new size for a product and returns the ID of the product.
         *
         * @param  Request  $request
         * @param  Collection  $products
         * @return int
         */
        $id =  $products->select("id")->orderBy('id', 'desc')->first()->id;

        /**
         * Generates an array of sizes and their corresponding IDs for a given product ID, based on the minimum and maximum sizes provided in the request.
         *
         * @param  Request  $request
         * @param  int  $id
         * @return array
         */


        if ($request->misize != 0 and $request->msize != 0) {
            $ids = 0;
            for ($i = $request->misize; $i <= $request->msize; $i++) {
                $sizes['size_' . $i]["size"] = $i;
                $sizes['size_' . $i]["id"] = $ids += 1;
                $sizes_table[] = [
                    'size' => $i,
                    'product_id' => $id
                ];
            }
        }

        // dd($sizes_table);
        /**
         * Inserts the sizes table into the sizes_product table, and saves the product details.
         *
         * @param  array  $sizes_table
         * @param  int  $id
         * @param  array  $sizes
         * @param  Illuminate\Http\Request  $request
         * @return void
         */
        try {

            $sizes_product->insert($sizes_table);
            $product_detali->product_id = $id;
            $product_detali->size =  json_encode(array($sizes));
            $product_detali->fill($request->all());
            $product_detali->save();
        } catch (\Exception $err) {
            return response()->json([
                'status' => '401',
                'message' => "creat not product successfully",
            ]);
        }
        return response()->json([
            'id' => $id,
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
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color', 'product_detail.size', 'product_detail.quantity', 'brands.brandName as branch')
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
        $sizes = new Size();
        $products = Product::find($id);
        $old_prDetai = ProductDetail::where('product_id', $id);

        if ($request->role == 'size') {
            $Old_ps = $sizes->where('product_id', $id)->get();
            $PSID = [];
            $size = [];
            $PS = [];
            $values =  [];
            $quantity = 0;


            foreach ($request->size as $key => $s) {
                $size[] = $s;
            };

            foreach ($request->PSID as $key => $s) {
                $PSID[] = $s;
            };

            foreach ($request->quantity as $key => $q) {
                $values[] =  [
                    'id' => $PSID[$key],
                    'size' => $size[$key],
                    'quantity' => $q
                ];
            }

            $count = count($Old_ps);
            foreach ($values as $row) {
                $input = [
                    'size' => $row['size'],
                    'quantity' => $row['quantity']
                ];

                for ($i = 0; $i < $count; $i++) {
                    if ($Old_ps[$i]['id'] ==  $row['id']) {
                        $Old_ps[$i]['size'] = (Int) $row['size'];
                        $Old_ps[$i]['quantity'] = (Int) $row['quantity'];
                    }
                }

                $sizes->where('id', $row['id'])->update($input);
            }

            foreach ($Old_ps as $key => $item){
                $PS['size_' . $key]["id"] = $key;
                $PS['size_' . $key]["size"] = $item->size;

                $quantity += $item->quantity;
            }

            

  

            if ($old_prDetai != null) {
                $new_product = ProductDetail::find($old_prDetai->first()->id);
                $new_product->quantity = $quantity;
                $new_product->size =  json_encode(array($PS));
                $new_product->save();
                return response()->json([
                    'status' => '200',
                    'message' => "update product successfully",
                ]);
            }
           
        }


        if ($request->role == "image") {
            $files = [];
            if ($request->hasfile('file_image')) {
                $id = 0;
                foreach ($request->file('file_image') as $file) {
                    $url = asset('uploads');
                    $name = $url . "/" . time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('uploads'), $name);
                    $files['image' . $id + 1]['name'] =  $name;
                    $files['image' . $id + 1]['id'] = $id += 1;
                }
            }
            $products->image = json_encode(array($files));

            try {
                $products->save();
            } catch (\Exception $err) {
                Alert::error('Update Product not successfuly', 'Cập nhật sản phẩm ko thành công');
                return back();
            }

            Alert::success('Update Product successfuly', 'Cập nhật sản phẩm thành công');
            return back();
        }

        if ($request->role == 'product') {
            $data = $products->fill($request->all());
            $new_product = ProductDetail::find($old_prDetai->first()->id);
            $new_product->color = $request->color;

            try {
                $data->save();
                $new_product->save();
            } catch (\Exception $err) {
                Alert::error('Update Product not successfuly', 'Cập nhật sản phẩm ko thành công');
                return back();
            }

            Alert::success('Update Product successfuly ', 'Cập nhật sản phẩm thành công');
            return back();
        }
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
        $products = new Product();
        $data = $products
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color', 'product_detail.size', 'product_detail.quantity', 'brands.brandName as branch')
            ->where([
                ['products.brandID', '=', $id],
                ['products.status', '=', 1]
            ])
            ->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['image'] = json_decode($data[$i]['image']);
            $data[$i]['size'] =  json_decode($data[$i]['size']);
        }

        return response()->json([
            'products' => $data,
        ]);
    }

    public function get_products_size($one_size, $id)
    {
        $size = new Size();

        $data = $size->join('products', 'products.id', '=', 'sizes.product_id')
            ->select()
            ->where([
                ['sizes.size', '=', $one_size],
                ['sizes.product_id', '=', $id],
            ])
            ->get();

        return response()->json([
            'products' => $data,
        ]);
    }


    public function get_products_name($name)
    {
        $products = new Product;
        $data = $products->join('product_detail', 'products.id', '=', 'product_detail.product_id')
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

    public function get_size_api($id)
    {
        $sizes = new Size();
        $data = $sizes->select()->where("product_id", $id)->get();
        return response()->json([
            'status' => '202',
            'message' => 'get size successfully',
            'data' => $data
        ]);
    }
}
