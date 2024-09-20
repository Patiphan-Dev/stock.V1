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
        // ดึงข้อมูล SalesOrder พร้อมกับ id ของ SalesList และ id ของ SalesOrder
        $SOs = SalesOrder::join('sales_lists', 'sales_orders.so_id', '=', 'sales_lists.so_id')
            ->select(
                'sales_orders.id as sales_order_id', // ดึง id ของ SalesOrder
                'sales_orders.so_customer_name as so_customer_name',
                'sales_orders.so_id',
                'sales_lists.id as sales_list_id',   // ดึง id ของ SalesList
                'sales_lists.so_prod_name',
                'sales_lists.so_prod_quantity',
                'sales_lists.so_prod_price_per_unit',
                'sales_lists.so_prod_price'
            )
            ->get();

        // ส่งข้อมูลไปยัง view
        return view('salesorder.salesrecord', array_merge($data, compact('SOs')));
    }
}
