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


class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        $users = User::all();
        $ps = ProductList::all();
        $pos = PurchaseOrder::all();
        $pls = PurchaseList::all();
        $sos = SalesOrder::all();
        $sls = SalesList::all();

        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge(['title' => $title], compact('users')));

        return view('dashboard.index', compact('title', 'users', 'ps', 'pos', 'pls', 'sos', 'sls'));
    }
}
