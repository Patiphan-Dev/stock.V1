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
        $PurchaseList = PurchaseList::join('purchase_orders', 'purchase_lists.po_id', 'purchase_orders.po_id')
        ->select('purchase_lists.*','purchase_orders.po_company_name','purchase_orders.po_date' )
        ->get();
        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd($PurchaseOrder);

        return view('purchaseorder.purchaserecord', array_merge($data, compact('POs','PLs','PurchaseList')));
    }
}
