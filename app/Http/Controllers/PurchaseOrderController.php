<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseList;
use App\Models\ProductList;
use App\Models\Company;
use Carbon\Carbon;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Purchase Order'
        ];
        $POs = PurchaseOrder::all();

        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('purchaseorder.index', array_merge($data, compact('POs')));
    }

    public function add()
    {
        $data = [
            'title' => 'Add Purchase Order'
        ];
        $POs = PurchaseOrder::all();
        $Prods = ProductList::all();
        $PurchaseOrder = PurchaseOrder::join('product_lists', 'purchase_orders.po_id', 'product_lists.po_id')
            ->select('purchase_orders.*', 'product_lists.*')
            ->get();

        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('purchaseorder.addPO', array_merge($data, compact('POs', 'Prods', 'PurchaseOrder')));
    }

    public function create(Request $request)
    {

        // dd( $request);
        $date = Carbon::now();
        // Validate
        $request->validate([
            'po_number1' => ['required', 'max:20'],
            'po_number2' => ['required', 'max:20'],
            'po_date' => ['required', 'date'],
            'po_company_name' => ['required', 'max:250'],
            'po_company_address' => ['required', 'max:250'],
            'po_company_tel' => ['required', 'max:10'],
            'po_company_fax' => ['required', 'max:10'],
            'po_company_taxpayer_number' => ['required', 'max:13'],
            'po_total_price' => ['required'],
            'po_vat' => ['required'],

            'po_prod_name.0' => ['required'],
            'po_prod_quantity.0' => ['required'],
            'po_prod_price_per_unit.0' => ['required'],
            'po_prod_price.0' => ['required'],
        ]);

        $poid = 'PO' . $date->format('y') . $date->format('m') . $date->format('d') . '/' . $date->format('m') . $date->format('s');
        // Create a PurchaseOrder
        PurchaseOrder::create([
            'po_id' => $poid,
            'po_number1' => $request->po_number1,
            'po_number2' => $request->po_number2,
            'po_date' => $request->po_date,
            'po_company_name' => $request->po_company_name,
            'po_company_address' => $request->po_company_address,
            'po_company_tel' => $request->po_company_tel,
            'po_company_fax' => $request->po_company_fax,
            'po_company_taxpayer_number' => $request->po_company_taxpayer_number,
            'po_total_price' => $request->po_total_price,
            'po_vat' => $request->po_vat,
            'po_net_price' => $request->po_net_price,
            'po_note' => $request->po_note,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 0; $i < count($request->po_prod_name); $i++) {
            $data = array(
                'po_id' => $poid,
                'po_prod_name' => $request->po_prod_name[$i],
                'po_prod_quantity' => $request->po_prod_quantity[$i],
                'po_prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                'po_prod_price' => $request->po_prod_price[$i],
                'created_at' => now(),
                'updated_at' => now(),
            );

            PurchaseList::insert($data);
        }

        for ($i = 0; $i < count($request->po_prod_name); $i++) {
            // Get the first matching product based on name
            $check = ProductList::where('prod_name', $request->po_prod_name[$i])->first();

            if (!$check) {
                // If no product found, insert a new product
                $data = array(
                    'po_id' => $poid,
                    'prod_name' => $request->po_prod_name[$i],
                    'prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                    'prod_price' => $request->po_prod_price[$i],
                    'prod_buy_qty' => $request->po_prod_quantity[$i],
                    'prod_sales_qty' => 0,
                    'prod_min_qty' => $request->po_prod_quantity[$i],
                    'created_at' => now(),
                    'updated_at' => now(),

                );
                ProductList::insert($data);
            } else {
                // If the product exists, update its quantity

                $qty = $request->po_prod_quantity[$i] + $check->prod_buy_qty;
                $minqty = $qty -  $check->prod_sales_qty;

                $data = array(
                    'po_id' => $poid,
                    'prod_name' => $request->po_prod_name[$i],
                    'prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                    'prod_price' => $request->po_prod_price[$i],
                    'prod_buy_qty' => $qty,
                    'prod_sales_qty' => 0,
                    'prod_min_qty' => $minqty,
                    'updated_at' => now(),
                );

                // Update the existing product instead of inserting
                $check->update($data);
            }
        }



        // Redirect back to PurchaseOrder
        return redirect()->route('po.index')->with('success', 'นำเข้าสินค้าสำเร็จ');
    }
}
