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
        $this->oder_detail->fill($request->all());
        $this->oder_detail->products = json_encode($request->products);
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

        if ($oder != null) {
            $detail_id = $this->oder_detail->select('id')->where('oder_id', $oder->id)->first()->id;
            $oder_detail = $this->oder_detail->find($detail_id);
        } else {
            $oder_detail = null;
        }

        if ($oder_detail == null or $oder == null) {

            return response()->json([
                'status' => '400',
                'error' => 'oder not found'
            ]);
        } else {

            $oder->fill($request->all());
            $oder_detail->fill($request->all());

            $oder->save();
            $oder_detail->save();

            return response()->json([
                'status' => '202',
                'message' => ' oder update successful'
            ]);
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
        $oder = $this->oders->find($id);;

        if ($oder == null) {
            $oder_detail = null;
        } else {
            $detail_id = $this->oder_detail->select('id')->where('oder_id', $oder->id)->first()->id;
            $oder_detail = $this->oder_detail->find($detail_id); 
        }


        if ($oder_detail == null or $oder == null) {

            return response()->json([
                'status' => '400',
                'error' => 'oder not found'
            ]);
        } else {
            $oder->delete();
            $oder_detail->delete();

            return response()->json([
                'status' => '202',
                'message' => ' oder delete successful'
            ]);
        }

    }

    public function history_oder($user,$status)
    {
        $data = $this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->join('users', 'users.id', '=', 'oders.user_id')
            ->select('users.name','oders.*','oderdetail.*')
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

    public function get_oder_status($status)
    {
        $data = $this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->join('users', 'users.id', '=', 'oders.user_id')
            ->select('users.name','oders.*','oderdetail.*')
            ->where([
                ['oderdetail.status', '=', $status],
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
