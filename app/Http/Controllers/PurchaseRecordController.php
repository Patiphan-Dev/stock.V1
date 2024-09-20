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
        // ดึงข้อมูล PurchaseOrder พร้อมกับ id ของ PurchaseList และ id ของ PurchaseOrder
        $POs = PurchaseOrder::join('purchase_lists', 'purchase_orders.po_id', '=', 'purchase_lists.po_id')
            ->select(
                'purchase_orders.id as purchase_order_id', // ดึง id ของ PurchaseOrder
                'purchase_orders.po_company_name as po_company_name',
                'purchase_orders.po_id',
                'purchase_lists.id as purchase_list_id',   // ดึง id ของ PurchaseList
                'purchase_lists.po_prod_name',
                'purchase_lists.po_prod_quantity',
                'purchase_lists.po_prod_price_per_unit',
                'purchase_lists.po_prod_price'
            )
            ->get();

        // ส่งข้อมูลไปยัง view
        return view('purchaseorder.purchaserecord', array_merge($data, compact('POs')));
    }
}
