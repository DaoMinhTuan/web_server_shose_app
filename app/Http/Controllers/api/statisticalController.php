<?php

namespace App\Http\Controllers\api;

use App\Models\Oder;
use App\Models\OderDetail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class statisticalController extends Controller
{
    protected $oder_detail, $oders;

    public  function __construct()
    {
        $this->oder_detail = new OderDetail();
        $this->oders = new Oder();
    }

    public function oder()
    { 
        $oder_list = [];
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

        $oder_list[] = [
            'oder_told' => $data_1,
            'oder_unsuccessful' => $data_2,
            'oder_successful' => $data_3,
            'xac_nhan' => $data_4,
            'dang_giao' => $data_5
        ];
        return response()->json([
            'status' => '202',
            'oder' => $oder_list
        ]);
    }

    public function price()
    {
        $data = $this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select('products')->where([
                ['oders.status', 3]
            ])
            ->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['products'] =  json_decode($data[$i]['products']);
            $data[$i]['products'] =  json_decode($data[$i]['products']);
        }

        $told = [];
        $price = 0;
        $sale = 0;

        if ($data !== null) {
            foreach ($data as $item) {
                foreach ($item->products as $p) {
                    $sale += $p->sale * $p->quantity;
                    $price += $p->price * $p->quantity;
                }
            }
        }
        $told[] = [
            'sale' => $p->sale,
            'price' => $p->price,
        ];

        return response()->json([
            'status' => '201',
            'told' => $told
        ]);
    }

    public function price_date($month, $year)
    {
        $data = $this->oder_detail
            ->join('oders', 'oders.id', '=', 'oderdetail.oder_id')
            ->select('products', '')->where([
                ['oders.status', 3]
            ])
            ->get();

        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $data[$i]['products'] =  json_decode($data[$i]['products']);
            $data[$i]['products'] =  json_decode($data[$i]['products']);
        }

        $price = 0;
        $sale = 0;
    }
}
