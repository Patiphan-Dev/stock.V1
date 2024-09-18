<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseList;
use App\Models\ProductList;
class PurchaseRecordController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Purchase Record'
        ];
        $POs = PurchaseOrder::all();
        $PLs = PurchaseList::all();
        return view('purchaseorder.purchaserecord', array_merge($data, compact('POs','PLs','PurchaseList')));
    }
}
