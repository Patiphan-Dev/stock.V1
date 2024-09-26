<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PurchaseList;
use App\Models\ProductList;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Purchase Order'
        ];
        $POs = PurchaseOrder::all();
        $products = ProductList::all();


        // พิมพ์ค่าของตัวแปรเพื่อดีบัก
        // dd(array_merge($data, compact('users')));

        return view('purchaseorder.index', array_merge($data, compact('POs', 'products')));
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

        return view('purchaseorder.addPO', array_merge($data, compact('POs', 'Prods', 'PurchaseOrder')));
    }

    public function create(Request $request)
    {
        $date = Carbon::now();
        // dd($request);

        // Validate input
        $request->validate([
            'po_date' => ['required', 'date'],
            'po_company_name' => ['required', 'max:250'],
            'po_company_address' => ['required', 'max:250'],
            'po_company_tel' => ['required', 'max:10'],
            'po_company_taxpayer_number' => ['required', 'max:13'],
            'po_total_price' => ['required'],
            'po_vat' => ['required'],

            'po_prod_name.*' => ['required'],
            'po_prod_quantity.*' => ['required', 'numeric'],
            'po_prod_price_per_unit.*' => ['required', 'numeric'],
            'po_prod_price.*' => ['required', 'numeric'],
        ]);

        // Generate PO ID
        $poid = 'PO' . $date->format('ymd') . '/' . $date->format('ms');

        // Use DB transaction to handle insertions
        DB::transaction(function () use ($request, $poid) {
            // Create the PurchaseOrder
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

            // Insert each product into PurchaseList and update or create in ProductList
            foreach ($request->po_prod_name as $i => $prodName) {

                 // Handle null product name
                 if ($prodName === null) {
                    $prodName = $request->input("po_prod_name.{$i}"); // Adjust accordingly to get the null name
                }

                // Handle custom product name
                if ($prodName === 'custom') {
                    $prodName = $request->input("custom_prod_name.{$i}"); // Adjust accordingly to get the custom name
                }


                // Insert into PurchaseList
                PurchaseList::create([
                    'po_id' => $poid,
                    'po_prod_name' => $prodName,
                    'po_prod_quantity' => $request->po_prod_quantity[$i],
                    'po_prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                    'po_prod_price' => $request->po_prod_price[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Check if the product exists in ProductList
                $product = ProductList::where('prod_name', $prodName)->first();

                if (!$product) {
                    // Create a new product if it doesn't exist
                    ProductList::create([
                        'po_id' => $poid,
                        'prod_name' => $prodName,
                        'prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                        'prod_buy_qty' => $request->po_prod_quantity[$i],
                        'prod_sales_qty' => 0,
                        'prod_min_qty' => $request->po_prod_quantity[$i],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // Update the existing product's quantity
                    $newQty = $product->prod_buy_qty + $request->po_prod_quantity[$i];
                    $minQty = $newQty - $product->prod_sales_qty;

                    $product->update([
                        'prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                        'prod_buy_qty' => $newQty,
                        'prod_min_qty' => $minQty,
                        'updated_at' => now(),
                    ]);
                }
            }
        });

        // Redirect back to PurchaseOrder
        return redirect()->route('po.index')->with('success', 'นำเข้าสินค้าสำเร็จ');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Purchase Order'
        ];
        $PO = PurchaseOrder::findOrFail($id); // ดึงข้อมูล PO ที่ต้องการแก้ไข
        $PurchaseList = PurchaseList::where('po_id', $PO->po_id)->get(); // ดึงข้อมูล PurchaseList ของ PO นั้น
        $Prods = ProductList::all(); // ดึงข้อมูล Product ทั้งหมด

        return view('purchaseorder.editPO', array_merge($data, compact('PO', 'PurchaseList', 'Prods')));
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'po_date' => ['required', 'date'],
            'po_company_name' => ['required', 'max:250'],
            'po_company_address' => ['required', 'max:250'],
            'po_company_tel' => ['required', 'max:10'],
            'po_company_taxpayer_number' => ['required', 'max:13'],
            'po_total_price' => ['required'],
            'po_vat' => ['required'],

            'po_prod_name.*' => ['required'],
            'po_prod_quantity.*' => ['required', 'numeric'],
            'po_prod_price_per_unit.*' => ['required', 'numeric'],
            'po_prod_price.*' => ['required', 'numeric'],
        ]);

        // Use DB transaction to handle the updates
        DB::transaction(function () use ($request, $id) {
            $PO = PurchaseOrder::findOrFail($id);

            // Update PurchaseOrder
            $PO->update([
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
                'updated_at' => now(),
            ]);

            // Delete existing PurchaseList entries for this PO
            PurchaseList::where('po_id', $PO->po_id)->delete();

            // Insert updated PurchaseList entries
            foreach ($request->po_prod_name as $i => $prodName) {
                PurchaseList::create([
                    'po_id' => $PO->po_id,
                    'po_prod_name' => $prodName,
                    'po_prod_quantity' => $request->po_prod_quantity[$i],
                    'po_prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                    'po_prod_price' => $request->po_prod_price[$i],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Check if the product exists in ProductList
                $product = ProductList::where('prod_name', $prodName)->first();
                $newQty = $request->po_prod_quantity[$i] -  $request->old_quantity[$i];
                $newQtyAll = $product->prod_buy_qty + $newQty;
                $newQtyStock = $product->prod_min_qty + $newQty;

                // dd(
                //     $newQty,
                //     $request->po_prod_quantity[$i],
                //     $request->old_quantity[$i],
                //     $product->prod_buy_qty,
                //     $product->prod_sales_qty,
                //     $product->prod_min_qty,
                //     $newQtyAll,
                //     $newQtyStock
                // );

                $product->update([
                    'prod_price_per_unit' => $request->po_prod_price_per_unit[$i],
                    'prod_price' => $request->po_prod_price[$i],
                    'prod_buy_qty' => $newQtyAll,
                    'prod_min_qty' => $newQtyStock,
                    'updated_at' => now(),
                ]);
            }
        });

        // Redirect back to PurchaseOrder
        return redirect()->route('po.purchaserecord')->with('success', 'อัปเดตข้อมูลสินค้าสำเร็จ');
    }

    public function delete($id)
    {
        // ลบข้อมูลใน PurchaseList ที่มี id ตรงกับที่ระบุ
        $purchaseList = PurchaseList::where('id', $id)->first();

        // Check if the product exists in ProductList
        $product = ProductList::where('prod_name', $purchaseList->po_prod_name)->first();

        $newQtyAll = $product->prod_buy_qty - $purchaseList->po_prod_quantity;
        $newQtyStock = $product->prod_min_qty - $purchaseList->po_prod_quantity;

        // dd(
        //     $purchaseList,
        //     $product,
        //     $purchaseList->po_prod_quantity,
        //     $product->prod_buy_qty,
        //     $product->prod_min_qty,
        //     $newQtyAll,
        //     $newQtyStock
        // );

        $product->update([
            'prod_buy_qty' => $newQtyAll,
            'prod_min_qty' => $newQtyStock,
            'updated_at' => now(),
        ]);

        // ตรวจสอบว่ามีรายการอยู่หรือไม่
        if ($purchaseList) {
            $purchaseList->delete();
            return redirect()->back()->with('success', 'ลบสำเร็จ');
        } else {
            return redirect()->back()->with('error', 'ไม่พบรายการที่ต้องการลบ');
        }
    }
}
