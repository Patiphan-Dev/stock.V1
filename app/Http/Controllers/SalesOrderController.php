<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\SalesList;
use App\Models\ProductList;
use Carbon\Carbon;

class SalesOrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sales Order'
        ];
        $SOs = SalesOrder::all();

        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('salesorder.index', array_merge($data, compact('SOs')));
    }

    public function add()
    {
        $data = [
            'title' => 'Add Purchase Order'
        ];
        $SOs = SalesOrder::all();
        $Prods = ProductList::all();


        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('salesorder.addSO', array_merge($data, compact('SOs', 'Prods')));
    }

    public function create(Request $request)
    {
        $date = Carbon::now();

        // dd($request);
        // Validate
        $request->validate([
            'so_number' => ['required', 'max:20'],
            'so_date' => ['required', 'date'],
            'so_customer_name' => ['required', 'max:200'],
            'so_customer_address' => ['required', 'max:250'],
            'so_customer_taxpayer_number' => ['required', 'max:13'],
            'so_total_price' => ['required'],
            'so_vat' => ['required'],
            'so_net_price' => ['required'],

            'so_prod_name.0' => ['required'],
            'so_prod_quantity.0' => ['required'],
            'so_prod_price_per_unit.0' => ['required'],
            'so_prod_price.0' => ['required'],

        ]);

        // dd($request);

        $soid = 'SO' . $date->format('y') . $date->format('m') . $date->format('d') . '/' . $date->format('m') . $date->format('s');
        // Create a SalesOrder
        SalesOrder::create([
            'so_id' => $soid,
            'so_number' => $request->so_number,
            'so_date' => $request->so_date,
            'so_customer_name' => $request->so_customer_name,
            'so_customer_address' => $request->so_customer_address,
            'so_customer_taxpayer_number' => $request->so_customer_taxpayer_number,
            'so_total_price' => $request->so_total_price,
            'so_vat' => $request->so_vat,
            'so_net_price' => $request->so_net_price,
            'so_note' => $request->so_note,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Create SalesList
        for ($i = 0; $i < count($request->so_prod_name); $i++) {
            $data = array(
                'so_id' => $soid,
                'so_prod_name' => $request->so_prod_name[$i],
                'so_prod_length' => $request->so_prod_length[$i],
                'so_prod_quantity' => $request->so_prod_quantity[$i],
                'so_prod_total_length' => $request->so_prod_quantity[$i],
                'so_prod_price_per_unit' => $request->so_prod_price_per_unit[$i],
                'so_prod_price' => $request->so_prod_price[$i],
                'created_at' => now(),
                'updated_at' => now(),
            );

            SalesList::insert($data);
        }

        for ($i = 0; $i < count($request->so_prod_name); $i++) {
            // Get the first matching product based on name
            $check = ProductList::where('prod_name', $request->so_prod_name[$i])->first();

            if (!$check) {
                return back()->with('error', 'สินค้าในสต๊อกไม่เพียงพอ');
            } else {
                // If the product exists, update its quantity
                $qty = $request->so_prod_quantity[$i] + $check->prod_sales_qty;
                $minqty = $check->prod_min_qty -  $request->so_prod_quantity[$i];

                $data = array(
                    'prod_sales_qty' => $qty,
                    'prod_min_qty' => $minqty,
                    'updated_at' => now(),
                );

                // Update the existing product instead of inserting
                $check->update($data);
            }
        }

        // Send email when users create a product (for practice)
        // Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $product));

        // Redirect back to dashboard
        return back()->with('success', 'นำออกสินค้าสำเร็จ');
    }
}
