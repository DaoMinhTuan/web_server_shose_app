<?php

namespace App\Http\Controllers\api;

use App\Models\Carts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $cart;
    public function __construct()
    {
        $this->cart = new Carts();
    }

    public function index()
    {
        
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
        $this->cart->fill($request->all());
        $this->cart->save();
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

    public function get_cart_user($user){

        $told = 0;

        $data = $this->cart
        ->join('products','products.id', '=','carts.id_product')
        ->join('product_detail', 'carts.id_product', '=', 'product_detail.product_id')
        ->join('users', 'users.id', '=','carts.id_user')
        ->select('products.id as product_id','products.name as product_name','products.price','products.sale','products.image','product_detail.color')
        ->where([
            ['carts.id_user','=',$user]
        ])->get();
        $count = count($data);

        for ($i = 0; $i < $count; $i++) {
            $data[$i]['image'] = json_decode($data[$i]['image']);
        }

        for ($i = 0; $i < $count; $i++) {
            $told += $data[$i]['price'];
        }


        return response()->json([
            'carts' => $data,
            'total' => $told
        ]);
    }
}
