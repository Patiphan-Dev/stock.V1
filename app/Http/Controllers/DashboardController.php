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
            // ->take(10) // ดึงสินค้าขายดี 10 อันดับ
            ->first(); // ใช้ get() เพื่อดึงข้อมูลเป็น Collection

            // สินค้าขายดี 3 เดือนย้อนหลัง
        $threeMonthsAgo = $today->copy()->subMonths(3);
        $bestSellingThreeMonths = SalesList::select('so_prod_name', SalesList::raw('SUM(so_prod_quantity) as total_quantity'))
            ->whereBetween('created_at', [$threeMonthsAgo, $today])
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc')
            // ->take(10)
            ->first();

        // สินค้าขายดี 6 เดือนย้อนหลัง
        $sixMonthsAgo = $today->copy()->subMonths(6);
        $bestSellingSixMonths = SalesList::select('so_prod_name', SalesList::raw('SUM(so_prod_quantity) as total_quantity'))
            ->whereBetween('created_at', [$sixMonthsAgo, $today])
            ->groupBy('so_prod_name')
            ->orderBy('total_quantity', 'desc')
            // ->take(10)
            ->first();


        return view('dashboard.index', compact('title', 'users', 'productcount', 'pos', 'pls', 'sos', 'sls', 'bestSellingToday', 'bestSellingThreeMonths', 'bestSellingSixMonths'));
    }
}
