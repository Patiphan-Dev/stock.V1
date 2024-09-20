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
        $POs = PurchaseOrder::join('purchase_lists', 'purchase_orders.po_id', 'purchase_lists.po_id')
            ->select(
                'purchase_orders.*',
                'purchase_lists.po_prod_name',
                'purchase_lists.po_prod_quantity',
                'purchase_lists.po_prod_price_per_unit',
                'purchase_lists.po_prod_price'
            )->get();
        $PLs = PurchaseList::all();
        
        return view('purchaseorder.purchaserecord', array_merge($data, compact('POs', 'PLs')));
    }
}
