<?php

namespace App\Http\Controllers\page;

use App\Models\Oder;
use App\Models\OderDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OderController extends Controller
{
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

        return view('page.admin.list_oder',[
            'data' => $data
        ]);
    }
}
