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


        return response()->json([
            'status' => '202',
            'oder_told' => $data_1,
            'oder_unsuccessful ' => $data_2,
            'oder_successful' => $data_3
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

        $price = 0;
        $sale = 0;

        if ($data !== null) {
            foreach ($data as $item) {
                foreach ($item->products as $p) {
                    $sale += $p->sale * $p->quantity;
                }
            }

            foreach ($data as $item) {
                foreach ($item->products as $p) {
                    $price += $p->price * $p->quantity;
                }
            }
        }

        return response()->json([
            'status' => '201',
            'price' => [
                'told_price' => number_format($price, 0, '', ','),
                'told_sale' => number_format($sale, 0, '', ',')
            ],
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
