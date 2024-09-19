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
        $SOs = SalesOrder::join('sales_lists', 'sales_orders.so_id', 'sales_lists.so_id')
            ->select(
                'sales_orders.*',
                'sales_lists.so_prod_name',
                'sales_lists.so_prod_quantity',
                'sales_lists.so_prod_price_per_unit',
                'sales_lists.so_prod_price'
            )->get();

        return view('salesorder.salesrecord', array_merge($data, compact('SOs')));
    }
}
