<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProductList;
use App\Models\PurchaseOrder;
use App\Models\PurchaseList;
use App\Models\SalesOrder;
use App\Models\SalesList;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $title = 'Dashboard';

        $users = User::all();
        $productcount = ProductList::count();
        $pos = PurchaseOrder::all();
        $pls = PurchaseList::all();
        $sos = SalesOrder::all();
        $sls = SalesList::all();

        // สินค้าขายดีวันนี้
        $today = Carbon::now();
        $bestSellingToday = SalesList::select('so_prod_name', SalesList::raw('SUM(so_prod_quantity) as total_quantity'))
            ->whereDate('created_at', $today)
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc')
            ->take(10) // ดึงสินค้าขายดี 10 อันดับ
            ->get();

        // สินค้าขายดี 3 เดือนย้อนหลัง
        $threeMonthsAgo = $today->copy()->subMonths(3);
        $bestSellingThreeMonths = SalesList::select('so_prod_name', SalesList::raw('SUM(so_prod_quantity) as total_quantity'))
            ->whereBetween('created_at', [$threeMonthsAgo, $today])
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc')
            ->take(10) // ดึง 10 อันดับ
            ->get();

        // สินค้าขายดี 6 เดือนย้อนหลัง
        $sixMonthsAgo = $today->copy()->subMonths(6);
        $bestSellingSixMonths = SalesList::select('so_prod_name', SalesList::raw('SUM(so_prod_quantity) as total_quantity'))
            ->whereBetween('created_at', [$sixMonthsAgo, $today])
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc')
            ->take(10) // ดึง 10 อันดับ
            ->get();


        // สินค้าขายดี 3 เดือนย้อนหลัง
        $today = Carbon::now();
        $threeMonthsAgo = $today->copy()->subMonths(3);
        $bestSellingProducts = SalesList::select('so_prod_name', SalesList::raw('SUM(so_prod_quantity) as total_quantity'))
            ->whereBetween('created_at', [$threeMonthsAgo, $today])
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc')
            ->take(6)
            ->get();

        // ส่งชื่อและจำนวนสินค้าขายดีไปที่ View
        $productNames = $bestSellingProducts->pluck('so_prod_name');
        $productQuantities = $bestSellingProducts->pluck('total_quantity');


        // สินค้าขายดี 6 เดือนย้อนหลัง
        $today = Carbon::now();
        $sixMonthsAgo = $today->copy()->subMonths(6);
        $bestSellingProductsSixMonths = SalesList::select('so_prod_name', SalesList::raw('SUM(so_prod_quantity) as total_quantity'))
            ->whereBetween('created_at', [$sixMonthsAgo, $today])
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc')
            ->take(6)
            ->get();

        // ส่งชื่อและจำนวนสินค้าขายดีไปที่ View สำหรับช่วง 6 เดือน
        $productNamesSixMonths = $bestSellingProductsSixMonths->pluck('so_prod_name');
        $productQuantitiesSixMonths = $bestSellingProductsSixMonths->pluck('total_quantity');

        // สินค้าขายดีในช่วง 1 ปี
        $today = Carbon::now();
        $oneYearAgo = $today->copy()->subYear();

        // ดึงข้อมูลจำนวนสินค้าที่ขายดีตามเดือน
        $salesData = SalesList::join('sales_orders', 'sales_lists.so_id', '=', 'sales_orders.so_id')->select(
            SalesOrder::raw('MONTH(so_date) as month'),
            SalesList::raw('SUM(so_prod_quantity) as total_quantity')
        )
            ->whereBetween('so_date', [$oneYearAgo, $today])
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // ส่งชื่อเดือนและจำนวนสินค้าไปที่ View
        $months = $salesData->pluck('month');
        $quantities = $salesData->pluck('total_quantity');

        return view(
            'dashboard.index',
            compact(
                'title',
                'users',
                'productcount',
                'pos',
                'pls',
                'sos',
                'sls',
                'bestSellingToday',
                'bestSellingThreeMonths',
                'bestSellingSixMonths',
                'productNames',
                'productQuantities',
                'productNamesSixMonths',
                'productQuantitiesSixMonths',
                'months',
                'quantities',
            )
        );
    }
}
