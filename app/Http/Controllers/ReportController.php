<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PurchaseOrder;
use App\Models\PurchaseList;
use App\Models\ProductList;
use App\Models\SalesOrder;
use App\Models\SalesList;


class ReportController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Sales Reports'
        ];

        // อ่านค่าฟิลเตอร์จาก request (ถ้าไม่มี ให้ใช้เป็นค่าเริ่มต้น 'all')
        $filterPeriod = $request->input('filter_period', 'all');

        // กำหนดค่าของวันนี้
        $today = Carbon::now();

        // ตรวจสอบค่าฟิลเตอร์ที่ผู้ใช้เลือก
        if ($filterPeriod == 'oneday') {
            $startDate = $today;
        } elseif ($filterPeriod == '3_months') {
            $startDate = $today->copy()->subMonths(3);
        } elseif ($filterPeriod == '6_months') {
            $startDate = $today->copy()->subMonths(6);
        } elseif ($filterPeriod == '1_year') {
            $startDate = $today->copy()->subYear();
        } else {
            // หากไม่เลือกฟิลเตอร์ (แสดงสินค้าทั้งหมด)
            $startDate = null;
        }

        // คิวรีข้อมูลสินค้าขายดี
        $salesQuery = SalesList::select(
            'so_prod_name',
            SalesList::raw('SUM(so_prod_quantity) as total_quantity'),
            SalesList::raw('SUM(so_prod_price) as total_price')
        )
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc');

        // ถ้ามีการเลือกช่วงเวลา ให้เพิ่มเงื่อนไข where
        if ($startDate) {
            $salesQuery->whereBetween('created_at', [$startDate, $today]);
        }

        // ดึงข้อมูลจากคิวรี
        $salesData = $salesQuery->get();

        return view('reports.index', array_merge($data, compact('salesData')));
    }
}
