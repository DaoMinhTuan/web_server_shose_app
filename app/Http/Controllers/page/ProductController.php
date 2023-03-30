<?php

namespace App\Http\Controllers\page;

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
        return view('page.products.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.products.add');
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
        $product_detali = new ProductDetail();
        try {
            $files = [];
            $sizes = [];
            if ($request->file('file_image')){
                foreach($request->file('file_image') as $key => $file)
                {
                    $fileName = time().rand(1,99).'.'.$file->extension();  
                    $file->move(public_path('uploads'), $fileName);
                    $files[$key]['name'] = asset('uploads', $fileName);
                    $files[$key]['id'] = $key+1;
                }
            }

            if($request->misize != 0 and $request->msize != 0){
                $ids = 0;
                for ($i = $request->misize; $i <= $request->msize; $i ++){
                    $sizes[$i]["size"] = $i;
                    $sizes[$i]["id"] = $ids+=1;
                }
            }else{
                
            }
            $products->image = json_encode($files);
            $products->fill($request->all());
            $products->save();
            
            $id =  $products->select("id")->orderBy('id', 'desc')->first()->id;
            $product_detali->product_id = $id;
            $product_detali->size =  json_encode($sizes);
            $product_detali->fill($request->all());
            $product_detali->save();
        } catch (\Exception $err) {
            Alert::error('Acccount not active ', 'thêm sản phẩm ko thành công');
            return back();
            
        }
        Alert::success('Product create successfully ', 'thêm sản phẩm thành công');
        return back();
        
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
