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

    public function buysReportThreeMonths()
    {
        $data = [
            'title' => 'Buys Report Three Months'
        ];
        // วันที่เริ่มต้น (3 เดือนก่อน)
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        // ดึงข้อมูลการขายสินค้าภายใน 3 เดือนย้อนหลัง
        $reports = PurchaseList::where('created_at', '>=', $threeMonthsAgo)
            ->get();

        return view('reports.buys.3-months', array_merge($data, compact('reports')));
    }

    public function buysReportSixMonths()
    {
        $data = [
            'title' => 'Buys Report Six Months'
        ];
        // วันที่เริ่มต้น (6 เดือนก่อน)
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // ดึงข้อมูลการขายสินค้าภายใน 6 เดือนย้อนหลัง
        $reports = PurchaseList::where('created_at', '>=', $sixMonthsAgo)
            ->get();

        return view('reports.buys.6-months', array_merge($data, compact('reports')));
    }

    public function salesReportThreeMonths()
    {
        $data = [
            'title' => 'Sales Report Three Months'
        ];
        // วันที่เริ่มต้น (3 เดือนก่อน)
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        // ดึงข้อมูลการขายสินค้าภายใน 3 เดือนย้อนหลัง
        $reports = SalesList::where('created_at', '>=', $threeMonthsAgo)
            ->get();

        return view('reports.sales.3-months', array_merge($data, compact('reports')));
    }

    public function salesReportSixMonths()
    {
        $data = [
            'title' => 'Sales Report Six Months'
        ];
        // วันที่เริ่มต้น (6 เดือนก่อน)
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        // ดึงข้อมูลการขายสินค้าภายใน 6 เดือนย้อนหลัง
        $reports = SalesList::where('created_at', '>=', $sixMonthsAgo)
            ->get();

        return view('reports.sales.6-months', array_merge($data, compact('reports')));
    }
}
