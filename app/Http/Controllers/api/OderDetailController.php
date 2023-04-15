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
    protected $oder_detail, $oders;

    public  function __construct()
    {
        $this->oder_detail = new OderDetail();
        $this->oders = new Oder();
    }

    public function index()
    {
        $data = $this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select()->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['products'] =  json_decode($data[$i]['products']);
            $data[$i]['products'] =  json_decode($data[$i]['products']);
        }

        return response()->json([
            'status' => '202',
            'data' => $data
        ]);
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
        $this->oders->fill($request->all());
        $this->oders->save();

        $id =  $this->oders->select("id")->orderBy('id', 'desc')->first()->id;

        $this->oder_detail->oder_id = $id;
        $this->oder_detail->products = json_encode($request->products);
        $this->oder_detail->fill($request->all());
        $this->oder_detail->save();


        return response()->json([
            'status' => 'success',
            'message' => 'oders successfully',
            'id_oder' =>  $id
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

        
        $oder = $this->oders->find($id);
        $oder->fill($request->all());
        $oder_detail = $this->oder_detail->find($oder->id);
        $oder_detail->fill($request->all());
        $oder->save();
        $oder_detail->save();
    

        
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

    public function history_oder($user,$status)
    {
        $data = $this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select()
            ->where([
                ['oderdetail.status', '=', $status],
                ['oders.user_id', '=', $user]
            ])
            ->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['products'] =  json_decode($data[$i]['products']);
            $data[$i]['products'] =  json_decode($data[$i]['products']);
        }

        return response()->json([
            'status' => '202',
            'data' => $data
        ]);
    }
}
