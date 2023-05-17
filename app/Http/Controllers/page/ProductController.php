<?php

namespace App\Http\Controllers\page;

use App\Http\Requests\productRequest;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use Dotenv\Parser\Value;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Product();

        $data = $products
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color', 'product_detail.size', 'product_detail.quantity', 'brands.brandName as branch')
            ->orderBy('id','desc')
            ->paginate(5);

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['image'] = json_decode($data[$i]['image']);
            $data[$i]['size'] =  json_decode($data[$i]['size']);
        }



        return view('page.products.list', [
            'data' => $data
        ]);
    }

    public function get_size($id)
    {
        $sizes = new Size();
        $data = $sizes->select()->where("product_id", $id)->get();
        return view('page.products.sizes', [
            'size' => $data

        ]);
    }

    public function update_size(Request $request)
    {
        $sizes = new Size();
        try {
            $id = [];
            $size = [];
            $values =  [];
            $quantity = 0;

            foreach ($request->size as $key => $s) {
                $size[] = $s;
            };


            foreach ($request->id as $value) {
                $id[] = $value;
            }

            foreach ($request->quantity as $key => $q) {
                $values[] =  [
                    'id' => $id[$key],
                    'size' => $size[$key],
                    'quantity' => $q
                ];
                $quantity += $q;
            }

            $pro_id = $sizes->where('id', $request->id)->first()->product_id;

            $old_product = ProductDetail::where('product_id', $pro_id)->first();

            if ($old_product != null) {
                $new_product = ProductDetail::find($old_product->id);
                $new_product->quantity = $quantity;
                $new_product->save();
            }


            foreach ($values as $row) {
                $input = [
                    'size' => $row['size'],
                    'quantity' => $row['quantity']
                ];
                $sizes->where('id', $row['id'])->update($input);
            }
        } catch (\Exception $err) {

            Alert::error('Not found ', 'cập nhật số lượng sản phẩm ko thành công');
            return back();
        }

        Alert::success(' successfully ', 'cập nhật số lượng sản phẩm thành công');
        return back();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**
         * Creates a new instance of the Brand class.
         *
         * @return Brand
         */
        $branch = new Brand();
        /**
         * Retrieve all records from the database table associated with the current branch object.
         *
         * @return Illuminate\Support\Collection
         */
        $data = $branch->select()->get();
        /**
         * Returns a view with the specified data for the page.products.add page.
         *
         * @param array $data
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        return view('page.products.add', [
            'branch' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(productRequest $request)
    {
        /**
         * Creates instances of Product, ProductDetail, and Size classes.
         *
         * @return Product, ProductDetail, Size
         */
        $products = new Product();
        $product_detali = new ProductDetail();
        $sizes_product = new Size();

        try {
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
            $sizes_product->insert($sizes_table);
            $product_detali->product_id = $id;
            $product_detali->size =  json_encode(array($sizes));
            $product_detali->fill($request->all());
            $product_detali->save();
        } catch (\Exception $err) {
            Alert::error('Acccount not active ', 'thêm sản phẩm ko thành công');
            return back();
        }
        Alert::success('Product create successfully ', 'thêm sản phẩm thành công');
        return redirect()->route('get_sizes', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sizes_product = new Size();
        $products = new Product();
        $size = $sizes_product->where([['product_id', '=', $id]])->get();

        $branch = Brand::all();
        $data = $products
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color')
            ->where([['products.id', '=', $id]])
            ->first();



        return view('page.products.list_update', [
            'id' => $id,
            'size' => $size,
            'product' => $data,
            'branch' => $branch
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


        if ($request->role == 'size') {
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

                $PS['size' . $key + 1] = [
                    'size' => $size[$key],
                    'id' => $key + 1
                ];

                $quantity += $q;
            }


            if ($old_prDetai != null) {
                $new_product = ProductDetail::find($old_prDetai->first()->id);
                $new_product->quantity = $quantity;
                $new_product->size =  json_encode(array($PS));
                $new_product->save();
            }

            foreach ($values as $row) {
                $input = [
                    'size' => $row['size'],
                    'quantity' => $row['quantity']
                ];
                $sizes->where('id', $row['id'])->update($input);
            }
        }
        Alert::success('Update Product successfuly ', 'Cập nhật sản phẩm thành công');
        return back();
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
