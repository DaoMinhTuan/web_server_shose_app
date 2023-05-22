<?php

namespace App\Http\Controllers\page;

use App\Http\Requests\productRequest;
use App\Models\Size;
use App\Models\Brand;
use App\Models\OderDetail;
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
     *
     */
    protected $oder_detail;
    public function __construct()
    {
        $this->oder_detail = new OderDetail();
    }
    public function index()
    {
        $products = new Product();

        $data = $products
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color', 'product_detail.size', 'product_detail.quantity', 'brands.brandName as branch')
            ->orderBy('id', 'desc')
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
        return redirect('product.index');
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
                    $ids += 1;
                    $sizes['size_' . $ids]["size"] = $i;
                    $sizes['size_' . $ids]["id"] = $ids;
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
        $products = new Product();
        $sizes_product = new Size();

        $data = $products
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color', 'product_detail.size', 'product_detail.quantity', 'brands.brandName as branch')
            ->where('products.id', $id)
            ->first();
        $size = $sizes_product->where([['product_id', '=', $id]])->get();


        if ($data != null) {
            $data->image = json_decode($data->image);
            $data->size =  $size;

            $count_image =  count(get_object_vars($data->image[0]));


            $sale_off = ($data->price - $data->sale) / $data->price * 100;
            return view('page.products.detail_product', [
                'data' => $data,
                'count_img' => $count_image,
                'sale_off' => round($sale_off, 3),
            ]);
        }

        return view('page.products.detail_product', [
            'data' => $data,
        ]);
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
                        $Old_ps[$i]['size'] = (int) $row['size'];
                        $Old_ps[$i]['quantity'] = (int) $row['quantity'];
                    }
                }

                $sizes->where('id', $row['id'])->update($input);
            }

            foreach ($Old_ps as $key => $item) {
                $PS['size_' . $key]["id"] = $key;
                $PS['size_' . $key]["size"] = $item->size;

                $quantity += $item->quantity;
            }





            if ($old_prDetai != null) {
                $new_product = ProductDetail::find($old_prDetai->first()->id);
                $new_product->quantity = $quantity;
                $new_product->size =  json_encode(array($PS));
                $new_product->save();
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

    public function dashboard()
    {

        $products = new Product();

        $data_1 = count($this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select()->get());

        $data_2 = count($this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select()->where([
                ['oders.status', 4]
            ])->get());

        $data_3 = count($this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select()->where([
                ['oders.status', 3]
            ])->get());

        $data_4 = count($this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select()->where([
                ['oders.status', 1]
            ])->get());

        $data_5 = count($this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select()->where([
                ['oders.status', 2]
            ])->get());


        $oder_price = $this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select('products')->where([
                ['oders.status', 3]
            ])->get();

        $out_price = $products
            ->join('product_detail', 'products.id', '=', 'product_detail.product_id')
            ->join('brands', 'products.brandID', '=', 'brands.id')
            ->select('products.*', 'product_detail.color', 'product_detail.size', 'product_detail.quantity', 'brands.brandName as branch')
            ->get();

            $count = count($oder_price);
            for ($i = 0; $i < $count; $i++) {
                $oder_price[$i]['products'] =  json_decode($oder_price[$i]['products']);
                $oder_price[$i]['products'] =  json_decode($oder_price[$i]['products']);
            }

        $price = 0;
        $o_price = 0;
        $sale = 0;

        if ($oder_price != null) {
            foreach ($oder_price as $item) {
                foreach ($item->products as $p) {
                    $sale += $p->sale * $p->quantity;
                    $price += $p->price * $p->quantity;
                }
            }
        }




        if ($out_price != null) {
            foreach ($out_price as $item) {
                $o_price += $p->price * $p->quantity;
            }
        }
        // return response()->json([
        //     'oder_told' => $data_1,
        //     'oder_unsuccessful' => $data_2,
        //     'oder_successful' => $data_3,
        //     'successful' => $data_4,
        //     'delivering' => $data_5,
        //     'told_price' => $sale,
        //     'out_price' => 0,
        // ]);



        return view('page.dashboard', [
            'status' => '202',
            'oder_told' => $data_1,
            'oder_unsuccessful' => $data_2,
            'oder_successful' => $data_3,
            'successful' => $data_4,
            'delivering' => $data_5,
            'told_price' => $sale,
            'out_price' => $o_price,

        ]);
    }
}
