<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\SalesList;

use App\Models\ProductList;

class SalesRecordController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sales Record'
        ];
        $SOs = SalesOrder::all();
        $SLs = SalesList::all();

        dd($SOs,$SLs);

        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('salesorder.salesrecord', array_merge($data, compact('SOs','SLs')));
    }
}
