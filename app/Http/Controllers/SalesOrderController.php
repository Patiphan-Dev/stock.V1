<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\SalesList;
use App\Models\ProductList;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SalesOrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Sales Order'
        ];
        $SOs = SalesOrder::all();
        $products = ProductList::all();
        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('salesorder.index', array_merge($data, compact('SOs', 'products')));
    }

    public function add()
    {
        $data = [
            'title' => 'Add Sales Order'
        ];
        $SOs = SalesOrder::all();
        $Prods = ProductList::all();
        $SalesOrder = SalesOrder::join('product_lists', 'sales_orders.so_id', 'product_lists.so_id')
            ->select('sales_orders.*', 'product_lists.*')
            ->get();

        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('salesorder.addSO', array_merge($data, compact('SOs', 'Prods', 'SalesOrder')));
    }

    public function create(Request $request)
    {
        $date = Carbon::now();

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

        // Generate sales order ID
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
            // คำนวณ so_prod_total_length
            $length = $request->so_prod_length[$i] ?? 0; // Default to 0 if not set
            $quantity = $request->so_prod_quantity[$i] ?? 0; // Default to 0 if not set
            $total_length = $length * $quantity; // คำนวณความยาวทั้งหมด

            $data = array(
                'so_id' => $soid,
                'so_prod_name' => $request->so_prod_name[$i],
                'so_prod_length' => $length,
                'so_prod_quantity' => $quantity,
                'so_prod_total_length' => $total_length, // ใช้ค่า total_length ที่คำนวณ
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

        // Redirect back to dashboard
        return back()->with('success', 'นำออกสินค้าสำเร็จ');
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Edit Sales Order'
        ];
        $SO = SalesOrder::findOrFail($id); // ดึงข้อมูล SO ที่ต้องการแก้ไข
        $SalesList = SalesList::with('product')->where('so_id', $SO->so_id)->get(); // ดึงข้อมูล SalesList ของ SO นั้น
        $products = ProductList::all(); // ดึงข้อมูล Product ทั้งหมด

    //    dd($SalesList) ;

        return view('salesorder.editSO', array_merge($data, compact('SO', 'SalesList', 'products')));
    }

    public function update(Request $request, $id)
{
    // Validate input
    $request->validate([
        'so_number' => ['required', 'max:20'],
        'so_date' => ['required', 'date'],
        'so_customer_name' => ['required', 'max:250'],
        'so_customer_address' => ['required', 'max:250'],
        'so_customer_taxpayer_number' => ['required', 'max:13'],
        'so_total_price' => ['required'],
        'so_vat' => ['required'],
        'so_prod_name.*' => ['required'],
        'so_prod_quantity.*' => ['required', 'numeric'],
        'so_prod_price_per_unit.*' => ['required', 'numeric'],
        'so_prod_price.*' => ['required', 'numeric'],
    ]);

    // Use DB transaction to handle the updates
    DB::transaction(function () use ($request, $id) {
        $SO = SalesOrder::findOrFail($id);

        // Update SalesOrder
        $SO->update([
            'so_number' => $request->so_number,
            'so_date' => $request->so_date,
            'so_customer_name' => $request->so_customer_name,
            'so_customer_address' => $request->so_customer_address,
            'so_customer_taxpayer_number' => $request->so_customer_taxpayer_number,
            'so_total_price' => $request->so_total_price,
            'so_vat' => $request->so_vat,
            'so_net_price' => $request->so_net_price,
            'so_note' => $request->so_note,
            'updated_at' => now(),
        ]);

        // Delete existing SalesList entries for this Sales Order
        SalesList::where('so_id', $SO->so_id)->delete();

        // Insert updated SalesList entries
        foreach ($request->so_prod_name as $i => $prodName) {
            // คำนวณ so_prod_total_length
            $length = $request->so_prod_length[$i] ?? 0; // Default to 0 if not set
            $quantity = $request->so_prod_quantity[$i] ?? 0; // Default to 0 if not set
            $totalLength = $length * $quantity; // คำนวณความยาวทั้งหมด

            SalesList::create([
                'so_id' => $SO->so_id,
                'so_prod_name' => $prodName,
                'so_prod_length' => $length,
                'so_prod_quantity' => $quantity,
                'so_prod_total_length' => $totalLength, // ใช้ค่า totalLength ที่คำนวณ
                'so_prod_price_per_unit' => $request->so_prod_price_per_unit[$i],
                'so_prod_price' => $request->so_prod_price[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Check if the product exists in ProductList
            $product = ProductList::where('prod_name', $prodName)->first();

            if ($product) {
                $newQty = $request->so_prod_quantity[$i] - ($request->old_quantity[$i] ?? 0); // ถ้ามี old_quantity ให้ใช้ ถ้าไม่มีก็ใช้ 0
                $newQtyAll = $product->prod_sales_qty + $newQty;
                $newQtyStock = $product->prod_min_qty - $newQty;

                $product->update([
                    'prod_unit' => $request->so_prod_unit[$i],
                    'prod_price_per_unit' => $request->so_prod_price_per_unit[$i],
                    'prod_sales_qty' => $newQtyAll,
                    'prod_min_qty' => $newQtyStock,
                    'updated_at' => now(),
                ]);
            }
        }
    });

    // Redirect back to SalesOrder
    return redirect()->route('so.salesrecord')->with('success', 'อัปเดตข้อมูลสินค้าสำเร็จ');
}


    public function delete($id)
    {
        // ลบข้อมูลใน SalesList ที่มี id ตรงกับที่ระบุ
        $salesList = SalesList::where('id', $id)->first();

        // Check if the product exists in ProductList
        $product = ProductList::where('prod_name', $salesList->so_prod_name)->first();

        $newQtyAll = $product->prod_sales_qty - $salesList->so_prod_quantity;
        $newQtyStock = $product->prod_min_qty + $salesList->so_prod_quantity;

        // dd(
        //     $salesList,
        //     $product,
        //     $salesList->so_prod_quantity,
        //     $product->prod_sales_qty,
        //     $product->prod_min_qty,
        //     $newQtyAll,
        //     $newQtyStock
        // );

        $product->update([
            'prod_sales_qty' => $newQtyAll,
            'prod_min_qty' => $newQtyStock,
            'updated_at' => now(),
        ]);

        // ตรวจสอบว่ามีรายการอยู่หรือไม่
        if ($salesList) {
            $salesList->delete();
            return redirect()->back()->with('success', 'ลบสำเร็จ');
        } else {
            return redirect()->back()->with('error', 'ไม่พบรายการที่ต้องการลบ');
        }
    }
}
