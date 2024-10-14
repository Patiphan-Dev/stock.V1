<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SalesList;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Sales Reports'
        ];

        // รับค่าฟิลเตอร์จาก request หรือใช้ 'all' เป็นค่าเริ่มต้น
        $filterPeriod = $request->input('filter_period', 'all');

        // ตั้งค่าวันนี้สำหรับการเปรียบเทียบ
        $today = Carbon::now();

        // กำหนดค่า start date และ end date ตามฟิลเตอร์ที่เลือก
        if ($filterPeriod == 'oneday') {
            $startDate = $today->copy()->startOfDay();
            $endDate = $today->copy()->endOfDay();
        } elseif ($filterPeriod == '3_months') {
            $startDate = $today->copy()->subMonths(3);
            $endDate = $today;
        } elseif ($filterPeriod == '6_months') {
            $startDate = $today->copy()->subMonths(6);
            $endDate = $today;
        } elseif ($filterPeriod == '1_year') {
            $startDate = $today->copy()->subYear();
            $endDate = $today;
        } else {
            $startDate = null; // แสดงข้อมูลทั้งหมดหากไม่มีช่วงเวลา
            $endDate = $today;
        }

        // คิวรีข้อมูลสินค้าขายดี
        $salesQuery = SalesList::with('product')->select(
            'so_prod_name',
            SalesList::raw('SUM(so_prod_quantity) as total_quantity'),
            SalesList::raw('SUM(so_prod_price) as total_price')
        )
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc');

        // ใช้ช่วงเวลา startDate และ endDate หากมี
        if ($startDate) {
            $salesQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        $salesData = $salesQuery->get();

        return view('reports.index', array_merge($data, compact('salesData')));
    }
}
