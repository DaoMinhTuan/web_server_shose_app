<?php

namespace App\Http\Controllers\api;

use App\Models\Oder;
use App\Models\OderDetail;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class OderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $oder_detail,$oders;

    public  function __construct()
    {
       $this->oder_detail = new OderDetail(); 
       $this->oders = new Oder(); 
    }

    public function index()
    {
       $data = $this->oder_detail
       ->join('oders','oders.id','=','oderdetail.oder_id')
       ->join('products','products.id','=','oderdetail.product_id')
       ->join('product_details','product_details.product_id','=','oderdetail.product_id')
       ->select()->get();
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
        $this->oder_detail->fill($request->all());
        $this->oder_detail->save();

        $id =  $this->oder_detail->select("id")->orderBy('id', 'desc')->first()->id;
        
        $this->oders->fill($request->all());
        $this->oders->product_id = $id;
        $this->oders->save();


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
